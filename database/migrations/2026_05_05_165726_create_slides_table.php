<?php

/**
 * Ubicación: `database/migrations/2026_05_05_165726_create_slides_table.php`
 *
 * Descripción: Crea tabla slides para el slider principal con order, image,
 *              title, description, link, is_active.
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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('link')->nullable();
            $table->string('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
