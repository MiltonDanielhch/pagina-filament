<?php

namespace App\Observers;

use App\Jobs\RegenerateSitemap;
use App\Models\Post;

class PostObserver
{
    public function created(Post $post): void
    {
        $this->regenerateIfPublished($post);
    }

    public function updated(Post $post): void
    {
        $this->regenerateIfPublished($post);
    }

    public function deleted(Post $post): void
    {
        if ($post->status === 'published') {
            RegenerateSitemap::dispatch();
        }
    }

    protected function regenerateIfPublished(Post $post): void
    {
        if ($post->status === 'published' && $post->published_at) {
            RegenerateSitemap::dispatch();
        }
    }
}