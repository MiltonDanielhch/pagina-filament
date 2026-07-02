<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PageViewsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = PageView::count();
        $today = PageView::whereDate('created_at', today())->count();
        $thisWeek = PageView::where('created_at', '>=', now()->startOfWeek())->count();
        $thisMonth = PageView::where('created_at', '>=', now()->startOfMonth())->count();
        $uniqueIps = PageView::distinct('ip_address')->count('ip_address');

        return [
            Stat::make('Visitas totales', $total)
                ->icon('heroicon-o-eye')
                ->color('success'),
            Stat::make('Visitas hoy', $today)
                ->icon('heroicon-o-clock')
                ->color('primary'),
            Stat::make('Esta semana', $thisWeek)
                ->icon('heroicon-o-calendar-days')
                ->color('info'),
            Stat::make('Este mes', $thisMonth)
                ->icon('heroicon-o-calendar')
                ->color('info'),
            Stat::make('Visitantes únicos', $uniqueIps)
                ->icon('heroicon-o-users')
                ->color('warning'),
        ];
    }
}
