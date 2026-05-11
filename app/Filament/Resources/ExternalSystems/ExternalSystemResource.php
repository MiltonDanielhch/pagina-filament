<?php

/**
 * Ubicación: `app/Filament/Resources/ExternalSystems/ExternalSystemResource.php`
 *
 * Descripción: Resource Filament para gestionar sistemas externos. Incluye
 *              campos URL, estado de health check automático.
 *
 * Grupo: Administración
 * Roadmap: 05-BACKEND.md — Bloque 5.2
 */

namespace App\Filament\Resources\ExternalSystems;

use App\Filament\Resources\ExternalSystems\Pages\CreateExternalSystem;
use App\Filament\Resources\ExternalSystems\Pages\EditExternalSystem;
use App\Filament\Resources\ExternalSystems\Pages\ListExternalSystems;
use App\Filament\Resources\ExternalSystems\Pages\ViewExternalSystem;
use App\Filament\Resources\ExternalSystems\Schemas\ExternalSystemForm;
use App\Filament\Resources\ExternalSystems\Schemas\ExternalSystemInfolist;
use App\Filament\Resources\ExternalSystems\Tables\ExternalSystemsTable;
use App\Models\ExternalSystem;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExternalSystemResource extends Resource
{
    protected static ?string $model = ExternalSystem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    protected static ?string $navigationLabel = 'Sistemas externos';

    protected static string|UnitEnum|null $navigationGroup = 'Multimedia';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Sistemas externos';

    protected static ?string $modelLabel = 'Sistema externo';

    public static function form(Schema $schema): Schema
    {
        return ExternalSystemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExternalSystemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExternalSystemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExternalSystems::route('/'),
            'create' => CreateExternalSystem::route('/create'),
            'view' => ViewExternalSystem::route('/{record}'),
            'edit' => EditExternalSystem::route('/{record}/edit'),
        ];
    }
}