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
        $record = $this->getRecord();

        // Jika kegiatan yang diedit berstatus Approved,
        // kembalikan ke Pending untuk review ulang oleh admin.
        // approved_at TIDAK di-reset agar tetap memakai tanggal pertama kali di-approve.
        if ($record->status === ActivityStatus::Approved) {
            $data['status'] = ActivityStatus::Pending->value;

            // Pastikan approved_at tetap tersimpan (tidak berubah)
            unset($data['approved_at']);

            Notification::make()
                ->title('Kegiatan Diedit')
                ->body('Status kegiatan dikembalikan ke Pending untuk review ulang. Tanggal persetujuan awal tetap dipertahankan.')
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
