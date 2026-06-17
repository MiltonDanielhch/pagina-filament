<?php

namespace App\Filament\Resources\Official\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class OfficialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->label('Foto')
                    ->collection('officials')
                    ->square(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('position')
                    ->label('Cargo')
                    ->searchable(),
                TextColumn::make('area')
                    ->label('Área')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('gray'),
                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                SelectFilter::make('area')
                    ->label('Área')
                    ->options([
                        'Gobernación' => 'Gobernación',
                        'Secretaría de Planificación' => 'Secretaría de Planificación',
                        'Secretaría de Hacienda' => 'Secretaría de Hacienda',
                        'Secretaría de Obras Públicas' => 'Secretaría de Obras Públicas',
                        'Secretaría de Educación' => 'Secretaría de Educación',
                        'Secretaría de Salud' => 'Secretaría de Salud',
                        'Secretaría de Desarrollo Productivo' => 'Secretaría de Desarrollo Productivo',
                        'Secretaría de Tierras' => 'Secretaría de Tierras',
                        'Secretaría de Transparencia' => 'Secretaría de Transparencia',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
