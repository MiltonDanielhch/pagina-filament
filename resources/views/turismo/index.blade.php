@extends('layouts.main')

@section('title', $title . ' - Gobernación Autónoma del Beni')
@section('meta_description', $description)

@section('content')
<section class="relative w-full h-[550px] md:h-[600px] flex items-center justify-center overflow-hidden">
    <img src="{{ asset('images/llanos.png') }}"
         alt="Amazonia Beniana"
         class="absolute inset-0 w-full h-full object-cover object-center z-0">
    <div class="absolute inset-0 bg-gradient-to-b from-[#06200f]/80 via-[#0a3118]/75 to-[#051c0d]/90 z-10"></div>
    <div class="relative z-20 text-center max-w-4xl px-6 mx-auto flex flex-col items-center justify-center">
        <h1 class="text-white font-bold text-3xl md:text-5xl lg:text-6xl tracking-tight mb-4 drop-shadow-md">
            Turismo y Naturaleza
        </h1>
        <p class="text-white/90 text-sm md:text-lg leading-relaxed max-w-2xl mx-auto drop-shadow-sm font-light">
            Descubra el santuario ecológico más vibrante de Bolivia. Desde los enigmáticos Llanos de Moxos hasta nuestros parques nacionales.
        </p>
    </div>
</section>

