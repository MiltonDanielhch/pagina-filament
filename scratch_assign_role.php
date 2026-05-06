<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;

$user = User::where('email', 'admin@admin.com')->first();
if ($user) {
    $role = Role::firstOrCreate(['name' => 'super_admin']);
    $user->assignRole($role);
    echo "Role super_admin assigned to " . $user->email . "\n";
} else {
    echo "User admin@admin.com not found\n";
}
