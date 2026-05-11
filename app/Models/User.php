<?php

/**
 * Ubicación: `app/Models/User.php`
 *
 * Descripción: Modelo de usuario con SoftDeletes, HasRoles (Shield), 2FA.
 *
 * Roadmap: 04-DATOS.md — Bloque 4.1
 */

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return true;
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'department',
        'avatar',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'two_factor_secret' => 'encrypted',
        'two_factor_recovery_codes' => 'encrypted',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}