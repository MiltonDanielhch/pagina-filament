<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Announcement — Convocatoria pública o proceso de contratación.
 * Publicación de oportunidades y compras estatales.
 */
class Announcement extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'code', 'type', 'title', 'slug', 'description', 'requirements',
        'publication_date', 'opening_date', 'closing_date', 'status', 'sort_order',
        'document_file', 'external_url', 'responsible_secretariat_id',
    ];

    protected $casts = [
        'publication_date' => 'date',
        'opening_date' => 'datetime',
        'closing_date' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function secretariat(): BelongsTo
    {
        return $this->belongsTo(Secretariat::class, 'responsible_secretariat_id');
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status', 'publicada');
    }

    public function scopeOpen(Builder $q): Builder
    {
        return $q->whereIn('status', ['publicada', 'en_proceso']);
    }

    public function scopeByType(Builder $q, string $type): Builder
    {
        return $q->where('type', $type);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'borrador' => 'Borrador',
            'publicada' => 'Publicada',
            'en_proceso' => 'En proceso',
            'finalizada' => 'Finalizada',
            'desierta' => 'Desierta',
            default => 'Sin estado',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'borrador' => 'gray',
            'publicada' => 'info',
            'en_proceso' => 'warning',
            'finalizada' => 'success',
            'desierta' => 'danger',
            default => 'gray',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'convocatoria_publica' => 'Convocatoria Pública',
            'contratacion' => 'Contratación',
            'consultoria' => 'Consultoría',
            default => 'Otro',
        };
    }

    public function getIsOpenAttribute(): bool
    {
        if (!in_array($this->status, ['publicada', 'en_proceso'])) {
            return false;
        }
        if ($this->closing_date && $this->closing_date->isPast()) {
            return false;
        }
        return true;
    }
}
