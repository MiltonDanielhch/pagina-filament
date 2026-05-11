<?php

/**
 * Ubicación: `database/seeders/AssignPermissionsToEditorSeeder.php`
 *
 * Descripción: Asigna permisos específicos al rol editor. El editor
 *              puede crear y editar posts, eventos y slides.
 *
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
        }

        $editorPermissions = [
            // Posts - CRUD completo
            'posts:viewAny', 'posts:view', 'posts:create', 'posts:update', 'posts:delete', 'posts:restore',
            'ViewAny:Post', 'View:Post', 'Create:Post', 'Update:Post', 'Delete:Post', 'Restore:Post',

            // Eventos - CRUD completo
            'events:viewAny', 'events:view', 'events:create', 'events:update', 'events:delete', 'events:restore',
            'ViewAny:Event', 'View:Event', 'Create:Event', 'Update:Event', 'Delete:Event', 'Restore:Event',

            // Slides - ver y crear
            'slides:viewAny', 'slides:view', 'slides:create',
            'ViewAny:Slide', 'View:Slide', 'Create:Slide',

            // Categorías - solo ver
            'categories:viewAny', 'categories:view',
            'ViewAny:Category', 'View:Category',

            // Páginas - solo ver
            'pages:viewAny', 'pages:view',
            'ViewAny:Page', 'View:Page',
        ];

        // Filtrar solo los que existen en la base de datos
        $allPermNames = Permission::where('guard_name', 'web')->pluck('name')->toArray();
        $validPermissions = array_filter($editorPermissions, fn($p) => in_array($p, $allPermNames));

        $editor->syncPermissions(array_values($validPermissions));

        $this->command->info('Editor ahora tiene ' . count($validPermissions) . ' permisos.');
    }
}