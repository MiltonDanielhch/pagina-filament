<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Inicio',
                'slug' => 'inicio',
                'content' => 'Bienvenido al sitio web de la Gobernación del Beni.',
                'is_published' => true,
            ],
            [
                'title' => 'Gobernador',
                'slug' => 'gobernador',
                'content' => 'Información sobre el Gobernador del Beni.',
                'is_published' => true,
            ],
            [
                'title' => 'Política de Privacidad',
                'slug' => 'politica-de-privacidad',
                'content' => 'Política de privacidad del sitio web.',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            \App\Models\Page::create($page);
        }
    }
}
