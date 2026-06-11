<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('slides')) {
            DB::statement('ALTER TABLE `slides` MODIFY `title` VARCHAR(255) NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('slides')) {
            DB::statement('ALTER TABLE `slides` MODIFY `title` VARCHAR(255) NOT NULL');
        }
    }
};
