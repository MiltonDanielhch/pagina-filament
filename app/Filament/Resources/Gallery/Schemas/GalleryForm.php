<?php

/**
 * Ubicación: `app/Filament/Resources/Gallery/Schemas/GalleryForm.php`
 *
 * Descripción: Formulario para crear/editar galerías.
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace App\Filament\Resources\Gallery\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GalleryForm
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
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                $set('slug', Str::slug($state));
                            }),
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'photo' => 'Fotos',
                                'video' => 'Videos',
                                'mixed' => 'Mixto',
                            ])
                            ->default('photo')
                            ->required(),
                    ]),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        DateTimePicker::make('event_date')
                            ->label('Fecha del evento')
                            ->native(false),
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'draft' => 'Borrador',
                                'published' => 'Publicado',
                            ])
                            ->default('draft')
                            ->required(),
                    ]),
                SpatieMediaLibraryFileUpload::make('cover')
                    ->label('Imagen de portada')
                    ->collection('cover')
                    ->multiple(false)
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->label('Destacado')
                    ->default(false),
            ]);
    }
}
