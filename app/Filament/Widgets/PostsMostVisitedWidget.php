<?php

/**
 * Ubicación: `app/Filament/Widgets/PostsMostVisitedWidget.php`
 *
 * Descripción: Widget Filament que muestra tabla de los 10 posts más visitados
 *              de la semana actual
 *
 * Uso: Se usa en el dashboard de Filament
 * Roadmap: 12-FUTURO.md — Contador de visitas
 */

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class PostsMostVisitedWidget extends BaseWidget
{
    protected int $maxRecords = 10;

    protected function getTableQuery(): Builder
    {
        // Posts publicados de la última semana ordenados por visitas
        return Post::published()
            ->where('published_at', '>=', now()->subWeek())
            ->orderBy('view_count', 'desc');
    }

    protected function getTableTable(): Table
    {
        return Table::make()
            ->columns([
                TextColumn::make('view_count')
                    ->label('Visitas')
                    ->sortable()
                    ->numeric()
                    ->alignEnd(),
                TextColumn::make('title')
                    ->label('Título')
                    ->limit(35)
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Categoría')
                    ->placeholder('-'),
                TextColumn::make('published_at')
                    ->label('Publicado')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('view_count', 'desc');
    }
}
