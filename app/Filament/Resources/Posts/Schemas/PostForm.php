<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Forms\Components\TiptapEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

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
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                Textarea::make('excerpt')
                    ->label('Extracto')
                    ->columnSpanFull(),
                TiptapEditor::make('body')
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