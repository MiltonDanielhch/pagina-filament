<?php
namespace App\Filament\Resources\Secretariat\Pages;
use App\Filament\Resources\Secretariat\SecretariatResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
class ViewSecretariat extends ViewRecord
{
    protected static string $resource = SecretariatResource::class;
    protected function getHeaderActions(): array { return [EditAction::make()]; }
}
