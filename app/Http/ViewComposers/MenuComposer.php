<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        // Cargar ítems padre activos con sus hijos también activos
        $itemQuery = function ($query) {
            $query->where('is_active', true)
                ->where('parent_id', null)
                ->orderBy('order')
                ->with(['children' => function ($q) {
                    $q->where('is_active', true)->orderBy('order');
                }, 'page', 'children.page']);
        };

        $headerMenu = Menu::where('location', 'header')
            ->where('is_active', true)
            ->with(['items' => $itemQuery])
            ->first();

        $footerMenu = Menu::where('location', 'footer')
            ->where('is_active', true)
            ->with(['items' => $itemQuery])
            ->first();

        $view->with([
            'headerMenu' => $headerMenu,
            'footerMenu' => $footerMenu,
        ]);
    }
}