<?php

/**
 * Ubicación: `database/migrations/2026_06_05_020306_create_post_templates_table.php`
 *
 * Descripción: Crea tabla post_templates para plantillas predefinidas de noticias.
 *              Almacena estructura base para Comunicado Oficial, Evento y Nota de Prensa.
 *
 * Roadmap: 13-automatizacion-noticias.md — Bloque 13.3
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
        Schema::create('post_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // comunicado, evento, nota_prensa
            $table->json('default_data'); // Campos predefinidos: title, body, category_id, etc.
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_templates');
    }
};
