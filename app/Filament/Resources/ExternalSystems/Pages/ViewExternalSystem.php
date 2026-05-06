<?php

namespace App\Filament\Resources\ExternalSystems\Pages;

use App\Filament\Resources\ExternalSystems\ExternalSystemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewExternalSystem extends ViewRecord
{
    protected static string $resource = ExternalSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
