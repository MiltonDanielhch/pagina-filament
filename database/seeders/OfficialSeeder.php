<?php

namespace Database\Seeders;

use App\Models\Official;
use App\Models\User;
use Illuminate\Database\Seeder;

class OfficialSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create(['name' => 'Administración']);

        $officials = [
            // Gobernacion
            [
                'name' => 'Alejandro Unzueta Shiriqui',
                'position' => 'Gobernador Departamental',
                'area' => 'Gobernación',
                'email' => 'gobernador@beni.gob.bo',
                'phone' => '(591) 346-21651',
                'bio' => 'Gobernador Autónomo Departamental del Beni. Liderando el desarrollo integral del Beni hacia el protagonismo bioceánico.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretaría de Planificación
            [
                'name' => 'Lic. María Elena Flores Pérez',
                'position' => 'Secretaria de Planificación',
                'area' => 'Secretaría de Planificación',
                'email' => 'planificacion@beni.gob.bo',
                'phone' => '(591) 346-21652',
                'bio' => 'Responsable de la planificación estratégica del desarrollo departamental.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretaría de Hacienda
            [
                'name' => 'C.P. Jorge Luis Ríos Vargas',
                'position' => 'Secretario de Hacienda',
                'area' => 'Secretaría de Hacienda',
                'email' => 'hacienda@beni.gob.bo',
                'phone' => '(591) 346-21653',
                'bio' => 'Encargado de la gestión financiera y presupuestaria del gobierno departamental.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretaría de Obras Públicas
            [
                'name' => 'Ing. Roberto Carlos Mamani Copa',
                'position' => 'Secretario de Obras Públicas',
                'area' => 'Secretaría de Obras Públicas',
                'email' => 'obraspublicas@beni.gob.bo',
                'phone' => '(591) 346-21654',
                'bio' => 'Gestión de proyectos de infraestructura vial, puentes y obras públicas departamentales.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretaría de Educación
            [
                'name' => 'Prof. Teresa Beatriz Ajno Huanca',
                'position' => 'Secretaria de Educación',
                'area' => 'Secretaría de Educación',
                'email' => 'educacion@beni.gob.bo',
                'phone' => '(591) 346-21655',
                'bio' => 'Promoviendo la educación técnica y el desarrollo educativo en el departamento.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretaría de Salud
            [
                'name' => 'Dr. Juan Carlos Pereira Justiniano',
                'position' => 'Secretario de Salud',
                'area' => 'Secretaría de Salud',
                'email' => 'salud@beni.gob.bo',
                'phone' => '(591) 346-21656',
                'bio' => 'Coordinando los programas de salud pública y atención hospitalaria departamental.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretaría de Desarrollo Productivo
            [
                'name' => 'Ing. Agr. Luis Alberto Terán Lara',
                'position' => 'Secretario de Desarrollo Productivo',
                'area' => 'Secretaría de Desarrollo Productivo',
                'email' => 'desarrolloproductivo@beni.gob.bo',
                'phone' => '(591) 346-21657',
                'bio' => 'Fomentando la producción agrícola, ganadera y el emprendimiento en el Beni.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretaría de Transparencia
            [
                'name' => 'Abog. Carmen Rosa Justiniano Ríos',
                'position' => 'Secretaria de Transparencia',
                'area' => 'Secretaría de Transparencia',
                'email' => 'transparencia@beni.gob.bo',
                'phone' => '(591) 346-21658',
                'bio' => 'Garantizando la transparencia y acceso a la información pública departamental.',
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
        ];

        foreach ($officials as $official) {
            Official::updateOrCreate(
                ['email' => $official['email']],
                $official
            );
        }

        $this->command->info('OfficialSeeder: ' . count($officials) . ' funcionarios creados/actualizados.');
    }
}
