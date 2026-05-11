<?php

/**
 * Ubicación: `app/Filament/Resources/Users/Pages/CreateUser.php`
 *
 * Descripción: Página para crear nuevos usuarios en el panel Filament.
 *
 * Grupo: Seguridad
 * Roadmap: 05-BACKEND.md — Bloque 5.2
 */

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (isset($data['roles'])) {
            session(['pending_roles' => $data['roles']]);
            unset($data['roles']);
        }
        return $data;
    }

    protected function afterCreate(): void
    {
        $roles = session('pending_roles', []);
        if (!empty($roles)) {
            $this->record->syncRoles($roles);
        }
        session()->forget('pending_roles');
    }
}
