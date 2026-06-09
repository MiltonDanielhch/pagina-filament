<?php

namespace App\Filament\Resources\MarcoNormativo;

use App\Filament\Resources\MarcoNormativo\Pages\CreateMarcoNormativo;
use App\Filament\Resources\MarcoNormativo\Pages\EditMarcoNormativo;
use App\Filament\Resources\MarcoNormativo\Pages\ListMarcoNormativos;
use App\Filament\Resources\MarcoNormativo\Pages\ViewMarcoNormativo;
use App\Filament\Resources\MarcoNormativo\Schemas\MarcoNormativoForm;
use App\Filament\Resources\MarcoNormativo\Tables\MarcoNormativosTable;
use App\Models\MarcoNormativo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MarcoNormativoResource extends Resource
{
    protected static ?string $model = MarcoNormativo::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;
    protected static ?string $navigationLabel = 'Marco Normativo';
    protected static ?string $pluralModelLabel = 'Marco Normativo';
    protected static ?string $modelLabel = 'Norma';
    protected static string|UnitEnum|null $navigationGroup = 'Transparencia';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema { return MarcoNormativoForm::configure($schema); }
    public static function table(Table $table): Table { return MarcoNormativosTable::configure($table); }
    public static function getPages(): array
    {
        return [
            'index' => ListMarcoNormativos::route('/'),
            'create' => CreateMarcoNormativo::route('/create'),
            'view' => ViewMarcoNormativo::route('/{record}'),
            'edit' => EditMarcoNormativo::route('/{record}/edit'),
        ];
    }
}
