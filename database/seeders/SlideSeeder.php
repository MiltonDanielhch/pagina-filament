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
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
