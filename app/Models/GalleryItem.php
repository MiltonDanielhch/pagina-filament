<?php

/**
 * Ubicación: `app/Models/GalleryItem.php`
 *
 * Descripción: Modelo para ítems individuales de galería (fotos o videos).
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'title',
        'caption',
        'type',
        'image_path',
        'video_url',
        'youtube_id',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Relación: Álbum padre.
     */
    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    /**
     * Obtener URL de imagen completa.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }

        return '';
    }

    /**
     * Obtener thumbnail de YouTube.
     */
    public function getYoutubeThumbnailAttribute(): string
    {
        if ($this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/mqdefault.jpg";
        }

        return '';
    }

    /**
     * Obtener embed URL de YouTube.
     */
    public function getYoutubeEmbedUrlAttribute(): string
    {
        if ($this->youtube_id) {
            return "https://www.youtube.com/embed/{$this->youtube_id}";
        }

        return '';
    }

    /**
     * Extraer YouTube ID de una URL.
     */
    public static function extractYoutubeId(string $url): ?string
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);

        return $matches[1] ?? null;
    }
}
