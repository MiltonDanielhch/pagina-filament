<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('secretariats', function (Blueprint $table) {
            $table->foreignId('head_official_id')
                ->nullable()
                ->after('parent_secretariat_id')
                ->constrained('officials')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('secretariats', function (Blueprint $table) {
            $table->dropForeign(['head_official_id']);
            $table->dropColumn('head_official_id');
        });
    }
};
