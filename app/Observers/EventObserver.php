<?php

namespace App\Observers;

use App\Jobs\RegenerateSitemap;
use App\Models\Event;

class EventObserver
{
    public function created(Event $event): void
    {
        $this->regenerateIfPublished($event);
    }

    public function updated(Event $event): void
    {
        $this->regenerateIfPublished($event);
    }

    public function deleted(Event $event): void
    {
        if ($event->status === 'published') {
            RegenerateSitemap::dispatch();
        }
    }

    protected function regenerateIfPublished(Event $event): void
    {
        if ($event->status === 'published' && $event->starts_at >= now()) {
            RegenerateSitemap::dispatch();
        }
    }
}