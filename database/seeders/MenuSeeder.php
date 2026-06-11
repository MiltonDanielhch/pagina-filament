<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedHeader();
        $this->seedFooter();
    }

    /**
     * Menú principal (header) — 5 bloques normativos.
     */
    protected function seedHeader(): void
    {
        $mainMenu = Menu::firstOrCreate(
            ['location' => 'header'],
            ['name' => 'Principal', 'is_active' => true]
        );

        // Limpiar items existentes
        MenuItem::where('menu_id', $mainMenu->id)->delete();

        // Items de nivel superior
        $blocks = [
            [
                'label' => 'Inicio',
                'url' => '/',
                'order' => 1,
            ],
            [
                'label' => 'La Gobernación',
                'url' => '#',
                'order' => 2,
                'children' => [
                    ['label' => 'Reseña Histórica', 'url' => '/institucional'],
                    ['label' => 'Misión, Visión y Objetivos', 'url' => '/institucional#mision-vision'],
                    ['label' => 'Marco Normativo', 'url' => '/transparencia/marco-normativo'],
                    ['label' => 'Organigrama', 'url' => '/institucional/organigrama'],
                    ['label' => 'Gobernador', 'url' => '/gobernador'],
                    ['label' => 'Gobernador y Gabinete', 'url' => '/institucional/autoridades'],
                    ['label' => 'Secretarías Departamentales', 'url' => '/institucional/secretarias'],
                ],
            ],
            [
                'label' => 'Servicios al Ciudadano',
                'url' => '#',
                'order' => 3,
                'children' => [
                    ['label' => 'Catálogo de Trámites', 'url' => '/tramites'],
                    ['label' => 'Trámites en Línea (SISCOR)', 'url' => 'https://siscor.beni.gob.bo', 'target' => '_blank'],
                    ['label' => 'Seguimiento de Trámite', 'url' => '/quejas-reclamos/seguir'],
                    ['label' => 'Quejas y Reclamos', 'url' => '/quejas-reclamos'],
                    ['label' => 'Oficinas de Atención', 'url' => '/atencion-ciudadano'],
                    ['label' => 'Directorio de Funcionarios', 'url' => '/autoridades'],
                ],
            ],
            [
                'label' => 'Transparencia',
                'url' => '#',
                'order' => 4,
                'children' => [
                    ['label' => 'Portal de Transparencia', 'url' => '/transparencia'],
                    ['label' => 'Presupuesto', 'url' => '/transparencia/presupuesto'],
                    ['label' => 'Plan Operativo Anual (POA)', 'url' => '/transparencia/poa'],
                    ['label' => 'Informes de Gestión', 'url' => '/transparencia/informes'],
                    ['label' => 'Rendición Pública de Cuentas', 'url' => '/transparencia/rendicion-cuentas'],
                    ['label' => 'Auditorías', 'url' => '/transparencia/auditorias'],
                    ['label' => 'Convocatorias y Contratación', 'url' => '/convocatorias'],
                    ['label' => 'Datos Abiertos', 'url' => '/datos-abiertos'],
                ],
            ],
            [
                'label' => 'Comunicación',
                'url' => '#',
                'order' => 5,
                'children' => [
                    ['label' => 'Noticias', 'url' => '/blog'],
                    ['label' => 'Comunicados Oficiales', 'url' => '/blog?tipo=comunicado'],
                    ['label' => 'Eventos', 'url' => '/eventos'],
                    ['label' => 'Galería', 'url' => '/galeria'],
                    ['label' => 'Agenda del Gobernador', 'url' => '/agenda'],
                ],
            ],
            [
                'label' => 'Contacto',
                'url' => '/contacto',
                'order' => 6,
            ],
        ];

        foreach ($blocks as $block) {
            $children = $block['children'] ?? null;
            unset($block['children']);

            $item = MenuItem::create(array_merge($block, [
                'menu_id' => $mainMenu->id,
                'parent_id' => null,
                'is_active' => true,
            ]));

            if ($children) {
                foreach ($children as $i => $child) {
                    MenuItem::create([
                        'menu_id' => $mainMenu->id,
                        'parent_id' => $item->id,
                        'label' => $child['label'],
                        'url' => $child['url'],
                        'target' => $child['target'] ?? '_self',
                        'order' => $i + 1,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }

    /**
     * Menú footer — 4 columnas de enlaces.
     */
    protected function seedFooter(): void
    {
        $footerMenu = Menu::firstOrCreate(
            ['location' => 'footer'],
            ['name' => 'Footer Principal', 'is_active' => true]
        );

        MenuItem::where('menu_id', $footerMenu->id)->delete();

        $footerItems = [
            // Columna 1: Servicios
            ['label' => 'Gaceta Jurídica', 'url' => 'https://gaceta.beni.gob.bo', 'target' => '_blank', 'order' => 1],
            ['label' => 'Plataforma SISCOR', 'url' => 'https://siscor.beni.gob.bo', 'target' => '_blank', 'order' => 2],
            ['label' => 'Portal de Transparencia', 'url' => 'https://transparencia.beni.gob.bo', 'target' => '_blank', 'order' => 3],
            ['label' => 'Datos Abiertos', 'url' => '/datos-abiertos', 'order' => 4],
            ['label' => 'Catálogo de Trámites', 'url' => '/tramites', 'order' => 5],

            // Columna 2: Institucional
            ['label' => 'Reseña Histórica', 'url' => '/institucional', 'order' => 6],
            ['label' => 'Marco Normativo', 'url' => '/transparencia/marco-normativo', 'order' => 7],
            ['label' => 'Organigrama', 'url' => '/institucional/organigrama', 'order' => 8],
            ['label' => 'Autoridades', 'url' => '/institucional/autoridades', 'order' => 9],
            ['label' => 'Secretarías', 'url' => '/institucional/secretarias', 'order' => 10],

            // Columna 3: Comunicación
            ['label' => 'Noticias', 'url' => '/blog', 'order' => 11],
            ['label' => 'Eventos', 'url' => '/eventos', 'order' => 12],
            ['label' => 'Galería', 'url' => '/galeria', 'order' => 13],
            ['label' => 'Convocatorias', 'url' => '/convocatorias', 'order' => 14],
            ['label' => 'Quejas y Reclamos', 'url' => '/quejas-reclamos', 'order' => 15],

            // Columna 4: Portal
            ['label' => 'Contacto', 'url' => '/contacto', 'order' => 16],
            ['label' => 'Buscador', 'url' => '/buscar', 'order' => 17],
            ['label' => 'Mapa del Sitio', 'url' => '/mapa-del-sitio', 'order' => 18],
            ['label' => 'Política de Privacidad', 'url' => '/politica-de-privacidad', 'order' => 19],
            ['label' => 'Términos de Uso', 'url' => '/terminos-de-uso', 'order' => 20],
        ];

        foreach ($footerItems as $item) {
            MenuItem::create(array_merge($item, [
                'menu_id' => $footerMenu->id,
                'is_active' => true,
            ]));
        }
    }
}
