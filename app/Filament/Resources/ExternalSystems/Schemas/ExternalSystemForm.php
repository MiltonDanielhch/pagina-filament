<?php

namespace App\Filament\Resources\ExternalSystems\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ExternalSystemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('url')
                    ->label('URL')
                    ->url()
                    ->required(),
                TextInput::make('description')
                    ->label('Descripción'),
                TextInput::make('icon')
                    ->label('Ícono'),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->required(),
                TextInput::make('order')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('last_status')
                    ->label('Último estado')
                    ->options([
                        'online' => 'En línea', 
                        'offline' => 'Fuera de línea', 
                        'unknown' => 'Desconocido'
                    ])
                    ->default('unknown')
                    ->required(),
                DateTimePicker::make('last_checked_at')
                    ->label('Última verificación'),
            ]);
    }
}