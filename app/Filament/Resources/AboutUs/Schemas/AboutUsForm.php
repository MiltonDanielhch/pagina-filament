<?php

namespace App\Filament\Resources\AboutUs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class AboutUsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->columnSpanFull(),
                RichEditor::make('history')
                    ->label('Reseña Histórica')
                    ->columnSpanFull(),
                RichEditor::make('mission')
                    ->label('Misión')
                    ->columnSpanFull(),
                RichEditor::make('vision')
                    ->label('Visión')
                    ->columnSpanFull(),
                RichEditor::make('objectives')
                    ->label('Objetivos')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->directory('about')
                    ->image()
                    ->maxSize(5120)
                    ->columnSpanFull(),
            ]);
    }
}
