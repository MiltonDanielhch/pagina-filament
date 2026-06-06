<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Menú Principal
        $mainMenu = Menu::create([
            'name' => 'Principal',
            'location' => 'header',
            'is_active' => true,
        ]);

        $menuItems = [
            ['label' => 'Inicio', 'url' => '/', 'order' => 1],
            ['label' => 'Noticias', 'url' => '/blog', 'order' => 2],
            ['label' => 'Gobernador', 'url' => '/gobernador', 'order' => 3],
            ['label' => 'Ver más', 'url' => '#', 'order' => 4, 'is_dropdown' => true],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create(array_merge($item, [
                'menu_id' => $mainMenu->id,
                'is_active' => true,
            ]));
        }

        // Crear items hijos para "Ver más"
        $verMasItem = MenuItem::where('menu_id', $mainMenu->id)->where('label', 'Ver más')->first();
        
        if ($verMasItem) {
            $childItems = [
                ['label' => 'Eventos', 'url' => '/eventos', 'order' => 1],
                ['label' => 'Galería', 'url' => '/galeria', 'order' => 2],
                ['label' => 'Agenda', 'url' => '/agenda', 'order' => 3],
                ['label' => 'Resultados', 'url' => '/resultados', 'order' => 4],
                ['label' => 'Estadísticas', 'url' => '/estadisticas', 'order' => 5],
                ['label' => 'Autoridades', 'url' => '/autoridades', 'order' => 6],
                ['label' => 'Contacto', 'url' => '/contacto', 'order' => 7],
            ];

            foreach ($childItems as $item) {
                MenuItem::create(array_merge($item, [
                    'menu_id' => $mainMenu->id,
                    'parent_id' => $verMasItem->id,
                    'is_active' => true,
                ]));
            }
        }

        // Menú Footer
        $footerMenu = Menu::create([
            'name' => 'Footer Principal',
            'location' => 'footer',
            'is_active' => true,
        ]);

        $footerItems = [
            ['label' => 'Gaceta Jurídica', 'url' => 'https://gaceta.beni.gob.bo', 'target' => '_blank', 'order' => 1],
            ['label' => 'SISCOR', 'url' => 'https://siscor.beni.gob.bo', 'target' => '_blank', 'order' => 2],
            ['label' => 'Transparencia', 'url' => 'https://transparencia.beni.gob.bo', 'target' => '_blank', 'order' => 3],
            ['label' => 'Buscador', 'url' => '/buscar', 'order' => 4],
            ['label' => 'Política de Privacidad', 'url' => '/politica-de-privacidad', 'order' => 5],
            ['label' => 'Trámites Online', 'url' => 'https://siscor.beni.gob.bo', 'target' => '_blank', 'order' => 6],
            ['label' => 'Noticias', 'url' => '/blog', 'order' => 7],
            ['label' => 'Eventos', 'url' => '/eventos', 'order' => 8],
            ['label' => 'Directorio', 'url' => '/directorio', 'order' => 9],
        ];

        foreach ($footerItems as $item) {
            MenuItem::create(array_merge($item, [
                'menu_id' => $footerMenu->id,
                'is_active' => true,
            ]));
        }
    }
}
