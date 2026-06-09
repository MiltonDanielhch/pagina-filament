<?php

/**
 * Ubicación: `app/Models/Official.php`
 *
 * Descripción: Modelo para funcionarios/autoridades del gobierno departamental.
 *
 * Roadmap: 12-FUTURO.md — Directorio de funcionarios
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Official extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'parent_id', 'secretariat_id',
        'name', 'position', 'area',
        'email', 'phone', 'image', 'bio', 'function',
        'sort_order', 'position_level', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'position_level' => 'integer',
    ];

    /**
     * Relación: Usuario que creó el registro.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Funcionario del que depende (organigrama).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Official::class, 'parent_id');
    }

    /**
     * Relación: Subordinados directos.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Official::class, 'parent_id');
    }

    /**
     * Relación: Secretaría a la que pertenece.
     */
    public function secretariat(): BelongsTo
    {
        return $this->belongsTo(Secretariat::class);
    }

    /**
     * Scope: Solo activos.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Filtrar por área.
     */
    public function scopeByArea($query, string $area)
    {
        return $query->where('area', $area);
    }

    /**
     * Scope: Ordenar por jerarquía (Gobernador primero).
     */
    public function scopeByHierarchy($query)
    {
        return $query->orderBy('position_level')->orderBy('sort_order');
    }

    /**
     * Etiqueta del nivel jerárquico.
     */
    public function getLevelLabelAttribute(): string
    {
        return match ($this->position_level) {
            1 => 'Gobernador',
            2 => 'Vicegobernador',
            3 => 'Secretario Departamental',
            4 => 'Director',
            5 => 'Jefe de Unidad',
            6 => 'Técnico / Profesional',
            default => 'Funcionario',
        };
    }

    /**
     * Obtener foto o placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=0f766e&color=ffffff&size=200';
    }
}
