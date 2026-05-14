<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                Toggle::make('show_in_menu')
                    ->label('Mostrar en menú')
                    ->default(false),
                TextInput::make('menu_order')
                    ->label('Orden en menú')
                    ->numeric()
                    ->default(0),
            ]);
    }
}