<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                RichEditor::make('content')
                    ->label('Contenido')
                    ->columnSpanFull(),
                TextInput::make('meta_title')
                    ->label('Meta título'),
                Textarea::make('meta_description')
                    ->label('Meta descripción')
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Publicado')
                    ->required(),
            ]);
    }
}