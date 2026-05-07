<?php

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