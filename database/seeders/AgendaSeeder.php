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
                'title' => 'Reunión con Alcaldes',
                'description' => 'Reunión de coordinación con los alcaldes de los municipios de la provincia para discutir proyectos de desarrollo.',
                'date' => now()->addDays(10)->toDateString(),
                'time' => '14:00:00',
                'location' => 'Gobierno Departamental, Sala de Consejos',
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Visita a Proyecto de Riego',
                'description' => 'Inspección técnica del nuevo sistema de riego que beneficiará a los agricultores de la zona.',
                'date' => now()->addDays(15)->toDateString(),
                'time' => '08:30:00',
                'location' => 'Comunidad San José, Carretera Norte',
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Conferencia de Prensa',
                'description' => 'Conferencia mensual para informar sobre los avances en gestión y proyectos en ejecución.',
                'date' => now()->addDays(20)->toDateString(),
                'time' => '10:00:00',
                'location' => 'Auditorio del Gobierno Departamental',
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
            [
                'title' => 'Reunión Privada con Ministros',
                'description' => 'Reunión de trabajo con ministros del gobierno central para coordinar políticas departamentales.',
                'date' => now()->addDays(8)->toDateString(),
                'time' => '16:00:00',
                'location' => 'Gobierno Departamental, Despacho Gubernamental',
                'is_public' => false,
                'status' => 'published',
            ],
            [
                'title' => 'Ceremonia de Condecoración',
                'description' => 'Entrega de condecoraciones a destacados ciudadanos por su servicio a la comunidad.',
                'date' => now()->addDays(30)->toDateString(),
                'time' => '18:00:00',
                'location' => 'Teatro Municipal',
                'is_public' => true,
                'status' => 'published',
            ],
            [
                'title' => 'Inauguración de Escuela',
                'description' => 'Inauguración de la nueva unidad educativa con capacidad para 500 estudiantes.',
                'date' => now()->addDays(12)->toDateString(),
                'time' => '10:30:00',
                'location' => 'Barrio Nuevo, Trinidad',
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
