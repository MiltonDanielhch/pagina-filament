<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TurismoDestino extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'location_name',
        'badge_label',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
            ->singleFile()
            ->useDisk('public');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'cultura' => 'Cultura y Tradición',
            'santuario' => 'Santuarios Naturales',
            'home' => 'Home Destacado',
            'biodiversidad' => 'Biodiversidad',
            'galeria' => 'Galería',
            default => ucfirst($this->category),
        };
    }

    public function getCategoryColorAttribute(): string
    {
        return match ($this->category) {
            'cultura' => 'amber',
            'santuario' => 'emerald',
            'home' => 'teal',
            'biodiversidad' => 'cyan',
            'galeria' => 'purple',
            default => 'gray',
        };
    }
}
