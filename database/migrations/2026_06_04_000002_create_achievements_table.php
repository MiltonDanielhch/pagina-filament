<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('area')->nullable(); // Área de gobierno: Salud, Educación, Infraestructura, etc.
            $table->date('achieved_at')->nullable(); // Fecha en que se logró
            $table->string('image')->nullable(); // Ruta a imagen (para no depender de Spatie en migración simple)
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'achieved_at']);
            $table->index('area');
        });
    }

    public function down(): void
    {
        Schema::dropIfEntries('achievements');
    }
};
