{{--
    Vista: Catálogo de Trámites — Index
    Cumplimiento: RM 067/2025 — Componentes 13, 14
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Catálogo de trámites y servicios de la Gobernación del Beni. Requisitos, costos, plazos y enlaces a trámite en línea.">
@endsection

@section('content')
<section class="bg-white pt-12 pb-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-5xl mx-auto text-center flex flex-col items-center justify-center">

        <!-- Migas de Pan (Breadcrumb) adaptadas de tu componente -->
        {{-- <div class="mb-8 w-full flex justify-center text-xs md:text-sm">
            <x-breadcrumb :items="[
                ['label' => 'Inicio', 'url' => '/'],
                ['label' => 'Servicios al Ciudadano', 'url' => null],
                ['label' => 'Trámites', 'url' => null]
            ]" />
        </div> --}}

        <!-- Título Principal Institucional -->
        <h1 class="text-[#0a3118] font-bold text-3xl md:text-5xl tracking-tight mb-4">
            Trámites y Servicios al Ciudadano
        </h1>

        <!-- Descripción / Bajada Informativa -->
        <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-2xl mx-auto font-light mb-8">
            Facilitamos tu acceso a la gestión pública departamental. Encuentra guías detalladas y realiza tus trámites de forma segura y eficiente.
        </p>

        <!-- Barra de Búsqueda Integrada con Sombra Suave -->
        <form action="/buscar" method="GET" class="w-full max-w-3xl bg-white rounded-xl shadow-md border border-gray-100 p-2 flex items-center gap-2 mb-6">
            <div class="pl-3 text-gray-400">
                <!-- Icono de Lupa (Search) -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <!-- Input text de búsqueda -->
            <input type="text" name="q"
                   placeholder="¿Qué trámite estás buscando hoy?"
                   class="w-full py-2 px-1 text-gray-700 text-sm md:text-base focus:outline-none placeholder-gray-400 bg-transparent">

            <!-- Botón Buscar Institucional -->
            <button type="submit" class="bg-[#0a3118] hover:bg-[#06200f] text-white font-semibold text-sm md:text-base px-6 py-2.5 rounded-lg transition-colors duration-200 shadow-sm">
                Buscar
            </button>
        </form>

        <!-- Trámites Frecuentes (Etiquetas Estilo Píldora) -->
        <div class="flex flex-wrap items-center justify-center gap-2 md:gap-3 text-xs md:text-sm">
            <span class="text-gray-500 font-medium mr-1">Frecuentes:</span>

            <a href="#" class="bg-gray-100 text-[#0a3118] hover:bg-gray-200 transition-colors duration-150 px-3.5 py-1.5 rounded-full font-medium">
                Personería Jurídica
            </a>

            <a href="#" class="bg-gray-100 text-[#0a3118] hover:bg-gray-200 transition-colors duration-150 px-3.5 py-1.5 rounded-full font-medium">
                Licencia Ambiental
            </a>

            <a href="#" class="bg-gray-100 text-[#0a3118] hover:bg-gray-200 transition-colors duration-150 px-3.5 py-1.5 rounded-full font-medium">
                Tasas Forestales
            </a>
        </div>

    </div>
</section>

<!-- Sección: Categorías de Servicios -->
<section id="categorias-servicios" class="bg-white pb-25 px-4 md:px-12 lg:px-24 block clear-both w-full">
    <div class="max-w-7xl mx-auto w-full block">

        <!-- Título de la Sección con Línea Divisoria -->
        <div class="flex items-center gap-4 mb-10 w-full">
            <h2 class="text-[#0a3118] font-bold text-2xl md:text-3xl tracking-tight whitespace-nowrap block text-left">
                Categorías de Servicios
            </h2>
            <div class="grow h-[1px] bg-gray-100"></div>
        </div>

        <!-- Grid Principal Controlado: 2 Columnas idénticas en Escritorio -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full items-stretch">

            <!-- TARJETA 1: Personalidad Jurídica -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 flex flex-col justify-between min-h-[320px] text-left w-full">
                <div class="block w-full">
                    <!-- Icono -->
                    <div class="w-10 h-10 bg-[#DEF7EC] text-[#0a3118] rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <!-- Título -->
                    <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                        Personalidad Jurídica
                    </h3>
                    <!-- Descripción Forzada a Ancho Completo Normal -->
                    <p class="text-gray-500 text-sm leading-relaxed font-light block text-left w-full whitespace-normal">
                        Solicitud, renovación y registro de entes colectivos, organizaciones territoriales y fundaciones dentro del departamento.
                    </p>
                </div>

                <!-- Botones de Acción Horizontales -->
                <div class="flex flex-row flex-wrap gap-3 mt-8 justify-start items-center w-full">
                    <a href="#" class="bg-[#0a3118] hover:bg-[#06200f] text-white text-xs font-semibold px-4 py-2.5 rounded-lg transition-colors duration-200 inline-block">
                        Ver Requisitos
                    </a>
                    <a href="#" class="bg-white text-[#d4ac0d] border border-[#d4ac0d] hover:bg-gray-50 text-xs font-semibold px-4 py-2.5 rounded-lg transition-colors duration-200 inline-block">
                        Iniciar Trámite
                    </a>
                </div>
            </div>

            <!-- TARJETA 2: Licencias Ambientales -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 flex flex-col justify-between min-h-[320px] text-left w-full">
                <div class="block w-full">
                    <div class="w-10 h-10 bg-[#FEF9E7] text-[#B7950B] rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.364l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                        Licencias Ambientales
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-light block text-left w-full whitespace-normal">
                        Categorización, fichas ambientales y monitoreo para proyectos productivos sostenibles.
                    </p>
                </div>

                <div class="flex mt-8 justify-start w-full">
                    <a href="#" class="inline-flex items-center text-[#0a3118] hover:text-[#06200f] font-bold text-sm transition-colors duration-200 group">
                        Explorar
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- TARJETA 3: Tasas Departamentales -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 flex flex-col justify-between min-h-[320px] text-left w-full">
                <div class="block w-full">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                        Tasas Departamentales
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-light block text-left w-full whitespace-normal">
                        Liquidación y consulta de tasas administrativas por servicios agropecuarios y forestales.
                    </p>
                </div>

                <div class="flex mt-8 justify-start w-full">
                    <a href="#" class="inline-flex items-center text-[#0a3118] hover:text-[#06200f] font-bold text-sm transition-colors duration-200 group">
                        Ver Tasas
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- TARJETA 4: Sector Agropecuario (Estructura Dividida en 2 Columnas Internas Flex) -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col md:flex-row min-h-[320px] w-full items-stretch">
                <!-- Contenido Informativo Izquierdo (Ocupa el 60% de espacio) -->
                <div class="p-8 flex flex-col justify-between flex-1 text-left md:w-3/5">
                    <div class="block w-full">
                        <div class="w-10 h-10 bg-[#DEF7EC] text-[#0a3118] rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5A2.5 2.5 0 0019 9.5V8a2 2 0 00-2-2h-1a3 3 0 01-3-3V3.055M11 20a9 9 0 101.993-5.71"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                            Sector Agropecuario
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-light mb-5 block text-left w-full whitespace-normal">
                            Certificaciones de sanidad animal, guías de movimiento de ganado y apoyo técnico para el productor beniano.
                        </p>

                        <!-- Viñetas con Checkmarks Verdes -->
                        <ul class="space-y-2.5 text-xs md:text-sm text-gray-600 font-medium block w-full">
                            <li class="flex items-center gap-2 text-left w-full">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 inline" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="inline-block">Guías de Movimiento</span>
                            </li>
                            <li class="flex items-center gap-2 text-left w-full">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 inline" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="inline-block">Registro de Marcas</span>
                            </li>
                            <li class="flex items-center gap-2 text-left w-full">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 inline" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="inline-block">Certificado de Vacunación</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Imagen Derecha Acoplada (Ocupa el 40% de espacio) -->
                <!-- Nota: Coloca aquí una foto de un paisaje o ganado real en tu carpeta public, p. ej. /img/beni.jpg -->
                {{-- <div class="w-full md:w-2/5 min-h-[180px] md:min-h-full relative bg-gray-100 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&w=600&q=80" alt="Ganadería" class="absolute inset-0 w-full h-full object-cover">
                </div> --}}
            </div>

        </div>
    </div>
</section>

<!-- Sección: Sistemas y Plataformas Digitales -->
<section id="sistemas-digitales" class="bg-white py-10 px-4 md:px-12 lg:px-24 w-full block clear-both">
    <div class="max-w-7xl mx-auto w-full block">

        <div class="flex items-center gap-4 mb-10 w-full">
            <h2 class="text-[#0a3118] font-bold text-2xl md:text-3xl tracking-tight whitespace-nowrap block text-left">
                Sistemas y Plataformas Digitales
            </h2>
            <div class="grow h-[1px] bg-gray-100"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 w-full">

            @php
                $iconMap = [
                    'plus' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7v8m4-4H8m11 9H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z"/></svg>',
                    'document' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>',
                    'eye' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>',
                    'external-link' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>',
                    'globe' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5A2.5 2.5 0 0019 9.5V8a2 2 0 00-2-2h-1a3 3 0 01-3-3V3.055"/></svg>',
                    'calendar' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
                    'beaker' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
                    'clipboard' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 3-3"/></svg>',
                    'cube' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>',
                    'building' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21l-7-5-7 5V5a2 2 0 012-2h10a2 2 0 012 2v16z"/></svg>',
                    'mountain' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3L5 10v11h14V10L12 3z"/></svg>',
                    'cog' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                    'government' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11m16-11v11M8 14v3m4-3v3m4-3v3"/></svg>',
                ];

                $colorPalette = [
                    ['bg' => '#DEF7EC', 'text' => '#0a3118'],
                    ['bg' => '#FEF9E7', 'text' => '#B7950B'],
                    ['bg' => '#DBEAFE', 'text' => '#2563EB'],
                    ['bg' => '#FEE2E2', 'text' => '#DC2626'],
                    ['bg' => '#FEF3C7', 'text' => '#D97706'],
                    ['bg' => '#DBEAFE', 'text' => '#4F46E5'],
                    ['bg' => '#FFEDD5', 'text' => '#EA580C'],
                    ['bg' => '#D1FAE5', 'text' => '#059669'],
                    ['bg' => '#FEF9C3', 'text' => '#CA8A04'],
                    ['bg' => '#CCFBF1', 'text' => '#0D9488'],
                    ['bg' => '#F3E8FF', 'text' => '#9333EA'],
                    ['bg' => '#FCE7F3', 'text' => '#DB2777'],
                    ['bg' => '#F3F4F6', 'text' => '#4B5563'],
                ];
            @endphp

            @forelse($externalSystems as $system)
            @php $c = $colorPalette[$loop->index % count($colorPalette)]; @endphp
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 flex flex-col items-center text-center hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color: {{ $c['bg'] }}; color: {{ $c['text'] }};">
                    {!! $iconMap[$system->icon] ?? $iconMap['external-link'] !!}
                </div>
                <h3 class="text-[#0a3118] font-bold text-sm mb-1">{{ $system->name }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed font-light mb-3">{{ $system->description }}</p>
                @php
                    $isExternal = Str::startsWith($system->url, 'http');
                @endphp
                <a href="{{ $system->url }}" @if($isExternal) target="_blank" @endif class="mt-auto inline-flex items-center gap-1.5 text-[#0a3118] font-semibold text-xs bg-gray-50 hover:bg-gray-100 border border-gray-100 px-3.5 py-2 rounded-lg transition-colors">
                    {{ $isExternal ? 'Acceder' : 'Explorar' }} <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-10 text-gray-500">
                No hay sistemas disponibles por el momento.
            </div>
            @endforelse

        </div>
    </div>
</section>

<!-- Sección: Ventanilla Única Virtual -->
<section id="ventanilla-virtual" class="bg-[#0a3118] text-white py-20 px-6 md:px-12 lg:px-24 w-full block">
    <div class="max-w-7xl mx-auto text-left md:text-center flex flex-col items-center">

        <!-- Encabezado de la Sección -->
        <div class="w-full max-w-3xl text-left md:text-center mb-16">
            <h2 class="text-white font-bold text-3xl md:text-4xl mb-4 tracking-tight">
                Ventanilla Única Virtual
            </h2>
            <p class="text-gray-300 text-sm md:text-base font-light leading-relaxed">
                Estamos digitalizando el Beni. Realiza tus trámites desde la comodidad de tu hogar en tres simples pasos.
            </p>
        </div>

        <!-- Grid de 3 Pasos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 w-full text-left mb-16">

            <!-- Paso 01 -->
            <div class="flex flex-col items-fstart">
                <!-- Número Enmarcado Dorado sutil -->
                <div class="w-14 h-14 border border-[#d4ac0d]/40 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-[#d4ac0d] font-bold text-xl tracking-wider font-mono">01</span>
                </div>
                <h3 class="text-white font-bold text-lg mb-3">
                    Identidad Digital
                </h3>
                <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed">
                    Regístrate en nuestro portal ciudadano con tu C.I. y correo electrónico para validar tu identidad de forma segura.
                </p>
            </div>

            <!-- Paso 02 -->
            <div class="flex flex-col items-start">
                <!-- Número Enmarcado -->
                <div class="w-14 h-14 border border-[#d4ac0d]/40 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-[#d4ac0d] font-bold text-xl tracking-wider font-mono">02</span>
                </div>
                <h3 class="text-white font-bold text-lg mb-3">
                    Carga de Documentos
                </h3>
                <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed">
                    Sube los requisitos escaneados en formato PDF. Nuestro sistema verificará la integridad de los datos automáticamente.
                </p>
            </div>

            <!-- Paso 03 -->
            <div class="flex flex-col items-start">
                <!-- Número Enmarcado -->
                <div class="w-14 h-14 border border-[#d4ac0d]/40 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-[#d4ac0d] font-bold text-xl tracking-wider font-mono">03</span>
                </div>
                <h3 class="text-white font-bold text-lg mb-3">
                    Seguimiento y Firma
                </h3>
                <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed">
                    Sigue el estado de tu trámite en tiempo real y recibe tu certificado digital con firma electrónica certificada.
                </p>
            </div>

        </div>

        <!-- Botón de Acción Centrado -->
        <div class="w-full flex justify-start md:justify-center">
            <a href="#" class="bg-[#e5c158] hover:bg-[#d4ac0d] text-[#0a3118] font-bold text-sm px-6 py-3.5 rounded-xl transition-all duration-200 flex items-center gap-2 shadow-md group">
                Acceder al Portal Virtual
                <!-- Icono de Login / Salida -->
                <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </a>
        </div>

    </div>
</section>


<!-- Sección: Soporte y Ayuda Ciudadana (Blindada) -->
<section id="soporte-ciudadano" class="bg-white py-20 px-4 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <!-- Grid Principal Forzado -->
        <div class="flex flex-col lg:flex-row gap-12 items-start justify-between w-full" style="display: flex; width: 100%;">

            <!-- COLUMNA IZQUIERDA: Texto y Tarjetas (Ocupa el 55% en pantallas grandes) -->
            <div class="w-full lg:w-[55%] flex flex-col justify-start text-left" style="display: flex; flex-direction: column; text-align: left;">

                <!-- Título e Introducción Forzados -->
                <div class="mb-10 block w-full" style="display: block; width: 100%;">
                    <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl mb-4 tracking-tight block" style="display: block; font-weight: 700; color: #0a3118;">
                        ¿Necesitas Ayuda?
                    </h2>
                    <p class="text-gray-500 text-sm md:text-base font-light leading-relaxed block w-full" style="display: block; width: 100%; white-space: normal; text-align: left; color: #6b7280; line-height: 1.625;">
                        Nuestro equipo de atención al ciudadano está listo para orientarte en cada paso de tu gestión.
                    </p>
                </div>

                <!-- Contenedor de Canales Verticales -->
                <div class="space-y-4 w-full block" style="display: block; width: 100%;">

                    <!-- Tarjeta 2: Central Telefónica -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-row items-start gap-4 text-left w-full" style="display: flex; flex-direction: row; align-items: flex-start; text-align: left; width: 100%; background-color: #fff; border-radius: 1rem; border-width: 1px; padding: 1.25rem;">
                        <div class="w-12 h-12 bg-emerald-50 text-[#0a3118] rounded-xl flex items-center justify-center flex-shrink-0" style="flex-shrink: 0; width: 3rem; height: 3rem; background-color: #ecfdf5; border-radius: 0.75rem; display: flex; align-items: center; justify-center: center;">
                            <svg class="w-6 h-6 text-[#0a3118]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.5rem; height: 1.5rem; color: #0a3118;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div style="flex: 1 1 0%; min-width: 0; display: block; text-align: left;">
                            <h3 class="text-[#0a3118] font-bold text-base mb-1 block" style="display: block; font-weight: 700; color: #0a3118;">Central Telefónica</h3>
                            <p class="text-gray-500 text-sm font-light block" style="display: block; color: #6b7280; white-space: normal; margin-bottom: 0.25rem;">
                                Llamada gratuita nacional: <span style="font-weight: 600; color: #374151;">800-10-BENI (2364)</span>
                            </p>
                            <p class="text-gray-500 text-sm font-light block" style="display: block; color: #6b7280; white-space: normal;">
                                Internacional: <span style="font-weight: 600; color: #374151;">+591 (3) 462-1234</span>
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Oficinas Centrales -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-row items-start gap-4 text-left w-full" style="display: flex; flex-direction: row; align-items: flex-start; text-align: left; width: 100%; background-color: #fff; border-radius: 1rem; border-width: 1px; padding: 1.25rem;">
                        <div class="w-12 h-12 bg-emerald-50 text-[#0a3118] rounded-xl flex items-center justify-center flex-shrink-0" style="flex-shrink: 0; width: 3rem; height: 3rem; background-color: #ecfdf5; border-radius: 0.75rem; display: flex; align-items: center; justify-center: center;">
                            <svg class="w-6 h-6 text-[#0a3118]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.5rem; height: 1.5rem; color: #0a3118;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div style="flex: 1 1 0%; min-width: 0; display: block; text-align: left;">
                            <h3 class="text-[#0a3118] font-bold text-base mb-1 block" style="display: block; font-weight: 700; color: #0a3118;">Oficinas Centrales</h3>
                            <p class="text-gray-500 text-sm font-light mb-2 block" style="display: block; color: #6b7280; white-space: normal;">Plaza Principal Mcal. José Ballivián, Trinidad, Beni.</p>
                            <a href="#" class="text-[#0a3118] font-bold text-sm inline-flex items-center gap-1" style="display: inline-flex; align-items: center; color: #0a3118; font-weight: 700;">
                                Ver en el Mapa
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 0.875rem; height: 0.875rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- COLUMNA DERECHA: Mapa Google Maps (Ocupa el 40%) -->
            <div class="w-full lg:w-[40%] flex justify-center lg:justify-end flex-shrink-0" style="display: flex; flex-shrink: 0; justify-content: flex-end;">
                <div class="w-full max-w-[380px] rounded-[2.5rem] overflow-hidden shadow-xl h-[400px]" style="width: 100%; max-width: 380px; border-radius: 2.5rem; overflow: hidden; height: 400px;">
                    <iframe
                        src="https://www.google.com/maps?q=Gobernaci%C3%B3n+del+Beni+Plaza+Ballivi%C3%A1n+Trinidad+Bolivia&output=embed&z=17"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
