<?php

/**
 * Ubicación: `app/Filament/Resources/InfrastructureProjects/Schemas/InfrastructureProjectInfolist.php`
 *
 * Descripción: Infolist para ver detalles de proyectos de infraestructura.
 *
 * Roadmap: 12-FUTURO.md — Mapa interactivo del Beni
 */

namespace App\Filament\Resources\InfrastructureProjects\Schemas;

use App\Models\InfrastructureProject;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class InfrastructureProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Título'),
                        TextEntry::make('slug')
                            ->label('Slug'),
                    ]),
                TextEntry::make('description')
                    ->label('Descripción')
                    ->placeholder('-')
                    ->columnSpanFull(),
                Grid::make(2)
                    ->schema([
                        TextEntry::make('category')
                            ->label('Categoría')
                            ->formatStateUsing(fn (string $state): string => match($state) {
                                'salud' => 'Salud',
                                'educacion' => 'Educación',
                                'infraestructura' => 'Infraestructura',
                                'agua' => 'Agua y Saneamiento',
                                'energia' => 'Energía',
                                'transporte' => 'Transporte',
                                'otro' => 'Otro',
                                default => $state,
                            }),
                        TextEntry::make('municipality')
                            ->label('Municipio'),
                    ]),
                Grid::make(2)
                    ->schema([
                        TextEntry::make('latitude')
                            ->label('Latitud'),
                        TextEntry::make('longitude')
                            ->label('Longitud'),
                    ]),
                Grid::make(3)
                    ->schema([
                        TextEntry::make('status')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                'planned' => 'gray',
                                'in_progress' => 'warning',
                                'completed' => 'success',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match($state) {
                                'planned' => 'Planificado',
                                'in_progress' => 'En Progreso',
                                'completed' => 'Completado',
                                default => $state,
                            }),
                        TextEntry::make('start_date')
                            ->label('Fecha de Inicio')
                            ->date('d/m/Y')
                            ->placeholder('-'),
                        TextEntry::make('completion_date')
                            ->label('Fecha de Finalización')
                            ->date('d/m/Y')
                            ->placeholder('-'),
                    ]),
                Grid::make(2)
                    ->schema([
                        TextEntry::make('budget')
                            ->label('Presupuesto')
                            ->money('BOB')
                            ->placeholder('-'),
                        ImageEntry::make('image')
                            ->label('Imagen')
                            ->height(200),
                    ]),
                TextEntry::make('user.name')
                    ->label('Creado por'),
            ]);
    }
}
