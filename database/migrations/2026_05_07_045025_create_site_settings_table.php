<?php

/**
 * Ubicación: `database/migrations/2026_05_07_045025_create_site_settings_table.php`
 *
 * Descripción: Crea tabla site_settings key/value para configuraciones:
 *              site_name, contact_email, redes_sociales, etc.
 *
 * Dependencias: Ninguna
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
