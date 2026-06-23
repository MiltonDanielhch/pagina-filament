<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    protected static ?string $heading = 'Acciones Rápidas';

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.widgets.quick-actions';
}
