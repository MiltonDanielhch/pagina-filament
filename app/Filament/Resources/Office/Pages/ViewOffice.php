<?php
namespace App\Filament\Resources\Office\Pages;
use App\Filament\Resources\Office\OfficeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewOffice extends ViewRecord
{
    protected static string $resource = OfficeResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}
