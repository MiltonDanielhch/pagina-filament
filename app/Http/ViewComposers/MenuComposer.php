<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        // Obtener menús activos por ubicación con items y children
        $headerMenu = Menu::where('location', 'header')
            ->where('is_active', true)
            ->with(['items' => function ($query) {
                $query->where('is_active', true)
                    ->where('parent_id', null)
                    ->orderBy('order')
                    ->with('children');
            }])
            ->first();

        $footerMenu = Menu::where('location', 'footer')
            ->where('is_active', true)
            ->with(['items' => function ($query) {
                $query->where('is_active', true)
                    ->where('parent_id', null)
                    ->orderBy('order')
                    ->with('children');
            }])
            ->first();

        $view->with([
            'headerMenu' => $headerMenu,
            'footerMenu' => $footerMenu,
        ]);
    }
}