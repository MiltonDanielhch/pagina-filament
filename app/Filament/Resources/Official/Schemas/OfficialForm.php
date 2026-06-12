<?php

namespace App\Filament\Resources\Official\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class OfficialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Información Personal')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre completo')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('position')
                            ->label('Cargo')
                            ->required()
                            ->maxLength(255),
                        Select::make('secretariat_id')
                            ->label('Secretaría')
                            ->relationship('secretariat', 'name')
                            ->searchable()
                            ->preload(),
                        TextInput::make('area')
                            ->label('Área')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Ej: Salud, Educación, Infraestructura'),
                        Select::make('parent_id')
                            ->label('Depende de (organigrama)')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->helperText('Funcionario del que depende jerárquicamente'),
                        TextInput::make('email')
                            ->label('Email institucional')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->maxLength(50),
                        FileUpload::make('image')
                            ->label('Fotografía')
                            ->image()
                            ->disk('public')
                            ->directory('officials')
                            ->imagePreviewHeight(150),
                    ])
                    ->columns(2),
                \Filament\Schemas\Components\Section::make('Biografía y Funciones')
                    ->schema([
                        Textarea::make('bio')
                            ->label('Biografía corta')
                            ->rows(3)
                            ->maxLength(500),
                        Textarea::make('function')
                            ->label('Funciones del cargo')
                            ->rows(3),
                    ]),
                \Filament\Schemas\Components\Section::make('Configuración')
                    ->schema([
                        Select::make('position_level')
                            ->label('Nivel jerárquico')
                            ->options([
                                1 => '1 — Gobernador',
                                2 => '2 — Vicegobernador',
                                3 => '3 — Secretario Departamental',
                                4 => '4 — Director',
                                5 => '5 — Jefe de Unidad',
                                6 => '6 — Técnico / Profesional',
                            ])
                            ->default(6)
                            ->required(),
                        TextInput::make('sort_order')
                            ->label('Orden de aparición')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Funcionario activo')
                            ->default(true),
                    ])
                    ->columns(3),
            ]);
    }
}
