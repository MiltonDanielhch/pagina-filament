<?php

/**
 * Ubicación: `database/migrations/2026_05_05_170000_create_posts_table.php`
 *
 * Descripción: Crea tabla posts con title, slug, excerpt, content,
 *              status, published_at, SEO fields, timestamps y softDeletes.
 *
 * Dependencias: users_table, categories_table
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('body');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('is_pinned')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
            $table->boolean('shared_to_social')->default(false);
            $table->timestamp('shared_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'published_at'], 'idx_posts_status_published');
            $table->index(['category_id', 'status', 'published_at'], 'idx_posts_category_status_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
