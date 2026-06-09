<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RM 067/2025 + RA AGETIC/0030/2025 — Conjuntos de datos abiertos.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('open_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('category')->nullable(); // "presupuesto", "salud"...
            $table->string('publisher')->nullable(); // secretaría responsable
            $table->enum('update_frequency', [
                'diario', 'semanal', 'mensual', 'trimestral', 'anual', 'eventual',
            ])->default('eventual');
            $table->date('last_updated_at')->nullable();
            $table->json('formats')->nullable(); // ["csv", "json", "xlsx"]
            $table->string('license', 50)->default('CC-BY-4.0');
            $table->string('file_csv')->nullable();
            $table->string('file_json')->nullable();
            $table->string('file_xlsx')->nullable();
            $table->string('file_pdf')->nullable();
            $table->string('external_url')->nullable();
            $table->json('metadata')->nullable(); // schema.org/Dataset
            $table->boolean('is_published')->default(false);
            $table->integer('sort_order')->default(0);
            $table->integer('download_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['is_published', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('open_datasets');
    }
};
