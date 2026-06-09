<?php
namespace App\Filament\Resources\Secretariat\Pages;
use App\Filament\Resources\Secretariat\SecretariatResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditSecretariat extends EditRecord
{
    protected static string $resource = SecretariatResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
