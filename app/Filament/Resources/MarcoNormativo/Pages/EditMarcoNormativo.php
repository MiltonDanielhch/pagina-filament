<?php
namespace App\Filament\Resources\MarcoNormativo\Pages;
use App\Filament\Resources\MarcoNormativo\MarcoNormativoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditMarcoNormativo extends EditRecord
{
    protected static string $resource = MarcoNormativoResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
