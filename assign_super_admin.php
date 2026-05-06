<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::first();
if ($user) {
    echo "User: " . $user->name . " (" . $user->email . ")\n";
    
    // Verificar si el rol existe
    $role = \Spatie\Permission\Models\Role::where('name', 'super_admin')->first();
    if (!$role) {
        echo "ERROR: El rol 'super_admin' no existe. Ejecuta: php artisan db:seed --class=RolePermissionSeeder\n";
        exit(1);
    }
    
    // Asignar rol
    $user->assignRole('super_admin');
    echo "Rol 'super_admin' asignado exitosamente!\n";
    echo "Roles actuales: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";
} else {
    echo "No se encontró ningún usuario\n";
}
