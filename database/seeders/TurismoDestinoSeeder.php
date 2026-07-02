<?php

namespace Database\Seeders;

use App\Models\TurismoDestino;
use Illuminate\Database\Seeder;

class TurismoDestinoSeeder extends Seeder
{
    public function run(): void
    {
        // ──────────────────────────────────────────────
        // HOME DESTACADOS (for homepage Turismo section)
        // ──────────────────────────────────────────────
        TurismoDestino::create([
            'title'       => 'Ruta del Bufeo',
            'description' => 'Descubre la magia del delfín rosado en su hábitat natural, navegando los ríos Mamoré e Iténez.',
            'category'    => 'home',
            'is_published' => true,
            'sort_order'  => 1,
        ]);

        TurismoDestino::create([
            'title'       => 'Llanos de Moxos',
            'description' => 'Explora los paisajes más exuberantes de la llanura beniana, santuario de biodiversidad y cultura milenaria.',
            'category'    => 'home',
            'is_published' => true,
            'sort_order'  => 2,
        ]);

        TurismoDestino::create([
            'title'       => 'Misiones Jesuíticas',
            'description' => 'Recorre el legado arquitectónico y espiritual de las reducciones jesuíticas, patrimonio vivo de la fe.',
            'category'    => 'home',
            'is_published' => true,
            'sort_order'  => 3,
        ]);

        TurismoDestino::create([
            'title'       => 'Gastronomía Beniana',
            'description' => 'Sabores autóctonos que cautivan el paladar: Majadito, Masaco, Keperí y la tradición culinaria de la llanura.',
            'category'    => 'home',
            'is_published' => true,
            'sort_order'  => 4,
        ]);

        // ──────────────────────────────────────────────
        // BIODIVERSIDAD (mini cards + main image)
        // ──────────────────────────────────────────────
        TurismoDestino::create([
            'title'       => 'Cuencas Hídricas',
            'description' => 'Red de navegación natural.',
            'category'    => 'biodiversidad',
            'is_published' => true,
            'sort_order'  => 1,
        ]);

        TurismoDestino::create([
            'title'       => 'Fauna Exótica',
            'description' => 'Hogar del Bufeo y la Paraba Barba Azul.',
            'category'    => 'biodiversidad',
            'is_published' => true,
            'sort_order'  => 2,
        ]);

        // ──────────────────────────────────────────────
        // CULTURA Y TRADICIÓN (4 cards in 2-col/1-col grid)
        // ──────────────────────────────────────────────
        TurismoDestino::create([
            'title'       => 'Sabores de la Llanura',
            'description' => 'El Majadito, el Masaco y el Keperí: un viaje culinario por nuestra historia.',
            'category'    => 'cultura',
            'is_published' => true,
            'sort_order'  => 1,
        ]);

        TurismoDestino::create([
            'title'       => 'Chope Fiesta',
            'description' => 'La Gran Fiesta de la Santísima Trinidad.',
            'category'    => 'cultura',
            'is_published' => true,
            'sort_order'  => 2,
        ]);

        TurismoDestino::create([
            'title'       => 'Manos Benianas',
            'description' => 'Artesanía en palma y maderas nobles.',
            'category'    => 'cultura',
            'is_published' => true,
            'sort_order'  => 3,
        ]);

        TurismoDestino::create([
            'title'       => 'Misiones Jesuíticas',
            'description' => 'Un legado arquitectónico y espiritual que trasciende los siglos.',
            'category'    => 'cultura',
            'is_published' => true,
            'sort_order'  => 4,
        ]);

        // ──────────────────────────────────────────────
        // SANTUARIOS NATURALES (3 cards with location badges)
        // ──────────────────────────────────────────────
        TurismoDestino::create([
            'title'         => 'PD ANMI Iténez',
            'description'   => 'Biodiversidad fluvial inigualable y frontera natural biológica.',
            'category'      => 'santuario',
            'location_name' => 'Provincia Iténez',
            'is_published'  => true,
            'sort_order'    => 1,
        ]);

        TurismoDestino::create([
            'title'         => 'TIPNIS',
            'description'   => 'Parque Nacional Isiboro Sécure, territorio indígena y pulmón del mundo.',
            'category'      => 'santuario',
            'location_name' => 'Sur del Beni',
            'is_published'  => true,
            'sort_order'    => 2,
        ]);

        TurismoDestino::create([
            'title'         => 'E.B. del Beni',
            'description'   => 'Centro de investigación y reserva de la biosfera (UNESCO).',
            'category'      => 'santuario',
            'location_name' => 'Provincia Ballivián',
            'is_published'  => true,
            'sort_order'    => 3,
        ]);

        // ──────────────────────────────────────────────
        // VENTANAS AL PARAÍSO (Galería — 4 images)
        // ──────────────────────────────────────────────
        TurismoDestino::create([
            'title'       => 'Atardecer en la llanura beniana',
            'description' => 'La luz dorada del Beni pintando el horizonte infinito.',
            'category'    => 'galeria',
            'is_published' => true,
            'sort_order'  => 1,
        ]);

        TurismoDestino::create([
            'title'       => 'Bufeo boliviano en el río',
            'description' => 'El delfín rosado, símbolo viviente de nuestra Amazonía.',
            'category'    => 'galeria',
            'is_published' => true,
            'sort_order'  => 2,
        ]);

        TurismoDestino::create([
            'title'       => 'Paisaje ganadero del Beni',
            'description' => 'La llanura beniana, tradición ganadera y horizontes sin fin.',
            'category'    => 'galeria',
            'is_published' => true,
            'sort_order'  => 3,
        ]);

        TurismoDestino::create([
            'title'       => 'Vista aérea de ríos benianos',
            'description' => 'Los majestuosos ríos Mamoré, Beni e Iténez desde las alturas.',
            'category'    => 'galeria',
            'is_published' => true,
            'sort_order'  => 4,
        ]);
    }
}
