<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'id' => 1,
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
            ]
        );
    }
}
