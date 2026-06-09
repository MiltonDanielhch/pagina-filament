<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Complaint — Queja, reclamo, sugerencia o denuncia ciudadana.
 * Libro de Reclamaciones Virtual (RM 067/2025).
 */
class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type', 'code', 'full_name', 'ci', 'email', 'phone', 'address',
        'subject', 'description', 'attachment',
        'related_secretariat_id', 'status', 'response', 'response_date',
        'assigned_to', 'tracking_token', 'ip_address',
    ];

    protected $casts = [
        'response_date' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Complaint $c) {
            if (empty($c->tracking_token)) {
                $c->tracking_token = Str::random(48);
            }
            if (empty($c->code)) {
                $c->code = static::generateCode();
            }
        });
    }

    public static function generateCode(): string
    {
        $year = now()->year;
        $prefix = match (request()->input('type') ?? 'queja') {
            'reclamo' => 'RE',
            'sugerencia' => 'SU',
            'denuncia' => 'DE',
            default => 'QR',
        };
        $last = static::withTrashed()
            ->whereYear('created_at', $year)
            ->where('code', 'like', $prefix . "-{$year}-%")
            ->orderByDesc('id')
            ->value('code');
        $next = 1;
        if ($last && preg_match('/(\d+)$/', $last, $m)) {
            $next = ((int) $m[1]) + 1;
        }
        return sprintf('%s-%d-%06d', $prefix, $year, $next);
    }

    public function secretariat(): BelongsTo
    {
        return $this->belongsTo(Secretariat::class, 'related_secretariat_id');
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeByStatus(Builder $q, string $status): Builder
    {
        return $q->where('status', $status);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'recibido' => 'Recibido',
            'en_proceso' => 'En proceso',
            'resuelto' => 'Resuelto',
            'rechazado' => 'Rechazado',
            default => 'Sin estado',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'recibido' => 'info',
            'en_proceso' => 'warning',
            'resuelto' => 'success',
            'rechazado' => 'danger',
            default => 'gray',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'queja' => 'Queja',
            'reclamo' => 'Reclamo',
            'sugerencia' => 'Sugerencia',
            'denuncia' => 'Denuncia',
            default => 'Otro',
        };
    }

    public function getTrackingUrlAttribute(): string
    {
        return route('complaints.track', $this->tracking_token);
    }
}
