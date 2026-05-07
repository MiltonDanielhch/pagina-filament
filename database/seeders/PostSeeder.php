<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::first();
        
        // Si no hay usuario, crear uno temporal
        if (!$user) {
            $user = \App\Models\User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ]);
            $user->assignRole('super_admin');
        }
        
        $categories = \App\Models\Category::all();

        $posts = [
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('slug', 'salud')->first()?->id,
                'title' => 'Paciente internado con dengue hemorrágico recibe apoyo de la Gobernación en Trinidad',
                'slug' => 'paciente-dengue-trinidad',
                'excerpt' => 'El paciente Mauricio Mole transferido desde Rurrenabaque a Trinidad recibe apoyo de la Gobernación.',
                'body' => 'El paciente Mauricio Mole transferido desde Rurrenabaque a Trinidad recibe apoyo de la Gobernación del Beni. Las autoridades departamentales han garantizado la atención médica necesaria para su recuperación.',
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('slug', 'infraestructura')->first()?->id,
                'title' => 'San Ignacio de Moxos tendrá su planta potabilizadora de agua',
                'slug' => 'san-ignacio-planta-potabilizadora',
                'excerpt' => 'San Ignacio de Moxos está a punto de dar un paso histórico con la construcción de su planta potabilizadora.',
                'body' => 'La Gobernación del Beni inicia la construcción de la planta potabilizadora que beneficiará a miles de habitantes de San Ignacio de Moxos.',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'user_id' => $user->id,
                'category_id' => $categories->where('slug', 'cultura')->first()?->id,
                'title' => 'La Gobernación del Beni Renueva su Presencia Digital',
                'slug' => 'nuevo-sitio-web',
                'excerpt' => 'Con gran entusiasmo, les anunciamos que el sitio web de la Gobernación del Beni ha sido renovado.',
                'body' => 'El nuevo sitio web trae una experiencia moderna y accesible para todos los ciudadanos del Beni.',
                'status' => 'published',
                'published_at' => now()->subDays(30),
            ],
        ];

        foreach ($posts as $post) {
            \App\Models\Post::create($post);
        }
    }
}
