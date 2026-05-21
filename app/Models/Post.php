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
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    // Prioridad a InteractsWithMedia para registrar eventos de Eloquent antes del logger
    use InteractsWithMedia, HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        // Identificadores de relaciones estructurales
        'user_id',
        'category_id',

        // Contenido de la noticia
        'title',
        'slug',
        'excerpt',
        'body',

        // Estado y visibilidad
        'status',
        'is_pinned',
        'published_at',

        // SEO y Metadatos de la publicación
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Relación: Autor de la publicación (Noticia pertenece a un Usuario)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Clasificación (Noticia pertenece a una Categoría)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope: Filtrar solo noticias publicadas en el sitio principal
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope: Filtrar las publicaciones según su categoría base
     */
    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
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

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
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
            ->performOnCollections('featured', 'gallery');

        $this->addMediaConversion('medium')
            ->width(800)
            ->format('webp')
            ->quality(85)
            ->performOnCollections('featured', 'gallery');

        $this->addMediaConversion('large')
            ->width(1200)
            ->format('webp')
            ->quality(90)
            ->performOnCollections('featured', 'gallery');

        $this->addMediaConversion('og')
            ->width(1200)
            ->height(630)
            ->format('webp')
            ->quality(95)
            ->performOnCollections('featured');
    }

    /**
     * Configuración del rastro de auditoría y registros de actividad del modelo
     */
    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}
