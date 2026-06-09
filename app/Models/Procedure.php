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
 * Procedure — Trámite o servicio al ciudadano.
 * Catálogo con requisitos, costos, plazos y enlace a trámite en línea.
 */
class Procedure extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'code', 'name', 'slug', 'description', 'requirements',
        'cost', 'currency', 'processing_time_days', 'schedule',
        'category', 'responsible_secretariat_id', 'responsible_official_id',
        'online_url', 'is_online', 'status', 'is_featured', 'sort_order',
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'processing_time_days' => 'integer',
        'is_online' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function secretariat(): BelongsTo
    {
        return $this->belongsTo(Secretariat::class, 'responsible_secretariat_id');
    }

    public function official(): BelongsTo
    {
        return $this->belongsTo(Official::class, 'responsible_official_id');
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('status', 'activo');
    }

    public function scopeFeatured(Builder $q): Builder
    {
        return $q->where('is_featured', true);
    }

    public function scopeByCategory(Builder $q, string $category): Builder
    {
        return $q->where('category', $category);
    }

    public function scopeOnline(Builder $q): Builder
    {
        return $q->where('is_online', true);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'salud' => 'Salud',
            'educacion' => 'Educación',
            'infraestructura' => 'Infraestructura',
            'catastro' => 'Catastro',
            'impuestos' => 'Impuestos',
            'recursos_humanos' => 'Recursos Humanos',
            'ganaderia' => 'Ganadería',
            'mineria' => 'Minería',
            'transporte' => 'Transporte',
            'medio_ambiente' => 'Medio Ambiente',
            'cultura' => 'Cultura',
            'turismo' => 'Turismo',
            'justicia' => 'Justicia',
            default => 'Otro',
        };
    }

    public function getRequirementsListAttribute(): array
    {
        if (!$this->requirements) {
            return [];
        }
        return array_values(array_filter(array_map('trim',
            preg_split("/\r\n|\n|\r|•|-/", $this->requirements)
        )));
    }

    public function getCostFormattedAttribute(): string
    {
        if ($this->cost === null) {
            return 'Gratuito';
        }
        return 'Bs. ' . number_format($this->cost, 2);
    }
}
