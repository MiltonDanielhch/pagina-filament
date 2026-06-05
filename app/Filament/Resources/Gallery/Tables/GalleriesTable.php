<?php

/**
 * Ubicación: `app/Filament/Resources/Gallery/Tables/GalleriesTable.php`
 *
 * Descripción: Configuración de tabla para galerías.
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace App\Filament\Resources\Gallery\Tables;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('Portada')
                    ->collection('cover')
                    ->circular()
                    ->size(60),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'photo' => 'Fotos',
                        'video' => 'Videos',
                        'mixed' => 'Mixto',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'photo' => 'info',
                        'video' => 'warning',
                        'mixed' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('item_count')
                    ->label('Ítems')
                    ->counts('items')
                    ->sortable(),
                TextColumn::make('event_date')
                    ->label('Fecha')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'published' => 'success',
                        'draft' => 'gray',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
