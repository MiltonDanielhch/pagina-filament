<?php

/**
 * Ubicación: `database/migrations/2026_05_05_173019_create_external_systems_table.php`
 *
 * Descripción: Crea tabla external_systems para sistemas externos con name,
 *              url, description, is_active, last_status, last_checked_at.
 *
 * Dependencias: Ninguna
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('external_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->enum('last_status', ['online', 'offline', 'unknown'])->default('unknown');
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('external_systems');
    }
};
