<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('position'); // Cargo
            $table->string('area'); // Área de gobierno
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable(); // Ruta a foto
            $table->text('bio')->nullable(); // Biografía corta
            $table->integer('sort_order')->default(0); // Para ordenar dentro del área
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['area', 'is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};
