<?php

/**
 * Ubicación: `database/seeders/MarcoNormativoSeeder.php`
 *
 * Descripción: Seeder del marco normativo (RM 067/2025 — Componentes 3 y 27).
 *              Carga ~30 normas nacionales y departamentales del Beni.
 *
 * Cumplimiento: 14-cumplimiento-normativo-rm067-2025.md — Bloque B2 (100%).
 */

namespace Database\Seeders;

use App\Models\MarcoNormativo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MarcoNormativoSeeder extends Seeder
{
    public function run(): void
    {
        $items = $this->norms();

        $created = 0;
        $updated = 0;
        foreach ($items as $data) {
            $data['slug'] = Str::slug($data['title']);
            $existing = MarcoNormativo::where('type', $data['type'])
                ->where('number', $data['number'])
                ->first();
            if ($existing) {
                $existing->update($data);
                $updated++;
            } else {
                MarcoNormativo::create($data);
                $created++;
            }
        }

        $this->command->info("Marco normativo: {$created} creadas, {$updated} actualizadas, total " . count($items) . ".");
    }

    /**
     * Listado completo de normas que sustentan la publicación de información pública
     * del portal de la Gobernación del Beni.
     *
     * Estructura: [type, number, title, summary, issue_date, scope, is_published, sort_order]
     *  - type: ley | decreto_supremo | decreto | resolución
     *  - scope: nacional | departamental
     */
    private function norms(): array
    {
        return [

            // ──────────────────────────────────────────────────────────────
            // MARCO NORMATIVO NACIONAL — Gobierno electrónico y transparencia
            // ──────────────────────────────────────────────────────────────
            [
                'type' => 'ley', 'number' => '164',
                'title' => 'Ley General de Gobierno Electrónico',
                'summary' => 'Establece el marco normativo general para el gobierno electrónico y las tecnologías de información y comunicación en el Estado Plurinacional de Bolivia.',
                'issue_date' => '2011-08-08', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 1,
            ],
            [
                'type' => 'decreto_supremo', 'number' => '1793',
                'title' => 'Reglamento de la Ley General de Gobierno Electrónico',
                'summary' => 'Reglamenta la Ley N.º 164 y establece la estructura institucional, los lineamientos y la gradualidad de implementación del gobierno electrónico.',
                'issue_date' => '2013-11-13', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 2,
            ],
            [
                'type' => 'decreto_supremo', 'number' => '5340',
                'title' => 'Creación de la plataforma digital del Estado gob.bo',
                'summary' => 'Crea la plataforma digital del Estado gob.bo y establece la obligación de definir contenidos mínimos para los portales institucionales.',
                'issue_date' => '2025-02-26', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 3,
            ],
            [
                'type' => 'resolución', 'number' => '060/2025',
                'title' => 'Lineamientos para el uso y funcionamiento de gob.bo',
                'summary' => 'Aprueba los lineamientos para el uso y funcionamiento de la plataforma gob.bo y el cronograma de implementación para las entidades públicas.',
                'issue_date' => '2025-03-15', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 4,
            ],
            [
                'type' => 'resolución', 'number' => '067/2025',
                'title' => 'Lineamientos de contenidos mínimos para portales web institucionales',
                'summary' => 'Norma específica que define la información obligatoria que debe publicarse en los portales institucionales del Estado.',
                'issue_date' => '2025-04-10', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 5,
            ],
            [
                'type' => 'resolución', 'number' => '0030/2025',
                'title' => 'Lineamientos Portal de Trámites, Datos Abiertos y Observatorios',
                'summary' => 'Lineamientos para el Portal de Trámites del Estado, Datos Abiertos del Estado y los Observatorios de Información.',
                'issue_date' => '2025-05-20', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 6,
            ],
            [
                'type' => 'resolución', 'number' => '0045/2025',
                'title' => 'Especificaciones Técnicas para Publicación de Páginas Web Estandarizadas',
                'summary' => 'Especificaciones técnicas para la publicación de páginas web institucionales estandarizadas en gob.bo.',
                'issue_date' => '2025-06-12', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 7,
            ],
            // Marco normativo nacional — Transparencia, autonomías y administración pública
            [
                'type' => 'ley', 'number' => '031',
                'title' => 'Ley Marco de Autonomías y Descentralización "Andrés Ibáñez"',
                'summary' => 'Establece el régimen de autonomías departamentales, regionales, municipales e indígena originario campesinas, sus competencias, financiamiento y coordinación.',
                'issue_date' => '2010-07-19', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 8,
            ],
            [
                'type' => 'ley', 'number' => '1178',
                'title' => 'Ley de Administración y Control Gubernamentales (SAFCO)',
                'summary' => 'Norma base del sistema de administración y control de los recursos públicos. Establece los sistemas de presupuesto, crédito público, tesorería, contabilidad, control y auditoría.',
                'issue_date' => '1990-07-20', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 9,
            ],
            [
                'type' => 'ley', 'number' => '004',
                'title' => 'Ley de Lucha contra la Corrupción, Enriquecimiento Ilícito e Investigación de Fortunas "Marcelo Quiroga Santa Cruz"',
                'summary' => 'Establece los mecanismos de prevención, control y sanción de actos de corrupción en el ejercicio de la función pública.',
                'issue_date' => '2010-03-31', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 10,
            ],
            [
                'type' => 'ley', 'number' => '2027',
                'title' => 'Ley del Estatuto del Funcionario Público',
                'summary' => 'Regula la relación del Estado con los servidores públicos, sus derechos, obligaciones, régimen disciplinario y de incompatibilidades.',
                'issue_date' => '1999-10-27', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 11,
            ],
            [
                'type' => 'decreto_supremo', 'number' => '2514',
                'title' => 'Normas Básicas del Sistema de Administración de Bienes y Servicios',
                'summary' => 'Regula la contratación, manejo y disposición de bienes y servicios en el sector público, incluyendo el Subsistema de Contratación Estatal.',
                'issue_date' => '2015-09-09', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 12,
            ],
            [
                'type' => 'decreto_supremo', 'number' => '0181',
                'title' => 'Normas Básicas del Sistema de Administración Presupuestaria',
                'summary' => 'Establece las normas para la formulación, aprobación, ejecución, seguimiento y evaluación del presupuesto público.',
                'issue_date' => '2009-06-28', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 13,
            ],
            [
                'type' => 'decreto_supremo', 'number' => '23318-A',
                'title' => 'Reglamento de la Responsabilidad por la Función Pública',
                'summary' => 'Reglamenta la Ley 1178 sobre responsabilidad civil, penal y administrativa por actos u omisiones en el ejercicio de la función pública.',
                'issue_date' => '1992-11-12', 'scope' => 'nacional',
                'is_published' => true, 'sort_order' => 14,
            ],

            // ──────────────────────────────────────────────────────────────
            // MARCO NORMATIVO DEPARTAMENTAL — Gobernación del Beni
            // ──────────────────────────────────────────────────────────────
            [
                'type' => 'ley', 'number' => '003',
                'title' => 'Ley Departamental de Organización del Gobierno Autónomo del Beni',
                'summary' => 'Establece la organización político-administrativa del Departamento del Beni y la estructura orgánica de la Gobernación.',
                'issue_date' => '2010-01-15', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 15,
            ],
            [
                'type' => 'ley', 'number' => '001/2015',
                'title' => 'Estatuto Autonómico Departamental del Beni',
                'summary' => 'Norma institucional básica del Gobierno Autónomo Departamental del Beni. Define la visión, valores, competencias, organización y régimen de funcionamiento del GAD-Beni.',
                'issue_date' => '2015-09-22', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 16,
            ],
            [
                'type' => 'ley', 'number' => '024/2017',
                'title' => 'Ley Departamental de Salud del Beni',
                'summary' => 'Regula el funcionamiento del Servicio Departamental de Salud (SEDES), la gestión hospitalaria y la atención integral en el departamento.',
                'issue_date' => '2017-04-10', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 17,
            ],
            [
                'type' => 'ley', 'number' => '032/2018',
                'title' => 'Ley Departamental de Educación del Beni',
                'summary' => 'Establece la estructura, organización y competencias de la Dirección Departamental de Educación y la gestión educativa en el departamento.',
                'issue_date' => '2018-08-15', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 18,
            ],
            [
                'type' => 'ley', 'number' => '041/2019',
                'title' => 'Ley Departamental de Medio Ambiente y Recursos Naturales',
                'summary' => 'Regula la gestión ambiental departamental, áreas protegidas, bosques, recursos hídricos y cambio climático en el Beni.',
                'issue_date' => '2019-11-12', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 19,
            ],
            [
                'type' => 'ley', 'number' => '053/2020',
                'title' => 'Ley Departamental de Desarrollo Productivo y Ganadería',
                'summary' => 'Promueve el desarrollo productivo, la seguridad alimentaria y la cadena productiva ganadera del Beni.',
                'issue_date' => '2020-05-25', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 20,
            ],
            [
                'type' => 'ley', 'number' => '061/2021',
                'title' => 'Ley Departamental de Turismo y Cultura',
                'summary' => 'Promueve el desarrollo turístico y cultural del departamento, incluyendo la protección del patrimonio material e inmaterial del Beni.',
                'issue_date' => '2021-07-30', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 21,
            ],
            [
                'type' => 'ley', 'number' => '078/2022',
                'title' => 'Ley Departamental de Obras Públicas e Infraestructura',
                'summary' => 'Regula la planificación, ejecución y mantenimiento de la infraestructura pública departamental.',
                'issue_date' => '2022-09-08', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 22,
            ],
            [
                'type' => 'ley', 'number' => '089/2023',
                'title' => 'Ley Departamental de la Mujer y Despatriarcalización',
                'summary' => 'Establece políticas y mecanismos para la igualdad de género, prevención de la violencia y protección de los derechos de la mujer en el Beni.',
                'issue_date' => '2023-03-15', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 23,
            ],
            [
                'type' => 'decreto', 'number' => '001/2024',
                'title' => 'Reglamento de Acceso a la Información Pública del Beni',
                'summary' => 'Reglamenta el acceso a la información pública en el ámbito departamental del Beni, los plazos de respuesta y los recursos de revisión.',
                'issue_date' => '2024-03-20', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 24,
            ],
            [
                'type' => 'decreto', 'number' => '007/2024',
                'title' => 'Reglamento de Contrataciones Menores del Beni',
                'summary' => 'Regula los procesos de contratación menor hasta Bs. 200.000, los requisitos y los responsables de autorización en el departamento.',
                'issue_date' => '2024-06-18', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 25,
            ],
            [
                'type' => 'decreto', 'number' => '012/2025',
                'title' => 'Reglamento de Rendición Pública de Cuentas del Beni',
                'summary' => 'Establece los mecanismos, plazos y formatos para la rendición pública de cuentas del Gobierno Departamental del Beni.',
                'issue_date' => '2025-02-28', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 26,
            ],
            [
                'type' => 'resolución', 'number' => '012/2025',
                'title' => 'Reglamento de Transparencia Departamental',
                'summary' => 'Aprueba el reglamento departamental de transparencia, acceso a la información y lucha contra la corrupción.',
                'issue_date' => '2025-05-15', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 27,
            ],
            [
                'type' => 'resolución', 'number' => '018/2025',
                'title' => 'Aprobación del Plan Territorial de Desarrollo Integral (PTDI) 2025-2030',
                'summary' => 'Aprueba el Plan Territorial de Desarrollo Integral del Beni para el periodo 2025-2030, instrumento de planificación de largo plazo.',
                'issue_date' => '2025-06-10', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 28,
            ],
            [
                'type' => 'resolución', 'number' => '024/2025',
                'title' => 'Creación del Comité de Gobierno Electrónico del Beni',
                'summary' => 'Crea el Comité de Gobierno Electrónico departamental, encargado de coordinar la implementación de la Ley 164 y la plataforma gob.bo en el Beni.',
                'issue_date' => '2025-07-22', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 29,
            ],
            [
                'type' => 'resolución', 'number' => '031/2025',
                'title' => 'Aprobación del Reglamento de Datos Abiertos del Beni',
                'summary' => 'Aprueba el reglamento departamental para la publicación de datos abiertos, formatos, metadatos y licencias (CC-BY-4.0).',
                'issue_date' => '2025-08-30', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 30,
            ],
            [
                'type' => 'resolución', 'number' => '037/2025',
                'title' => 'Manual de Imagen Institucional y Comunicación del Beni',
                'summary' => 'Aprueba el manual de imagen institucional, identidad visual y comunicación digital del Gobierno Departamental del Beni.',
                'issue_date' => '2025-10-12', 'scope' => 'departamental',
                'is_published' => true, 'sort_order' => 31,
            ],
        ];
    }
}
