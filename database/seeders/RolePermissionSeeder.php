<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Posts
            'posts:viewAny',
            'posts:view',
            'posts:create',
            'posts:update',
            'posts:delete',
            'posts:forceDelete',
            'posts:restore',
            
            // Categories
            'categories:viewAny',
            'categories:view',
            'categories:create',
            'categories:update',
            'categories:delete',
            
            // Pages
            'pages:viewAny',
            'pages:view',
            'pages:create',
            'pages:update',
            'pages:delete',
            
            // Slides
            'slides:viewAny',
            'slides:view',
            'slides:create',
            'slides:update',
            'slides:delete',
            
            // Events
            'events:viewAny',
            'events:view',
            'events:create',
            'events:update',
            'events:delete',
            
            // External Systems
            'external_systems:viewAny',
            'external_systems:view',
            'external_systems:create',
            'external_systems:update',
            'external_systems:delete',
            
            // Users
            'users:viewAny',
            'users:view',
            'users:create',
            'users:update',
            'users:delete',
            
            // Roles
            'roles:viewAny',
            'roles:view',
            'roles:create',
            'roles:update',
            'roles:delete',
            
            // Permissions
            'permissions:viewAny',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        $admin->givePermissionTo([
            'posts:viewAny', 'posts:view', 'posts:create', 'posts:update', 'posts:delete',
            'categories:viewAny', 'categories:view', 'categories:create', 'categories:update',
            'pages:viewAny', 'pages:view', 'pages:create', 'pages:update',
            'slides:viewAny', 'slides:view', 'slides:create', 'slides:update', 'slides:delete',
            'events:viewAny', 'events:view', 'events:create', 'events:update',
            'external_systems:viewAny', 'external_systems:view',
            'users:viewAny', 'users:view',
        ]);

        $editor = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'web',
        ]);
        $editor->givePermissionTo([
            'posts:viewAny', 'posts:view', 'posts:create', 'posts:update',
            'categories:viewAny', 'categories:view',
            'pages:viewAny', 'pages:view',
            'events:viewAny', 'events:view', 'events:create',
        ]);
    }
}