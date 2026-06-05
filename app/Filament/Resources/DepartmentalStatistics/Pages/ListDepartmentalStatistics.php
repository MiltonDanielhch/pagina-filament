<?php

namespace App\Filament\Resources\DepartmentalStatistics\Pages;

use App\Filament\Resources\DepartmentalStatistics\DepartmentalStatisticsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDepartmentalStatistics extends ListRecords
{
    protected static string $resource = DepartmentalStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
