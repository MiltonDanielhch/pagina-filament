<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Office — Oficina o punto de atención al ciudadano.
 * Directorio de la Gobernación (RM 067/2025).
 */
class Office extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'address', 'municipality', 'phone', 'email', 'schedule',
        'latitude', 'longitude', 'services', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'services' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    public function scopeByMunicipality(Builder $q, string $municipality): Builder
    {
        return $q->where('municipality', $municipality);
    }

    public function getHasCoordinatesAttribute(): bool
    {
        return $this->latitude !== null && $this->longitude !== null;
    }
}
