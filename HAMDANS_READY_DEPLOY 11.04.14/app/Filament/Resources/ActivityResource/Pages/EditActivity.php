<?php

namespace App\Filament\Resources\ActivityResource\Pages;

use App\Filament\Resources\ActivityResource;
use App\Enums\ActivityStatus;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditActivity extends EditRecord
{
    protected static string $resource = ActivityResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $user = auth()->user();
        $record = $this->getRecord();

        // Jika yang mengedit adalah user wilayah (regional)
        // Dan status saat ini bukan Draft
        if ($user->hasRole('regional') && $record->status !== ActivityStatus::Draft) {
            // Set status kembali ke Pending agar direview ulang admin
            $data['status'] = ActivityStatus::Pending->value;
            
            Notification::make()
                ->title('Perubahan Disimpan')
                ->body('Kegiatan telah dikembalikan ke status Pending untuk review ulang oleh admin.')
                ->warning()
                ->send();
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
