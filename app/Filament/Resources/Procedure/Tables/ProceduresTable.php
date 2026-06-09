<?php

namespace App\Filament\Resources\Procedure\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProceduresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('code')
                    ->label('Código')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->wrap()
                    ->limit(50),
                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'salud' => 'danger',
                        'educacion' => 'warning',
                        'catastro', 'impuestos' => 'success',
                        'infraestructura' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('cost')
                    ->label('Costo')
                    ->money('BOB')
                    ->placeholder('Gratuito'),
                TextColumn::make('processing_time_days')
                    ->label('Días')
                    ->suffix(' d.')
                    ->placeholder('—'),
                IconColumn::make('is_online')
                    ->label('Online')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'activo' => 'success',
                        'suspendido' => 'warning',
                        'dado_de_baja' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Categoría')
                    ->options([
                        'salud' => 'Salud', 'educacion' => 'Educación',
                        'infraestructura' => 'Infraestructura', 'catastro' => 'Catastro',
                        'impuestos' => 'Impuestos', 'ganaderia' => 'Ganadería',
                    ]),
                TernaryFilter::make('is_online')->label('En línea'),
                TernaryFilter::make('is_featured')->label('Destacado'),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
