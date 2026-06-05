<?php

/**
 * Ubicación: `app/Models/DepartmentalStatistics.php`
 *
 * Descripción: Modelo para estadísticas departamentales del Beni.
 *
 * Roadmap: 12-FUTURO.md — Sistema de Estadísticas Departamentales
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class DepartmentalStatistics extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'year',
        'population',
        'population_growth_rate',
        'urban_population',
        'rural_population',
        'area_km2',
        'municipalities',
        'provinces',
        'gdp_billion_usd',
        'gdp_per_capita_usd',
        'inflation_rate',
        'unemployment_rate',
        'schools',
        'students',
        'teachers',
        'literacy_rate',
        'hospitals',
        'health_centers',
        'doctors',
        'infant_mortality_rate',
        'paved_roads_km',
        'electrification_coverage',
        'internet_users',
        'user_id',
        'notes',
        'data_source',
    ];

    protected $casts = [
        'year' => 'integer',
        'population' => 'integer',
        'population_growth_rate' => 'decimal:2',
        'urban_population' => 'integer',
        'rural_population' => 'integer',
        'area_km2' => 'decimal:2',
        'municipalities' => 'integer',
        'provinces' => 'integer',
        'gdp_billion_usd' => 'decimal:2',
        'gdp_per_capita_usd' => 'decimal:2',
        'inflation_rate' => 'decimal:2',
        'unemployment_rate' => 'decimal:2',
        'schools' => 'integer',
        'students' => 'integer',
        'teachers' => 'integer',
        'literacy_rate' => 'decimal:2',
        'hospitals' => 'integer',
        'health_centers' => 'integer',
        'doctors' => 'integer',
        'infant_mortality_rate' => 'decimal:2',
        'paved_roads_km' => 'integer',
        'electrification_coverage' => 'integer',
        'internet_users' => 'integer',
    ];

    /**
     * Relación: Usuario que creó/actualizó las estadísticas.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Estadísticas del año actual.
     */
    public function scopeCurrentYear($query)
    {
        return $query->where('year', date('Y'));
    }

    /**
     * Scope: Estadísticas ordenadas por año descendente.
     */
    public function scopeLatestYear($query)
    {
        return $query->orderBy('year', 'desc');
    }

    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}
