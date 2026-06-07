{{--
    Ubicación: resources/views/filament/pages/settings/site-settings.blade.php
    Descripción: Vista del formulario de configuración del sitio en
                 panel Filament con tabs.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
<?php

use App\Filament\Pages\Settings\SiteSettings;

?>

<x-filament-panels::page>
    {{ $this->form }}
</x-filament-panels::page>