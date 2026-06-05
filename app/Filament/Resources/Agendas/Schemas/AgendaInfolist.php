<?php

/**
 * Ubicación: `app/Filament/Resources/Agendas/Schemas/AgendaInfolist.php`
 *
 * Descripción: Infolist para ver detalles de agenda.
 *
 * Roadmap: 12-FUTURO.md — Agenda del gobernador
 */

namespace App\Filament\Resources\Agendas\Schemas;

use App\Models\Agenda;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class AgendaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Título'),
                        TextEntry::make('slug')
                            ->label('Slug'),
                    ]),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->placeholder('-')
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextEntry::make('date')
                            ->label('Fecha')
                            ->date('d/m/Y'),
                        TextEntry::make('time')
                            ->label('Hora')
                            ->time('H:i'),
                    ]),
                TextEntry::make('location')
                    ->label('Lugar'),
                Grid::make(2)
                    ->schema([
                        IconEntry::make('is_public')
                            ->label('Público')
                            ->boolean(),
                        TextEntry::make('status')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'published' => 'success',
                                'cancelled' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match($state) {
                                'published' => 'Publicado',
                                'cancelled' => 'Cancelado',
                                default => $state,
                            }),
                    ]),
                TextEntry::make('user.name')
                    ->label('Creado por'),
            ]);
    }
}
