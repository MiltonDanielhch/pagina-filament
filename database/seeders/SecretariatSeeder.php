<?php

namespace Database\Seeders;

use App\Models\Secretariat;
use Illuminate\Database\Seeder;

class SecretariatSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Secretaría General',
                'acronym' => 'SG',
                'description' => 'Coordinación general de la gestión gubernativa y enlace con las demás secretarías.',
                'mission' => 'Coordinar y supervisar la gestión administrativa, jurídica y de planificación del Gobierno Departamental del Beni.',
                'vision' => 'Ser el eje articulador de una gobernación moderna, eficiente y cercana a la ciudadanía beniana.',
                'objectives' => [
                    'Coordinar acciones entre secretarías',
                    'Supervisar el cumplimiento de la agenda gubernativa',
                    'Atender los asuntos jurídicos y normativos',
                ],
                'color' => '#0f766e',
                'sort_order' => 1,
            ],
            [
                'name' => 'Secretaría Departamental de Hacienda',
                'acronym' => 'SDH',
                'description' => 'Administración de los recursos financieros, presupuestarios y patrimoniales de la Gobernación.',
                'mission' => 'Administrar con transparencia y eficiencia los recursos económicos del Gobierno Departamental del Beni.',
                'vision' => 'Ser una gestión financiera modelo, con presupuesto participativo y rendición de cuentas.',
                'objectives' => [
                    'Elaborar y ejecutar el presupuesto departamental',
                    'Administrar el patrimonio institucional',
                    'Gestionar la recaudación tributaria',
                ],
                'color' => '#1e40af',
                'sort_order' => 2,
            ],
            [
                'name' => 'Secretaría Departamental de Salud',
                'acronym' => 'SDS',
                'description' => 'Política departamental de salud, red de servicios y atención hospitalaria.',
                'mission' => 'Garantizar el acceso universal a servicios de salud de calidad en el Departamento del Beni.',
                'vision' => 'Un sistema de salud departamental integrado, resolutivo y con enfoque intercultural.',
                'objectives' => [
                    'Fortalecer la red hospitalaria',
                    'Prevenir y controlar enfermedades endémicas (dengue, malaria)',
                    'Mejorar la atención primaria en comunidades rurales',
                ],
                'color' => '#dc2626',
                'sort_order' => 3,
            ],
            [
                'name' => 'Secretaría Departamental de Educación',
                'acronym' => 'SDE',
                'description' => 'Gestión educativa, infraestructura escolar y formación docente.',
                'mission' => 'Promover una educación inclusiva, intercultural y de calidad para todos los benianos.',
                'vision' => 'Un sistema educativo departamental referente nacional por su calidad y pertinencia cultural.',
                'objectives' => [
                    'Mejorar la infraestructura escolar',
                    'Fortalecer la formación docente',
                    'Promover la educación intercultural bilingüe',
                ],
                'color' => '#f59e0b',
                'sort_order' => 4,
            ],
            [
                'name' => 'Secretaría Departamental de Obras Públicas e Infraestructura',
                'acronym' => 'SDOPI',
                'description' => 'Construcción, mantenimiento y supervisión de obras de infraestructura departamental.',
                'mission' => 'Construir y mantener la infraestructura que impulse el desarrollo del Departamento del Beni.',
                'vision' => 'Un Beni conectado, con infraestructura moderna y servicios públicos de calidad.',
                'objectives' => [
                    'Mejorar la red vial departamental',
                    'Construir y mantener infraestructura pública',
                    'Supervisar la calidad de las obras',
                ],
                'color' => '#7c3aed',
                'sort_order' => 5,
            ],
            [
                'name' => 'Secretaría Departamental de Desarrollo Productivo',
                'acronym' => 'SDDP',
                'description' => 'Fomento a la producción agropecuaria, ganadería, pesca y turismo del Beni.',
                'mission' => 'Impulsar el desarrollo productivo sostenible del Departamento del Beni con enfoque de economía plural.',
                'vision' => 'Un Beni productivo, competitivo y referente nacional en producción ganadera y turismo.',
                'objectives' => [
                    'Fortalecer la cadena ganadera bovina',
                    'Apoyar a pequeños productores',
                    'Promover el turismo sostenible',
                ],
                'color' => '#16a34a',
                'sort_order' => 6,
            ],
            [
                'name' => 'Secretaría Departamental de Medio Ambiente y Recursos Naturales',
                'acronym' => 'SDMAN',
                'description' => 'Conservación ambiental, gestión de cuencas y áreas protegidas.',
                'mission' => 'Proteger y conservar el patrimonio natural del Beni para las presentes y futuras generaciones.',
                'vision' => 'Un Beni ambientalmente sostenible, con su riqueza amazónica preservada.',
                'objectives' => [
                    'Proteger las áreas protegidas',
                    'Gestionar cuencas hidrográficas',
                    'Controlar la contaminación y deforestación',
                ],
                'color' => '#059669',
                'sort_order' => 7,
            ],
            [
                'name' => 'Secretaría Departamental de Cultura y Turismo',
                'acronym' => 'SDCT',
                'description' => 'Promoción cultural, patrimonial y turística del Departamento del Beni.',
                'mission' => 'Rescatar, preservar y difundir la identidad cultural beniana, promoviendo el turismo como motor de desarrollo.',
                'vision' => 'Un Beni referente cultural y turístico del norte amazónico.',
                'objectives' => [
                    'Promover el patrimonio cultural y folclórico',
                    'Fortalecer la oferta turística',
                    'Apoyar a artistas y gestores culturales',
                ],
                'color' => '#db2777',
                'sort_order' => 8,
            ],
            [
                'name' => 'Secretaría Departamental de Justicia y Transparencia',
                'acronym' => 'SDJT',
                'description' => 'Transparencia, lucha contra la corrupción y acceso a la justicia.',
                'mission' => 'Promover la transparencia, la ética pública y el acceso a la justicia en el ámbito departamental.',
                'vision' => 'Una gestión departamental transparente, íntegra y con rendición de cuentas efectiva.',
                'objectives' => [
                    'Implementar políticas de transparencia',
                    'Prevenir y combatir la corrupción',
                    'Garantizar el acceso a la información pública',
                ],
                'color' => '#475569',
                'sort_order' => 9,
            ],
        ];

        foreach ($items as $data) {
            Secretariat::updateOrCreate(
                ['acronym' => $data['acronym']],
                $data + ['slug' => \Illuminate\Support\Str::slug($data['name']), 'is_active' => true]
            );
        }
    }
}
