<?php

namespace App\Filament\Resources\Turismo\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TurismoDestinoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('title')->label('Título'),
            TextEntry::make('category')->label('Categoría')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'cultura' => 'amber',
                    'santuario' => 'emerald',
                    'home' => 'teal',
                    'biodiversidad' => 'cyan',
                    'galeria' => 'purple',
                    default => 'gray',
                }),
            SpatieMediaLibraryImageEntry::make('image')
                ->collection('images')
                ->label('Imagen'),
            TextEntry::make('description')->label('Descripción')->placeholder('-'),
            TextEntry::make('location_name')->label('Ubicación')->placeholder('-'),
            TextEntry::make('badge_label')->label('Etiqueta')->placeholder('-'),
            TextEntry::make('sort_order')->label('Orden')->numeric(),
            IconEntry::make('is_published')->label('Publicado')->boolean(),
            TextEntry::make('created_at')->label('Creado')->dateTime()->placeholder('-'),
            TextEntry::make('updated_at')->label('Actualizado')->dateTime()->placeholder('-'),
        ]);
    }
}
