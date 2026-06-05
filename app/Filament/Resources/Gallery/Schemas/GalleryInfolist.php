<?php

/**
 * Ubicación: `app/Filament/Resources/Gallery/Schemas/GalleryInfolist.php`
 *
 * Descripción: Infolist para ver detalles de galerías.
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace App\Filament\Resources\Gallery\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class GalleryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Título'),
                        TextEntry::make('slug')
                            ->label('Slug'),
                        TextEntry::make('type')
                            ->label('Tipo')
                            ->formatStateUsing(fn (string $state): string => match($state) {
                                'photo' => 'Fotos',
                                'video' => 'Videos',
                                'mixed' => 'Mixto',
                                default => $state,
                            }),
                        TextEntry::make('description')
                            ->label('Descripción')
                            ->columnSpanFull(),
                        TextEntry::make('event_date')
                            ->label('Fecha del evento')
                            ->date('d/m/Y'),
                        TextEntry::make('status')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'published' => 'success',
                                'draft' => 'gray',
                                default => 'gray',
                            }),
                        IconEntry::make('is_featured')
                            ->label('Destacado')
                            ->boolean(),
                    ]),
                Grid::make(1)
                    ->schema([
                        SpatieMediaLibraryImageEntry::make('cover')
                            ->label('Portada')
                            ->collection('cover')
                            ->height(300),
                    ]),
                Grid::make(1)
                    ->schema([
                        TextEntry::make('item_count')
                            ->label('Total de ítems'),
                    ]),
            ]);
    }
}
