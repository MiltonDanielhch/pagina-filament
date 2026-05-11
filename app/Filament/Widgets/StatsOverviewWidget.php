<?php

/**
 * Ubicación: `app/Filament/Widgets/StatsOverviewWidget.php`
 *
 * Descripción: Widget Filament que muestra estadísticas en el dashboard:
 *              posts publicados, borradores, eventos próximos, usuarios
 *
 * Uso: Se usa en el dashboard de Filament
 * Roadmap: 05-BACKEND.md — Bloque 3.2
 */

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Event;
use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $publishedPosts = Post::where('status', 'published')->count();
        $draftPosts = Post::where('status', 'draft')->count();
        $upcomingEvents = Event::where('starts_at', '>=', now())->count();
        $activeUsers = User::count();

        return [
            Stat::make('Posts publicados', $publishedPosts)
                ->icon('heroicon-o-document-text')
                ->color('success'),
            Stat::make('Posts en borrador', $draftPosts)
                ->icon('heroicon-o-pencil')
                ->color('warning'),
            Stat::make('Eventos próximos', $upcomingEvents)
                ->icon('heroicon-o-calendar')
                ->color('info'),
            Stat::make('Usuarios activos', $activeUsers)
                ->icon('heroicon-o-users')
                ->color('primary'),
        ];
    }
}