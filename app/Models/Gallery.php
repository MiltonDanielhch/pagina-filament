<?php

/**
 * Ubicación: `app/Models/Gallery.php`
 *
 * Descripción: Modelo para álbumes de galería (fotos o videos).
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
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

class Gallery extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'type',
        'event_date',
        'cover_image',
        'is_featured',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_featured' => 'boolean',
    ];

    /**
     * Relación: Usuario que creó el álbum.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Ítems del álbum.
     */
    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class)->orderBy('sort_order');
    }

    /**
     * Scope: Solo publicados.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Solo fotos.
     */
    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    /**
     * Scope: Solo videos.
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Obtener imagen de portada o placeholder.
     */
    public function getCoverUrlAttribute(): string
    {
        // Usar Spatie Media Library
        $media = $this->getFirstMedia('cover');
        if ($media) {
            return $media->getUrl();
        }

        // Buscar primera imagen en items
        $firstImage = $this->items()->where('type', 'image')->first();
        if ($firstImage && $firstImage->image_path) {
            return asset('storage/' . $firstImage->image_path);
        }

        return 'https://via.placeholder.com/800x400/0f766e/ffffff?text=Galería';
    }

    /**
     * Contar items del álbum.
     */
    public function getItemCountAttribute(): int
    {
        return $this->items()->count();
    }

    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}
