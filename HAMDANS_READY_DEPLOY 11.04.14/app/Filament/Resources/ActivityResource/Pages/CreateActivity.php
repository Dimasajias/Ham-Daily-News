<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Enums\ActivityStatus;
use App\Enums\Platform;
use App\Filament\Resources\ActivityResource;
use App\Jobs\ScrapeActivityJob;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;

class CreateActivity extends CreateRecord
{
    protected static string $resource = ActivityResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        $data['user_id'] = $user->id;
        $data['office_id'] = $user->office_id ?? 1;
        $data['status'] = ActivityStatus::Pending;

        // Auto-detect platform dari URL jika user memilih 'other' atau tidak memilih
        if (!empty($data['social_media_links'])) {
            $data['social_media_links'] = collect($data['social_media_links'])
                ->map(function ($link) {
                    if (empty($link['platform']) || $link['platform'] === 'other') {
                        $detected = Platform::detectFromUrl($link['url'] ?? '');
                        if ($detected !== Platform::Other) {
                            $link['platform'] = $detected->value;
                        }
                    }
                    return $link;
                })
                ->filter(fn ($link) => !empty($link['url'])) // Hapus entry tanpa URL
                ->values()
                ->toArray();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        // Dispatch scraping job jika ada link
        $links = $this->record->social_media_links ?? [];
        if (!empty($links)) {
            ScrapeActivityJob::dispatch($this->record);
        }

        // Compress foto_dokumentasi to max 100KB without cropping
        if ($this->record->foto_dokumentasi) {
            $this->compressImage($this->record->foto_dokumentasi);
        }
    }

    protected function compressImage(string $path, int $maxSizeKb = 100): void
    {
        $disk = Storage::disk('public');
        $fullPath = $disk->path($path);

        if (!file_exists($fullPath)) {
            return;
        }

        // Already under limit
        if (filesize($fullPath) <= $maxSizeKb * 1024) {
            return;
        }

        $imageInfo = getimagesize($fullPath);
        if (!$imageInfo) {
            return;
        }

        // Load image based on type
        $image = match ($imageInfo['mime']) {
            'image/jpeg' => imagecreatefromjpeg($fullPath),
            'image/png' => imagecreatefrompng($fullPath),
            'image/webp' => imagecreatefromwebp($fullPath),
            default => null,
        };

        if (!$image) {
            return;
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $maxLimit = $maxSizeKb * 1024;

        // Step 1: Try quality reduction first (no resize)
        $quality = 85;
        $data = '';
        do {
            ob_start();
            imagejpeg($image, null, $quality);
            $data = ob_get_clean();

            if (strlen($data) <= $maxLimit) {
                break;
            }
            $quality -= 5;
        } while ($quality >= 40);

        // Step 2: If still too large, scale down proportionally (no crop)
        if (strlen($data) > $maxLimit) {
            $scale = 0.8; // reduce by 20% each iteration
            $currentWidth = $width;
            $currentHeight = $height;

            while (strlen($data) > $maxLimit && $currentWidth > 200) {
                $currentWidth = (int) ($currentWidth * $scale);
                $currentHeight = (int) ($currentHeight * $scale);

                $resized = imagecreatetruecolor($currentWidth, $currentHeight);

                // Preserve transparency for PNG
                imagealphablending($resized, false);
                imagesavealpha($resized, true);

                // Scale without cropping — maintains aspect ratio
                imagecopyresampled($resized, $image, 0, 0, 0, 0, $currentWidth, $currentHeight, $width, $height);

                ob_start();
                imagejpeg($resized, null, $quality);
                $data = ob_get_clean();

                imagedestroy($resized);
            }
        }

        // Save compressed image as JPEG
        $jpegPath = preg_replace('/\.[^.]+$/', '.jpg', $fullPath);
        file_put_contents($jpegPath, $data);

        // If original extension changed, update record and remove old file
        if ($jpegPath !== $fullPath) {
            @unlink($fullPath);
            $newRelativePath = preg_replace('/\.[^.]+$/', '.jpg', $path);
            $this->record->update(['foto_dokumentasi' => $newRelativePath]);
        }

        imagedestroy($image);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
