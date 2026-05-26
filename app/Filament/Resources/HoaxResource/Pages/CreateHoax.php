<?php

namespace App\Filament\Resources\HoaxResource\Pages;

use App\Filament\Resources\HoaxResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHoax extends CreateRecord
{
    protected static string $resource = HoaxResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();
        $data['user_id'] = $user->id;
        $data['office_id'] = $user->office_id;

        if (!empty($data['is_published']) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}
