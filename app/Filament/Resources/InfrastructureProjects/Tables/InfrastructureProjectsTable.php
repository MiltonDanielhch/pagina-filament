<?php

/**
 * Ubicación: `app/Filament/Resources/InfrastructureProjects/Tables/InfrastructureProjectsTable.php`
 *
 * Descripción: Configuración de tabla para proyectos de infraestructura.
 *
 * Roadmap: 12-FUTURO.md — Mapa interactivo del Beni
 */

namespace App\Filament\Resources\InfrastructureProjects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class InfrastructureProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Categoría')
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'salud' => 'Salud',
                        'educacion' => 'Educación',
                        'infraestructura' => 'Infraestructura',
                        'agua' => 'Agua y Saneamiento',
                        'energia' => 'Energía',
                        'transporte' => 'Transporte',
                        'otro' => 'Otro',
                        default => $state,
                    }),
                TextColumn::make('municipality')
                    ->label('Municipio')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'planned' => 'gray',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'planned' => 'Planificado',
                        'in_progress' => 'En Progreso',
                        'completed' => 'Completado',
                        default => $state,
                    }),
                TextColumn::make('budget')
                    ->label('Presupuesto')
                    ->money('BOB')
                    ->sortable(),
                TextColumn::make('start_date')
                    ->label('Inicio')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('completion_date')
                    ->label('Finalización')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'salud' => 'Salud',
                        'educacion' => 'Educación',
                        'infraestructura' => 'Infraestructura',
                        'agua' => 'Agua y Saneamiento',
                        'energia' => 'Energía',
                        'transporte' => 'Transporte',
                        'otro' => 'Otro',
                    ]),
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'planned' => 'Planificado',
                        'in_progress' => 'En Progreso',
                        'completed' => 'Completado',
                    ]),
                TrashedFilter::make(),
            ])
            ->defaultSort('created_at', 'desc')
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
