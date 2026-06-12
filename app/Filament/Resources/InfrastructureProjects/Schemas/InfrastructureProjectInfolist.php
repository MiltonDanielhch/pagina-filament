<?php

/**
 * Ubicación: `app/Filament/Resources/InfrastructureProjects/Schemas/InfrastructureProjectInfolist.php`
 *
 * Descripción: Infolist para ver detalles de proyectos de inversión.
 *
 * Cumplimiento: 14-cumplimiento-normativo-rm067-2025.md — Bloque B4.
 */

namespace App\Filament\Resources\InfrastructureProjects\Schemas;

use App\Models\InfrastructureProject;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InfrastructureProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identificación')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('code')
                            ->label('Código')
                            ->placeholder('—'),
                        TextEntry::make('title')
                            ->label('Título'),
                        TextEntry::make('slug')
                            ->label('Slug')
                            ->placeholder('—'),
                        TextEntry::make('secretariat.name')
                            ->label('Secretaría responsable')
                            ->placeholder('—'),
                    ]),

                Section::make('Descripción')
                    ->schema([
                        TextEntry::make('description')
                            ->label('Descripción')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        TextEntry::make('beneficiary_communities')
                            ->label('Comunidades beneficiarias')
                            ->formatStateUsing(function ($state) {
                                if (! is_array($state) || empty($state)) {
                                    return '—';
                                }
                                $parts = [];
                                foreach ($state as $community => $families) {
                                    $parts[] = $community . ($families !== '' && $families !== null ? " ({$families} fam.)" : '');
                                }
                                return implode(' · ', $parts);
                            })
                            ->columnSpanFull(),
                    ]),

                Section::make('Clasificación y ubicación')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('category')
                            ->label('Categoría')
                            ->formatStateUsing(fn ($state) => InfrastructureProject::categories()[$state] ?? $state),
                        TextEntry::make('municipality')
                            ->label('Municipio')
                            ->formatStateUsing(fn (string $state): string => str_replace('_', ' ', ucwords($state, '_'))),
                        TextEntry::make('latitude')
                            ->label('Latitud')
                            ->placeholder('—'),
                        TextEntry::make('longitude')
                            ->label('Longitud')
                            ->placeholder('—'),
                    ]),

                Section::make('Estado y cronograma')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('status')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (string $state): string => match($state) {
                                InfrastructureProject::STATUS_PLANNING  => 'blue',
                                InfrastructureProject::STATUS_PROGRESS  => 'warning',
                                InfrastructureProject::STATUS_COMPLETED => 'success',
                                InfrastructureProject::STATUS_PARALYZED => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => InfrastructureProject::statuses()[$state] ?? $state),
                        TextEntry::make('progress_percentage')
                            ->label('Avance')
                            ->suffix('%')
                            ->numeric()
                            ->placeholder(0),
                        IconEntry::make('is_featured')
                            ->label('Destacado')
                            ->boolean(),
                        TextEntry::make('start_date')
                            ->label('Inicio')
                            ->date('d/m/Y')
                            ->placeholder('—'),
                        TextEntry::make('end_date_planned')
                            ->label('Conclusión prevista')
                            ->date('d/m/Y')
                            ->placeholder('—'),
                        TextEntry::make('end_date_real')
                            ->label('Conclusión real')
                            ->date('d/m/Y')
                            ->placeholder('—'),
                    ]),

                Section::make('Presupuesto y financiamiento')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('budget')
                            ->label('Presupuesto')
                            ->money('BOB')
                            ->placeholder('—'),
                        TextEntry::make('contract_number')
                            ->label('Nº de contrato')
                            ->placeholder('—'),
                        TextEntry::make('contracting_company')
                            ->label('Empresa contratista')
                            ->placeholder('—'),
                        TextEntry::make('financing_source')
                            ->label('Fuente de financiamiento')
                            ->placeholder('—'),
                    ]),

                Section::make('Imagen principal')
                    ->schema([
                        ImageEntry::make('image')
                            ->label('')
                            ->height(240),
                    ]),

                Section::make('Auditoría')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Creado por')
                            ->placeholder('—'),
                        TextEntry::make('created_at')
                            ->label('Fecha de creación')
                            ->date('d/m/Y H:i'),
                    ]),
            ]);
    }
}
