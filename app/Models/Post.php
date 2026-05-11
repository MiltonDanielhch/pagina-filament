<?php

/**
 * Ubicación: `app/Models/Post.php`
 *
 * Descripción: Modelo Eloquent para las noticias del sitio.
 *              Implementa SoftDeletes, HasMedia (Spatie), HasSlug y
 *              scopes de publicación. Relacionado con Category y User.
 *
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
            ->singleFile();

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->format('webp')
            ->quality(80);

        $this->addMediaConversion('medium')
            ->width(800)
            ->format('webp')
            ->quality(85);

        $this->addMediaConversion('large')
            ->width(1200)
            ->format('webp')
            ->quality(90);

        $this->addMediaConversion('og')
            ->width(1200)
            ->height(630)
            ->format('webp')
            ->quality(95);
    }

    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}