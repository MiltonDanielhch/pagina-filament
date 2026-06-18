<?php

/**
 * Ubicación: `app/Filament/Resources/ActivityLog/ActivityLogResource.php`
 *
 * Descripción: Resource Filament para visualizar el log de actividad
 *              (spatie/laravel-activitylog). Solo lectura de auditorías.
 *
 * Grupo: Administración
 * Roadmap: 05-BACKEND.md — Bloque 5.2
 */

namespace App\Filament\Resources\ActivityLog;

use App\Filament\Resources\ActivityLog\Pages\ListActivities;
use Filament\Resources\Resource;
use BackedEnum;
use UnitEnum;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Icons\Heroicon;
use Spatie\Activitylog\Models\Activity;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $navigationLabel = 'Registro de actividad';

    protected static string|UnitEnum|null $navigationGroup = 'Seguridad';

    protected static ?string $modelLabel = 'Actividad';

    protected static ?string $pluralModelLabel = 'Actividades';

    protected static ?int $navigationSort = 100;

    public static function getPages(): array
    {
        return [
            'index' => ListActivities::route('/'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('view_any_activity_log') ?? false;
    }
}