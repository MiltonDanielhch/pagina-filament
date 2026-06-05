<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create(['name' => 'Administración']);

        $achievements = [
            [
                'title' => 'Carretera Rurrenabaque – Riberalta',
                'slug' => 'carretera-rurrenabaque-riberalta',
                'description' => 'La carretera Rurrenabaque-Riberalta de 508 kilómetros se constituye como la más larga del país. Esta obra del Bicentenario demandó una inversión de Bs 3.974 millones, financiada por el Gobierno Nacional mediante crédito de Eximbank-China y contraparte del Gobierno Autónomo Departamental de Beni. La infraestructura incluye 10 puentes que aseguran el tránsito continuo y 771 alcantarillas, integrando los departamentos de La Paz, Cochabamba y Beni con Brasil.',
                'area' => 'Infraestructura',
                'achieved_at' => '2025-08-29',
                'status' => 'published',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Puente Binacional Bolivia-Brasil confirmado',
                'slug' => 'puente-binacional-bolivia-brasil',
                'description' => 'La Cancillería del Brasil ha confirmado oficialmente la construcción del tan esperado puente binacional que unirá Bolivia y Brasil, marcando un hito histórico en la integración regional y el desarrollo de la Amazonía boliviana. Este proyecto era considerado una utopía durante años y hoy se concreta como símbolo de unidad, lucha y esperanza para el pueblo beniano.',
                'area' => 'Integración',
                'achieved_at' => '2025-08-08',
                'status' => 'published',
                'user_id' => $user->id,
            ],
            [
                'title' => 'Carreteras y Vialidad Rural',
                'slug' => 'carreteras-vialidad-rural-2025',
                'description' => 'El departamento del Beni vivió en 2025 uno de sus periodos más intensos de inversión pública en infraestructura vial. Se ejecutaron obras que fortalecieron la integración vial, mejorando la conectividad de comunidades rurales historically aisladas y reduciendo tiempos de viaje para el transporte de productos agrícolas yganaderos.',
                'area' => 'Infraestructura',
                'achieved_at' => '2025-12-31',
                'status' => 'published',
                'user_id' => $user->id,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::updateOrCreate(
                ['slug' => $achievement['slug']],
                $achievement
            );
        }

        $this->command->info('AchievementSeeder: ' . count($achievements) . ' logros creados/actualizados.');
    }
}
