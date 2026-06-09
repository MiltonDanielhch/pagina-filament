<?php
namespace App\Filament\Resources\OpenDataset\Pages;
use App\Filament\Resources\OpenDataset\OpenDatasetResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditOpenDataset extends EditRecord
{
    protected static string $resource = OpenDatasetResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
