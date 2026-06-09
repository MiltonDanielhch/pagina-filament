<?php
namespace App\Filament\Resources\Procedure\Pages;
use App\Filament\Resources\Procedure\ProcedureResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewProcedure extends ViewRecord
{
    protected static string $resource = ProcedureResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}
