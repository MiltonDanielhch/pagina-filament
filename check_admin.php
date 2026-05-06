<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::where('email', 'admin@admin.com')->first();
if ($user) {
    echo "Usuario: " . $user->name . " (" . $user->email . ")\n";
    echo "ID: " . $user->id . "\n";
    $roles = $user->getRoleNames()->toArray();
    echo "Roles: " . (empty($roles) ? "NINGUNO" : implode(', ', $roles)) . "\n";
    
    // Verificar si existe super_admin
    $superAdmin = \Spatie\Permission\Models\Role::where('name', 'super_admin')->first();
    echo "\nRol super_admin existe: " . ($superAdmin ? 'SI' : 'NO') . "\n";
    
    if ($superAdmin) {
        $permissions = $superAdmin->permissions->pluck('name')->toArray();
        echo "Permisos de super_admin: " . count($permissions) . "\n";
        echo "Primeros 5: " . implode(', ', array_slice($permissions, 0, 5)) . "\n";
    }
} else {
    echo "Usuario admin@admin.com NO encontrado\n";
    echo "Usuarios existentes:\n";
    \App\Models\User::all()->each(function($u) {
        echo "  - " . $u->email . "\n";
    });
}
