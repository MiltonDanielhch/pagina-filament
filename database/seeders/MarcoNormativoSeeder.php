<?php

namespace Database\Seeders;

use App\Models\MarcoNormativo;
use Illuminate\Database\Seeder;

class MarcoNormativoSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // Marco normativo nacional
            [
                'type' => 'ley',
                'number' => '164',
                'title' => 'Ley General de Gobierno Electrónico',
                'summary' => 'Establece el marco normativo general para el gobierno electrónico y las tecnologías de información y comunicación en el Estado Plurinacional de Bolivia.',
                'issue_date' => '2011-08-08',
                'scope' => 'nacional',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'type' => 'decreto_supremo',
                'number' => '1793',
                'title' => 'Reglamento de la Ley General de Gobierno Electrónico',
                'summary' => 'Reglamenta la Ley N.º 164 y establece la estructura institucional, los lineamientos y la gradualidad de implementación del gobierno electrónico.',
                'issue_date' => '2013-11-13',
                'scope' => 'nacional',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'type' => 'decreto_supremo',
                'number' => '5340',
                'title' => 'Creación de la plataforma digital del Estado gob.bo',
                'summary' => 'Crea la plataforma digital del Estado gob.bo y establece la obligación de definir contenidos mínimos para los portales institucionales.',
                'issue_date' => '2025-02-26',
                'scope' => 'nacional',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'type' => 'resolución',
                'number' => '060/2025',
                'title' => 'Lineamientos para el uso y funcionamiento de gob.bo',
                'summary' => 'Aprueba los lineamientos para el uso y funcionamiento de la plataforma gob.bo y el cronograma de implementación para las entidades públicas.',
                'issue_date' => '2025-03-15',
                'scope' => 'nacional',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'type' => 'resolución',
                'number' => '067/2025',
                'title' => 'Lineamientos de contenidos mínimos para portales web institucionales',
                'summary' => 'Norma específica que define la información obligatoria que debe publicarse en los portales institucionales del Estado.',
                'issue_date' => '2025-04-10',
                'scope' => 'nacional',
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'type' => 'resolución',
                'number' => '0030/2025',
                'title' => 'Lineamientos Portal de Trámites, Datos Abiertos y Observatorios',
                'summary' => 'Lineamientos para el Portal de Trámites del Estado, Datos Abiertos del Estado y los Observatorios de Información.',
                'issue_date' => '2025-05-20',
                'scope' => 'nacional',
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'type' => 'resolución',
                'number' => '0045/2025',
                'title' => 'Especificaciones Técnicas para Publicación de Páginas Web Estandarizadas',
                'summary' => 'Especificaciones técnicas para la publicación de páginas web institucionales estandarizadas en gob.bo.',
                'issue_date' => '2025-06-12',
                'scope' => 'nacional',
                'is_published' => true,
                'sort_order' => 7,
            ],
            // Marco normativo departamental
            [
                'type' => 'ley',
                'number' => '003',
                'title' => 'Ley Departamental de Organización del Beni',
                'summary' => 'Establece la organización político-administrativa del Departamento del Beni.',
                'issue_date' => '2010-01-15',
                'scope' => 'departamental',
                'is_published' => true,
                'sort_order' => 8,
            ],
            [
                'type' => 'decreto',
                'number' => '001/2024',
                'title' => 'Reglamento de Acceso a la Información Pública del Beni',
                'summary' => 'Reglamenta el acceso a la información pública en el ámbito departamental del Beni.',
                'issue_date' => '2024-03-20',
                'scope' => 'departamental',
                'is_published' => true,
                'sort_order' => 9,
            ],
            [
                'type' => 'resolución',
                'number' => '012/2025',
                'title' => 'Reglamento de Transparencia Departamental',
                'summary' => 'Aprueba el reglamento departamental de transparencia y lucha contra la corrupción.',
                'issue_date' => '2025-05-15',
                'scope' => 'departamental',
                'is_published' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($items as $data) {
            MarcoNormativo::updateOrCreate(
                ['type' => $data['type'], 'number' => $data['number']],
                $data + ['slug' => \Illuminate\Support\Str::slug($data['title'])]
            );
        }
    }
}
