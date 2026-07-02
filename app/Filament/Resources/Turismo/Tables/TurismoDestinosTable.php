<?php

namespace App\Filament\Resources\Turismo\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TurismoDestinosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('')
                    ->collection('images')
                    ->size(48)
                    ->circular(),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->wrap()
                    ->limit(40),
                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'cultura' => 'amber',
                        'santuario' => 'emerald',
                        'home' => 'teal',
                        'biodiversidad' => 'cyan',
                        'galeria' => 'purple',
                        default => 'gray',
                    }),
                TextColumn::make('location_name')
                    ->label('Ubicación')
                    ->searchable()
                    ->placeholder('—'),
                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'home' => 'Home - Destacado',
                        'cultura' => 'Cultura y Tradición',
                        'santuario' => 'Santuarios Naturales',
                        'biodiversidad' => 'Biodiversidad',
                        'galeria' => 'Galería',
                    ]),
                TernaryFilter::make('is_published')
                    ->label('Publicado'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
