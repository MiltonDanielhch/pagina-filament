<?php

/**
 * Ubicación: `app/Filament/Resources/DepartmentalStatistics/Schemas/DepartmentalStatisticsForm.php`
 *
 * Descripción: Formulario para estadísticas departamentales.
 *
 * Roadmap: 12-FUTURO.md — Sistema de Estadísticas Departamentales
 */

namespace App\Filament\Resources\DepartmentalStatistics\Schemas;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DepartmentalStatisticsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información General')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('year')
                                    ->label('Año')
                                    ->required()
                                    ->numeric()
                                    ->min(2000)
                                    ->max(2100),
                                Select::make('user_id')
                                    ->label('Usuario')
                                    ->relationship('user', 'name')
                                    ->required(),
                                TextInput::make('data_source')
                                    ->label('Fuente de Datos')
                                    ->required()
                                    ->default('INE Bolivia'),
                            ]),
                    ]),
                
                Section::make('Indicadores Demográficos')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextInput::make('population')
                                    ->label('Población Total')
                                    ->numeric()
                                    ->suffix(' hab.'),
                                TextInput::make('population_growth_rate')
                                    ->label('Tasa de Crecimiento')
                                    ->numeric()
                                    ->suffix('%'),
                                TextInput::make('urban_population')
                                    ->label('Población Urbana')
                                    ->numeric()
                                    ->suffix(' hab.'),
                                TextInput::make('rural_population')
                                    ->label('Población Rural')
                                    ->numeric()
                                    ->suffix(' hab.'),
                            ]),
                    ]),
                
                Section::make('Indicadores Geográficos')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('area_km2')
                                    ->label('Área')
                                    ->numeric()
                                    ->suffix(' km²'),
                                TextInput::make('municipalities')
                                    ->label('Municipios')
                                    ->numeric(),
                                TextInput::make('provinces')
                                    ->label('Provincias')
                                    ->numeric(),
                            ]),
                    ]),
                
                Section::make('Indicadores Económicos')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextInput::make('gdp_billion_usd')
                                    ->label('PIB (miles de millones USD)')
                                    ->numeric()
                                    ->step(0.01),
                                TextInput::make('gdp_per_capita_usd')
                                    ->label('PIB per cápita (USD)')
                                    ->numeric()
                                    ->step(0.01),
                                TextInput::make('inflation_rate')
                                    ->label('Tasa de Inflación')
                                    ->numeric()
                                    ->suffix('%'),
                                TextInput::make('unemployment_rate')
                                    ->label('Tasa de Desempleo')
                                    ->numeric()
                                    ->suffix('%'),
                            ]),
                    ]),
                
                Section::make('Indicadores Educativos')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextInput::make('schools')
                                    ->label('Escuelas')
                                    ->numeric(),
                                TextInput::make('students')
                                    ->label('Estudiantes')
                                    ->numeric(),
                                TextInput::make('teachers')
                                    ->label('Docentes')
                                    ->numeric(),
                                TextInput::make('literacy_rate')
                                    ->label('Tasa de Alfabetización')
                                    ->numeric()
                                    ->suffix('%'),
                            ]),
                    ]),
                
                Section::make('Indicadores de Salud')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextInput::make('hospitals')
                                    ->label('Hospitales')
                                    ->numeric(),
                                TextInput::make('health_centers')
                                    ->label('Centros de Salud')
                                    ->numeric(),
                                TextInput::make('doctors')
                                    ->label('Médicos')
                                    ->numeric(),
                                TextInput::make('infant_mortality_rate')
                                    ->label('Mortalidad Infantil')
                                    ->numeric()
                                    ->suffix(' por 1000'),
                            ]),
                    ]),
                
                Section::make('Indicadores de Infraestructura')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('paved_roads_km')
                                    ->label('Carreteras Pavimentadas')
                                    ->numeric()
                                    ->suffix(' km'),
                                TextInput::make('electrification_coverage')
                                    ->label('Cobertura de Electrificación')
                                    ->numeric()
                                    ->suffix('%'),
                                TextInput::make('internet_users')
                                    ->label('Usuarios de Internet')
                                    ->numeric(),
                            ]),
                    ]),
                
                Section::make('Notas Adicionales')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Notas')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
