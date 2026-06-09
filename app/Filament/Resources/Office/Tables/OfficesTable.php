<?php

namespace App\Filament\Resources\Office\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class OfficesTable
{
    public static function configure(Table $table): Table
    {
        return $table->defaultSort('sort_order')
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable()->wrap()->limit(40),
                TextColumn::make('municipality')->label('Municipio')->placeholder('—'),
                TextColumn::make('phone')->label('Teléfono')->placeholder('—'),
                TextColumn::make('email')->label('Email')->placeholder('—')->searchable(),
                TextColumn::make('schedule')->label('Horario')->placeholder('—'),
                IconColumn::make('is_active')->label('Activo')->boolean(),
            ])
            ->filters([TernaryFilter::make('is_active')->label('Activo')])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
