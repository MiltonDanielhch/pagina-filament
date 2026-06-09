<?php

namespace App\Filament\Resources\OpenDataset\Tables;

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

class OpenDatasetsTable
{
    public static function configure(Table $table): Table
    {
        return $table->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')->label('Título')->searchable()->wrap()->limit(60),
                TextColumn::make('category')->label('Categoría')->badge(),
                TextColumn::make('publisher')->label('Publicador')->placeholder('—'),
                TextColumn::make('update_frequency')->label('Frecuencia')->badge(),
                TextColumn::make('last_updated_at')->label('Actualizado')->date('d/m/Y')->sortable(),
                TextColumn::make('download_count')->label('Descargas')->numeric()->sortable(),
                IconColumn::make('is_published')->label('Publicado')->boolean(),
            ])
            ->filters([
                SelectFilter::make('category')->label('Categoría'),
                TernaryFilter::make('is_published')->label('Publicado'),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
