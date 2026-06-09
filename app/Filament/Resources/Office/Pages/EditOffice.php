<?php
namespace App\Filament\Resources\Office\Pages;
use App\Filament\Resources\Office\OfficeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditOffice extends EditRecord
{
    protected static string $resource = OfficeResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
