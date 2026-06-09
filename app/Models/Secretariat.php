<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Secretariat — Secretaría departamental del Beni.
 * Estructura jerárquica con parent_secretariat_id.
 */
class Secretariat extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia, SoftDeletes;

    protected $table = 'secretariats';

    protected $fillable = [
        'name', 'slug', 'acronym', 'description',
        'mission', 'vision', 'objectives',
        'parent_secretariat_id', 'head_official_id',
        'contact_email', 'contact_phone', 'office_address',
        'logo_path', 'color', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'objectives' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Secretariat::class, 'parent_secretariat_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Secretariat::class, 'parent_secretariat_id');
    }

    public function head(): BelongsTo
    {
        return $this->belongsTo(Official::class, 'head_official_id');
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class, 'responsible_secretariat_id');
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'responsible_secretariat_id');
    }

    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    public function scopeRoots(Builder $q): Builder
    {
        return $q->whereNull('parent_secretariat_id');
    }

    public function getLogoUrlAttribute(): string
    {
        if ($this->logo_path) {
            return asset('storage/' . $this->logo_path);
        }
        return asset('images/secretariat-default.png');
    }
}
