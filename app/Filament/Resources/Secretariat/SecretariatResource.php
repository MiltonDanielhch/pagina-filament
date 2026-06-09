<?php

namespace App\Filament\Resources\Secretariat;

use App\Filament\Resources\Secretariat\Pages\CreateSecretariat;
use App\Filament\Resources\Secretariat\Pages\EditSecretariat;
use App\Filament\Resources\Secretariat\Pages\ListSecretariats;
use App\Filament\Resources\Secretariat\Pages\ViewSecretariat;
use App\Filament\Resources\Secretariat\Schemas\SecretariatForm;
use App\Filament\Resources\Secretariat\Tables\SecretariatsTable;
use App\Models\Secretariat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SecretariatResource extends Resource
{
    protected static ?string $model = Secretariat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?string $navigationLabel = 'Secretarías';

    protected static ?string $pluralModelLabel = 'Secretarías Departamentales';

    protected static ?string $modelLabel = 'Secretaría';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SecretariatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SecretariatsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSecretariats::route('/'),
            'create' => CreateSecretariat::route('/create'),
            'view' => ViewSecretariat::route('/{record}'),
            'edit' => EditSecretariat::route('/{record}/edit'),
        ];
    }
}
