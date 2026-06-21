<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('infrastructure_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('secretariat_id')->nullable()->constrained('secretariats')->nullOnDelete();
            $table->foreignId('gallery_id')->nullable()->constrained('galleries')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('code', 50)->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('contracting_company')->nullable();
            $table->string('financing_source')->nullable();
            $table->string('contract_number')->nullable();
            $table->string('category');
            $table->string('municipality');
            $table->json('beneficiary_communities')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('status')->default('planned');
            $table->boolean('is_featured')->default(false);
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->date('end_date_planned')->nullable();
            $table->date('end_date_real')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->unsignedTinyInteger('progress_percentage')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'is_featured']);
            $table->index('municipality', 'idx_projects_municipality');
            $table->index('category', 'idx_projects_category');
            $table->index('start_date', 'idx_projects_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infrastructure_projects');
    }
};
