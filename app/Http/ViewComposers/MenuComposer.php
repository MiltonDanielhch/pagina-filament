<?php

namespace App\Http\ViewComposers;

use App\Models\Page;
use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view)
    {
        $pages = Page::where('is_published', true)
            ->where('show_in_menu', true)
            ->orderBy('menu_order')
            ->get();
        
        $view->with('menuPages', $pages);
    }
}