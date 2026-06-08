<?php

/**
 * Ubicación: `app/Http/Middleware/IncreaseExecutionTimeForUploads.php`
 *
 * Descripción: Middleware que aumenta el tiempo máximo de ejecución PHP
 *              para los endpoints de carga de archivos, previniendo timeouts
 *              durante el procesamiento de imágenes con Spatie Media Library.
 *
 * Vinculación: Registrado en AdminPanelProvider middleware
 * Roadmap: 09-SEGURIDAD.md — Bloque 9.3
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncreaseExecutionTimeForUploads
{
    /**
     * Handle an incoming request.
     *
     * Increase PHP max_execution_time to 300 seconds (5 minutes) for Livewire uploads
     * to allow adequate time for file processing, media conversions, and database operations.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only increase timeout for Livewire upload endpoints
        if ($request->is('livewire*/upload-file')) {
            ini_set('max_execution_time', 300); // 5 minutes for uploads
        }

        return $next($request);
    }
}
