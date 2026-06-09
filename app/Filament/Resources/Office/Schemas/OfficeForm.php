<?php

namespace App\Filament\Resources\Office\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class OfficeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Datos básicos')->schema([
                TextInput::make('name')->label('Nombre')->required()->columnSpanFull(),
                TextInput::make('address')->label('Dirección')->required()->columnSpanFull(),
            ]),
            Section::make('Ubicación y contacto')->schema([
                Grid::make(2)->schema([
                    TextInput::make('municipality')->label('Municipio'),
                    TextInput::make('phone')->label('Teléfono')->tel(),
                    TextInput::make('email')->label('Email')->email(),
                    TextInput::make('schedule')->label('Horario')->placeholder('Lun-Vie 08:00-16:00'),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('latitude')->label('Latitud')->numeric()->step(0.0000001),
                    TextInput::make('longitude')->label('Longitud')->numeric()->step(0.0000001),
                ]),
            ]),
            Section::make('Configuración')->schema([
                Grid::make(2)->schema([
                    TextInput::make('sort_order')->label('Orden')->numeric()->default(0),
                    Toggle::make('is_active')->label('Activo')->default(true),
                ]),
            ]),
        ]);
    }
}
