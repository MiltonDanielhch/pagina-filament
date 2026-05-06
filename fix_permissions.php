<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== ARREGLANDO PERMISOS ===\n\n";

// 1. Limpiar permisos antiguos con formato incorrecto
echo "1. Limpiando permisos antiguos...\n";
$oldPermissions = \Spatie\Permission\Models\Permission::where('name', 'LIKE', '%.%')->get();
foreach ($oldPermissions as $perm) {
    echo "   Eliminando: {$perm->name}\n";
    $perm->delete();
}
echo "   Permisos eliminados: " . $oldPermissions->count() . "\n\n";

// 2. Crear permisos nuevos con formato correcto (:)
echo "2. Creando permisos con formato correcto (:)...\n";
$permissionNames = [
    'posts:viewAny', 'posts:view', 'posts:create', 'posts:update', 'posts:delete', 'posts:forceDelete', 'posts:restore',
    'categories:viewAny', 'categories:view', 'categories:create', 'categories:update', 'categories:delete',
    'pages:viewAny', 'pages:view', 'pages:create', 'pages:update', 'pages:delete',
    'slides:viewAny', 'slides:view', 'slides:create', 'slides:update', 'slides:delete',
    'events:viewAny', 'events:view', 'events:create', 'events:update', 'events:delete',
    'external_systems:viewAny', 'external_systems:view', 'external_systems:create', 'external_systems:update', 'external_systems:delete',
    'users:viewAny', 'users:view', 'users:create', 'users:update', 'users:delete',
    'roles:viewAny', 'roles:view', 'roles:create', 'roles:update', 'roles:delete',
    'permissions:viewAny',
];

foreach ($permissionNames as $name) {
    \Spatie\Permission\Models\Permission::firstOrCreate([
        'name' => $name,
        'guard_name' => 'web',
    ]);
}
echo "   Permisos creados: " . count($permissionNames) . "\n\n";

// 3. Asignar todos los permisos a super_admin
echo "3. Asignando permisos a super_admin...\n";
$superAdmin = \Spatie\Permission\Models\Role::where('name', 'super_admin')->first();
if ($superAdmin) {
    $superAdmin->syncPermissions(\Spatie\Permission\Models\Permission::all());
    echo "   super_admin ahora tiene " . $superAdmin->permissions->count() . " permisos\n\n";
} else {
    echo "   ERROR: super_admin no existe\n\n";
}

// 4. Asignar rol super_admin al usuario admin
echo "4. Asignando rol super_admin a admin@admin.com...\n";
$user = \App\Models\User::where('email', 'admin@admin.com')->first();
if ($user) {
    $user->syncRoles(['super_admin']);
    echo "   Usuario ahora tiene roles: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";
} else {
    echo "   ERROR: Usuario no encontrado\n";
}

echo "\n=== LISTO! Recarga el panel de Filament ===\n";
