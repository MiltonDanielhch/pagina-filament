<?php

namespace App\Filament\Resources\DepartmentalStatistics\Pages;

use App\Filament\Resources\DepartmentalStatistics\DepartmentalStatisticsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartmentalStatistics extends ViewRecord
{
    protected static string $resource = DepartmentalStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
