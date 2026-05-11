<?php

/**
 * Ubicación: `database/seeders/AssignPermissionsToAdminSeeder.php`
 *
 * Descripción: Asigna permisos al rol admin. El admin puede gestionar
 *              todo el contenido pero no puede modificar usuarios
 *              ni configuraciones del sistema.
 *
 * Permisos: Todo el contenido (posts, eventos, páginas, categorías,
 *           slides, menús) + ver usuarios y activity log
 * No incluye: gestión de usuarios, roles, configuraciones
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
            $this->command->info('Rol admin creado.');
        }

        // Obtener permisos de posts, eventos, páginas, categorías, slides, menús, sistemas
        $resources = ['post', 'event', 'page', 'category', 'slide', 'menu', 'external_system'];
        $adminPermissions = [];

        foreach ($resources as $resource) {
            $permissions = Permission::where('name', 'like', "% {$resource}")->pluck('name')->toArray();
            $adminPermissions = array_merge($adminPermissions, $permissions);
        }

        // Agregar permisos de dashboard y widgets
        $adminPermissions[] = 'view dashboard';
        $adminPermissions[] = 'viewAny stats_overview_widget';
        $adminPermissions[] = 'viewAny recent_posts_widget';
        $adminPermissions[] = 'viewAny quick_actions_widget';

        // Solo puede ver usuarios (no crear/editar/borrar)
        $adminPermissions[] = 'viewAny user';
        $adminPermissions[] = 'view user';

        // Puede ver activity log
        $adminPermissions[] = 'viewAny activity_log';
        $adminPermissions[] = 'view activity_log';

        // Menús - full CRUD
        $menuPermissions = Permission::where('name', 'like', '% menu%')->pluck('name')->toArray();
        $adminPermissions = array_merge($adminPermissions, $menuPermissions);

        $admin->syncPermissions($adminPermissions);

        $this->command->info('Admin ahora tiene ' . count($adminPermissions) . ' permisos asignados.');
    }
}