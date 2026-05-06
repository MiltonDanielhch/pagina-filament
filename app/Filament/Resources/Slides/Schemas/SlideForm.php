<?php

namespace App\Filament\Resources\Slides\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->required(),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->image()
                    ->required(),
                TextInput::make('link')
                    ->label('Enlace'),
                TextInput::make('description')
                    ->label('Descripción'),
                TextInput::make('order')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->required(),
            ]);
    }
}