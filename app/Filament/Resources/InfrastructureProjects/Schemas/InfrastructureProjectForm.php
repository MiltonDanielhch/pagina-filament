<?php

/**
 * Ubicación: `app/Filament/Resources/InfrastructureProjects/Schemas/InfrastructureProjectForm.php`
 *
 * Descripción: Formulario para proyectos de infraestructura.
 *
 * Roadmap: 12-FUTURO.md — Mapa interactivo del Beni
 */

namespace App\Filament\Resources\InfrastructureProjects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InfrastructureProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', \Illuminate\Support\Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                    ]),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        Select::make('category')
                            ->label('Categoría')
                            ->options([
                                'salud' => 'Salud',
                                'educacion' => 'Educación',
                                'infraestructura' => 'Infraestructura',
                                'agua' => 'Agua y Saneamiento',
                                'energia' => 'Energía',
                                'transporte' => 'Transporte',
                                'otro' => 'Otro',
                            ])
                            ->required(),
                        Select::make('municipality')
                            ->label('Municipio')
                            ->options([
                                'trinidad' => 'Trinidad',
                                'san_ignacio' => 'San Ignacio de Moxos',
                                'riberalta' => 'Riberalta',
                                'guayaramerin' => 'Guayaramerín',
                                'rurrenabaque' => 'Rurrenabaque',
                                'san_borja' => 'San Borja',
                                'san_javier' => 'San Javier',
                                'san_andres' => 'San Andrés',
                                'san_joaquin' => 'San Joaquín',
                                'magdalena' => 'Magdalena',
                                'san_pedro' => 'San Pedro',
                                'san_ramon' => 'San Ramón',
                                'san_carlos' => 'San Carlos',
                                'san_ana' => 'San Ana',
                                'san_martin' => 'San Martín',
                                'san_jose' => 'San José',
                                'san_felipe' => 'San Felipe',
                                'san_lucas' => 'San Lucas',
                                'san_miguel' => 'San Miguel',
                                'san_pablo' => 'San Pablo',
                                'san_roque' => 'San Roque',
                                'santa_ana' => 'Santa Ana',
                                'santa_rosa' => 'Santa Rosa',
                                'santa_cruz' => 'Santa Cruz',
                                'exaltacion' => 'Exaltación',
                                'loreto' => 'Loreto',
                                'puerto_siles' => 'Puerto Siles',
                                'puerto_rico' => 'Puerto Rico',
                                'puerto_suarez' => 'Puerto Suárez',
                                'puerto_acosta' => 'Puerto Acosta',
                                'puerto_alonso' => 'Puerto Alonso',
                                'puerto_busch' => 'Puerto Busch',
                                'puerto_carabuco' => 'Puerto Carabuco',
                                'puerto_cortes' => 'Puerto Cortés',
                                'puerto_gonzalez' => 'Puerto González',
                                'puerto_huallata' => 'Puerto Huallata',
                                'puerto_mataral' => 'Puerto Mataral',
                                'puerto_mendoza' => 'Puerto Mendoza',
                                'puerto_morales' => 'Puerto Morales',
                                'puerto_paz' => 'Puerto Paz',
                                'puerto_pirai' => 'Puerto Piraí',
                                'puerto_quijaro' => 'Puerto Quijarro',
                                'puerto_serrano' => 'Puerto Serrano',
                                'puerto_villarroel' => 'Puerto Villarroel',
                                'puerto_yacuiba' => 'Puerto Yacuiba',
                                'puerto_zudanez' => 'Puerto Zudáñez',
                            ])
                            ->required(),
                    ]),
                Grid::make(2)
                    ->schema([
                        TextInput::make('latitude')
                            ->label('Latitud')
                            ->required()
                            ->numeric()
                            ->step(0.00000001),
                        TextInput::make('longitude')
                            ->label('Longitud')
                            ->required()
                            ->numeric()
                            ->step(0.00000001),
                    ]),
                Grid::make(3)
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'planned' => 'Planificado',
                                'in_progress' => 'En Progreso',
                                'completed' => 'Completado',
                            ])
                            ->required()
                            ->default('planned'),
                        DatePicker::make('start_date')
                            ->label('Fecha de Inicio')
                            ->native(false),
                        DatePicker::make('completion_date')
                            ->label('Fecha de Finalización')
                            ->native(false),
                    ]),
                Grid::make(2)
                    ->schema([
                        TextInput::make('budget')
                            ->label('Presupuesto (Bs)')
                            ->numeric()
                            ->prefix('Bs.'),
                        FileUpload::make('image')
                            ->label('Imagen')
                            ->image()
                            ->directory('infrastructure-projects'),
                    ]),
            ]);
    }
}
