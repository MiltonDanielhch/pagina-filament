<?php

namespace App\Filament\Resources\InfrastructureProjects;

use App\Filament\Resources\InfrastructureProjects\Pages\CreateInfrastructureProject;
use App\Filament\Resources\InfrastructureProjects\Pages\EditInfrastructureProject;
use App\Filament\Resources\InfrastructureProjects\Pages\ListInfrastructureProjects;
use App\Filament\Resources\InfrastructureProjects\Pages\ViewInfrastructureProject;
use App\Filament\Resources\InfrastructureProjects\Schemas\InfrastructureProjectForm;
use App\Filament\Resources\InfrastructureProjects\Schemas\InfrastructureProjectInfolist;
use App\Filament\Resources\InfrastructureProjects\Tables\InfrastructureProjectsTable;
use App\Models\InfrastructureProject;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class InfrastructureProjectResource extends Resource
{
    protected static ?string $model = InfrastructureProject::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static ?string $navigationLabel = 'Proyectos de Infraestructura';

    protected static UnitEnum|string|null $navigationGroup = 'Contenido';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $pluralModelLabel = 'Proyectos de Infraestructura';

    protected static ?string $modelLabel = 'Proyecto de Infraestructura';

    public static function form(Schema $schema): Schema
    {
        return InfrastructureProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InfrastructureProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InfrastructureProjectsTable::configure($table);
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
            'index' => ListInfrastructureProjects::route('/'),
            'create' => CreateInfrastructureProject::route('/create'),
            'view' => ViewInfrastructureProject::route('/{record}'),
            'edit' => EditInfrastructureProject::route('/{record}/edit'),
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
