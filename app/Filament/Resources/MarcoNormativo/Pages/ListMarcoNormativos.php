<?php
namespace App\Filament\Resources\MarcoNormativo\Pages;
use App\Filament\Resources\MarcoNormativo\MarcoNormativoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListMarcoNormativos extends ListRecords
{
    protected static string $resource = MarcoNormativoResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
