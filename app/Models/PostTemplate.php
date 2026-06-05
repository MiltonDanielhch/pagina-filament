<?php

/**
 * Ubicación: `app/Models/PostTemplate.php`
 *
 * Descripción: Modelo para plantillas predefinidas de noticias.
 *              Almacena estructura base para Comunicado Oficial, Evento y Nota de Prensa.
 *
 * Roadmap: 13-automatizacion-noticias.md — Bloque 13.3
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'default_data',
        'description',
        'is_active',
    ];

    protected $casts = [
        'default_data' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Filtrar solo plantillas activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Filtrar por tipo de plantilla
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
