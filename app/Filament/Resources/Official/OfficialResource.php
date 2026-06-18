<?php

/**
 * Ubicación: `app/Filament/Resources/Official/OfficialResource.php`
 *
 * Descripción: Resource Filament para gestionar funcionarios/autoridades.
 *
 * Grupo: Contenido
 * Roadmap: 12-FUTURO.md — Directorio de funcionarios
 */

namespace App\Filament\Resources\Official;

use App\Filament\Resources\Official\Pages\CreateOfficial;
use App\Filament\Resources\Official\Pages\EditOfficial;
use App\Filament\Resources\Official\Pages\ListOfficials;
use App\Filament\Resources\Official\Pages\ViewOfficial;
use App\Filament\Resources\Official\Schemas\OfficialForm;
use App\Filament\Resources\Official\Schemas\OfficialInfolist;
use App\Filament\Resources\Official\Tables\OfficialsTable;
use App\Models\Official;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficialResource extends Resource
{
    protected static ?string $model = Official::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Autoridades';

    protected static string|UnitEnum|null $navigationGroup = 'La Gobernación';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Autoridades';

    protected static ?string $modelLabel = 'Funcionario';

    public static function form(Schema $schema): Schema
    {
        return OfficialForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OfficialInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OfficialsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOfficials::route('/'),
            'create' => CreateOfficial::route('/create'),
            'view' => ViewOfficial::route('/{record}'),
            'edit' => EditOfficial::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
