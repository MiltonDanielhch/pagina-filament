<?php

/**
 * Ubicación: `database/seeders/SetupRolesAndPermissionsSeeder.php`
 *
 * Descripción: Seeder maestro que ejecuta todo en orden después de migrate:fresh
 *              1. Genera permisos de Shield
 *              2. Crea/actualiza roles
 *              3. Asigna permisos a cada rol
 *              4. Crea usuario admin inicial
 *
 * Ejecutar: php artisan db:seed --class=SetupRolesAndPermissionsSeeder
 * Después de: php artisan migrate:fresh
 * Roadmap: 05-BACKEND.md — Bloque 5.1
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class SetupRolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Generar permisos de Shield (ejecuta el comando)
        $this->command->info('Generando permisos de Shield...');
        Artisan::call('shield:seed', ['--panel' => 'admin']);

        // 2. Super Admin - todos los permisos
        $this->setupSuperAdmin();

        // 3. Admin - todo contenido excepto usuarios/roles
        $this->setupAdmin();

        // 4. Editor - posts, eventos, slides, categorías, páginas (ver/crear/editar)
        $this->setupEditor();

        // 5. Crear usuarios para cada rol
        $this->setupAdminUser();
        $this->createUsers();

        $this->command->info('✓ Roles y permisos configurados correctamente.');
    }

    private function setupSuperAdmin(): void
    {
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin'], ['guard_name' => 'web']);
        $allPermissions = Permission::where('guard_name', 'web')->pluck('name')->toArray();
        $superAdmin->syncPermissions($allPermissions);
        $this->command->info("  Super Admin: " . count($allPermissions) . " permisos");
    }

    private function setupAdmin(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin'], ['guard_name' => 'web']);

        $allPerms = Permission::where('guard_name', 'web')->pluck('name')->toArray();
        $adminPerms = array_filter($allPerms, function ($perm) {
            if (str_contains($perm, ':User') || str_contains($perm, 'users:')) return false;
            if (str_contains($perm, ':Role') || str_contains($perm, 'roles:')) return false;
            return true;
        });

        $admin->syncPermissions(array_values($adminPerms));
        $this->command->info("  Admin: " . count($adminPerms) . " permisos");
    }

    private function setupEditor(): void
    {
        $editor = Role::firstOrCreate(['name' => 'editor'], ['guard_name' => 'web']);

        $editorPerms = [
            'posts:viewAny', 'posts:view', 'posts:create', 'posts:update', 'posts:delete', 'posts:restore',
            'ViewAny:Post', 'View:Post', 'Create:Post', 'Update:Post', 'Delete:Post', 'Restore:Post',
            'events:viewAny', 'events:view', 'events:create', 'events:update', 'events:delete', 'events:restore',
            'ViewAny:Event', 'View:Event', 'Create:Event', 'Update:Event', 'Delete:Event', 'Restore:Event',
            'slides:viewAny', 'slides:view', 'slides:create',
            'ViewAny:Slide', 'View:Slide', 'Create:Slide',
            'categories:viewAny', 'categories:view',
            'ViewAny:Category', 'View:Category',
            'pages:viewAny', 'pages:view',
            'ViewAny:Page', 'View:Page',
        ];

        $allPermNames = Permission::where('guard_name', 'web')->pluck('name')->toArray();
        $validPerms = array_filter($editorPerms, fn($p) => in_array($p, $allPermNames));

        $editor->syncPermissions(array_values($validPerms));
        $this->command->info("  Editor: " . count($validPerms) . " permisos");
    }

    private function setupAdminUser(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@beni.gob.bo'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('Admin2026!'),
            ]
        );

        $user->assignRole('super_admin');
    }

    private function createUsers(): void
    {
        // Usuario Admin (jefe de contenido)
        $adminUser = User::firstOrCreate(
            ['email' => 'jefe@beni.gob.bo'],
            [
                'name' => 'Jefe de Contenido',
                'password' => bcrypt('Admin2026!'),
            ]
        );
        $adminUser->assignRole('admin');

        // Usuario Editor
        $editorUser = User::firstOrCreate(
            ['email' => 'editor@beni.gob.bo'],
            [
                'name' => 'Editor de Noticias',
                'password' => bcrypt('Editor2026!'),
            ]
        );
        $editorUser->assignRole('editor');

        $this->command->info("  ✓ admin@beni.gob.bo → super_admin");
        $this->command->info("  ✓ jefe@beni.gob.bo → admin");
        $this->command->info("  ✓ editor@beni.gob.bo → editor");
    }
}