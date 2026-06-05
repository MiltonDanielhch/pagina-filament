<?php

namespace App\Filament\Resources\DepartmentalStatistics\Pages;

use App\Filament\Resources\DepartmentalStatistics\DepartmentalStatisticsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDepartmentalStatistics extends EditRecord
{
    protected static string $resource = DepartmentalStatisticsResource::class;

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
