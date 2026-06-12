<?php

namespace App\Filament\Resources\MarcoNormativo\Tables;

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

class MarcoNormativosTable
{
    public static function configure(Table $table): Table
    {
        return $table->defaultSort('sort_order')
            ->columns([
                TextColumn::make('type')
                    ->label('Tipo')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ley' => 'danger', 'decreto_supremo' => 'warning',
                        'decreto' => 'info', 'resolución' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('number')->label('N°')->placeholder('—')->searchable(),
                TextColumn::make('title')->label('Título')->searchable()->wrap()->limit(50),
                TextColumn::make('scope')
                    ->label('Ámbito')->badge()
                    ->color(fn (string $state): string => $state === 'nacional' ? 'primary' : 'success'),
                TextColumn::make('issue_date')->label('Fecha')->date('d/m/Y')->sortable(),
                IconColumn::make('is_published')->label('Publicado')->boolean(),
            ])
            ->filters([
                SelectFilter::make('type')->label('Tipo'),
                SelectFilter::make('scope')->label('Ámbito'),
                TernaryFilter::make('is_published')->label('Publicado'),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
