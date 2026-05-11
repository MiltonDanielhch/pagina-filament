<?php

/**
 * Ubicación: `app/Jobs/RegenerateSitemap.php`
 *
 * Descripción: Job para regenerar el archivo sitemap.xml después de
 *              publicar contenido. Se ejecuta en la cola 'default'.
 *
 * Uso: RegenerateSitemap::dispatch()
 * Roadmap: 08-RENDIMIENTO.md — Bloque 8.6
 */

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class RegenerateSitemap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        $this->onQueue('default');
    }

    public function handle(): void
    {
        try {
            Artisan::call('sitemap:generate', ['--no-interaction' => true]);
        } catch (\Exception $e) {
            logger()->error('Error regenerando sitemap desde job: ' . $e->getMessage());
        }
    }
}