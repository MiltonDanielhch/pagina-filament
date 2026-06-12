<?php

namespace App\Filament\Resources\Achievement\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Str;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información del Logro')
                    ->schema([
                        Grid::make(2)->schema([
                            Select::make('user_id')
                                ->label('Autor')
                                ->relationship('user', 'name')
                                ->default(fn () => auth()->id())
                                ->disabled(fn () => !auth()->user()?->hasRole('super_admin'))
                                ->dehydrated()
                                ->required(),
                            Select::make('status')
                                ->label('Estado')
                                ->options([
                                    'draft' => 'Borrador',
                                    'published' => 'Publicado',
                                ])
                                ->default('draft')
                                ->required(),
                        ]),
                        TextInput::make('title')
                            ->label('Título del logro')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                        TextInput::make('area')
                            ->label('Área de gobierno')
                            ->placeholder('Ej: Salud, Educación, Infraestructura')
                            ->maxLength(100),
                        DatePicker::make('achieved_at')
                            ->label('Fecha del logro'),
                    ])
                    ->columns(2),
                Section::make('Descripción')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Descripción completa')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                Section::make('Imagen')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Imagen')
                            ->collection('featured')
                            ->multiple(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
