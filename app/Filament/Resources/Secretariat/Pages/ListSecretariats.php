<?php
namespace App\Filament\Resources\Secretariat\Pages;
use App\Filament\Resources\Secretariat\SecretariatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListSecretariats extends ListRecords
{
    protected static string $resource = SecretariatResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
