<?php

/**
 * Ubicación: `app/Filament/Widgets/RecentPostsWidget.php`
 *
 * Descripción: Widget Filament que muestra tabla de los 5 posts más recientes
 *              publicados
 *
 * Uso: Se usa en el dashboard de Filament
 * Roadmap: 05-BACKEND.md — Bloque 3.2
 */

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentPostsWidget extends BaseWidget
{
    protected int $maxRecords = 5;

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Post::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(5);
    }

    protected function getTableTable(): Table
    {
        return Table::make()
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Autor'),
                TextColumn::make('published_at')
                    ->label('Fecha')
                    ->date('d/m/Y'),
            ]);
    }
}