<?php

/**
 * Ubicación: `app/Models/Slide.php`
 *
 * Descripción: Modelo para diapositivas del slider principal.
 *
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slide extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, LogsActivity;

    protected $fillable = [
        'title',
        'image',
        'link',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}