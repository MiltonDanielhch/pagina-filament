<?php

/**
 * Ubicación: `database/migrations/2026_05_05_165650_create_pages_table.php`
 *
 * Descripción: Crea tabla pages con title, slug, content, SEO fields,
 *              is_published, timestamps y softDeletes.
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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
