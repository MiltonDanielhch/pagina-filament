<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
echo "Total publicadas: " . App\Models\MarcoNormativo::published()->count() . PHP_EOL;
echo "Por tipo:" . PHP_EOL;
foreach (App\Models\MarcoNormativo::published()->groupBy('type') as $t => $c) {
    echo "  - $t: " . $c->count() . PHP_EOL;
}
echo "Por ámbito:" . PHP_EOL;
foreach (App\Models\MarcoNormativo::published()->groupBy('scope') as $s => $c) {
    echo "  - $s: " . $c->count() . PHP_EOL;
}
