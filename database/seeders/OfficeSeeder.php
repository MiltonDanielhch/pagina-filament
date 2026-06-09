<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name' => 'Edificio Central — Gobernación del Beni',
                'address' => 'Plaza José Ballivián N° 1, acera sur',
                'municipality' => 'Trinidad',
                'phone' => '(591) 346-21651',
                'email' => 'despacho@beni.gob.bo',
                'schedule' => 'Lun-Vie 08:00-16:00',
                'latitude' => -14.83333,
                'longitude' => -64.9,
                'sort_order' => 1,
            ],
            [
                'name' => 'Oficina de Atención al Ciudadano — Trinidad',
                'address' => 'Calle 9 de Abril entre Av. 6 de Agosto',
                'municipality' => 'Trinidad',
                'phone' => '(591) 346-22000',
                'email' => 'atencion@beni.gob.bo',
                'schedule' => 'Lun-Vie 08:00-16:00',
                'latitude' => -14.83500,
                'longitude' => -64.90100,
                'sort_order' => 2,
            ],
            [
                'name' => 'Sub-Gobernación de Riberalta',
                'address' => 'Av. Máximo Henicke, Riberalta',
                'municipality' => 'Riberalta',
                'phone' => '(591) 385-22000',
                'email' => 'riberalta@beni.gob.bo',
                'schedule' => 'Lun-Vie 08:00-16:00',
                'latitude' => -11.0,
                'longitude' => -66.1,
                'sort_order' => 3,
            ],
            [
                'name' => 'Sub-Gobernación de Guayaramerín',
                'address' => 'Av. Costanera, Guayaramerín',
                'municipality' => 'Guayaramerín',
                'phone' => '(591) 385-55000',
                'email' => 'guayaramerin@beni.gob.bo',
                'schedule' => 'Lun-Vie 08:00-16:00',
                'latitude' => -10.83,
                'longitude' => -65.36,
                'sort_order' => 4,
            ],
            [
                'name' => 'Secretaría de Salud — Hospital Departamental',
                'address' => 'Av. Japón, Trinidad',
                'municipality' => 'Trinidad',
                'phone' => '(591) 346-21800',
                'email' => 'salud@beni.gob.bo',
                'schedule' => 'Atención 24 horas para emergencias',
                'latitude' => -14.84000,
                'longitude' => -64.91000,
                'sort_order' => 5,
            ],
        ];

        foreach ($items as $data) {
            Office::updateOrCreate(
                ['name' => $data['name']],
                $data + ['is_active' => true]
            );
        }
    }
}
