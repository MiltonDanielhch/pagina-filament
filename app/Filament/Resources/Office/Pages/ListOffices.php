<?php
namespace App\Filament\Resources\Office\Pages;
use App\Filament\Resources\Office\OfficeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListOffices extends ListRecords
{
    protected static string $resource = OfficeResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
