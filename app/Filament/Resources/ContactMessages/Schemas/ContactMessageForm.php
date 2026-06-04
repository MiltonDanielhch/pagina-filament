<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Mensaje')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->disabled()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->disabled()
                            ->maxLength(255),
                        TextInput::make('subject')
                            ->label('Asunto')
                            ->required()
                            ->disabled()
                            ->maxLength(255),
                        Textarea::make('message')
                            ->label('Mensaje')
                            ->required()
                            ->disabled()
                            ->columnSpanFull()
                            ->rows(5),
                        Toggle::make('is_read')
                            ->label('Leído')
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }
}
