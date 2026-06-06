<?php

/**
 * Ubicación: `database/seeders/InfrastructureProjectSeeder.php`
 *
 * Descripción: Seeder para proyectos de infraestructura de ejemplo.
 *
 * Roadmap: 12-FUTURO.md — Mapa interactivo del Beni
 */

namespace Database\Seeders;

use App\Models\InfrastructureProject;
use App\Models\User;
use Illuminate\Database\Seeder;

class InfrastructureProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn('No users found. Skipping InfrastructureProjectSeeder.');
            return;
        }

        $projects = [
            [
                'title' => 'Hospital Regional de Trinidad',
                'slug' => 'hospital-regional-trinidad',
                'description' => 'Construcción del nuevo hospital regional con capacidad de 200 camas y equipamiento médico moderno.',
                'category' => 'salud',
                'municipality' => 'trinidad',
                'latitude' => -14.8333,
                'longitude' => -64.9,
                'status' => 'in_progress',
                'start_date' => '2024-01-15',
                'completion_date' => '2025-12-31',
                'budget' => 50000000.00,
            ],
            [
                'title' => 'Puente sobre el Río Mamoré',
                'slug' => 'puente-rio-mamore',
                'description' => 'Construcción de puente vehicular sobre el Río Mamoré para conectar municipios.',
                'category' => 'infraestructura',
                'municipality' => 'san_borja',
                'latitude' => -14.4167,
                'longitude' => -66.8833,
                'status' => 'in_progress',
                'start_date' => '2024-03-01',
                'completion_date' => '2025-09-30',
                'budget' => 12000000.00,
            ],
            [
                'title' => 'Sistema de Alcantarillado San Borja',
                'slug' => 'sistema-alcantarillado-san-borja',
                'description' => 'Instalación de sistema de alcantarillado sanitario para la ciudad.',
                'category' => 'agua',
                'municipality' => 'san_borja',
                'latitude' => -14.4167,
                'longitude' => -66.8833,
                'status' => 'planned',
                'start_date' => '2025-07-01',
                'completion_date' => '2026-12-31',
                'budget' => 10000000.00,
            ],
        ];

        foreach ($projects as $project) {
            InfrastructureProject::create(array_merge($project, ['user_id' => $user->id]));
        }

        $this->command->info('Infrastructure projects seeded successfully with ' . count($projects) . ' projects.');
    }
}
