<?php

/**
 * Ubicación: `app/Providers/HorizonServiceProvider.php`
 *
 * Descripción: Service Provider para configurar Laravel Horizon,
 *              incluye gate de seguridad para super_admin.
 *
 * Vinculación: Se carga automáticamente via config/app.php
 * Roadmap: 08-RENDIMIENTO.md — Bloque 8.7
 */

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        // Horizon::routeSmsNotificationsTo('15556667777');
        // Horizon::routeMailNotificationsTo('example@example.com');
        // Horizon::routeSlackNotificationsTo('slack-webhook-url', '#channel');
    }

    /**
     * Register the Horizon gate.
     *
     * This gate determines who can access Horizon in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewHorizon', function ($user) {
            if (!$user) {
                return false;
            }
            
            if ($user->hasRole('super_admin')) {
                return true;
            }
            
            return in_array($user->email, [
                'admin@beni.gob.bo',
                'despacho@beni.gob.bo',
            ]);
        });
    }
}
