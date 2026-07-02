<?php

namespace App\Filament\Resources\Turismo\Pages;

use App\Filament\Resources\Turismo\TurismoDestinoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTurismoDestinos extends ListRecords
{
    protected static string $resource = TurismoDestinoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
