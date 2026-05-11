<?php

/**
 * Ubicación: `database/seeders/AssignAllPermissionsToSuperAdminSeeder.php`
 *
 * Descripción: Asigna TODOS los permisos del sistema al rol super_admin.
 *              Ejecutar después de cada php artisan shield:generate
 *
 * Ejecutar: php artisan db:seed --class=AssignAllPermissionsToSuperAdminSeeder
 * Roadmap: 05-BACKEND.md — Bloque 5.1
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignAllPermissionsToSuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::where('name', 'super_admin')->first();

        if (!$superAdmin) {
            $this->command->error('Rol super_admin no encontrado. Ejecuta primero: php artisan shield:install');
            return;
        }

        $allPermissions = Permission::pluck('name')->toArray();

        $superAdmin->syncPermissions($allPermissions);

        $this->command->info('Super Admin ahora tiene ' . count($allPermissions) . ' permisos asignados.');
    }
}