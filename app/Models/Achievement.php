<?php

/**
 * Ubicación: `app/Models/Achievement.php`
 *
 * Descripción: Modelo para logros/resultados del gobierno departamental.
 *              Implementa SoftDeletes y relación con User.
 *
 * Roadmap: 12-FUTURO.md — Página de resultados del gobierno
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Achievement extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'area',
        'achieved_at',
        'image',
        'status',
    ];

    protected $casts = [
        'achieved_at' => 'date',
    ];

    /**
     * Relación: Usuario que creó el registro.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Solo publicados.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Filtrar por área.
     */
    public function scopeByArea($query, string $area)
    {
        return $query->where('area', $area);
    }

    /**
     * Obtener imagen o placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return 'https://via.placeholder.com/800x400/0f766e/ffffff?text=Logro+Gubernamental';
    }

    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}
