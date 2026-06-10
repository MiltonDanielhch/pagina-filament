<?php

/**
 * Ubicación: `app/Filament/Resources/InfrastructureProjects/Tables/InfrastructureProjectsTable.php`
 *
 * Descripción: Configuración de tabla para proyectos de inversión.
 *
 * Cumplimiento: 14-cumplimiento-normativo-rm067-2025.md — Bloque B4.
 */

namespace App\Filament\Resources\InfrastructureProjects\Tables;

use App\Models\InfrastructureProject;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class InfrastructureProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->square()
                    ->size(48),
                TextColumn::make('code')
                    ->label('Código')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(60),
                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => InfrastructureProject::categories()[$state] ?? $state)
                    ->color('info'),
                TextColumn::make('municipality')
                    ->label('Municipio')
                    ->formatStateUsing(fn (string $state): string => str_replace('_', ' ', ucwords($state, '_')))
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        InfrastructureProject::STATUS_PLANNING  => 'blue',
                        InfrastructureProject::STATUS_PROGRESS  => 'warning',
                        InfrastructureProject::STATUS_COMPLETED => 'success',
                        InfrastructureProject::STATUS_PARALYZED => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => InfrastructureProject::statuses()[$state] ?? $state),
                TextColumn::make('progress_percentage')
                    ->label('Avance')
                    ->suffix('%')
                    ->numeric()
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('budget')
                    ->label('Presupuesto')
                    ->money('BOB')
                    ->sortable(),
                TextColumn::make('secretariat.name')
                    ->label('Secretaría')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('—'),
                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->alignCenter(),
                TextColumn::make('start_date')
                    ->label('Inicio')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('end_date_planned')
                    ->label('Conclusión prevista')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('end_date_real')
                    ->label('Conclusión real')
                    ->date('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoría')
                    ->options(InfrastructureProject::categories()),
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options(InfrastructureProject::statuses()),
                SelectFilter::make('secretariat_id')
                    ->label('Secretaría')
                    ->relationship('secretariat', 'name')
                    ->preload(),
                TernaryFilter::make('is_featured')
                    ->label('Destacado'),
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
