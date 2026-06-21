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
            $table->foreignId('parent_id')->nullable()->constrained('officials')->onDelete('set null');
            $table->string('name');
            $table->string('position');
            $table->string('area');
            $table->foreignId('secretariat_id')->nullable()->constrained('secretariats')->onDelete('set null');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->text('bio')->nullable();
            $table->text('function')->nullable();
            $table->unsignedTinyInteger('position_level')->default(5);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['area', 'is_active', 'sort_order']);
            $table->index(['secretariat_id', 'is_active', 'position_level', 'sort_order'], 'idx_officials_sec_active_level_order');
            $table->index('position_level', 'idx_officials_position_level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};
