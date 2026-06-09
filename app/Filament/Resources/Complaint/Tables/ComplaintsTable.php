<?php

namespace App\Filament\Resources\Complaint\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ComplaintsTable
{
    public static function configure(Table $table): Table
    {
        return $table->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('code')->label('Código')->badge()->color('info')->searchable(),
                TextColumn::make('type')->label('Tipo')->badge(),
                TextColumn::make('full_name')->label('Ciudadano')->searchable(),
                TextColumn::make('subject')->label('Asunto')->wrap()->limit(50)->searchable(),
                TextColumn::make('status')
                    ->label('Estado')->badge()
                    ->color(fn (string $s): string => match ($s) {
                        'recibido' => 'info', 'en_proceso' => 'warning',
                        'resuelto' => 'success', 'rechazado' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->label('Recibido')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')->label('Tipo'),
                SelectFilter::make('status')->label('Estado'),
            ])
            ->recordActions([ViewAction::make(), EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
