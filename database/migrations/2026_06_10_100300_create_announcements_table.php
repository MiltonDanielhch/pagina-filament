<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RM 067/2025 — Convocatorias y procesos de contratación.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique(); // ej: "GAD-BENI-2026-001"
            $table->enum('type', [
                'convocatoria_publica', 'contratacion', 'consultoria', 'otro',
            ])->default('convocatoria_publica');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->longText('requirements')->nullable();
            $table->date('publication_date')->nullable();
            $table->dateTime('opening_date')->nullable();
            $table->dateTime('closing_date')->nullable();
            $table->enum('status', [
                'borrador', 'publicada', 'en_proceso', 'finalizada', 'desierta',
            ])->default('borrador');
            $table->string('document_file')->nullable();
            $table->string('external_url')->nullable(); // SICOES
            $table->foreignId('responsible_secretariat_id')
                ->nullable()
                ->constrained('secretariats')
                ->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'type', 'publication_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
