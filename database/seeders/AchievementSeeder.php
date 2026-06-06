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
                'title' => 'Puente Binacional Bolivia-Brasil confirmado',
                'slug' => 'puente-binacional-bolivia-brasil',
                'description' => 'La Cancillería del Brasil ha confirmado oficialmente la construcción del tan esperado puente binacional que unirá Bolivia y Brasil, marcando un hito histórico en la integración regional y el desarrollo de la Amazonía boliviana. Este proyecto era considerado una utopía durante años y hoy se concreta como símbolo de unidad, lucha y esperanza para el pueblo beniano.',
                'area' => 'Integración',
                'achieved_at' => '2025-08-08',
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
