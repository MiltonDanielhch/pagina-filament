<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExternalSystemSeeder extends Seeder
{
    public function run(): void
    {
        $systems = [
            ['name' => 'Gaceta Jurídica',              'url' => 'https://gaceta.beni.gob.bo',           'description' => 'Normativa departamental oficial actualizada.',                  'icon' => 'plus',         'order' => 1],
            ['name' => 'Plataforma SISCOR',             'url' => 'https://siscor.beni.gob.bo',            'description' => 'Correspondencia y control institucional.',                    'icon' => 'document',     'order' => 2],
            ['name' => 'Portal de Transparencia',       'url' => 'https://transparencia.beni.gob.bo',     'description' => 'Datos abiertos y rendición de cuentas.',                       'icon' => 'eye',          'order' => 3],
            ['name' => 'IDTGB',                         'url' => 'https://idtgb.beni.gob.bo',             'description' => 'Calcula el impuesto por transmisión gratuita de bienes.',     'icon' => 'globe',        'order' => 4],
            ['name' => 'Transporte',                    'url' => 'https://transporte.beni.gob.bo',         'description' => 'Gestiona asociados, vehículos, rutas y organizaciones.',       'icon' => 'calendar',     'order' => 5],
            ['name' => 'Auditoría Interna',             'url' => 'https://auditoria.beni.gob.bo',          'description' => 'Control y auditoría institucional.',                          'icon' => 'clipboard',    'order' => 6],
            ['name' => 'Almacén Central',               'url' => 'https://almacen.beni.gob.bo',            'description' => 'Gestión de almacenes y suministros.',                          'icon' => 'cube',         'order' => 7],
            ['name' => 'Ecoalbergue',                   'url' => 'http://aguaysal.beni.gob.bo',            'description' => 'Gestión hotelera, habitaciones y paquetes turísticos.',         'icon' => 'building',     'order' => 8],
            ['name' => 'Minería',                       'url' => 'https://mineria.beni.gob.bo',            'description' => 'Gestión de recursos mineros departamentales.',                 'icon' => 'mountain',     'order' => 9],
            ['name' => 'Sistema Mamoré',                'url' => 'https://mamore.beni.gob.bo',             'description' => 'Gestión administrativa departamental.',                        'icon' => 'cog',          'order' => 10],
            ['name' => 'Gobernación',                   'url' => 'https://www.beni.gob.bo',                'description' => 'Portal principal institucional del Beni.',                    'icon' => 'government',   'order' => 11],
        ];

        foreach ($systems as $system) {
            \App\Models\ExternalSystem::updateOrCreate(
                ['name' => $system['name']],
                $system
            );
        }
    }
}
