<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * RM 067/2025 — Catálogo de trámites y servicios al ciudadano.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->string('code', 30)->unique(); // ej: "GAD-BENI-T-001"
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable(); // procedimiento paso a paso
            $table->longText('requirements')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->string('currency', 5)->default('BOB');
            $table->unsignedSmallInteger('processing_time_days')->nullable();
            $table->string('schedule')->nullable(); // "Lun-Vie 08:00-16:00"
            $table->enum('category', [
                'salud', 'educacion', 'infraestructura', 'catastro',
                'impuestos', 'recursos_humanos', 'ganaderia', 'mineria',
                'transporte', 'medio_ambiente', 'cultura', 'turismo',
                'justicia', 'otro',
            ])->default('otro');
            $table->foreignId('responsible_secretariat_id')
                ->nullable()
                ->constrained('secretariats')
                ->onDelete('set null');
            $table->foreignId('responsible_official_id')
                ->nullable()
                ->constrained('officials')
                ->onDelete('set null');
            $table->string('online_url')->nullable();
            $table->boolean('is_online')->default(false);
            $table->enum('status', ['activo', 'suspendido', 'dado_de_baja'])->default('activo');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_featured', 'sort_order']);
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('procedures');
    }
};
