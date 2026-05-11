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
    <form wire:submit="save">
        {{ $this->form }}
        
        <div class="mt-6 flex justify-end">
            <button type="submit" class="filament-button filament-button-size-sm inline-flex items-center justify-center py-2 px-3 rounded-lg font-medium text-white bg-primary-600 hover:bg-primary-500 focus:ring-primary-500 focus:ring-offset-2 focus:ring-2">
                Guardar configuración
            </button>
        </div>
    </form>
</x-filament-panels::page>