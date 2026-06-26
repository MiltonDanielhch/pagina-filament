<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql') {
            $tables = DB::select('SHOW TABLES');
            $existing = array_map('current', $tables);

            $indexes = [
                'posts' => ['fields' => 'title, excerpt, body', 'name' => 'posts_fulltext_idx'],
                'procedures' => ['fields' => 'name, description', 'name' => 'procedures_fulltext_idx'],
                'events' => ['fields' => 'title, description, location', 'name' => 'events_fulltext_idx'],
                'announcements' => ['fields' => 'title, description, code', 'name' => 'announcements_fulltext_idx'],
                'infrastructure_projects' => ['fields' => 'title, description, municipality, code', 'name' => 'projects_fulltext_idx'],
                'open_datasets' => ['fields' => 'title, description, category', 'name' => 'datasets_fulltext_idx'],
                'agenda' => ['fields' => 'title, description, location', 'name' => 'agenda_fulltext_idx'],
                'pages' => ['fields' => 'title, content', 'name' => 'pages_fulltext_idx'],
                'officials' => ['fields' => 'name, position, area, bio', 'name' => 'officials_fulltext_idx'],
                'external_systems' => ['fields' => 'name, description', 'name' => 'systems_fulltext_idx'],
            ];

            foreach ($indexes as $table => $config) {
                if (!in_array($table, $existing)) continue;

                $indexExists = DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$config['name']]);
                if (empty($indexExists)) {
                    DB::statement("ALTER TABLE {$table} ADD FULLTEXT INDEX {$config['name']} ({$config['fields']})");
                }
            }
        }
    }

    public function down(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql') {
            $tables = DB::select('SHOW TABLES');
            $existing = array_map('current', $tables);

            $names = [
                'posts_fulltext_idx', 'procedures_fulltext_idx', 'events_fulltext_idx',
                'announcements_fulltext_idx', 'projects_fulltext_idx', 'datasets_fulltext_idx',
                'agenda_fulltext_idx', 'pages_fulltext_idx', 'officials_fulltext_idx',
                'systems_fulltext_idx',
            ];

            foreach ($names as $name) {
                $table = explode('_fulltext', $name)[0];
                $table = str_replace('_idx', '', $table);
                if (in_array($table, $existing)) {
                    DB::statement("ALTER TABLE {$table} DROP INDEX {$name}");
                }
            }
        }
    }
};
