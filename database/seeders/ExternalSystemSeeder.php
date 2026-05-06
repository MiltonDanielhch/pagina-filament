<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExternalSystemSeeder extends Seeder
{
    public function run(): void
    {
        $systems = [
            [
                'name' => 'Gaceta Jurídica',
                'url' => 'https://gaceta.beni.gob.bo',
                'description' => 'Publicación oficial de leyes, decrees y resoluciones',
                'icon' => 'document-text',
                'order' => 1,
            ],
            [
                'name' => 'SISCOR',
                'url' => 'https://siscor.beni.gob.bo',
                'description' => 'Sistema de seguimiento de trámites',
                'icon' => 'clipboard-check',
                'order' => 2,
            ],
            [
                'name' => 'Transparencia',
                'url' => 'https://transparencia.beni.gob.bo',
                'description' => 'Portal de transparencia y denuncias',
                'icon' => 'eye',
                'order' => 3,
            ],
        ];

        foreach ($systems as $system) {
            \App\Models\ExternalSystem::create($system);
        }
    }
}
