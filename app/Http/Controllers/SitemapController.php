<?php

/**
 * Ubicación: `app/Http/Controllers\SitemapController.php`
 *
 * Descripción: Controlador que genera el sitemap.xml dinámicamente con posts,
 *              páginas y eventos publicados.
 *
 * Métodos: __invoke() — GET /sitemap.xml
 * Roadmap: 06-FRONTEND.md — Bloque 6.7
 */

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use App\Models\Event;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/blog')
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/contacto')
                ->setPriority(0.8)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));

        Post::where('status', 'published')
            ->whereNotNull('published_at')
            ->each(function ($post) use ($sitemap) {
                $sitemap->add(Url::create("/blog/{$post->slug}")
                    ->setPriority(0.8)
                    ->setLastModificationDate($post->published_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            });

        Page::where('is_published', true)
            ->each(function ($page) use ($sitemap) {
                $sitemap->add(Url::create("/{$page->slug}")
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY));
            });

        Event::where('status', 'published')
            ->where('starts_at', '>=', now())
            ->each(function ($event) use ($sitemap) {
                $sitemap->add(Url::create("/eventos/{$event->slug}")
                    ->setPriority(0.7)
                    ->setLastModificationDate($event->starts_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
            });

        return $sitemap->toResponse(request());
    }
}