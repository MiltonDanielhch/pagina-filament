<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Gobernación Autónoma Departamental del Beni',
                'description' => 'Gobierno Autónomo Departamental',
                'image' => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=1920&q=80',
                'link' => '/contacto',
                'order' => 1,
            ],
            [
                'title' => 'Comprometidos con el Desarrollo Integral',
                'description' => 'Trabajando por el Beni',
                'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1920&q=80',
                'link' => '/blog',
                'order' => 2,
            ],
            [
                'title' => 'Servicios para la Comunidad',
                'description' => 'Tu bienestar es nuestra prioridad',
                'image' => 'https://images.unsplash.com/photo-1509099836639-18ba1795216d?w=1920&q=80',
                'link' => 'https://siscor.beni.gob.bo',
                'order' => 3,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
