<?php

namespace App\Filament\Resources\InfrastructureProjects\Pages;

use App\Filament\Resources\InfrastructureProjects\InfrastructureProjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInfrastructureProjects extends ListRecords
{
    protected static string $resource = InfrastructureProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
