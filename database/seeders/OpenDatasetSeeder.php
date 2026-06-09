<?php

namespace Database\Seeders;

use App\Models\OpenDataset;
use Illuminate\Database\Seeder;

class OpenDatasetSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Ejecución Presupuestaria del Gobierno Departamental del Beni 2025',
                'description' => 'Datos detallados de la ejecución presupuestaria de ingresos y gastos del Gobierno Departamental del Beni, correspondientes a la gestión 2025. Incluye clasificación por programa, actividad y fuente de financiamiento.',
                'category' => 'presupuesto',
                'publisher' => 'Secretaría Departamental de Hacienda',
                'update_frequency' => 'trimestral',
                'last_updated_at' => '2026-04-15',
                'formats' => ['csv', 'json', 'xlsx', 'pdf'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Directorio de Funcionarios Públicos del Beni',
                'description' => 'Directorio oficial de funcionarios del Gobierno Departamental del Beni, con cargo, dependencia, contacto y fecha de ingreso.',
                'category' => 'recursos_humanos',
                'publisher' => 'Secretaría General',
                'update_frequency' => 'mensual',
                'last_updated_at' => '2026-06-01',
                'formats' => ['csv', 'xlsx'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Estadísticas de Salud — Dengue y Malaria Beni',
                'description' => 'Series históricas de casos reportados y atendidos de dengue y malaria en los municipios del Beni, con desagregación por semana epidemiológica.',
                'category' => 'salud',
                'publisher' => 'Secretaría Departamental de Salud',
                'update_frequency' => 'semanal',
                'last_updated_at' => '2026-06-02',
                'formats' => ['csv', 'json'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Contrataciones Públicas — Licitaciones 2024-2026',
                'description' => 'Registro de procesos de contratación pública publicados en SICOES, correspondientes al Gobierno Departamental del Beni.',
                'category' => 'contrataciones',
                'publisher' => 'Secretaría Departamental de Hacienda',
                'update_frequency' => 'mensual',
                'last_updated_at' => '2026-06-01',
                'formats' => ['csv', 'xlsx'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Matrícula Estudiantil Departamental 2026',
                'description' => 'Datos de matrícula escolar por distrito educativo, nivel y área geográfica para la gestión 2026.',
                'category' => 'educacion',
                'publisher' => 'Secretaría Departamental de Educación',
                'update_frequency' => 'anual',
                'last_updated_at' => '2026-03-15',
                'formats' => ['csv', 'xlsx', 'pdf'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Proyectos de Inversión Pública del Beni',
                'description' => 'Inventario de proyectos de inversión ejecutados y en ejecución por el Gobierno Departamental del Beni, con presupuesto, avance y beneficiarios.',
                'category' => 'inversion',
                'publisher' => 'Secretaría Departamental de Obras Públicas',
                'update_frequency' => 'trimestral',
                'last_updated_at' => '2026-04-30',
                'formats' => ['csv', 'json', 'xlsx'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Nómina de Establecimientos Educativos',
                'description' => 'Listado georreferenciado de unidades educativas fiscales, de convenio y privadas del Departamento del Beni.',
                'category' => 'educacion',
                'publisher' => 'Secretaría Departamental de Educación',
                'update_frequency' => 'anual',
                'last_updated_at' => '2026-02-10',
                'formats' => ['csv', 'xlsx'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Catastro de Establecimientos de Salud',
                'description' => 'Listado de hospitales, centros y puestos de salud del Departamento del Beni con tipo, nivel, capacidad y ubicación.',
                'category' => 'salud',
                'publisher' => 'Secretaría Departamental de Salud',
                'update_frequency' => 'anual',
                'last_updated_at' => '2026-02-20',
                'formats' => ['csv', 'xlsx'],
                'license' => 'CC-BY-4.0',
                'is_published' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($items as $data) {
            OpenDataset::updateOrCreate(
                ['title' => $data['title']],
                $data + ['slug' => \Illuminate\Support\Str::slug($data['title'])]
            );
        }
    }
}
