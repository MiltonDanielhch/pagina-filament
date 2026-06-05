<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->string('type'); // 'image' o 'video'
            $table->string('image_path')->nullable(); // Para imágenes
            $table->string('video_url')->nullable(); // Para videos (YouTube/Vimeo)
            $table->string('youtube_id')->nullable(); // ID de YouTube extraído
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['gallery_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
