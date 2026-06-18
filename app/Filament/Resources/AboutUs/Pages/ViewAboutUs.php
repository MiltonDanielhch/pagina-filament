<?php

namespace App\Filament\Resources\AboutUs\Pages;

use App\Filament\Resources\AboutUs\AboutUsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAboutUs extends ViewRecord
{
    protected static string $resource = AboutUsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
