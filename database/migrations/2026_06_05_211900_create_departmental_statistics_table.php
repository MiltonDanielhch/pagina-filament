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
        Schema::create('departmental_statistics', function (Blueprint $table) {
            $table->id();
            $table->year('year')->unique();
            
            // Indicadores demográficos
            $table->integer('population')->nullable();
            $table->decimal('population_growth_rate', 5, 2)->nullable();
            $table->integer('urban_population')->nullable();
            $table->integer('rural_population')->nullable();
            
            // Indicadores geográficos
            $table->decimal('area_km2', 10, 2)->nullable();
            $table->integer('municipalities')->nullable();
            $table->integer('provinces')->nullable();
            
            // Indicadores económicos
            $table->decimal('gdp_billion_usd', 10, 2)->nullable();
            $table->decimal('gdp_per_capita_usd', 10, 2)->nullable();
            $table->decimal('inflation_rate', 5, 2)->nullable();
            $table->decimal('unemployment_rate', 5, 2)->nullable();
            
            // Indicadores educativos
            $table->integer('schools')->nullable();
            $table->integer('students')->nullable();
            $table->integer('teachers')->nullable();
            $table->decimal('literacy_rate', 5, 2)->nullable();
            
            // Indicadores de salud
            $table->integer('hospitals')->nullable();
            $table->integer('health_centers')->nullable();
            $table->integer('doctors')->nullable();
            $table->decimal('infant_mortality_rate', 5, 2)->nullable();
            
            // Indicadores de infraestructura
            $table->integer('paved_roads_km')->nullable();
            $table->integer('electrification_coverage')->nullable();
            $table->integer('internet_users')->nullable();
            
            // Metadatos
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->string('data_source')->default('INE Bolivia');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departmental_statistics');
    }
};
