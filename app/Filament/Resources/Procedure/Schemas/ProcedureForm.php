<?php

namespace App\Filament\Resources\Procedure\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class ProcedureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Identificación')->schema([
                Grid::make(2)->schema([
                    TextInput::make('code')
                        ->label('Código')
                        ->required()
                        ->placeholder('GAD-BENI-T-001')
                        ->maxLength(30),
                    Select::make('category')
                        ->label('Categoría')
                        ->options([
                            'salud' => 'Salud',
                            'educacion' => 'Educación',
                            'infraestructura' => 'Infraestructura',
                            'catastro' => 'Catastro',
                            'impuestos' => 'Impuestos',
                            'recursos_humanos' => 'Recursos Humanos',
                            'ganaderia' => 'Ganadería',
                            'mineria' => 'Minería',
                            'transporte' => 'Transporte',
                            'medio_ambiente' => 'Medio Ambiente',
                            'cultura' => 'Cultura',
                            'turismo' => 'Turismo',
                            'justicia' => 'Justicia',
                            'otro' => 'Otro',
                        ])->required()->default('otro'),
                ]),
                TextInput::make('name')
                    ->label('Nombre del trámite')
                    ->required()->columnSpanFull(),
            ]),

            Section::make('Descripción y Requisitos')->schema([
                Textarea::make('description')
                    ->label('Procedimiento paso a paso')
                    ->rows(6)
                    ->columnSpanFull(),
                Textarea::make('requirements')
                    ->label('Requisitos')
                    ->rows(6)
                    ->placeholder("Un requisito por línea:\n- Cédula de identidad\n- Comprobante de domicilio")
                    ->columnSpanFull(),
            ]),

            Section::make('Costos y Tiempos')->schema([
                Grid::make(3)->schema([
                    TextInput::make('cost')
                        ->label('Costo (Bs.)')
                        ->numeric()->step(0.01),
                    TextInput::make('processing_time_days')
                        ->label('Plazo (días)')
                        ->numeric(),
                    TextInput::make('schedule')
                        ->label('Horario de atención')
                        ->placeholder('Lun-Vie 08:00-16:00'),
                ]),
            ]),

            Section::make('Trámite en línea y responsabilidad')->schema([
                Grid::make(2)->schema([
                    Select::make('responsible_secretariat_id')
                        ->label('Secretaría responsable')
                        ->relationship('secretariat', 'name')
                        ->searchable()->preload(),
                    Select::make('responsible_official_id')
                        ->label('Funcionario responsable')
                        ->relationship('official', 'name')
                        ->searchable()->preload(),
                ]),
                TextInput::make('online_url')
                    ->label('URL de trámite en línea')
                    ->url()
                    ->placeholder('https://siscor.beni.gob.bo/...')
                    ->columnSpanFull(),
                Grid::make(2)->schema([
                    Toggle::make('is_online')
                        ->label('Disponible en línea')
                        ->default(false),
                    Toggle::make('is_featured')
                        ->label('Destacado en homepage')
                        ->default(false),
                ]),
            ]),

            Section::make('Configuración')->schema([
                Grid::make(3)->schema([
                    Select::make('status')
                        ->label('Estado')
                        ->options(['activo' => 'Activo', 'suspendido' => 'Suspendido', 'dado_de_baja' => 'Dado de baja'])
                        ->default('activo')->required(),
                    TextInput::make('sort_order')
                        ->label('Orden')
                        ->numeric()->default(0),
                    Toggle::make('is_active')
                        ->label('Visible')
                        ->default(true),
                ]),
            ]),
        ]);
    }
}
