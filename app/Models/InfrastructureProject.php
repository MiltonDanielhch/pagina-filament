<?php

/**
 * Ubicación: `app/Models/InfrastructureProject.php`
 *
 * Descripción: Modelo para proyectos de inversión pública (B4, RM 067/2025).
 *              Cubre: avance físico, presupuesto, financiamiento, beneficiarios,
 *              geolocalización, secretaría responsable y galería de imágenes.
 *
 * Cumplimiento: 14-cumplimiento-normativo-rm067-2025.md — Bloque B4.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class InfrastructureProject extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, LogsActivity, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'secretariat_id',
        'gallery_id',
        'code',
        'title',
        'slug',
        'description',
        'category',
        'municipality',
        'beneficiary_communities',
        'latitude',
        'longitude',
        'status',
        'is_featured',
        'start_date',
        'end_date_planned',
        'end_date_real',
        'completion_date',
        'progress_percentage',
        'budget',
        'contracting_company',
        'financing_source',
        'contract_number',
        'image',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date_planned' => 'date',
        'end_date_real' => 'date',
        'completion_date' => 'date',
        'budget' => 'decimal:2',
        'progress_percentage' => 'integer',
        'beneficiary_communities' => 'array',
        'is_featured' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /* -----------------------------------------------------------------
     |  Estados canónicos del proyecto
     | ----------------------------------------------------------------- */
    public const STATUS_PLANNING   = 'planificacion';
    public const STATUS_PROGRESS   = 'ejecucion';
    public const STATUS_COMPLETED  = 'concluido';
    public const STATUS_PARALYZED  = 'paralizado';

    public static function statuses(): array
    {
        return [
            self::STATUS_PLANNING  => 'Planificación',
            self::STATUS_PROGRESS  => 'En ejecución',
            self::STATUS_COMPLETED => 'Concluido',
            self::STATUS_PARALYZED => 'Parado',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? ucfirst((string) $this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PLANNING  => 'blue',
            self::STATUS_PROGRESS  => 'amber',
            self::STATUS_COMPLETED => 'green',
            self::STATUS_PARALYZED => 'red',
            default => 'gray',
        };
    }

    /* -----------------------------------------------------------------
     |  Categorías
     | ----------------------------------------------------------------- */
    public static function categories(): array
    {
        return [
            'salud'           => 'Salud',
            'educacion'       => 'Educación',
            'infraestructura' => 'Infraestructura vial',
            'agua'            => 'Agua y saneamiento',
            'energia'         => 'Energía',
            'transporte'      => 'Transporte',
            'deporte'         => 'Deporte y recreación',
            'productivo'      => 'Desarrollo productivo',
            'otro'            => 'Otro',
        ];
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::categories()[$this->category] ?? ucfirst((string) $this->category);
    }

    /* -----------------------------------------------------------------
     |  Relaciones
     | ----------------------------------------------------------------- */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function secretariat(): BelongsTo
    {
        return $this->belongsTo(Secretariat::class);
    }

    public function gallery(): BelongsTo
    {
        return $this->belongsTo(Gallery::class);
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | ----------------------------------------------------------------- */
    public function scopePublished($query)
    {
        // Sólo proyectos con cierto avance o finalizados
        return $query->whereIn('status', [
            self::STATUS_PLANNING,
            self::STATUS_PROGRESS,
            self::STATUS_COMPLETED,
        ]);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', self::STATUS_PROGRESS);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeByMunicipality($query, ?string $municipality)
    {
        return $municipality
            ? $query->where('municipality', $municipality)
            : $query;
    }

    public function scopeByStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeByCategory($query, ?string $category)
    {
        return $category ? $query->where('category', $category) : $query;
    }

    /* -----------------------------------------------------------------
     |  Spatie Media — "gallery" collection
     | ----------------------------------------------------------------- */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /* -----------------------------------------------------------------
     |  Activity log
     | ----------------------------------------------------------------- */
    protected function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnlyDirty()
            ->logExcept(['created_at', 'updated_at']);
    }
}
