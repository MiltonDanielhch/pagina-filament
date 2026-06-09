<?php
namespace App\Filament\Resources\OpenDataset\Pages;
use App\Filament\Resources\OpenDataset\OpenDatasetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListOpenDatasets extends ListRecords
{
    protected static string $resource = OpenDatasetResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
