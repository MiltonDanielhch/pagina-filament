<?php

/**
 * Ubicación: `app/Filament/Resources/Gallery/GalleryResource.php`
 *
 * Descripción: Resource Filament para gestionar álbumes de galería.
 *
 * Grupo: Contenido
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace App\Filament\Resources\Gallery;

use App\Filament\Resources\Gallery\Pages\CreateGallery;
use App\Filament\Resources\Gallery\Pages\EditGallery;
use App\Filament\Resources\Gallery\Pages\ListGalleries;
use App\Filament\Resources\Gallery\Pages\ViewGallery;
use App\Filament\Resources\Gallery\Schemas\GalleryForm;
use App\Filament\Resources\Gallery\Schemas\GalleryInfolist;
use App\Filament\Resources\Gallery\Tables\GalleriesTable;
use App\Filament\Resources\GalleryItems\GalleryItemResource;
use App\Models\Gallery;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Galerías';

    protected static string|UnitEnum|null $navigationGroup = 'Contenido';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $pluralModelLabel = 'Galerías';

    protected static ?string $modelLabel = 'Galería';

    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function form(Schema $schema): Schema
    {
        return GalleryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GalleryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GalleriesTable::configure($table);
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
            'index' => ListGalleries::route('/'),
            'create' => CreateGallery::route('/create'),
            'view' => ViewGallery::route('/{record}'),
            'edit' => EditGallery::route('/{record}/edit'),
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
