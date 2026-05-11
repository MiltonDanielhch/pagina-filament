<?php

/**
 * Ubicación: `database/seeders/AdminSeeder.php`
 *
 * Descripción: Crea el usuario administrador inicial con rol super_admin
 *              y todos los permisos del sistema.
 *
 * Ejecutar: php artisan db:seed --class=AdminSeeder
 * Roadmap: 03-SETUP.md — Bloque 3.2
 */

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin'], [
            'guard_name' => 'web',
        ]);

        $user = User::firstOrCreate(
            ['email' => 'admin@beni.gob.bo'],
            [
                'id' => 1,
                'name' => 'Administrador',
                'password' => bcrypt('Admin2026!'),
            ]
        );

        $user->assignRole($superAdmin);
    }
}
