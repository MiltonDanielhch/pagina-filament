<?php

/**
 * Ubicación: `app/Filament/Resources/Agendas/Schemas/AgendaForm.php`
 *
 * Descripción: Formulario para agenda del gobernador.
 *
 * Roadmap: 12-FUTURO.md — Agenda del gobernador
 */

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ]),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        DatePicker::make('date')
                            ->label('Fecha')
                            ->required()
                            ->native(false),
                        TimePicker::make('time')
                            ->label('Hora')
                            ->required()
                            ->native(false),
                    ]),
                TextInput::make('location')
                    ->label('Lugar')
                    ->required()
                    ->maxLength(255),
                Grid::make(2)
                    ->schema([
                        Toggle::make('is_public')
                            ->label('Público')
                            ->default(true)
                            ->inline(false),
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'published' => 'Publicado',
                                'cancelled' => 'Cancelado',
                            ])
                            ->required()
                            ->default('published'),
                    ]),
            ]);
    }
}
