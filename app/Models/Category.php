<?php

/**
 * Ubicación: `app/Models/Category.php`
 *
 * Descripción: Modelo para categorías de noticias con color y relación hasMany.
 *
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}