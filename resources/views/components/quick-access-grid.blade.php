{{--
    Componente: Grid de Accesos Rápidos (Bloque 5 del homepage)
    8 botones grandes con íconos. RM 067/2025 — Accesibilidad.
--}}
@props([
    'items' => [
        ['route' => 'procedures.index',     'icon' => 'document', 'label' => 'Trámites',         'color' => 'teal',    'desc' => 'Catálogo completo'],
        ['route' => 'transparency.index',   'icon' => 'eye',      'label' => 'Transparencia',    'color' => 'emerald', 'desc' => 'Información pública'],
        ['route' => 'announcements.index',  'icon' => 'megaphone','label' => 'Convocatorias',    'color' => 'amber',   'desc' => 'Procesos vigentes'],
        ['route' => 'complaints.create',    'icon' => 'pencil',   'label' => 'Quejas',           'color' => 'red',     'desc' => 'Libro de reclamaciones'],
        ['route' => 'institutional.index',  'icon' => 'building', 'label' => 'La Gobernación',   'color' => 'blue',    'desc' => 'Reseña y organigrama'],
        ['route' => 'open-data.index',      'icon' => 'database', 'label' => 'Datos Abiertos',   'color' => 'indigo',  'desc' => 'Datasets públicos'],
        ['route' => 'offices',             'icon' => 'location', 'label' => 'Oficinas',         'color' => 'orange',  'desc' => 'Puntos de atención'],
        ['route' => 'blog',                 'icon' => 'news',     'label' => 'Noticias',         'color' => 'cyan',    'desc' => 'Sala de prensa'],
    ]
])

@php
    $iconMap = [
        'document' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
        'eye'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>',
        'megaphone'=> '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>',
        'pencil'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>',
        'building' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
        'database' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>',
        'location' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
        'news'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
    ];
    $colorMap = [
        'teal'    => ['bg' => 'bg-teal-50',     'text' => 'text-teal-700',     'hover' => 'group-hover:bg-teal-600',     'ring' => 'group-hover:ring-teal-200'],
        'emerald' => ['bg' => 'bg-emerald-50',  'text' => 'text-emerald-700',  'hover' => 'group-hover:bg-emerald-600',  'ring' => 'group-hover:ring-emerald-200'],
        'amber'   => ['bg' => 'bg-amber-50',    'text' => 'text-amber-700',    'hover' => 'group-hover:bg-amber-600',    'ring' => 'group-hover:ring-amber-200'],
        'red'     => ['bg' => 'bg-red-50',      'text' => 'text-red-700',      'hover' => 'group-hover:bg-red-600',      'ring' => 'group-hover:ring-red-200'],
        'blue'    => ['bg' => 'bg-blue-50',     'text' => 'text-blue-700',     'hover' => 'group-hover:bg-blue-600',     'ring' => 'group-hover:ring-blue-200'],
        'indigo'  => ['bg' => 'bg-indigo-50',   'text' => 'text-indigo-700',   'hover' => 'group-hover:bg-indigo-600',   'ring' => 'group-hover:ring-indigo-200'],
        'orange'  => ['bg' => 'bg-orange-50',   'text' => 'text-orange-700',   'hover' => 'group-hover:bg-orange-600',   'ring' => 'group-hover:ring-orange-200'],
        'cyan'    => ['bg' => 'bg-cyan-50',     'text' => 'text-cyan-700',     'hover' => 'group-hover:bg-cyan-600',     'ring' => 'group-hover:ring-cyan-200'],
    ];
@endphp

<section class="py-12 bg-white" aria-label="Accesos rápidos">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Accesos Rápidos</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">¿Qué necesitas hacer hoy?</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-3 md:gap-4">
            @foreach($items as $item)
                @php
                    $colors = $colorMap[$item['color']] ?? $colorMap['teal'];
                    $url = \Illuminate\Support\Str::startsWith($item['route'], '/') ? $item['route'] : route($item['route']);
                @endphp
                <a href="{{ $url }}"
                   class="group flex flex-col items-center p-4 md:p-5 bg-white border-2 border-gray-100 rounded-2xl hover:border-transparent hover:shadow-xl transition ring-0 {{ $colors['ring'] }}">
                    <div class="w-12 h-12 md:w-14 md:h-14 {{ $colors['bg'] }} {{ $colors['text'] }} rounded-xl flex items-center justify-center mb-3 group-hover:bg-white transition {{ $colors['hover'] }} group-hover:text-white">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $iconMap[$item['icon']] ?? $iconMap['document'] !!}
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-gray-900 group-hover:text-teal-700 transition text-center leading-tight">
                        {{ $item['label'] }}
                    </p>
                    <p class="text-xs text-gray-500 text-center mt-0.5 hidden md:block">{{ $item['desc'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
