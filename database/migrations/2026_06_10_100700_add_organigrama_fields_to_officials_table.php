<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Modificación a officials: agregar parent_id (organigrama),
 * secretariat_id y position_level para jerarquía.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('officials', function (Blueprint $table) {
            $table->foreignId('parent_id')
                ->nullable()
                ->after('user_id')
                ->constrained('officials')
                ->onDelete('set null');

            $table->foreignId('secretariat_id')
                ->nullable()
                ->after('area')
                ->constrained('secretariats')
                ->onDelete('set null');

            $table->unsignedTinyInteger('position_level')
                ->default(5)
                ->after('sort_order'); // 1=Gobernador, 2=Vice, 3=Secretario, 4=Director, 5=Jefe, 6=Técnico

            $table->text('function')->nullable()->after('bio'); // funciones del cargo
        });
    }

    public function down(): void
    {
        Schema::table('officials', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['secretariat_id']);
            $table->dropColumn(['parent_id', 'secretariat_id', 'position_level', 'function']);
        });
    }
};
