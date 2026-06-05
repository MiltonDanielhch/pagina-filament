<?php

namespace App\Filament\Resources\Achievement\Schemas;

use Filament\Schemas\Schema;

class AchievementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Section::make('Información del Logro')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('title')
                            ->label('Título del logro')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('area')
                            ->label('Área de gobierno')
                            ->placeholder('Ej: Salud, Educación, Infraestructura')
                            ->maxLength(100),
                        \Filament\Forms\Components\DatePicker::make('achieved_at')
                            ->label('Fecha del logro'),
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'draft' => 'Borrador',
                                'published' => 'Publicado',
                            ])
                            ->default('draft')
                            ->required(),
                    ])
                    ->columns(2),
                \Filament\Forms\Components\Section::make('Descripción')
                    ->schema([
                        \Filament\Forms\Components\RichEditor::make('description')
                            ->label('Descripción completa')
                            ->required()
                            ->toolbar(fn () => [
                                'bold', 'italic', 'underline', 'strike',
                                'h2', 'h3',
                                'bulletList', 'orderedList',
                                'link', 'blockquote', 'codeBlock',
                                'undo', 'redo',
                            ]),
                    ]),
                \Filament\Forms\Components\Section::make('Imagen')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('image')
                            ->label('Imagen')
                            ->image()
                            ->disk('public')
                            ->directory('achievements')
                            ->imagePreviewHeight(200),
                    ]),
            ]);
    }
}
