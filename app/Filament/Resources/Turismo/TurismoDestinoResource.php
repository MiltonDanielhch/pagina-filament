<?php

namespace App\Filament\Resources\Turismo;

use App\Filament\Resources\Turismo\Pages\CreateTurismoDestino;
use App\Filament\Resources\Turismo\Pages\EditTurismoDestino;
use App\Filament\Resources\Turismo\Pages\ListTurismoDestinos;
use App\Filament\Resources\Turismo\Pages\ViewTurismoDestino;
use App\Filament\Resources\Turismo\Schemas\TurismoDestinoForm;
use App\Filament\Resources\Turismo\Schemas\TurismoDestinoInfolist;
use App\Filament\Resources\Turismo\Tables\TurismoDestinosTable;
use App\Models\TurismoDestino;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TurismoDestinoResource extends Resource
{
    protected static ?string $model = TurismoDestino::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAmericas;

    protected static ?string $navigationLabel = 'Destinos Turísticos';

    protected static ?string $pluralModelLabel = 'Destinos Turísticos';

    protected static ?string $modelLabel = 'Destino';

    protected static string|UnitEnum|null $navigationGroup = 'Turismo';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return TurismoDestinoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TurismoDestinoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TurismoDestinosTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTurismoDestinos::route('/'),
            'create' => CreateTurismoDestino::route('/create'),
            'view' => ViewTurismoDestino::route('/{record}'),
            'edit' => EditTurismoDestino::route('/{record}/edit'),
        ];
    }
}
