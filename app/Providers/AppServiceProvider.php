<?php

/**
 * Ubicación: `app/Providers/AppServiceProvider.php`
 *
 * Descripción: Service Provider principal donde se registran
 *              los observers de Post, Page y Event.
 *
 * Vinculación: Se carga automáticamente via config/app.php
 * Roadmap: 08-RENDIMIENTO.md — Bloque 8.6
 */

namespace App\Providers;

use App\Models\Event;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Observers\EventObserver;
use App\Observers\PageObserver;
use App\Observers\PostObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Post::observe(PostObserver::class);
        Page::observe(PageObserver::class);
        Event::observe(EventObserver::class);
    }
}
