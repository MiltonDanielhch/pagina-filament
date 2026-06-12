<?php

namespace App\Filament\Resources\Announcement\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identificación')->schema([
                Grid::make(2)->schema([
                    TextInput::make('code')
                        ->label('Código')
                        ->required()
                        ->placeholder('GAD-BENI-2026-001')
                        ->maxLength(50),
                    Select::make('type')
                        ->label('Tipo')
                        ->options([
                            'convocatoria_publica' => 'Convocatoria Pública',
                            'contratacion' => 'Contratación',
                            'consultoria' => 'Consultoría',
                            'otro' => 'Otro',
                        ])->required()->default('convocatoria_publica'),
                ]),
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->columnSpanFull(),
            ]),
            Section::make('Contenido')->schema([
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(5)
                    ->columnSpanFull(),
                Textarea::make('requirements')
                    ->label('Requisitos / DBC')
                    ->rows(5)
                    ->columnSpanFull(),
            ]),
            Section::make('Fechas y Estado')->schema([
                Grid::make(2)->schema([
                    DateTimePicker::make('publication_date')
                        ->label('Fecha de publicación'),
                    DateTimePicker::make('opening_date')
                        ->label('Apertura'),
                    DateTimePicker::make('closing_date')
                        ->label('Cierre'),
                    Select::make('status')
                        ->label('Estado')
                        ->options([
                            'borrador' => 'Borrador',
                            'publicada' => 'Publicada',
                            'en_proceso' => 'En proceso',
                            'finalizada' => 'Finalizada',
                            'desierta' => 'Desierta',
                        ])->required()->default('borrador'),
                ]),
            ]),
            Section::make('Documentos y Enlaces')->schema([
                Grid::make(2)->schema([
                    FileUpload::make('document_file')
                        ->label('Bases / DBC (PDF)')
                        ->disk('public')->directory('announcements'),
                    TextInput::make('external_url')
                        ->label('Enlace externo (SICOES)')
                        ->url(),
                ]),
                Select::make('responsible_secretariat_id')
                    ->label('Secretaría responsable')
                    ->relationship('secretariat', 'name')
                    ->searchable()->preload(),
            ]),
        ]);
    }
}
