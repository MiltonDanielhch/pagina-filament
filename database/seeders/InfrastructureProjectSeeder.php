<?php

/**
 * Ubicación: `database/seeders/InfrastructureProjectSeeder.php`
 *
 * Descripción: Seeder para proyectos de inversión pública del Beni.
 *              Usa los nuevos campos del B4 (RM 067/2025).
 *
 * Cumplimiento: 14-cumplimiento-normativo-rm067-2025.md — Bloque B4.
 */

namespace Database\Seeders;

use App\Models\InfrastructureProject;
use App\Models\Secretariat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InfrastructureProjectSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            $this->command->warn('No users found. Skipping InfrastructureProjectSeeder.');
            return;
        }

        // Vincular secretarías por nombre (si existen en BD)
        $secretariats = Secretariat::pluck('id', 'name');

        $findSec = function (string $name) use ($secretariats) {
            foreach ($secretariats as $key => $id) {
                if (Str::contains(Str::lower($key), Str::lower($name))) {
                    return $id;
                }
            }
            return null;
        };

        $projects = [
            [
                'code'     => 'GAD-BENI-PI-2024-001',
                'title'    => 'Hospital Regional de Trinidad',
                'slug'     => 'hospital-regional-trinidad',
                'description' => 'Construcción del nuevo hospital regional con capacidad de 200 camas, 6 quirófanos y equipamiento médico moderno. La obra incluye áreas de emergencia, hospitalización, consultas externas, laboratorio, imagenología y farmacia institucional.',
                'category' => 'salud',
                'municipality' => 'trinidad',
                'latitude' => -14.8333,
                'longitude' => -64.9,
                'status' => InfrastructureProject::STATUS_PROGRESS,
                'is_featured' => true,
                'progress_percentage' => 65,
                'start_date' => '2024-01-15',
                'end_date_planned' => '2026-06-30',
                'budget' => 185_500_000.00,
                'contracting_company' => 'Constructora Boliviana S.A.',
                'financing_source' => 'TGN + Crédito CAF',
                'contract_number' => 'GAD-BENI-CONT-2024-001',
                'beneficiary_communities' => [
                    'Trinidad (zona urbana)'    => 38000,
                    'San Javier'                => 4200,
                    'San Pedro'                 => 3100,
                    'Comunidades rurales Beni'  => 12000,
                ],
                'secretariat_id' => $findSec('salud'),
            ],
            [
                'code'     => 'GAD-BENI-PI-2024-002',
                'title'    => 'Puente vehicular sobre el Río Mamoré (San Borja)',
                'slug'     => 'puente-rio-mamore-san-borja',
                'description' => 'Construcción de puente vehicular de 320 m sobre el Río Mamoré para conectar los municipios de San Borja y Trinidad, beneficiando a más de 40.000 habitantes y dinamizando el comercio regional.',
                'category' => 'infraestructura',
                'municipality' => 'san_borja',
                'latitude' => -14.4167,
                'longitude' => -66.8833,
                'status' => InfrastructureProject::STATUS_PROGRESS,
                'is_featured' => true,
                'progress_percentage' => 42,
                'start_date' => '2024-03-01',
                'end_date_planned' => '2026-12-15',
                'budget' => 92_000_000.00,
                'contracting_company' => 'Asociación Vial Mamoré',
                'financing_source' => 'IDH + BCB',
                'contract_number' => 'GAD-BENI-CONT-2024-002',
                'beneficiary_communities' => [
                    'San Borja'        => 24500,
                    'Reyes'            => 6800,
                    'Rurrenabaque'     => 19500,
                    'San Ignacio'      => 22300,
                ],
                'secretariat_id' => $findSec('obras') ?? $findSec('infraestructura'),
            ],
            [
                'code'     => 'GAD-BENI-PI-2025-003',
                'title'    => 'Sistema de Alcantarillado Sanitario — San Borja',
                'slug'     => 'sistema-alcantarillado-san-borja',
                'description' => 'Instalación de 48 km de red de alcantarillado sanitario, planta de tratamiento de aguas residuales y 1.200 conexiones domiciliarias en la ciudad de San Borja.',
                'category' => 'agua',
                'municipality' => 'san_borja',
                'latitude' => -14.8583,
                'longitude' => -66.7472,
                'status' => InfrastructureProject::STATUS_PLANNING,
                'is_featured' => false,
                'progress_percentage' => 5,
                'start_date' => '2025-09-01',
                'end_date_planned' => '2027-08-30',
                'budget' => 38_500_000.00,
                'contracting_company' => 'Hidrobeni S.R.L.',
                'financing_source' => 'Cooperación BID',
                'contract_number' => 'GAD-BENI-CONT-2025-003',
                'beneficiary_communities' => [
                    'San Borja (zona urbana)' => 24500,
                    'Comunidades ribereñas'   => 1800,
                ],
                'secretariat_id' => $findSec('agua') ?? $findSec('infraestructura'),
            ],
            [
                'code'     => 'GAD-BENI-PI-2023-004',
                'title'    => 'Electrificación Rural Riberalta — Tumi Cielo',
                'slug'     => 'electrificacion-rural-riberalta',
                'description' => 'Extensión de red eléctrica trifásica de 22 km y 8 km de red monofásica para las comunidades Tumi Cielo, El Prado, 6 de Agosto y Villa Fátima. Incluye 12 subestaciones de distribución.',
                'category' => 'energia',
                'municipality' => 'riberalta',
                'latitude' => -11.0,
                'longitude' => -66.05,
                'status' => InfrastructureProject::STATUS_COMPLETED,
                'is_featured' => true,
                'progress_percentage' => 100,
                'start_date' => '2023-04-10',
                'end_date_planned' => '2024-11-30',
                'end_date_real'    => '2024-10-22',
                'budget' => 12_800_000.00,
                'contracting_company' => 'ENDE Beni',
                'financing_source' => 'IDH',
                'contract_number' => 'GAD-BENI-CONT-2023-014',
                'beneficiary_communities' => [
                    'Tumi Cielo' => 320,
                    'El Prado'   => 210,
                    '6 de Agosto' => 180,
                    'Villa Fátima' => 410,
                ],
                'secretariat_id' => $findSec('energía') ?? $findSec('energia'),
            ],
            [
                'code'     => 'GAD-BENI-PI-2024-005',
                'title'    => 'Complejo Deportivo Universitario — Trinidad',
                'slug'     => 'complejo-deportivo-universitario-trinidad',
                'description' => 'Construcción de complejo deportivo con cancha de fútbol reglamentaria, pista atlética, cancha polifuncional, gimnasio y vestuarios. Capacidad: 4.000 espectadores.',
                'category' => 'deporte',
                'municipality' => 'trinidad',
                'latitude' => -14.826,
                'longitude' => -64.901,
                'status' => InfrastructureProject::STATUS_PROGRESS,
                'is_featured' => false,
                'progress_percentage' => 78,
                'start_date' => '2024-02-01',
                'end_date_planned' => '2025-12-15',
                'budget' => 28_400_000.00,
                'contracting_company' => 'Constructora Trinidad S.R.L.',
                'financing_source' => 'TGN',
                'contract_number' => 'GAD-BENI-CONT-2024-005',
                'beneficiary_communities' => [
                    'Trinidad'           => 105000,
                    'Universitarios UAB' => 9200,
                ],
                'secretariat_id' => $findSec('cultura') ?? $findSec('deporte'),
            ],
            [
                'code'     => 'GAD-BENI-PI-2023-006',
                'title'    => 'Mercado Modelo Central de Guayaramerín',
                'slug'     => 'mercado-modelo-guayaramerin',
                'description' => 'Construcción de mercado modelo con 320 puestos, áreas de carga y descarga, cámaras frigoríficas, estacionamiento y baterías de baños. Modernización del comercio local.',
                'category' => 'productivo',
                'municipality' => 'guayaramerin',
                'latitude' => -10.8267,
                'longitude' => -65.3561,
                'status' => InfrastructureProject::STATUS_COMPLETED,
                'is_featured' => false,
                'progress_percentage' => 100,
                'start_date' => '2022-08-15',
                'end_date_planned' => '2024-04-30',
                'end_date_real'    => '2024-04-18',
                'budget' => 22_100_000.00,
                'contracting_company' => 'Consorcio Beniano',
                'financing_source' => 'TGN + IDH',
                'contract_number' => 'GAD-BENI-CONT-2022-019',
                'beneficiary_communities' => [
                    'Guayaramerín' => 38900,
                ],
                'secretariat_id' => $findSec('productivo') ?? $findSec('desarrollo'),
            ],
            [
                'code'     => 'GAD-BENI-PI-2024-007',
                'title'    => 'Mejoramiento Camino Trinidad — San Ignacio de Moxos',
                'slug'     => 'mejoramiento-camino-trinidad-san-ignacio',
                'description' => 'Pavimentación de 95 km de la carretera Trinidad – San Ignacio de Moxos, con 4 carriles, 3 puentes, señalización horizontal y vertical, y obras de drenaje.',
                'category' => 'transporte',
                'municipality' => 'san_ignacio',
                'latitude' => -14.995,
                'longitude' => -65.6383,
                'status' => InfrastructureProject::STATUS_PROGRESS,
                'is_featured' => true,
                'progress_percentage' => 30,
                'start_date' => '2024-06-01',
                'end_date_planned' => '2027-05-31',
                'budget' => 245_000_000.00,
                'contracting_company' => 'Consorcio Vial Beni',
                'financing_source' => 'Crédito CAF + TGN',
                'contract_number' => 'GAD-BENI-CONT-2024-007',
                'beneficiary_communities' => [
                    'Trinidad'        => 105000,
                    'San Ignacio'     => 22500,
                    'San Andrés'      => 11200,
                ],
                'secretariat_id' => $findSec('obras') ?? $findSec('infraestructura'),
            ],
            [
                'code'     => 'GAD-BENI-PI-2024-008',
                'title'    => 'Escuela Técnica Agroindustrial — Rurrenabaque',
                'slug'     => 'escuela-tecnica-rurrenabaque',
                'description' => 'Construcción y equipamiento de escuela técnica con 12 aulas, 4 laboratorios, talleres de agroindustria, biblioteca, internado y áreas deportivas.',
                'category' => 'educacion',
                'municipality' => 'rurrenabaque',
                'latitude' => -14.4419,
                'longitude' => -67.5278,
                'status' => InfrastructureProject::STATUS_PARALYZED,
                'is_featured' => false,
                'progress_percentage' => 18,
                'start_date' => '2024-04-15',
                'end_date_planned' => '2025-12-31',
                'budget' => 18_900_000.00,
                'contracting_company' => 'Edificar Beni S.R.L.',
                'financing_source' => 'TGN',
                'contract_number' => 'GAD-BENI-CONT-2024-008',
                'beneficiary_communities' => [
                    'Rurrenabaque'   => 19500,
                    'San Borja'      => 24500,
                    'Comunidades eje' => 3200,
                ],
                'secretariat_id' => $findSec('educación') ?? $findSec('educacion'),
            ],
        ];

        $created = 0;
        foreach ($projects as $data) {
            $payload = array_merge($data, ['user_id' => $user->id]);

            // Evitar duplicados por código o por slug
            $existing = InfrastructureProject::where('code', $data['code'])
                ->orWhere('slug', $data['slug'])
                ->first();
            if ($existing) {
                $existing->update($payload);
                continue;
            }

            InfrastructureProject::create($payload);
            $created++;
        }

        $this->command->info("Infrastructure projects: {$created} created, " . (count($projects) - $created) . ' updated.');
    }
}
