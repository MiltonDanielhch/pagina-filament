<?php

namespace App\Filament\Resources\Complaint\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class ComplaintForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Datos del ciudadano')->schema([
                Grid::make(2)->schema([
                    TextInput::make('full_name')->label('Nombre completo')->required(),
                    TextInput::make('ci')->label('Cédula')->maxLength(20),
                    TextInput::make('email')->label('Email')->email()->required(),
                    TextInput::make('phone')->label('Teléfono')->tel(),
                ]),
                TextInput::make('address')->label('Dirección')->columnSpanFull(),
            ]),
            Section::make('Reclamo')->schema([
                Grid::make(2)->schema([
                    Select::make('type')->label('Tipo')->options([
                        'queja' => 'Queja', 'reclamo' => 'Reclamo',
                        'sugerencia' => 'Sugerencia', 'denuncia' => 'Denuncia',
                    ])->required()->default('queja'),
                    Select::make('related_secretariat_id')
                        ->label('Secretaría relacionada')
                        ->relationship('secretariat', 'name')
                        ->searchable()->preload(),
                ]),
                TextInput::make('subject')->label('Asunto')->required()->columnSpanFull(),
                Textarea::make('description')->label('Descripción')->rows(6)->required()->columnSpanFull(),
            ]),
            Section::make('Gestión interna')->schema([
                Grid::make(2)->schema([
                    Select::make('status')->label('Estado')->options([
                        'recibido' => 'Recibido', 'en_proceso' => 'En proceso',
                        'resuelto' => 'Resuelto', 'rechazado' => 'Rechazado',
                    ])->default('recibido')->required(),
                    Select::make('assigned_to')
                        ->label('Asignado a')
                        ->relationship('assignedUser', 'name')
                        ->searchable()->preload(),
                ]),
                DateTimePicker::make('response_date')->label('Fecha de respuesta'),
                Textarea::make('response')->label('Respuesta')->rows(4)->columnSpanFull(),
            ]),
        ]);
    }
}
