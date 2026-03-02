<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = auth()->user();

        // ──── 16:00 Local Time Restriction ────
        if (!$user->isAdmin() && $user->office) {
            $tz = $user->office->timezone;
            if (now()->timezone($tz)->hour >= 16) {
                Notification::make()
                    ->title('Batas Waktu Terlewati')
                    ->body("Batas waktu pengeditan kegiatan adalah pukul 16:00 waktu setempat ({$tz}). Waktu di wilayah instalasi Anda saat ini menunjukkan pukul " . now()->timezone($tz)->format('H:i') . ".")
                    ->danger()
                    ->send();

                $this->halt();
            }
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
