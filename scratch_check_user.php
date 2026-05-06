<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::first();
if ($user) {
    echo "User: " . $user->name . "\n";
    echo "Roles: " . implode(', ', $user->getRoleNames()->toArray()) . "\n";
} else {
    echo "No user found\n";
}
