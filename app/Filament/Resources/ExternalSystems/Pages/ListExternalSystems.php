<?php

namespace App\Filament\Resources\ExternalSystems\Pages;

use App\Filament\Resources\ExternalSystems\ExternalSystemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExternalSystems extends ListRecords
{
    protected static string $resource = ExternalSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}