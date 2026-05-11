{{--
    Ubicación: resources/views/filament/widgets/quick-actions.blade.php
    Descripción: Widget de acciones rápidas en dashboard Filament:
                 crear post, crear evento, ver sitio.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
<div class="grid grid-cols-3 gap-4">
    <a href="{{ route('filament.admin.resources.posts.create') }}"
       class="flex flex-col items-center justify-center p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:border-primary-500 transition-colors">
        <svg width="24" height="24" class="mb-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        <span class="text-xs font-medium text-gray-700">Crear noticia</span>
    </a>
    <a href="{{ route('filament.admin.resources.events.create') }}"
       class="flex flex-col items-center justify-center p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:border-primary-500 transition-colors">
        <svg width="24" height="24" class="mb-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <span class="text-xs font-medium text-gray-700">Crear evento</span>
    </a>
    <a href="/" target="_blank"
       class="flex flex-col items-center justify-center p-4 bg-white rounded-lg shadow-sm border border-gray-200 hover:border-primary-500 transition-colors">
        <svg width="24" height="24" class="mb-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
        </svg>
        <span class="text-xs font-medium text-gray-700">Ver sitio público</span>
    </a>
</div>