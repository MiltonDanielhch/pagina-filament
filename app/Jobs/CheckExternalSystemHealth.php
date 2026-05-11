<?php

/**
 * Ubicación: `app/Jobs/CheckExternalSystemHealth.php`
 *
 * Descripción: Job para verificar el estado de salud de sistemas externos.
 *              Se ejecuta en la cola 'health-checks'.
 *
 * Uso: CheckExternalSystemHealth::dispatch($systemId)
 * Roadmap: 08-RENDIMIENTO.md — Bloque 8.6
 */

namespace App\Jobs;

use App\Models\ExternalSystem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CheckExternalSystemHealth implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ?int $systemId;

    public function __construct(?int $systemId = null)
    {
        $this->systemId = $systemId;
        $this->onQueue('health-checks');
    }

    public function handle(): void
    {
        if ($this->systemId) {
            $systems = ExternalSystem::where('id', $this->systemId)->get();
        } else {
            $systems = ExternalSystem::active()->get();
        }

        foreach ($systems as $system) {
            $this->checkSystem($system);
        }
    }

    protected function checkSystem(ExternalSystem $system): void
    {
        try {
            $response = Http::timeout(10)->get($system->url);
            $status = $response->successful() ? 'online' : 'offline';
            $responseCode = $response->status();
        } catch (\Exception $e) {
            $status = 'offline';
            $responseCode = null;
            Log::warning("Health check failed for {$system->name}: {$e->getMessage()}");
        }

        $system->update([
            'last_status' => $status,
            'last_checked_at' => now(),
            'last_response_code' => $responseCode,
        ]);
    }

    public static function checkNow(ExternalSystem $system): bool
    {
        try {
            $response = Http::timeout(5)->get($system->url);
            $isOnline = $response->successful();
        } catch (\Exception $e) {
            $isOnline = false;
        }

        $system->update([
            'last_status' => $isOnline ? 'online' : 'offline',
            'last_checked_at' => now(),
        ]);

        return $isOnline;
    }
}