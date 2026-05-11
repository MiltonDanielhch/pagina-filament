<?php

/**
 * Ubicación: `app/Filament/Resources/Users/Pages/EditUser.php`
 *
 * Descripción: Página para editar usuarios existentes en el panel Filament.
 *              Incluye acciones de ver y eliminar en el header.
 *
 * Grupo: Seguridad
 * Roadmap: 05-BACKEND.md — Bloque 5.2
 */

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['roles'])) {
            session(['pending_roles' => $data['roles']]);
            unset($data['roles']);
        }
        return $data;
    }

    protected function afterSave(): void
    {
        $roles = session('pending_roles', []);
        if (!empty($roles)) {
            $this->record->syncRoles($roles);
        }
        session()->forget('pending_roles');
    }
}
