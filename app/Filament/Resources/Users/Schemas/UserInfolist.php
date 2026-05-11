<?php

/**
 * Ubicación: `app/Filament/Resources/Users/Schemas/UserInfolist.php`
 *
 * Descripción: Schema de infolist para visualizar detalles de un usuario.
 *              Muestra nombre, email, rol, fechas de verificación y creación.
 *
 * Grupo: Seguridad
 * Roadmap: 05-BACKEND.md — Bloque 5.2
 */

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nombre'),
                TextEntry::make('email')
                    ->label('Correo electrónico'),
                TextEntry::make('roles.name')
                    ->label('Rol')
                    ->badge()
                    ->color('info')
                    ->getStateUsing(function ($record) {
                        return $record->getRoleNames()->first() ?? 'Sin rol';
                    }),
                TextEntry::make('email_verified_at')
                    ->label('Verificado el')
                    ->dateTime()
                    ->placeholder('No verificado'),
                TextEntry::make('created_at')
                    ->label('Creado el')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->label('Actualizado el')
                    ->dateTime(),
            ]);
    }
}
