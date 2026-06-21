<?php

namespace App\Filament\Resources\DepartmentalStatistics;

use App\Filament\Resources\DepartmentalStatistics\Pages\CreateDepartmentalStatistics;
use App\Filament\Resources\DepartmentalStatistics\Pages\EditDepartmentalStatistics;
use App\Filament\Resources\DepartmentalStatistics\Pages\ListDepartmentalStatistics;
use App\Filament\Resources\DepartmentalStatistics\Pages\ViewDepartmentalStatistics;
use App\Filament\Resources\DepartmentalStatistics\Schemas\DepartmentalStatisticsForm;
use App\Filament\Resources\DepartmentalStatistics\Schemas\DepartmentalStatisticsInfolist;
use App\Filament\Resources\DepartmentalStatistics\Tables\DepartmentalStatisticsTable;
use App\Models\DepartmentalStatistics;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class DepartmentalStatisticsResource extends Resource
{
    protected static ?string $model = DepartmentalStatistics::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Estadísticas Departamentales';

    protected static UnitEnum|string|null $navigationGroup = 'Comunicación';

    protected static ?string $recordTitleAttribute = 'year';

    protected static ?string $pluralModelLabel = 'Estadísticas Departamentales';

    protected static ?string $modelLabel = 'Estadística Departamental';

    public static function form(Schema $schema): Schema
    {
        return DepartmentalStatisticsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DepartmentalStatisticsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartmentalStatisticsTable::configure($table);
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
            'index' => ListDepartmentalStatistics::route('/'),
            'create' => CreateDepartmentalStatistics::route('/create'),
            'view' => ViewDepartmentalStatistics::route('/{record}'),
            'edit' => EditDepartmentalStatistics::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user']);
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->with(['user']);
    }
}
