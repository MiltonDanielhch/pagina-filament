<?php

namespace App\Filament\Resources\InfrastructureProjects\Pages;

use App\Filament\Resources\InfrastructureProjects\InfrastructureProjectResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInfrastructureProject extends ViewRecord
{
    protected static string $resource = InfrastructureProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
