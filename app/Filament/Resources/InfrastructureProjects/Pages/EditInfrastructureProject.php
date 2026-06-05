<?php

namespace App\Filament\Resources\InfrastructureProjects\Pages;

use App\Filament\Resources\InfrastructureProjects\InfrastructureProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInfrastructureProject extends EditRecord
{
    protected static string $resource = InfrastructureProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
