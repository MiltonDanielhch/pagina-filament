<?php

namespace App\Filament\Resources\Secretariat\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class SecretariatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Información General')->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Nombre')
                        ->required()->maxLength(255),
                    TextInput::make('acronym')
                        ->label('Sigla')
                        ->maxLength(20),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('contact_email')
                        ->label('Email de contacto')
                        ->email(),
                    TextInput::make('contact_phone')
                        ->label('Teléfono')
                        ->tel(),
                ]),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3),
            ]),

            Section::make('Misión, Visión y Objetivos')->schema([
                Textarea::make('mission')
                    ->label('Misión')
                    ->rows(2),
                Textarea::make('vision')
                    ->label('Visión')
                    ->rows(2),
                Repeater::make('objectives')
                    ->label('Objetivos')
                    ->schema([
                        TextInput::make('objective')->label('Objetivo')->required(),
                    ])
                    ->columnSpanFull()
                    ->collapsible(),
            ]),

            Section::make('Organización')->schema([
                Grid::make(2)->schema([
                    Select::make('parent_secretariat_id')
                        ->label('Secretaría padre')
                        ->relationship('parent', 'name')
                        ->placeholder('— Ninguna (raíz) —')
                        ->searchable(),
                    Select::make('head_official_id')
                        ->label('Secretario/a actual')
                        ->relationship('head', 'name')
                        ->searchable()
                        ->preload(),
                ]),
                TextInput::make('office_address')
                    ->label('Dirección de oficina'),
            ]),

            Section::make('Apariencia y Configuración')->schema([
                Grid::make(3)->schema([
                    FileUpload::make('logo_path')
                        ->label('Logo')
                        ->image()
                        ->disk('public')
                        ->directory('secretariats')
                        ->imagePreviewHeight(80),
                    ColorPicker::make('color')
                        ->label('Color institucional')
                        ->default('#0f766e'),
                    TextInput::make('sort_order')
                        ->label('Orden')
                        ->numeric()->default(0),
                ]),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ]),
        ]);
    }
}
