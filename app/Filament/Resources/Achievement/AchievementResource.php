<?php

/**
 * Ubicación: `app/Filament/Resources/Achievement/AchievementResource.php`
 *
 * Descripción: Resource Filament para gestionar logros/resultados del gobierno.
 *
 * Grupo: Contenido
 * Roadmap: 12-FUTURO.md — Página de resultados del gobierno
 */

namespace App\Filament\Resources\Achievement;

use App\Filament\Resources\Achievement\Pages\CreateAchievement;
use App\Filament\Resources\Achievement\Pages\EditAchievement;
use App\Filament\Resources\Achievement\Pages\ListAchievements;
use App\Filament\Resources\Achievement\Pages\ViewAchievement;
use App\Filament\Resources\Achievement\Schemas\AchievementForm;
use App\Filament\Resources\Achievement\Schemas\AchievementInfolist;
use App\Filament\Resources\Achievement\Tables\AchievementsTable;
use App\Models\Achievement;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Resultados';

    protected static string|UnitEnum|null $navigationGroup = 'Contenido';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $pluralModelLabel = 'Resultados';

    protected static ?string $modelLabel = 'Resultado';

    public static function form(Schema $schema): Schema
    {
        return AchievementForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AchievementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AchievementsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAchievements::route('/'),
            'create' => CreateAchievement::route('/create'),
            'view' => ViewAchievement::route('/{record}'),
            'edit' => EditAchievement::route('/{record}/edit'),
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
