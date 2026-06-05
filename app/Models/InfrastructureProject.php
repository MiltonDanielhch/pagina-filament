<?php

/**
 * Ubicación: `app/Models/InfrastructureProject.php`
 *
 * Descripción: Modelo para proyectos de infraestructura en el mapa interactivo.
 *
 * Roadmap: 12-FUTURO.md — Mapa interactivo del Beni
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class InfrastructureProject extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'category',
        'municipality',
        'latitude',
        'longitude',
        'status',
        'start_date',
        'completion_date',
        'budget',
        'image',
    ];

    protected $casts = [
        'start_date' => 'date',
        'completion_date' => 'date',
        'budget' => 'decimal:2',
    ];

    /**
     * Relación: Usuario que creó el proyecto.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Proyectos en progreso.
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope: Proyectos completados.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope: Proyectos por municipio.
     */
    public function scopeByMunicipality($query, $municipality)
    {
        return $query->where('municipality', $municipality);
    }

    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}
