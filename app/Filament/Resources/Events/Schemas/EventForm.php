<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Autor')
                    ->relationship('user', 'name')
                    ->required(),
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
                Textarea::make('description')
                    ->label('Descripción')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('location')
                    ->label('Lugar'),
                DateTimePicker::make('starts_at')
                    ->label('Fecha de inicio')
                    ->required(),
                DateTimePicker::make('ends_at')
                    ->label('Fecha de fin'),
                Toggle::make('is_featured')
                    ->label('Destacado'),
                Select::make('status')
                    ->label('Estado')
                    ->options(['draft' => 'Borrador', 'published' => 'Publicado'])
                    ->default('draft')
                    ->required(),
            ]);
    }
}