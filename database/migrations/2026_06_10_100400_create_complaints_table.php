<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RM 067/2025 — Libro de Reclamaciones Virtual.
 * Sistema de quejas, reclamos, sugerencias y denuncias ciudadanas.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['queja', 'reclamo', 'sugerencia', 'denuncia'])
                ->default('queja');
            $table->string('code', 20)->unique(); // autogenerado: "QR-2026-000001"
            $table->string('full_name');
            $table->string('ci', 20)->nullable(); // cédula de identidad
            $table->string('email');
            $table->string('phone', 30)->nullable();
            $table->string('address')->nullable();
            $table->string('subject');
            $table->longText('description');
            $table->string('attachment')->nullable();
            $table->foreignId('related_secretariat_id')
                ->nullable()
                ->constrained('secretariats')
                ->onDelete('set null');
            $table->enum('status', ['recibido', 'en_proceso', 'resuelto', 'rechazado'])
                ->default('recibido');
            $table->longText('response')->nullable();
            $table->dateTime('response_date')->nullable();
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');
            $table->string('tracking_token', 64)->unique();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'type']);
            $table->index('related_secretariat_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
