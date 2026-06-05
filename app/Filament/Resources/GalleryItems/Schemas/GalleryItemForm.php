<?php

/**
 * Ubicación: `app/Filament/Resources/GalleryItems/Schemas/GalleryItemForm.php`
 *
 * Descripción: Formulario para crear/editar ítems de galería.
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace App\Filament\Resources\GalleryItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GalleryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('gallery_id')
                    ->label('Galería')
                    ->relationship('gallery', 'title')
                    ->required(),
                Grid::make(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Título'),
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'image' => 'Imagen',
                                'video' => 'Video (YouTube)',
                            ])
                            ->default('image')
                            ->required()
                            ->live(),
                    ]),
                Textarea::make('caption')
                    ->label('Descripción')
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Imagen')
                            ->image()
                            ->directory('gallery-items')
                            ->visible(fn (callable $get) => $get('type') === 'image'),
                        TextInput::make('video_url')
                            ->label('URL de YouTube')
                            ->url()
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->live()
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state) {
                                    $youtubeId = \App\Models\GalleryItem::extractYoutubeId($state);
                                    if ($youtubeId) {
                                        $set('youtube_id', $youtubeId);
                                    }
                                }
                            })
                            ->visible(fn (callable $get) => $get('type') === 'video'),
                    ]),
                TextInput::make('youtube_id')
                    ->label('ID de YouTube')
                    ->disabled()
                    ->dehydrated()
                    ->visible(fn (callable $get) => $get('type') === 'video'),
                TextInput::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
