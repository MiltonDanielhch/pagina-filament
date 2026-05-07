<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Page;
use App\Models\Post;
use App\Observers\EventObserver;
use App\Observers\PageObserver;
use App\Observers\PostObserver;
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