@if($biodiversidad->count() > 0)
<section class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <div class="lg:col-span-5 flex flex-col justify-center">
                <span class="w-max bg-[#DEF7EC] text-[#0a3118] text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4">
                    Biodiversidad
                </span>
                <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight mb-4">
                    Nuestra Amazonia
                </h2>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-6">
                    El Beni es un ecosistema único donde la llanura se encuentra con la selva. Nuestros ríos —Mamoré, Beni e Iténez— no solo son vías de transporte, sino el torrente vital de una de las mayores reservas de agua dulce del mundo.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($biodiversidad as $item)
                    <div class="bg-gray-50/80 p-4 rounded-xl border border-gray-100 flex flex-col gap-1.5">
                        <h4 class="text-[#0a3118] font-bold text-sm">{{ $item->title }}</h4>
                        <p class="text-gray-500 text-xs">{{ $item->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="lg:col-span-7 relative group rounded-2xl overflow-hidden shadow-sm h-[320px] md:h-[420px] w-full mt-6 lg:mt-0">
                @if($biodiversidad->first() && $biodiversidad->first()->getFirstMediaUrl('images'))
                <img src="{{ $biodiversidad->first()->getFirstMediaUrl('images') }}" alt="{{ $biodiversidad->first()->title }}" class="w-full h-full object-cover transform group-hover:scale-[1.02] transition-transform duration-500">
                @else
                <img src="{{ asset('images/rios.png') }}" alt="Ríos del Beni" class="w-full h-full object-cover transform group-hover:scale-[1.02] transition-transform duration-500">
                @endif
                <div class="absolute bottom-6 left-6 z-10">
                    <button class="bg-white text-[#0a3118] font-bold text-xs md:text-sm px-5 py-3 rounded-xl shadow-lg hover:bg-gray-50 transition-all duration-200">
                        Explora nuestras regiones hídricas
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($cultura->count() > 0)
<section class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight mb-3">Cultura y Tradición</h2>
            <p class="text-gray-600 text-sm md:text-base font-light">La identidad beniana se forja entre la fe de sus misiones y el sabor de su tierra.</p>
        </div>

        @php
            $count = $cultura->count();
            $firstTwo = $cultura->take(2);
            $lastItems = $cultura->slice(2);
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($cultura as $index => $item)
                @php
                    $isLarge = $index === 0 || $index === $count - 1;
                    $colSpan = $isLarge ? 'md:col-span-2' : 'md:col-span-1';
                    $height = $isLarge ? 'h-[260px]' : 'h-[280px]';
                @endphp
                <div class="{{ $colSpan }} relative group {{ $height }} rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                    @if($item->getFirstMediaUrl('images'))
                    <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $item->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                    @else
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-br from-[#0a3118] via-[#0d4d24] to-[#06200f]"></div>
                    <div class="absolute inset-0 bg-[#0a3118]/20"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-10">
                        <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" stroke-width="0.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                    @endif

                    {{-- Cambios críticos aquí: w-full y asignación correcta del flujo de textos --}}
                    <div class="absolute inset-0 p-6 flex flex-col justify-end text-left w-full box-border z-20">
                        <h3 class="text-white font-bold text-xl md:text-2xl mb-2 drop-shadow-sm w-full block clear-both">
                            {{ $item->title }}
                        </h3>
                        <p class="text-white/85 text-xs md:text-sm font-light max-w-full w-full block normal-case whitespace-normal break-words leading-relaxed">
                            {{ $item->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($santuarios->count() > 0)
<section class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10 gap-4 w-full" style="width: 100%; min-width: 100%;">
            <div class="text-left block" style="display: block; flex-grow: 1; max-w: 42rem; width: 100%; box-sizing: border-box;">
                <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight mb-2 block" style="display: block; width: 100%;">Santuarios Naturales</h2>
                <p class="text-gray-600 text-sm md:text-base font-light block" style="display: block; width: 100%; white-space: normal !important; line-height: 1.5; overflow-wrap: break-word;">Protegemos el futuro resguardando el presente. Conoce nuestras áreas de preservación crítica.</p>
            </div>
            <div class="block whitespace-nowrap" style="flex-shrink: 0;">
                <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm transition-colors duration-200 group">
                    Ver mapa de áreas protegidas
                    <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($santuarios as $item)
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                <div class="h-[200px] w-full overflow-hidden">
                    @if($item->getFirstMediaUrl('images'))
                    <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-emerald-700 to-teal-800 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="p-6 flex flex-col flex-grow text-left">
                    <h3 class="text-[#0a3118] font-bold text-xl mb-2">{{ $item->title }}</h3>
                    <p class="text-gray-600 text-xs md:text-sm font-light leading-relaxed mb-4 flex-grow">{!! nl2br(e($item->description)) !!}</p>
                    @if($item->location_name)
                    <div class="mt-auto">
                        <span class="inline-flex items-center gap-1.5 bg-[#FEF9E7] text-[#B7950B] text-[11px] font-semibold px-3 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            {{ $item->location_name }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($galeria->count() > 0)
<section class="bg-[#0a3118] py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">
        <div class="text-left mb-10">
            <h2 class="text-white font-bold text-3xl md:text-4xl tracking-tight mb-2">Ventanas al Paraíso</h2>
            <p class="text-white/80 text-sm md:text-base font-light">La luz del Beni capturada en instantes eternos.</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach($galeria as $item)
            <div class="aspect-square w-full rounded-xl overflow-hidden shadow-sm group relative cursor-pointer">
                @if($item->getFirstMediaUrl('images'))
                <img src="{{ $item->getFirstMediaUrl('images') }}" alt="{{ $item->title }}" class="w-full h-full object-cover transform group-hover:scale-[1.04] transition-transform duration-500">
                @else
                <div class="w-full h-full bg-[#0a3118]/50 flex items-center justify-center">
                    <span class="text-white/20 text-3xl">🖼️</span>
                </div>
                @endif
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-colors duration-300"></div>
                <div class="absolute inset-0 flex items-end p-3 md:p-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white text-xs md:text-sm font-semibold drop-shadow-lg bg-black/40 px-2 py-1 rounded">{{ $item->title }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="bg-gray-50/50 py-20 px-6 md:px-12">
    <div class="max-w-4xl mx-auto text-center flex flex-col items-center justify-center">
        <h2 class="text-[#0a3118] font-bold text-2xl md:text-3.5xl lg:text-4xl tracking-tight mb-4">
            ¿Listo para vivir la experiencia beniana?
        </h2>
        <p class="text-gray-600 text-sm md:text-base italic font-light tracking-wide mb-8 max-w-2xl">
            "Cuna de libertad y de progreso, selva de encanto y de hermosura."
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">
            <a href="#"
               class="w-full sm:w-auto inline-flex items-center justify-center bg-[#0a3118] text-white text-sm font-bold px-8 py-3.5 rounded-lg shadow-sm hover:bg-[#06200f] transition-all duration-200 tracking-wide text-center">
                Guía de Turismo PDF
            </a>
            <a href="#"
               class="w-full sm:w-auto inline-flex items-center justify-center bg-white text-[#d4ac0d] border border-[#d4ac0d] text-sm font-semibold px-8 py-3.5 rounded-lg hover:bg-gray-50 transition-all duration-200 tracking-wide text-center">
                Contactar Operadores
            </a>
        </div>
    </div>
</section>

<!-- SECCIÓN: Ubicación Geográfica -->
<section id="ubicacion-geografica" class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">

        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-flex items-center gap-2 text-[12px] font-semibold uppercase tracking-widest text-[#B7950B] mb-3">
                <span class="block w-5 h-0.5 bg-[#fcd400] rounded"></span>
                Ubicación geográfica
                <span class="block w-5 h-0.5 bg-[#fcd400] rounded"></span>
            </span>
            <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight mb-3">
                Sede de la Gobernación
            </h2>
            <p class="text-gray-600 text-sm md:text-base font-light">
                La Gobernación del Beni tiene su sede en la ciudad de Trinidad, corazón político y administrativo del departamento.
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-stretch">

            <div class="lg:col-span-7 rounded-2xl overflow-hidden shadow-sm h-[400px] md:h-[500px]">
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

            <div class="lg:col-span-5 flex flex-col gap-4 justify-center">

                <div class="bg-gray-50/80 rounded-2xl border border-gray-100 p-6 flex flex-col gap-1.5">
                    <span class="text-[#0a3118] font-bold text-xs uppercase tracking-wider">Dirección</span>
                    <p class="text-gray-700 text-sm">Plaza José Ballivián, acera sur<br>Santísima Trinidad, Beni - Bolivia</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50/80 rounded-2xl border border-gray-100 p-5 flex flex-col gap-1">
                        <span class="text-[#0a3118] text-2xl font-bold">213.564</span>
                        <span class="text-gray-500 text-xs">km² de extensión</span>
                    </div>
                    <div class="bg-gray-50/80 rounded-2xl border border-gray-100 p-5 flex flex-col gap-1">
                        <span class="text-[#0a3118] text-2xl font-bold">8</span>
                        <span class="text-gray-500 text-xs">provincias</span>
                    </div>
                    <div class="bg-gray-50/80 rounded-2xl border border-gray-100 p-5 flex flex-col gap-1">
                        <span class="text-[#0a3118] text-2xl font-bold">19</span>
                        <span class="text-gray-500 text-xs">municipios</span>
                    </div>
                    <div class="bg-gray-50/80 rounded-2xl border border-gray-100 p-5 flex flex-col gap-1">
                        <span class="text-[#0a3118] text-2xl font-bold">~500k</span>
                        <span class="text-gray-500 text-xs">habitantes</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@include('departamento._invertir')

@include('departamento._apoyo-tecnico')
@endsection
