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
                \Filament\Forms\Components\Section::make('Información Personal')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre completo')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('position')
                            ->label('Cargo')
                            ->required()
                            ->maxLength(255),
                        Select::make('area')
                            ->label('Área de gobierno')
                            ->options([
                                'Gobernación' => 'Gobernación',
                                'Secretaría de Planificación' => 'Secretaría de Planificación',
                                'Secretaría de Hacienda' => 'Secretaría de Hacienda',
                                'Secretaría de Obras Públicas' => 'Secretaría de Obras Públicas',
                                'Secretaría de Educación' => 'Secretaría de Educación',
                                'Secretaría de Salud' => 'Secretaría de Salud',
                                'Secretaría de Desarrollo Productivo' => 'Secretaría de Desarrollo Productivo',
                                'Secretaría de Tierras' => 'Secretaría de Tierras',
                                'Secretaría de Transparencia' => 'Secretaría de Transparencia',
                            ])
                            ->required(),
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
                \Filament\Forms\Components\Section::make('Biografía')
                    ->schema([
                        Textarea::make('bio')
                            ->label('Biografía corta')
                            ->rows(3)
                            ->maxLength(500),
                    ]),
                \Filament\Forms\Components\Section::make('Configuración')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Funcionario activo')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Orden de aparición')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
