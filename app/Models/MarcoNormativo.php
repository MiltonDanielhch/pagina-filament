<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * MarcoNormativo — Leyes, decretos, resoluciones (nacionales y departamentales).
 * Base legal del portal (RM 067/2025, DS 5340, etc.).
 */
class MarcoNormativo extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'type', 'number', 'title', 'slug', 'summary',
        'issue_date', 'scope', 'document_file', 'external_url',
        'is_published', 'sort_order',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('is_published', true);
    }

    public function scopeNational(Builder $q): Builder
    {
        return $q->where('scope', 'nacional');
    }

    public function scopeDepartmental(Builder $q): Builder
    {
        return $q->where('scope', 'departamental');
    }

    public function scopeByType(Builder $q, string $type): Builder
    {
        return $q->where('type', $type);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'ley' => 'Ley',
            'decreto_supremo' => 'Decreto Supremo',
            'decreto' => 'Decreto',
            'resolución' => 'Resolución',
            default => 'Otra',
        };
    }

    public function getFullTitleAttribute(): string
    {
        $type = strtoupper($this->type_label);
        $number = $this->number ? " N° {$this->number}" : '';
        return "{$type}{$number} — {$this->title}";
    }
}
