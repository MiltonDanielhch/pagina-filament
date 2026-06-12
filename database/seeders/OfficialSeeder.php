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
            // Gobernacion - position_level 1
            [
                'name' => 'Jesús Tito Egüez Rivero',
                'position' => 'Gobernador Departamental',
                'area' => 'Gobernación',
                'email' => 'gobernador@beni.gob.bo',
                'phone' => '(591) 346-21651',
                'bio' => 'Gobernador Autónomo Departamental del Beni. Liderando el desarrollo integral del Beni hacia el protagonismo bioceánico.',
                'position_level' => 1,
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Vicegobernación - position_level 2
            [
                'name' => 'Lic. María Elena Flores Pérez',
                'position' => 'Vicegobernadora Departamental',
                'area' => 'Vicegobernación',
                'email' => 'vicegobernador@beni.gob.bo',
                'phone' => '(591) 346-21652',
                'bio' => 'Vicegobernadora Autónoma Departamental del Beni. Apoyando la gestión gubernamental.',
                'position_level' => 2,
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            // Secretarías - position_level 3
            [
                'name' => 'C.P. Jorge Luis Ríos Vargas',
                'position' => 'Secretario de Hacienda',
                'area' => 'Secretaría de Hacienda',
                'email' => 'hacienda@beni.gob.bo',
                'phone' => '(591) 346-21653',
                'bio' => 'Encargado de la gestión financiera y presupuestaria del gobierno departamental.',
                'position_level' => 3,
                'sort_order' => 1,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Ing. Roberto Carlos Mamani Copa',
                'position' => 'Secretario de Obras Públicas',
                'area' => 'Secretaría de Obras Públicas',
                'email' => 'obraspublicas@beni.gob.bo',
                'phone' => '(591) 346-21654',
                'bio' => 'Gestión de proyectos de infraestructura vial, puentes y obras públicas departamentales.',
                'position_level' => 3,
                'sort_order' => 2,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Prof. Teresa Beatriz Ajno Huanca',
                'position' => 'Secretaria de Educación',
                'area' => 'Secretaría de Educación',
                'email' => 'educacion@beni.gob.bo',
                'phone' => '(591) 346-21655',
                'bio' => 'Promoviendo la educación técnica y el desarrollo educativo en el departamento.',
                'position_level' => 3,
                'sort_order' => 3,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Dr. Juan Carlos Pereira Justiniano',
                'position' => 'Secretario de Salud',
                'area' => 'Secretaría de Salud',
                'email' => 'salud@beni.gob.bo',
                'phone' => '(591) 346-21656',
                'bio' => 'Coordinando los programas de salud pública y atención hospitalaria departamental.',
                'position_level' => 3,
                'sort_order' => 4,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Ing. Agr. Luis Alberto Terán Lara',
                'position' => 'Secretario de Desarrollo Productivo',
                'area' => 'Secretaría de Desarrollo Productivo',
                'email' => 'desarrolloproductivo@beni.gob.bo',
                'phone' => '(591) 346-21657',
                'bio' => 'Fomentando la producción agrícola, ganadera y el emprendimiento en el Beni.',
                'position_level' => 3,
                'sort_order' => 5,
                'is_active' => true,
                'user_id' => $user->id,
            ],
            [
                'name' => 'Abog. Carmen Rosa Justiniano Ríos',
                'position' => 'Secretaria de Transparencia',
                'area' => 'Secretaría de Transparencia',
                'email' => 'transparencia@beni.gob.bo',
                'phone' => '(591) 346-21658',
                'bio' => 'Garantizando la transparencia y acceso a la información pública departamental.',
                'position_level' => 3,
                'sort_order' => 6,
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
