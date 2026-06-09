<?php
namespace App\Filament\Resources\MarcoNormativo\Pages;
use App\Filament\Resources\MarcoNormativo\MarcoNormativoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewMarcoNormativo extends ViewRecord
{
    protected static string $resource = MarcoNormativoResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}
