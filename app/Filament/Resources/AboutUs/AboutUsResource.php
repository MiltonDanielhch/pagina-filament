<?php

namespace App\Filament\Resources\AboutUs;

use App\Filament\Resources\AboutUs\Pages\CreateAboutUs;
use App\Filament\Resources\AboutUs\Pages\EditAboutUs;
use App\Filament\Resources\AboutUs\Pages\ListAboutUs;
use App\Filament\Resources\AboutUs\Pages\ViewAboutUs;
use App\Filament\Resources\AboutUs\Schemas\AboutUsForm;
use App\Filament\Resources\AboutUs\Schemas\AboutUsInfolist;
use App\Filament\Resources\AboutUs\Tables\AboutUsTable;
use App\Models\AboutUs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutUsResource extends Resource
{
    protected static ?string $model = AboutUs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Sobre Nosotros';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationGroup(): string
    {
        return 'La Gobernación';
    }

    public static function form(Schema $schema): Schema
    {
        return AboutUsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AboutUsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AboutUsTable::configure($table);
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
            'index' => ListAboutUs::route('/'),
            'create' => CreateAboutUs::route('/create'),
            'view' => ViewAboutUs::route('/{record}'),
            'edit' => EditAboutUs::route('/{record}/edit'),
        ];
    }
}
