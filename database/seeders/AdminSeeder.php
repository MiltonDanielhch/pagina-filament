<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'id' => 1,
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
            ]
        );

        // Asignar super_admin si existe el rol
        if (method_exists($user, 'assignRole')) {
            $user->assignRole('super_admin');
        }
    }
}
