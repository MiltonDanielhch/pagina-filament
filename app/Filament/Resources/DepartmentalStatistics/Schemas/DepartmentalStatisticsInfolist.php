<?php

/**
 * Ubicación: `app/Filament/Resources/DepartmentalStatistics/Schemas/DepartmentalStatisticsInfolist.php`
 *
 * Descripción: Infolist para ver detalles de estadísticas departamentales.
 *
 * Roadmap: 12-FUTURO.md — Sistema de Estadísticas Departamentales
 */

namespace App\Filament\Resources\DepartmentalStatistics\Schemas;

use App\Models\DepartmentalStatistics;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DepartmentalStatisticsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información General')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('year')
                                    ->label('Año'),
                                TextEntry::make('data_source')
                                    ->label('Fuente de Datos'),
                                TextEntry::make('user.name')
                                    ->label('Actualizado por'),
                            ]),
                    ]),
                
                Section::make('Indicadores Demográficos')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('population')
                                    ->label('Población Total')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.') . ' hab.')
                                    ->placeholder('-'),
                                TextEntry::make('population_growth_rate')
                                    ->label('Tasa de Crecimiento')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2, ',', '.') . '%')
                                    ->placeholder('-'),
                                TextEntry::make('urban_population')
                                    ->label('Población Urbana')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.') . ' hab.')
                                    ->placeholder('-'),
                                TextEntry::make('rural_population')
                                    ->label('Población Rural')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.') . ' hab.')
                                    ->placeholder('-'),
                            ]),
                    ]),
                
                Section::make('Indicadores Geográficos')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('area_km2')
                                    ->label('Área')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2, ',', '.') . ' km²')
                                    ->placeholder('-'),
                                TextEntry::make('municipalities')
                                    ->label('Municipios')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('provinces')
                                    ->label('Provincias')
                                    ->numeric()
                                    ->placeholder('-'),
                            ]),
                    ]),
                
                Section::make('Indicadores Económicos')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('gdp_billion_usd')
                                    ->label('PIB')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => '$' . number_format($state ?? 0, 2, ',', '.') . 'B')
                                    ->placeholder('-'),
                                TextEntry::make('gdp_per_capita_usd')
                                    ->label('PIB per cápita')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => '$' . number_format($state ?? 0, 2, ',', '.'))
                                    ->placeholder('-'),
                                TextEntry::make('inflation_rate')
                                    ->label('Tasa de Inflación')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2, ',', '.') . '%')
                                    ->placeholder('-'),
                                TextEntry::make('unemployment_rate')
                                    ->label('Tasa de Desempleo')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2, ',', '.') . '%')
                                    ->placeholder('-'),
                            ]),
                    ]),
                
                Section::make('Indicadores Educativos')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('schools')
                                    ->label('Escuelas')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('students')
                                    ->label('Estudiantes')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.'))
                                    ->placeholder('-'),
                                TextEntry::make('teachers')
                                    ->label('Docentes')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.'))
                                    ->placeholder('-'),
                                TextEntry::make('literacy_rate')
                                    ->label('Tasa de Alfabetización')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2, ',', '.') . '%')
                                    ->placeholder('-'),
                            ]),
                    ]),
                
                Section::make('Indicadores de Salud')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('hospitals')
                                    ->label('Hospitales')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('health_centers')
                                    ->label('Centros de Salud')
                                    ->numeric()
                                    ->placeholder('-'),
                                TextEntry::make('doctors')
                                    ->label('Médicos')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.'))
                                    ->placeholder('-'),
                                TextEntry::make('infant_mortality_rate')
                                    ->label('Mortalidad Infantil')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2, ',', '.') . ' por 1000')
                                    ->placeholder('-'),
                            ]),
                    ]),
                
                Section::make('Indicadores de Infraestructura')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('paved_roads_km')
                                    ->label('Carreteras Pavimentadas')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.') . ' km')
                                    ->placeholder('-'),
                                TextEntry::make('electrification_coverage')
                                    ->label('Cobertura de Electrificación')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 2, ',', '.') . '%')
                                    ->placeholder('-'),
                                TextEntry::make('internet_users')
                                    ->label('Usuarios de Internet')
                                    ->numeric()
                                    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.'))
                                    ->placeholder('-'),
                            ]),
                    ]),
                
                Section::make('Notas')
                    ->schema([
                        TextEntry::make('notes')
                            ->label('Notas')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
