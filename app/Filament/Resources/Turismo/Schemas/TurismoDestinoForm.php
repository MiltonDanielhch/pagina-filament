<?php

namespace App\Filament\Resources\Turismo\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class TurismoDestinoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Información del Destino')->schema([
                Grid::make(2)->schema([
                    TextInput::make('title')->label('Título')->required(),
                    Select::make('category')
                        ->label('Categoría')
                        ->required()
                        ->options([
                            'home' => 'Home - Destacado',
                            'cultura' => 'Cultura y Tradición',
                            'santuario' => 'Santuarios Naturales',
                            'biodiversidad' => 'Biodiversidad',
                            'galeria' => 'Galería',
                        ])
                        ->default('home'),
                ]),
                Grid::make(2)->schema([
                    TextInput::make('location_name')->label('Ubicación'),
                    TextInput::make('badge_label')->label('Etiqueta'),
                ]),
                Textarea::make('description')->label('Descripción')->rows(4)->columnSpanFull(),
            ]),
            Section::make('Imagen')->schema([
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Imagen del destino')
                    ->collection('images')
                    ->multiple(false)
                    ->image()
                    ->maxSize(51200),
            ]),
            Section::make('Configuración')->schema([
                Grid::make(2)->schema([
                    TextInput::make('sort_order')->label('Orden')->numeric()->default(0),
                    Toggle::make('is_published')->label('Publicado')->default(true),
                ]),
            ]),
        ]);
    }
}
