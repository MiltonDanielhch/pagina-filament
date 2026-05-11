<?php

/**
 * Ubicación: `app/Filament/Widgets/QuickActionsWidget.php`
 *
 * Descripción: Widget Filament con enlaces rápidos a crear post, crear evento
 *              y ver sitio público
 *
 * Uso: Se usa en el dashboard de Filament
 * Roadmap: 05-BACKEND.md — Bloque 3.2
 */

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected string $view = 'filament.widgets.quick-actions';
}