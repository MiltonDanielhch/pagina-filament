<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RM 067/2025 — Secretarías departamentales del Beni.
 * Modelo base para la gobernación y sus áreas de gestión.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('secretariats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('acronym', 20)->nullable();
            $table->text('description')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision')->nullable();
            $table->json('objectives')->nullable();
            $table->foreignId('parent_secretariat_id')
                ->nullable()
                ->constrained('secretariats')
                ->onDelete('set null');
            $table->foreignId('head_official_id')
                ->nullable()
                ->constrained('officials')
                ->onDelete('set null');
            $table->string('contact_email')->nullable();
            $table->string('contact_phone', 50)->nullable();
            $table->string('office_address')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('color', 7)->default('#0f766e');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('secretariats');
    }
};
