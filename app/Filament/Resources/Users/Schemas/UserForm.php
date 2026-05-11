<?php

/**
 * Ubicación: `app/Filament/Resources/Users/Schemas/UserForm.php`
 *
 * Descripción: Schema de formulario para crear/editar usuarios.
 *              Incluye campos de usuario y selección de rol.
 *
 * Grupo: Seguridad
 * Roadmap: 05-BACKEND.md — Bloque 5.1
 */

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                TextInput::make('email')
                    ->label('Correo electrónico')
                    ->email()
                    ->required(),
                Select::make('roles')
                    ->label('Rol')
                    ->options(Role::where('guard_name', 'web')->pluck('name', 'name'))
                    ->multiple()
                    ->preload(),
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(fn(string $operation): bool => $operation === 'create')
                    ->dehydrated(fn(string $operation): bool => $operation === 'create'),
            ]);
    }
}