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
                'title' => 'Escuela Técnica Riberalta',
                'slug' => 'escuela-tecnica-riberalta',
                'description' => 'Construcción de escuela técnica con laboratorios y talleres para formación profesional.',
                'category' => 'educacion',
                'municipality' => 'riberalta',
                'latitude' => -11.0167,
                'longitude' => -66.1167,
                'status' => 'planned',
                'start_date' => '2025-03-01',
                'completion_date' => '2026-12-31',
                'budget' => 15000000.00,
            ],
            [
                'title' => 'Planta de Tratamiento de Agua Guayaramerín',
                'slug' => 'planta-tratamiento-agua-guayaramerin',
                'description' => 'Planta de tratamiento de agua potable con capacidad para 50,000 habitantes.',
                'category' => 'agua',
                'municipality' => 'guayaramerin',
                'latitude' => -10.85,
                'longitude' => -65.3833,
                'status' => 'in_progress',
                'start_date' => '2024-06-01',
                'completion_date' => '2025-06-30',
                'budget' => 8000000.00,
            ],
            [
                'title' => 'Carretera Trinidad-San Ignacio',
                'slug' => 'carretera-trinidad-san-ignacio',
                'description' => 'Pavimentación de la carretera que conecta Trinidad con San Ignacio de Moxos.',
                'category' => 'transporte',
                'municipality' => 'san_ignacio',
                'latitude' => -14.95,
                'longitude' => -65.95,
                'status' => 'completed',
                'start_date' => '2023-01-01',
                'completion_date' => '2024-03-31',
                'budget' => 25000000.00,
            ],
            [
                'title' => 'Central Hidroeléctrica Rurrenabaque',
                'slug' => 'central-hidroelectrica-rurrenabaque',
                'description' => 'Pequeña central hidroeléctrica para abastecer energía a la región.',
                'category' => 'energia',
                'municipality' => 'rurrenabaque',
                'latitude' => -14.45,
                'longitude' => -67.5333,
                'status' => 'planned',
                'start_date' => '2025-01-01',
                'completion_date' => '2027-12-31',
                'budget' => 35000000.00,
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
                'title' => 'Centro de Salud San Joaquín',
                'slug' => 'centro-salud-san-joaquin',
                'description' => 'Ampliación y equipamiento del centro de salud de San Joaquín.',
                'category' => 'salud',
                'municipality' => 'san_joaquin',
                'latitude' => -13.6,
                'longitude' => -64.8,
                'status' => 'completed',
                'start_date' => '2023-06-01',
                'completion_date' => '2024-02-28',
                'budget' => 5000000.00,
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
