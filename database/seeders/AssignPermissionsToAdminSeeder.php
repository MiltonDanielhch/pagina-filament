<?php

/**
 * Ubicación: `database/seeders/AssignPermissionsToAdminSeeder.php`
 *
 * Descripción: Asigna permisos al rol admin. El admin puede gestionar
 *              todo el contenido pero no puede modificar usuarios,
 *              roles ni configuraciones del sistema.
 *
 * Ejecutar: php artisan db:seed --class=AssignPermissionsToAdminSeeder
 * Roadmap: 05-BACKEND.md — Bloque 5.1
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToAdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::where('name', 'admin')->first();

        if (!$admin) {
            $admin = Role::firstOrCreate(['name' => 'admin'], [
                'guard_name' => 'web',
            ]);
        }

        $allPermissions = Permission::where('guard_name', 'web')->pluck('name')->toArray();

        $adminPermissions = array_filter($allPermissions, function ($perm) {
            // Excluir permisos de usuarios y roles (admin no puede gestionarlos)
            if (str_contains($perm, ':User') || str_contains($perm, 'users:')) return false;
            if (str_contains($perm, ':Role') || str_contains($perm, 'roles:')) return false;

            // Admin tiene todo el contenido
            return true;
        });

        $admin->syncPermissions(array_values($adminPermissions));

        $this->command->info('Admin ahora tiene ' . count($adminPermissions) . ' permisos.');
    }
}