<?php
namespace App\Filament\Resources\Complaint\Pages;
use App\Filament\Resources\Complaint\ComplaintResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewComplaint extends ViewRecord
{
    protected static string $resource = ComplaintResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}
