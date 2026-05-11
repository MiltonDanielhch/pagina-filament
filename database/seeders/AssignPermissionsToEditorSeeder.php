<?php

/**
 * Ubicación: `database/seeders/AssignPermissionsToEditorSeeder.php`
 *
 * Descripción: Asigna permisos específicos al rol editor. El editor
 *              puede crear y editar posts y eventos, pero no puede
 *              gestionar usuarios, roles, configuraciones ni otros
 *              recursos del sistema.
 *
 * Permisos: Posts (CRUD), Eventos (CRUD), Categorías (ver), Páginas (ver)
 * Ejecutar: php artisan db:seed --class=AssignPermissionsToEditorSeeder
 * Roadmap: 05-BACKEND.md — Bloque 5.1
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToEditorSeeder extends Seeder
{
    public function run(): void
    {
        $editor = Role::where('name', 'editor')->first();

        if (!$editor) {
            $editor = Role::firstOrCreate(['name' => 'editor'], [
                'guard_name' => 'web',
            ]);
            $this->command->info('Rol editor creado.');
        }

        $editorPermissions = [
            // Posts - todos los permisos
            'viewAny post',
            'view post',
            'create post',
            'update post',
            'delete post',
            'restore post',
            'replicate post',

            // Eventos - todos los permisos
            'viewAny event',
            'view event',
            'create event',
            'update event',
            'delete event',
            'restore event',
            'replicate event',

            // Slides - solo ver y crear
            'viewAny slide',
            'view slide',
            'create slide',

            // Categorías - solo ver
            'viewAny category',
            'view category',

            // Páginas - solo ver
            'viewAny page',
            'view page',

            // Menús - solo ver
            'viewAny menu',
            'view menu',

            // Sistemas externos - solo ver
            'viewAny external_system',
            'view external_system',

            // Dashboard
            'view dashboard',

            // Widgets
            'viewAny stats_overview_widget',
            'viewAny recent_posts_widget',
            'viewAny quick_actions_widget',
        ];

        $editor->syncPermissions($editorPermissions);

        $this->command->info('Editor ahora tiene ' . count($editorPermissions) . ' permisos asignados.');
    }
}