<?php
namespace App\Filament\Resources\OpenDataset\Pages;
use App\Filament\Resources\OpenDataset\OpenDatasetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewOpenDataset extends ViewRecord
{
    protected static string $resource = OpenDatasetResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}
