<?php
namespace App\Filament\Resources\Announcement\Pages;
use App\Filament\Resources\Announcement\AnnouncementResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewAnnouncement extends ViewRecord
{
    protected static string $resource = AnnouncementResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}
