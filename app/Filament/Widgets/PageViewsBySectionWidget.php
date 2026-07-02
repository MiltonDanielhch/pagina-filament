<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\Widget;

class PageViewsBySectionWidget extends Widget
{
    protected string $view = 'filament.widgets.page-views-by-section';

    protected int|string|array $columnSpan = 'full';

    public string $period = 'month';

    public function filter(string $period): void
    {
        $this->period = $period;
    }

    protected function getViewData(): array
    {
        $query = PageView::selectRaw('section, count(*) as total');

        if ($this->period === 'today') {
            $query->whereDate('created_at', today());
        } elseif ($this->period === 'week') {
            $query->where('created_at', '>=', now()->startOfWeek());
        } elseif ($this->period === 'month') {
            $query->where('created_at', '>=', now()->startOfMonth());
        }

        $sections = $query->groupBy('section')->orderByDesc('total')->get();
        $total = $sections->sum('total');

        return compact('sections', 'total');
    }
}
