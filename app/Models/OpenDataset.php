<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * OpenDataset — Conjunto de datos abiertos publicables.
 * Cumplimiento de transparencia activa (DS 5340 y RA AGETIC/0030/2025).
 */
class OpenDataset extends Model
{
    use HasFactory, HasSlug, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'category', 'publisher',
        'update_frequency', 'last_updated_at', 'formats', 'license',
        'file_csv', 'file_json', 'file_xlsx', 'file_pdf',
        'external_url', 'metadata', 'is_published', 'sort_order', 'download_count',
    ];

    protected $casts = [
        'last_updated_at' => 'date',
        'formats' => 'array',
        'metadata' => 'array',
        'is_published' => 'boolean',
        'download_count' => 'integer',
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

    public function scopeByCategory(Builder $q, string $category): Builder
    {
        return $q->where('category', $category);
    }

    public function scopeRecent(Builder $q, int $limit = 6): Builder
    {
        return $q->orderByDesc('last_updated_at')->limit($limit);
    }

    public function getFrequencyLabelAttribute(): string
    {
        return match ($this->update_frequency) {
            'diario' => 'Diario',
            'semanal' => 'Semanal',
            'mensual' => 'Mensual',
            'trimestral' => 'Trimestral',
            'anual' => 'Anual',
            default => 'Eventual',
        };
    }

    public function getFormatLabelsAttribute(): array
    {
        $map = [
            'csv' => 'CSV',
            'json' => 'JSON',
            'xlsx' => 'Excel',
            'pdf' => 'PDF',
        ];
        $formats = $this->formats ?? [];
        return array_map(fn ($f) => $map[$f] ?? strtoupper($f), $formats);
    }
}
