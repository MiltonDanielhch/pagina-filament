<?php

namespace App\Filament\Resources\Announcement\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AnnouncementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('publication_date', 'desc')
            ->columns([
                TextColumn::make('code')
                    ->label('Código')
                    ->badge()->color('info')->searchable(),
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->wrap()
                    ->limit(60),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->badge(),
                TextColumn::make('publication_date')
                    ->label('Publicación')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('closing_date')
                    ->label('Cierre')
                    ->date('d/m/Y')
                    ->placeholder('—'),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'borrador' => 'gray',
                        'publicada' => 'info',
                        'en_proceso' => 'warning',
                        'finalizada' => 'success',
                        'desierta' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('type')->label('Tipo')->options([
                    'convocatoria_publica' => 'Convocatoria Pública',
                    'contratacion' => 'Contratación',
                    'consultoria' => 'Consultoría',
                ]),
                SelectFilter::make('status')->label('Estado')->options([
                    'borrador' => 'Borrador', 'publicada' => 'Publicada',
                    'en_proceso' => 'En proceso', 'finalizada' => 'Finalizada',
                ]),
            ])
            ->recordActions([ViewAction::make(), EditAction::make(), DeleteAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
