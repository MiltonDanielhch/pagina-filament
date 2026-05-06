<?php

namespace App\Filament\Resources\ExternalSystems\Pages;

use App\Filament\Resources\ExternalSystems\ExternalSystemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditExternalSystem extends EditRecord
{
    protected static string $resource = ExternalSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
