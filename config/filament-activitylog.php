<?php

/**
 * Ubicación: `config/filament-activitylog.php`
 *
 * Descripción: Configuración del plugin Filament Activity Log para panel
 *              de auditoría.
 *
 * Dependencias: rmsramos/laravel-filament-activitylog
 * Roadmap: 08-RENDIMIENTO.md — Bloque 8.6
 */

return [
    'resources' => [
        'label'                     => 'Activity Log',
        'plural_label'              => 'Activity Logs',
        'hide_restore_action'       => false,
        'restore_action_label'      => 'Restore',
        'hide_resource_action'      => false,
        'hide_restore_model_action' => true,
        'resource_action_label'     => 'View',
        'navigation_item'           => true,
        'navigation_group'          => null,
        'navigation_icon'           => 'heroicon-o-shield-check',
        'navigation_sort'           => null,
        'default_sort_column'       => 'id',
        'default_sort_direction'    => 'desc',
        'navigation_count_badge'    => false,
        'resource'                  => \Rmsramos\Activitylog\Resources\ActivitylogResource::class,
    ],
    'date_format'     => 'd/m/Y',
    'datetime_format' => 'd/m/Y H:i:s',
];
