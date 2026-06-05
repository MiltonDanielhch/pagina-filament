<?php

/**
 * Ubicación: `app/Filament/Resources/DepartmentalStatistics/Tables/DepartmentalStatisticsTable.php`
 *
 * Descripción: Configuración de tabla para estadísticas departamentales.
 *
 * Roadmap: 12-FUTURO.md — Sistema de Estadísticas Departamentales
 */

namespace App\Filament\Resources\DepartmentalStatistics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class DepartmentalStatisticsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('year')
                    ->label('Año')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('population')
                    ->label('Población')
                    ->numeric()
                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('gdp_billion_usd')
                    ->label('PIB (USD)')
                    ->numeric()
                    ->formatStateUsing(fn ($state) => '$' . number_format($state ?? 0, 2, ',', '.') . 'B')
                    ->sortable(),
                TextColumn::make('gdp_per_capita_usd')
                    ->label('PIB per cápita')
                    ->numeric()
                    ->formatStateUsing(fn ($state) => '$' . number_format($state ?? 0, 2, ',', '.'))
                    ->sortable(),
                TextColumn::make('schools')
                    ->label('Escuelas')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('hospitals')
                    ->label('Hospitales')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('data_source')
                    ->label('Fuente')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('user.name')
                    ->label('Actualizado por')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('year', 'desc')
            ->filters([
                TrashedFilter::make(),
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
