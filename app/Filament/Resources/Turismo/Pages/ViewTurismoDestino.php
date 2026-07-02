<?php

namespace App\Filament\Resources\Turismo\Pages;

use App\Filament\Resources\Turismo\TurismoDestinoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTurismoDestino extends ViewRecord
{
    protected static string $resource = TurismoDestinoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
