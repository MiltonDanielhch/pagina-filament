<?php

namespace App\Filament\Resources\Office;

use App\Filament\Resources\Office\Pages\CreateOffice;
use App\Filament\Resources\Office\Pages\EditOffice;
use App\Filament\Resources\Office\Pages\ListOffices;
use App\Filament\Resources\Office\Pages\ViewOffice;
use App\Filament\Resources\Office\Schemas\OfficeForm;
use App\Filament\Resources\Office\Tables\OfficesTable;
use App\Models\Office;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OfficeResource extends Resource
{
    protected static ?string $model = Office::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;
    protected static ?string $navigationLabel = 'Oficinas';
    protected static ?string $pluralModelLabel = 'Oficinas de Atención';
    protected static ?string $modelLabel = 'Oficina';
    protected static string|UnitEnum|null $navigationGroup = 'Servicios';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema { return OfficeForm::configure($schema); }
    public static function table(Table $table): Table { return OfficesTable::configure($table); }
    public static function getPages(): array
    {
        return [
            'index' => ListOffices::route('/'),
            'create' => CreateOffice::route('/create'),
            'view' => ViewOffice::route('/{record}'),
            'edit' => EditOffice::route('/{record}/edit'),
        ];
    }
}
