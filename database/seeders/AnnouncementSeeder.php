<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Secretariat;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $secretariats = Secretariat::pluck('id', 'acronym');

        $items = [
            [
                'code' => 'GAD-BENI-2026-001',
                'type' => 'convocatoria_publica',
                'title' => 'Convocatoria para Notario de Gobierno del Beni 2026',
                'description' => "Convocatoria pública para la selección y designación de Notario de Gobierno del Departamento del Beni, gestión 2026.\n\nLos postulantes deberán cumplir los requisitos establecidos en la convocatoria y presentar su documentación en sobre cerrado en la Secretaría General.",
                'requirements' => "- Ser ciudadano boliviano en ejercicio\n- Título en Derecho con matrícula profesional vigente\n- Experiencia mínima de 5 años en el ejercicio profesional\n- No tener antecedentes penales ni sanciones disciplinarias\n- Cumplir con los demás requisitos del DBC",
                'publication_date' => '2026-04-15',
                'opening_date' => '2026-04-15 08:00:00',
                'closing_date' => '2026-06-30 16:00:00',
                'status' => 'en_proceso',
                'external_url' => 'https://sicoes.gob.bo',
                'sort_order' => 1,
                'secretariat' => 'SG',
            ],
            [
                'code' => 'GAD-BENI-2026-002',
                'type' => 'contratacion',
                'title' => 'Contratación de Empresa para Construcción de Pavimento Av. Costanera',
                'description' => "Licitación pública para la contratación de empresa constructora que ejecutará la obra de pavimentación de la Avenida Costanera de Trinidad, Tramo I.",
                'requirements' => "- Registro vigente en el Padrón Nacional de Constructores\n- NIT activo y al día en obligaciones tributarias\n- Experiencia general mínima de 10 años\n- Experiencia específica en obras de pavimentación vial urbana (3 obras mínimo)\n- Capacidad financiera y técnica demostrable",
                'publication_date' => '2026-05-10',
                'opening_date' => '2026-05-20 09:00:00',
                'closing_date' => '2026-06-25 15:00:00',
                'status' => 'publicada',
                'external_url' => 'https://sicoes.gob.bo/portal/index.php?opcion=2&id=convocatorias',
                'sort_order' => 2,
                'secretariat' => 'SDOPI',
            ],
            [
                'code' => 'GAD-BENI-2026-003',
                'type' => 'consultoria',
                'title' => 'Consultoría para Diseño del Plan Departamental de Cambio Climático',
                'description' => "Contratación de consultoría individual o por asociación para el diseño del Plan Departamental de Cambio Climático del Beni, con enfoque de gestión de riesgos.",
                'requirements' => "- Profesional con título en Ciencias Ambientales, Biología, Ingeniería o afín\n- Maestría en Cambio Climático, Gestión Ambiental o similar\n- Experiencia comprobable en formulación de planes de cambio climático (5 años mínimo)\n- Conocimiento de la realidad amazónica boliviana",
                'publication_date' => '2026-05-25',
                'opening_date' => '2026-06-05 09:00:00',
                'closing_date' => '2026-07-15 16:00:00',
                'status' => 'publicada',
                'external_url' => 'https://sicoes.gob.bo',
                'sort_order' => 3,
                'secretariat' => 'SDMAN',
            ],
            [
                'code' => 'GAD-BENI-2026-004',
                'type' => 'convocatoria_publica',
                'title' => 'Convocatoria a Becas Universitarias Beni 2026',
                'description' => "Convocatoria pública para acceder a becas universitarias gestión 2026, dirigidas a bachilleres destacados de escasos recursos del Departamento del Beni.",
                'requirements' => "- Bachiller egresado de unidades educativas del Beni\n- Haber obtenido un promedio mínimo de 80/100 en la secundaria\n- Acreditar insuficiencia económica\n- Carta de admisión a universidad pública o privada\n- No tener otra beca vigente",
                'publication_date' => '2026-02-01',
                'opening_date' => '2026-02-15 08:00:00',
                'closing_date' => '2026-04-30 16:00:00',
                'status' => 'finalizada',
                'sort_order' => 4,
                'secretariat' => 'SDE',
            ],
        ];

        foreach ($items as $data) {
            $secretariatAcronym = $data['secretariat'];
            unset($data['secretariat']);

            $secretariatId = $secretariats[$secretariatAcronym] ?? null;

            Announcement::updateOrCreate(
                ['code' => $data['code']],
                $data + [
                    'slug' => \Illuminate\Support\Str::slug($data['title']),
                    'responsible_secretariat_id' => $secretariatId,
                ]
            );
        }
    }
}
