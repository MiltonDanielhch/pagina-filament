<?php

namespace App\Jobs;

use App\Models\ExternalSystem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CheckExternalSystemHealth implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $systems = ExternalSystem::active()->get();

        foreach ($systems as $system) {
            $this->checkSystem($system);
        }
    }

    public function checkSystem(ExternalSystem $system): void
    {
        $cacheKey = "system_status_{$system->id}";

        if (Cache::has($cacheKey)) {
            continue;
        }

        try {
            $response = Http::timeout(5)->get($system->url);
            $status = $response->successful() ? 'online' : 'offline';
        } catch (\Exception $e) {
            $status = 'offline';
        }

        $system->update([
            'last_status' => $status,
            'last_checked_at' => now(),
        ]);

        Cache::put($cacheKey, true, now()->addMinutes(5));
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