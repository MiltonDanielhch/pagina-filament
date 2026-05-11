<?php

/**
 * Ubicación: `app/Models/ExternalSystem.php`
 *
 * Descripción: Modelo para sistemas externos con health check.
 *
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ExternalSystem extends Model
{
    protected $fillable = [
        'name',
        'url',
        'description',
        'icon',
        'is_active',
        'order',
        'last_status',
        'last_checked_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_checked_at' => 'datetime',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function isOnline(): bool
    {
        return $this->last_status === 'online';
    }
}