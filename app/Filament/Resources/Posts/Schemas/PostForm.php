<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Autor')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name'),
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, $set) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                SpatieMediaLibraryFileUpload::make('image')
                    ->label('Imagen')
                    ->collection('featured')
                    ->multiple(false),
                Textarea::make('excerpt')
                    ->label('Extracto')
                    ->columnSpanFull(),
                RichEditor::make('body')
                    ->label('Contenido')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'draft' => 'Borrador', 
                        'published' => 'Publicado', 
                        'archived' => 'Archivado'
                    ])
                    ->default('draft')
                    ->required(),
                Toggle::make('is_pinned')
                    ->label('Destacado'),
                DateTimePicker::make('published_at')
                    ->label('Fecha de publicación'),
                TextInput::make('meta_title')
                    ->label('Meta título'),
                Textarea::make('meta_description')
                    ->label('Meta descripción')
                    ->columnSpanFull(),
            ]);
    }
}