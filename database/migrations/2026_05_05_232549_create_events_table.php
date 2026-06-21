<?php

/**
 * Ubicación: `database/migrations/2026_05_05_232549_create_events_table.php`
 *
 * Descripción: Crea tabla events con title, slug, description, starts_at,
 *              ends_at, location, address, status, timestamps y softDeletes.
 *
 * Dependencias: users_table
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->unsignedBigInteger('view_count')->default(0);
            $table->string('location')->nullable();
            $table->dateTime('starts_at');
            $table->dateTime('ends_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'starts_at'], 'idx_events_status_starts');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};