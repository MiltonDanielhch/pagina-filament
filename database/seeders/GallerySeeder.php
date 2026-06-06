<?php

/**
 * Ubicación: `database/seeders/GallerySeeder.php`
 *
 * Descripción: Seeder con ejemplos de galerías multimedia.
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        // Galería 1: Inauguración de obra de infraestructura
        $gallery1 = Gallery::create([
            'user_id' => $user->id,
            'title' => 'Inauguración del Hospital Regional',
            'slug' => 'inauguracion-hospital-regional',
            'description' => 'Galería fotográfica de la inauguración del nuevo Hospital Regional del Beni, un hito importante para la salud departamental.',
            'type' => 'photo',
            'event_date' => now()->subMonths(2),
            'is_featured' => true,
            'status' => 'published',
        ]);

        // Ítems para galería 1
        GalleryItem::create([
            'gallery_id' => $gallery1->id,
            'title' => 'Corte de cinta',
            'caption' => 'El Gobernador del Beni realiza el corte de cinta simbólico.',
            'type' => 'image',
            'image_path' => 'gallery-items/hospital-1.jpg',
            'sort_order' => 1,
        ]);

        // Galería 2: Festival de Cultura Beniana
        $gallery2 = Gallery::create([
            'user_id' => $user->id,
            'title' => 'Festival de Cultura Beniana 2025',
            'slug' => 'festival-cultura-beniana-2025',
            'description' => 'Celebración de las tradiciones y cultura del Beni con participación de artistas locales.',
            'type' => 'mixed',
            'event_date' => now()->subMonths(1),
            'is_featured' => true,
            'status' => 'published',
        ]);

        // Ítems para galería 2
        GalleryItem::create([
            'gallery_id' => $gallery2->id,
            'title' => 'Video del festival',
            'caption' => 'Resumen del festival de cultura.',
            'type' => 'video',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'youtube_id' => 'dQw4w9WgXcQ',
            'sort_order' => 2,
        ]);


        // Galería 3: Videos institucionales
        $gallery3 = Gallery::create([
            'user_id' => $user->id,
            'title' => 'Videos Institucionales',
            'slug' => 'videos-institucionales',
            'description' => 'Repositorio de videos oficiales de la Gobernación del Beni.',
            'type' => 'video',
            'event_date' => now()->subMonths(3),
            'is_featured' => false,
            'status' => 'published',
        ]);

        // Ítems para galería 3
        GalleryItem::create([
            'gallery_id' => $gallery3->id,
            'title' => 'Mensaje del Gobernador',
            'caption' => 'Mensaje institucional del Gobernador del Beni.',
            'type' => 'video',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'youtube_id' => 'dQw4w9WgXcQ',
            'sort_order' => 1,
        ]);

        GalleryItem::create([
            'gallery_id' => $gallery3->id,
            'title' => 'Reporte de gestión',
            'caption' => 'Reporte de gestión trimestral.',
            'type' => 'video',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'youtube_id' => 'dQw4w9WgXcQ',
            'sort_order' => 2,
        ]);
    }
}
