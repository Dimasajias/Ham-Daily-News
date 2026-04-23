<?php

namespace App\Filament\Resources\HoaxResource\Pages;

use App\Filament\Resources\HoaxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHoaxes extends ListRecords
{
    protected static string $resource = HoaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
