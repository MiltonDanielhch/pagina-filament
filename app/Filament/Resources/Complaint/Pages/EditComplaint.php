<?php
namespace App\Filament\Resources\Complaint\Pages;
use App\Filament\Resources\Complaint\ComplaintResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditComplaint extends EditRecord
{
    protected static string $resource = ComplaintResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
