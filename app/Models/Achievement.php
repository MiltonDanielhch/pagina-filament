<?php

/**
 * Ubicación: `app/Models/Achievement.php`
 *
 * Descripción: Modelo para logros/resultados del gobierno departamental.
 *              Implementa SoftDeletes y relación con User.
 *
 * Roadmap: 12-FUTURO.md — Página de resultados del gobierno
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Achievement extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'area',
        'achieved_at',
        'status',
    ];

    protected $casts = [
        'achieved_at' => 'date',
    ];

    /**
     * Relación: Usuario que creó el registro.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Solo publicados.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Filtrar por área.
     */
    public function scopeByArea($query, string $area)
    {
        return $query->where('area', $area);
    }

    /**
     * Inicialización y reglas de almacenamiento para colecciones multimedia
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
            ->singleFile()
            ->useDisk('public');
    }

    /**
     * Sintonización del motor gráfico para conversiones optimizadas automáticas (.webp)
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->format('webp')
            ->quality(80)
            ->performOnCollections('featured');

        $this->addMediaConversion('medium')
            ->width(800)
            ->format('webp')
            ->quality(85)
            ->performOnCollections('featured');

        $this->addMediaConversion('large')
            ->width(1200)
            ->format('webp')
            ->quality(90)
            ->performOnCollections('featured');
    }

    /**
     * Obtener imagen o placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        $media = $this->getFirstMedia('featured');
        if ($media) {
            return $media->getUrl();
        }

        return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAwIiBoZWlnaHQ9IjQwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iODAwIiBoZWlnaHQ9IjQwMCIgZmlsbD0iIzBmNzY2ZSIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBkb21pbmFudC1iYXNlbGluZT0ibWlkZGxlIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmb250LXNpemU9IjI0IiBmaWxsPSIjZmZmZmZmIj5Mb2dybyBHdWJlcm5hbWVudGFsPC90ZXh0Pjwvc3ZnPg==';
    }

    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}
