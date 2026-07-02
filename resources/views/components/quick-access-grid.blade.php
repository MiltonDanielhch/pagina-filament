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
        ['route' => 'turismo.index',        'icon' => 'globe',    'label' => 'Turismo',          'color' => 'teal',    'desc' => 'Naturaleza y cultura'],
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
        'globe'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 0c2.21 0 4.21.895 5.657 2.343A7.994 7.994 0 0119 10M12 2a7.994 7.994 0 00-5.657 2.343A7.994 7.994 0 005 10m14 0a7.994 7.994 0 01-2.343 5.657A7.994 7.994 0 0112 18M5 10a7.994 7.994 0 002.343 5.657A7.994 7.994 0 0012 18m0 0c-2.21 0-4.21-.895-5.657-2.343A7.994 7.994 0 015 10m14 0a7.994 7.994 0 00-2.343-5.657A7.994 7.994 0 0012 2"/>',
    ];

    // Gradients — Beni Amazónico palette
    $gradientMap = [
        'teal'    => 'from-[#2d6a4f] to-[#1b4332]',   // forest green
        'emerald' => 'from-[#40916c] to-[#2d6a4f]',   // medium forest
        'amber'   => 'from-[#d4a017] to-[#b47d14]',   // gold
        'red'     => 'from-red-500 to-rose-600',
        'blue'    => 'from-blue-500 to-indigo-600',
        'indigo'  => 'from-[#1b4332] to-[#0d2418]',   // deep forest
        'orange'  => 'from-[#d4a017] to-orange-600',  // gold-orange
        'cyan'    => 'from-[#52b788] to-[#2d6a4f]',   // light-forest
    ];
    $hoverBorderMap = [
        'teal'    => 'hover:border-teal-400',
        'emerald' => 'hover:border-emerald-400',
        'amber'   => 'hover:border-amber-400',
        'red'     => 'hover:border-red-400',
        'blue'    => 'hover:border-blue-400',
        'indigo'  => 'hover:border-indigo-400',
        'orange'  => 'hover:border-orange-400',
        'cyan'    => 'hover:border-cyan-400',
    ];
    $hoverTextMap = [
        'teal'    => 'group-hover:text-teal-700',
        'emerald' => 'group-hover:text-emerald-700',
        'amber'   => 'group-hover:text-amber-700',
        'red'     => 'group-hover:text-red-700',
        'blue'    => 'group-hover:text-blue-700',
        'indigo'  => 'group-hover:text-indigo-700',
        'orange'  => 'group-hover:text-orange-700',
        'cyan'    => 'group-hover:text-cyan-700',
    ];
@endphp

<section class="py-10 bg-white border-b border-[#e8e0c8]" aria-label="Accesos rápidos">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <p class="section-label mx-auto justify-center">
                <span class="block w-5 h-0.5 bg-teal-500 rounded -mb-0.5"></span>
                Accesos Rápidos
                <span class="block w-5 h-0.5 bg-teal-500 rounded -mb-0.5"></span>
            </p>
            <h2 class="section-title section-title-center text-2xl md:text-3xl font-bold text-gray-900 mx-auto mt-2">¿Qué necesitas hacer hoy?</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-3">
            @foreach($items as $item)
                @php
                    $gradient = $gradientMap[$item['color']] ?? $gradientMap['teal'];
                    $hoverBorder = $hoverBorderMap[$item['color']] ?? $hoverBorderMap['teal'];
                    $hoverText = $hoverTextMap[$item['color']] ?? $hoverTextMap['teal'];
                    $url = \Illuminate\Support\Str::startsWith($item['route'], '/') ? $item['route'] : route($item['route']);
                @endphp
                <a href="{{ $url }}"
                   class="group flex flex-col items-center p-4 bg-white border-2 border-gray-100 {{ $hoverBorder }} rounded-2xl hover:shadow-xl transition-all duration-200 card-lift text-center reveal reveal-d{{ ($loop->index % 8) + 1 }}"
                   aria-label="{{ $item['label'] }} — {{ $item['desc'] }}">
                    {{-- Icon with gradient background + float animation --}}
                    <div class="icon-float float-d{{ $loop->index + 1 }} rounded-2xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center mb-3 shadow-md group-hover:shadow-lg transition-shadow duration-200" style="width:52px;height:52px;flex-shrink:0;">
                        <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $iconMap[$item['icon']] ?? $iconMap['document'] !!}
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-gray-800 {{ $hoverText }} transition-colors duration-200 leading-tight">
                        {{ $item['label'] }}
                    </p>
                    <p class="text-[11px] text-gray-400 text-center mt-0.5 leading-tight hidden sm:block">{{ $item['desc'] }}</p>
                    {{-- Arrow indicator on hover --}}
                    <span class="mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-3.5 h-3.5 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
