<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Crear admin primero (ID 1)
        $this->call(AdminSeeder::class);

        // 2. Roles y permisos
        $this->call(RolePermissionSeeder::class);

        // Re-asignar rol al admin
        $user = User::where('email', 'admin@admin.com')->first();
        if ($user) {
            $user->assignRole('super_admin');
        }

        // 3. Datos que dependen del usuario
        $this->call([
            SlideSeeder::class,
            CategorySeeder::class,
            PageSeeder::class,
            PostSeeder::class,
            ExternalSystemSeeder::class,
            EventSeeder::class,
        ]);
    }
}
