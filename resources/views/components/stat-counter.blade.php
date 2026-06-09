{{--
    Componente: Contador de Estadística (Bloque 8 — Transparencia en Cifras)
    Animación con CSS al entrar en viewport (clase count-up).
--}}
@props([
    'value' => 0,
    'label' => '',
    'icon' => 'chart',
    'color' => 'teal',
    'url' => null,
    'suffix' => '',
])

@php
    $colorMap = [
        'teal'    => ['bg' => 'bg-teal-50',    'text' => 'text-teal-700'],
        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700'],
        'amber'   => ['bg' => 'bg-amber-50',   'text' => 'text-amber-700'],
        'blue'    => ['bg' => 'bg-blue-50',    'text' => 'text-blue-700'],
        'purple'  => ['bg' => 'bg-purple-50',  'text' => 'text-purple-700'],
        'red'     => ['bg' => 'bg-red-50',     'text' => 'text-red-700'],
    ];
    $c = $colorMap[$color] ?? $colorMap['teal'];
    $iconMap = [
        'chart'    => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        'document' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
        'building' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        'money'    => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'people'   => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        'map'      => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z',
        'megaphone'=> 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
        'check'    => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'database' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4',
    ];
    $svg = $iconMap[$icon] ?? $iconMap['chart'];
@endphp

@if($url)
<a href="{{ $url }}" class="block group">
@endif
<div class="bg-white rounded-2xl p-5 md:p-6 shadow-sm hover:shadow-xl transition border border-gray-100 text-center group-hover:border-{{ $color }}-300">
    <div class="w-12 h-12 md:w-14 md:h-14 {{ $c['bg'] }} {{ $c['text'] }} rounded-xl flex items-center justify-center mb-3 mx-auto">
        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $svg }}"/>
        </svg>
    </div>
    <p class="text-3xl md:text-4xl font-bold text-gray-900 mb-1">
        <span class="counter" data-target="{{ $value }}">0</span>{{ $suffix }}
    </p>
    <p class="text-xs md:text-sm text-gray-600 font-medium">{{ $label }}</p>
</div>
@if($url)
</a>
@endif
