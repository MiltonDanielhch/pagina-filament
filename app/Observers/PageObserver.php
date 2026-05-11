<?php

/**
 * Ubicación: `app/Observers/PageObserver.php`
 *
 * Descripción: Observer que detecta cambios en páginas publicadas
 *              y dispatch job para regenerar el sitemap automáticamente.
 *
 * Vinculación: Se registra en AppServiceProvider para escuchar eventos de Page
 * Roadmap: 08-RENDIMIENTO.md — Bloque 8.6
 */

namespace App\Observers;

use App\Jobs\RegenerateSitemap;
use App\Models\Page;

class PageObserver
{
    public function created(Page $page): void
    {
        $this->regenerateIfPublished($page);
    }

    public function updated(Page $page): void
    {
        $this->regenerateIfPublished($page);
    }

    public function deleted(Page $page): void
    {
        if ($page->is_published) {
            RegenerateSitemap::dispatch();
        }
    }

    protected function regenerateIfPublished(Page $page): void
    {
        if ($page->is_published) {
            RegenerateSitemap::dispatch();
        }
    }
}