<?php

namespace App\Filament\Resources\Procedure;

use App\Filament\Resources\Procedure\Pages\CreateProcedure;
use App\Filament\Resources\Procedure\Pages\EditProcedure;
use App\Filament\Resources\Procedure\Pages\ListProcedures;
use App\Filament\Resources\Procedure\Pages\ViewProcedure;
use App\Filament\Resources\Procedure\Schemas\ProcedureForm;
use App\Filament\Resources\Procedure\Tables\ProceduresTable;
use App\Models\Procedure;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProcedureResource extends Resource
{
    protected static ?string $model = Procedure::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Trámites';

    protected static ?string $pluralModelLabel = 'Catálogo de Trámites';
    protected static ?string $modelLabel = 'Trámite';

    protected static string|UnitEnum|null $navigationGroup = 'Servicios';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProcedureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProceduresTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProcedures::route('/'),
            'create' => CreateProcedure::route('/create'),
            'view' => ViewProcedure::route('/{record}'),
            'edit' => EditProcedure::route('/{record}/edit'),
        ];
    }
}
