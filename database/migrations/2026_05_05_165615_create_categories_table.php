<?php

/**
 * Ubicación: `database/migrations/2026_05_05_165615_create_categories_table.php`
 *
 * Descripción: Crea tabla categories con name, slug, description, color_hex,
 *              order, softDeletes.
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('color')->default('#F59E0B');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
