<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('type', ['photo', 'video', 'mixed'])->default('photo');
            $table->date('event_date')->nullable(); // Fecha del evento/album
            $table->string('cover_image')->nullable(); // Imagen de portada
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['type', 'status', 'event_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
