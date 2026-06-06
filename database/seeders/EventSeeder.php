<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::first();

        $events = [
            [
                'user_id' => $user->id ?? 1,
                'title' => 'Festival del Beni',
                'slug' => 'festival-del-beni',
                'description' => 'Celebración anual de la cultura beniana con música, danza y gastronomía tradicional',
                'location' => 'Plaza José Ballivián, Trinidad',
                'starts_at' => '2026-06-15 10:00:00',
                'status' => 'published',
                'is_featured' => true,
            ],
            [
                'user_id' => $user->id ?? 1,
                'title' => 'Exposición Agropecuaria',
                'slug' => 'exposicion-agropecuaria',
                'description' => 'Feria de productos agrícolas y ganaderos del departamento del Beni',
                'location' => 'Centro de Ferias, Trinidad',
                'starts_at' => '2026-07-20 08:00:00',
                'status' => 'published',
                'is_featured' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
