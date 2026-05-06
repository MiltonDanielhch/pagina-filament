<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Salud',
                'slug' => 'salud',
                'description' => 'Noticias sobre salud pública y proyectos de salud en el Beni',
                'color' => '#EF4444',
            ],
            [
                'name' => 'Infraestructura',
                'slug' => 'infraestructura',
                'description' => 'Proyectos de infraestructura vial, educativa y sanitaria',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Cultura',
                'slug' => 'cultura',
                'description' => 'Actividades culturales y eventos del departamento',
                'color' => '#8B5CF6',
            ],
            [
                'name' => 'Educación',
                'slug' => 'educacion',
                'description' => 'Noticias sobre educación y programas educativos',
                'color' => '#3B82F6',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
