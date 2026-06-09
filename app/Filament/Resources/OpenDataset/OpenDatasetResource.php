<?php

namespace App\Filament\Resources\OpenDataset;

use App\Filament\Resources\OpenDataset\Pages\CreateOpenDataset;
use App\Filament\Resources\OpenDataset\Pages\EditOpenDataset;
use App\Filament\Resources\OpenDataset\Pages\ListOpenDatasets;
use App\Filament\Resources\OpenDataset\Pages\ViewOpenDataset;
use App\Filament\Resources\OpenDataset\Schemas\OpenDatasetForm;
use App\Filament\Resources\OpenDataset\Tables\OpenDatasetsTable;
use App\Models\OpenDataset;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OpenDatasetResource extends Resource
{
    protected static ?string $model = OpenDataset::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCircleStack;
    protected static ?string $navigationLabel = 'Datos Abiertos';
    protected static ?string $pluralModelLabel = 'Conjuntos de Datos Abiertos';
    protected static ?string $modelLabel = 'Dataset';
    protected static string|UnitEnum|null $navigationGroup = 'Transparencia';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema { return OpenDatasetForm::configure($schema); }
    public static function table(Table $table): Table { return OpenDatasetsTable::configure($table); }
    public static function getPages(): array
    {
        return [
            'index' => ListOpenDatasets::route('/'),
            'create' => CreateOpenDataset::route('/create'),
            'view' => ViewOpenDataset::route('/{record}'),
            'edit' => EditOpenDataset::route('/{record}/edit'),
        ];
    }
}
