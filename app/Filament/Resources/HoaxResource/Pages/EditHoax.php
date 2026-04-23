<?php

namespace App\Filament\Resources\HoaxResource\Pages;

use App\Filament\Resources\HoaxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHoax extends EditRecord
{
    protected static string $resource = HoaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['is_published']) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
