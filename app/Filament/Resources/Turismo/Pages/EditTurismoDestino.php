<?php

namespace App\Filament\Resources\Turismo\Pages;

use App\Filament\Resources\Turismo\TurismoDestinoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTurismoDestino extends EditRecord
{
    protected static string $resource = TurismoDestinoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
