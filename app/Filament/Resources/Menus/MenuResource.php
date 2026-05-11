<?php

/**
 * Ubicación: `app/Filament/Resources/Menus/MenuResource.php`
 *
 * Descripción: Resource Filament para gestionar menús de navegación. Soporta
 *              items anidados y relación con páginas/posts.
 *
 * Grupo: Contenido
 * Roadmap: 05-BACKEND.md — Bloque 5.2
 */

namespace App\Filament\Resources\Menus;

use App\Filament\Resources\Menus\Pages\CreateMenu;
use App\Filament\Resources\Menus\Pages\EditMenu;
use App\Filament\Resources\Menus\Pages\ListMenus;
use App\Filament\Resources\Menus\Pages\ViewMenu;
use App\Filament\Resources\Menus\Schemas\MenuForm;
use App\Filament\Resources\Menus\Schemas\MenuInfolist;
use App\Filament\Resources\Menus\Tables\MenusTable;
use App\Models\Menu;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Icons\Heroicon;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    protected static ?string $navigationLabel = 'Menús';

    protected static string|UnitEnum|null $navigationGroup = 'Gestión';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $pluralModelLabel = 'Menús';

    protected static ?string $modelLabel = 'Menú';

    public static function form(Schema $schema): Schema
    {
        return MenuForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MenuInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            MenuItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenus::route('/'),
            'create' => CreateMenu::route('/create'),
            'view' => ViewMenu::route('/{record}'),
            'edit' => EditMenu::route('/{record}/edit'),
        ];
    }
}

class MenuItemsRelationManager extends RelationManager
{
    public static function getRelationshipName(): string
    {
        return 'items';
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('label')
                    ->label('Etiqueta')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->searchable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('page.title')
                    ->label('Página')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('order')
                    ->label('Orden')
                    ->sortable(),
                \Filament\Tables\Columns\BooleanColumn::make('is_active')
                    ->label('Activo'),
            ])
            ->headerActions([
                \Filament\Actions\CreateAction::make(),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->reorderable('order');
    }
}