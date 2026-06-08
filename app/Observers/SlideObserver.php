<?php

/**
 * Ubicación: `app/Observers/SlideObserver.php`
 *
 * Descripción: Observer para el modelo Slide que optimiza el procesamiento
 *              de imágenes y regenera el sitemap cuando se crean o actualizan
 *              diapositivas.
 *
 * Vinculación: Registrado en AppServiceProvider
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

namespace App\Observers;

use App\Models\Slide;
use App\Jobs\RegenerateSitemap;

class SlideObserver
{
    /**
     * Handle the Slide "created" event.
     * Regenerates sitemap when a new slide is added.
     */
    public function created(Slide $slide): void
    {
        // Sitemap doesn't include slides, but log creation for audit
        activity()
            ->performedOn($slide)
            ->event('created')
            ->log('Diapositiva creada: ' . $slide->title);
    }

    /**
     * Handle the Slide "updated" event.
     * Regenerates sitemap when slide is updated.
     */
    public function updated(Slide $slide): void
    {
        // Log only field changes (not media)
        if ($slide->isDirty(['title', 'link', 'description', 'order', 'is_active'])) {
            activity()
                ->performedOn($slide)
                ->event('updated')
                ->withProperties(['old' => $slide->getOriginal(), 'new' => $slide->getAttributes()])
                ->log('Diapositiva actualizada: ' . $slide->title);
        }
    }

    /**
     * Handle the Slide "deleted" event.
     */
    public function deleted(Slide $slide): void
    {
        activity()
            ->performedOn($slide)
            ->event('deleted')
            ->log('Diapositiva eliminada: ' . $slide->title);
    }

    /**
     * Handle the Slide "restored" event.
     */
    public function restored(Slide $slide): void
    {
        activity()
            ->performedOn($slide)
            ->event('restored')
            ->log('Diapositiva restaurada: ' . $slide->title);
    }

    /**
     * Handle the Slide "force deleted" event.
     */
    public function forceDeleted(Slide $slide): void
    {
        activity()
            ->performedOn($slide)
            ->event('forceDeleted')
            ->log('Diapositiva eliminada permanentemente: ' . $slide->title);
    }
}
