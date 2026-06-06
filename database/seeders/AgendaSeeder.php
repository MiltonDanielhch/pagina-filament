<?php

/**
 * Ubicación: `database/seeders/AgendaSeeder.php`
 *
 * Descripción: Seeder para agenda del gobernador con datos de ejemplo.
 *
 * Roadmap: 12-FUTURO.md — Agenda del gobernador
 */

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->error('No user found. Please create a user first.');
            return;
        }

        $events = [
            [
                'title' => 'Inauguración del Hospital Regional',
                'description' => 'Ceremonia oficial de inauguración del nuevo hospital regional que servirá a más de 50,000 habitantes de la región.',
                'date' => now()->addDays(5)->toDateString(),
                'time' => '09:00:00',
                'location' => 'Av. Principal s/n, Trinidad',
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Feria de Emprendedores',
                'description' => 'Apoyo a los emprendedores locales con la feria anual de exposición de productos y servicios.',
                'date' => now()->addDays(25)->toDateString(),
                'time' => '09:00:00',
                'location' => 'Plaza Principal, Trinidad',
                'is_public' => true,
                'status' => 'published',
            ],
        ];

        foreach ($events as $event) {
            Agenda::create([
                'user_id' => $user->id,
                'title' => $event['title'],
                'slug' => Str::slug($event['title']),
                'description' => $event['description'],
                'date' => $event['date'],
                'time' => $event['time'],
                'location' => $event['location'],
                'is_public' => $event['is_public'],
                'status' => $event['status'],
            ]);
        }

        $this->command->info('Agenda seeded successfully with ' . count($events) . ' events.');
    }
}
