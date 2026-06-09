<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RM 067/2025 — Marco normativo (nacional y departamental)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marco_normativos', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['ley', 'decreto_supremo', 'decreto', 'resolución', 'otra'])
                ->default('otra');
            $table->string('number', 50)->nullable(); // ej: "5340"
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary')->nullable();
            $table->date('issue_date')->nullable();
            $table->enum('scope', ['nacional', 'departamental'])->default('nacional');
            $table->string('document_file')->nullable(); // PDF via Spatie
            $table->string('external_url')->nullable();
            $table->boolean('is_published')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['scope', 'is_published', 'type']);
            $table->index('issue_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marco_normativos');
    }
};
