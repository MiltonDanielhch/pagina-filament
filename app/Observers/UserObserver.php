<?php

/**
 * Ubicación: `app/Observers/UserObserver.php`
 *
 * Descripción: Observer para sincronizar roles asignados en el formulario de usuario.
 *              Cuando se crea/actualiza un usuario, se asignan los roles seleccionados.
 *
 * Vinculación: Registrado en AppServiceProvider
 * Roadmap: 05-BACKEND.md — Bloque 5.2
 */

namespace App\Observers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserObserver
{
    public function created(Model $model): void
    {
        if ($model instanceof User && isset($model->roles) && is_array($model->roles)) {
            $model->syncRoles($model->roles);
            unset($model->roles);
        }

        if ($model instanceof User && !$model->email_verified_at) {
            $model->forceFill(['email_verified_at' => now()]);
            $model->saveQuietly();
        }
    }

    public function updated(Model $model): void
    {
        if ($model instanceof User && isset($model->roles) && is_array($model->roles)) {
            $model->syncRoles($model->roles);
            unset($model->roles);
        }
    }
}