<?php

namespace App\Filament\Resources\Official\Pages;

use App\Filament\Resources\Official\OfficialResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOfficial extends ViewRecord
{
    protected static string $resource = OfficialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
