{{--
    Homepage rediseñado — 18 bloques según Sección C (doc 14 RM 067/2025)
    Cumple WCAG 2.1 AA, responsive, mobile-first.
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Portal oficial de la Gobernación Autónoma Departamental del Beni. Trámites, transparencia, noticias, proyectos de inversión y atención al ciudadano del departamento del Beni, Bolivia.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Gobernación Autónoma Departamental del Beni">
    <meta property="og:description" content="Comprometidos con el desarrollo integral del Beni. Trámites, transparencia y atención al ciudadano.">
@endsection

@section('content')

{{-- =====================================================
     BLOQUE 1+2: Header / Navbar — manejados por layout
     BLOQUE 3: Hero Slider Institucional — Dos paneles
     ===================================================== --}}
<section class="relative bg-[#004900] overflow-hidden" id="hero-slider" aria-label="Slider institucional">
    {{-- Background texture & gradient --}}
    <div class="absolute inset-0 bg-nature-pattern opacity-20"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#004900]/70 via-[#006400]/40 to-[#004900]/80"></div>

    <div class="container mx-auto px-4 relative z-10 py-6 md:py-0 md:h-[520px] lg:h-[560px]">
        <div class="flex flex-col md:flex-row md:h-full gap-4 md:gap-8 xl:gap-10 md:items-stretch">

            {{-- ========== MOBILE BANNER: Gobernador compacto (visible solo < md) ========== --}}
            <div class="flex md:hidden flex-col items-center text-center gap-2 mb-2">
                <div class="inline-flex items-center gap-1.5 bg-[#fcd400] text-[#544600] px-3 py-1 rounded-sm text-[11px] font-semibold uppercase tracking-[0.05em] shadow-sm">
                    <svg class="w-3.5 h-3.5 text-[#705d00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>
                    Gestión del Gobernador
                </div>
                <p class="text-white font-bold text-base leading-tight">BENI PRODUCTIVO, SOSTENIBLE Y REGULABLE</p>
            </div>

            {{-- ========== LEFT PANEL: Gobernador (md+) ========== --}}
            <div class="hidden md:flex w-[320px] xl:w-[360px] flex-shrink-0 flex-col gap-3 py-8 h-full">
                <div class="inline-flex items-center gap-1.5 bg-[#fcd400] text-[#544600] px-3 py-1 rounded-sm text-[11px] font-semibold uppercase tracking-[0.05em] self-start shadow-sm">
                    <svg class="w-3.5 h-3.5 text-[#705d00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>
                    Gestión del Gobernador
                </div>

                @php
                    $gov = $gobernador->first() ?? null;
                    $govBg = $gov && $gov->getFirstMediaUrl('officials') ? $gov->getFirstMediaUrl('officials') : null;
                @endphp
                <div class="relative flex-1 rounded-lg overflow-hidden card-ambient min-h-[200px] gov-card-bg"
                     style="background-image: url('{{ $govBg ?? asset('images/gobe.jpg') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#004900]/95 via-[#004900]/55 to-[#004900]/35 z-0"></div>
                    <div class="relative z-10 h-full flex flex-col items-center justify-end pb-5 px-4">
                        @if($gov)
                        <div class="flex-1 flex items-center justify-center w-full -mb-2">
                            <div class="relative w-full flex justify-center">
                                @if($gov->getFirstMediaUrl('officials'))
                                <img src="{{ $gov->getFirstMediaUrl('officials') }}"
                                     alt="{{ $gov->name }}"
                                     class="h-[220px] w-auto object-contain drop-shadow-xl">
                                @else
                                <div class="w-[140px] h-[180px] rounded flex items-center justify-center bg-[#006400]/60 text-white text-5xl font-bold">
                                    {{ strtoupper(mb_substr($gov->name, 0, 1)) }}
                                </div>
                                @endif
                                <div class="gov-band bottom-[60px]">Gobernador</div>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-white font-bold text-sm leading-tight">{{ $gov->name }}</p>
                            <p class="text-[#fcd400] text-[11px] font-semibold mt-0.5">{{ $gov->position ?? 'Gobernador Departamental' }}</p>
                        </div>
                        @else
                        <div class="flex-1 flex items-center justify-center">
                            <div class="text-center text-white/70">
                                <svg class="w-16 h-16 mx-auto mb-2 opacity-40" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                                <p class="text-xs">Autoridad</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="text-white text-[22px] xl:text-[26px] font-bold leading-[28px] xl:leading-[32px] tracking-tight">
                    BENI PRODUCTIVO,<br>
                    <span class="text-[#fcd400]">SOSTENIBLE Y REGULABLE</span>
                </div>
            </div>

            {{-- ========== RIGHT PANEL: Carrusel de proyectos/obras ========== --}}
            <div class="flex-1 min-w-0 relative flex flex-col justify-center md:py-8">
                @if($slides->count() > 0)
                <div class="relative">
                    @foreach($slides as $index => $slide)
                    @php
                        $slideImg = $slide->getFirstMediaUrl('slides') ?: $slide->image;
                    @endphp
                    <div class="hero-card-slide {{ $index === 0 ? 'active' : 'hidden' }}"
                         data-slide-card="{{ $index }}">
                        <div class="relative rounded-lg overflow-hidden card-ambient card-inset bg-[#005300]">
                            <div class="aspect-[4/3] sm:aspect-[16/9] md:aspect-[21/9] lg:aspect-[5/3] relative">
                                @if($slideImg)
                                <img src="{{ $slideImg }}"
                                     alt="{{ $slide->title }}"
                                     class="w-full h-full object-cover"
                                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                                {{-- Mobile: gradient bottom-to-top fuerte para legibilidad --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 via-40% to-transparent md:bg-gradient-to-r md:from-black/60 md:via-black/30 md:to-transparent"></div>
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-[#005300] to-[#004900]"></div>
                                @endif

                                <div class="absolute inset-0 flex flex-col justify-end p-4 md:p-7 lg:p-8">
                                    <div>
                                        <span class="inline-block bg-[#fcd400]/90 text-[#544600] text-[11px] font-semibold uppercase tracking-[0.05em] px-2.5 py-1 rounded-sm mb-1.5 md:mb-2">
                                            {{ $slide->subtitle ?? 'Proyecto Estratégico' }}
                                        </span>
                                    </div>
                                    <h2 class="text-white font-bold text-[18px] sm:text-xl md:text-[26px] lg:text-[28px] leading-[24px] sm:leading-[28px] md:leading-[34px] lg:leading-[36px] max-w-lg drop-shadow-lg">
                                        {{ $slide->title ?: 'Gobernación del Beni' }}
                                    </h2>
                                    @if($slide->description)
                                    <p class="text-white/80 text-[13px] md:text-[15px] leading-[18px] md:leading-[22px] mt-1 md:mt-1.5 max-w-md line-clamp-2">
                                        {{ $slide->description }}
                                    </p>
                                    @endif
                                    @if($slide->link)
                                    <div class="mt-2 md:mt-3">
                                        <a href="{{ $slide->link }}"
                                           class="inline-flex items-center gap-1.5 bg-[#004900] hover:bg-[#005300] text-white text-[12px] md:text-[13px] font-semibold px-3 py-1.5 md:px-4 md:py-2 rounded transition shadow-md group">
                                            Ver proyecto
                                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{-- Flechas de navegación --}}
                    @if($slides->count() > 1)
                    <button class="slider-arrow slider-arrow-left" id="prev-slide" aria-label="Anterior">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="slider-arrow slider-arrow-right" id="next-slide" aria-label="Siguiente">
                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    @endif
                </div>

                {{-- Indicadores de carrusel --}}
                @if($slides->count() > 1)
                <div class="flex items-center justify-center gap-2 mt-3 md:mt-4" role="tablist">
                    @foreach($slides as $index => $slide)
                    <button data-slide-btn="{{ $index }}"
                            class="carousel-dot {{ $index === 0 ? 'active' : '' }}"
                            aria-label="Slide {{ $index + 1 }}"
                            role="tab"
                            aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                    </button>
                    @endforeach
                </div>
                @endif

                @else
                <div class="flex items-center justify-center h-full py-12 md:py-0">
                    <div class="text-white/60 text-center">
                        <svg class="w-16 h-16 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm font-medium">Contenido próximamente</p>
                        <p class="text-xs mt-1 opacity-60">Proyectos y obras del departamento</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- =====================================================
     BLOQUE 4: Banda de Búsqueda
     ===================================================== --}}
{{-- <x-search-band /> --}}

{{-- =====================================================
     BLOQUE 5: Trámites Destacados
     ===================================================== --}}
<!-- @if(isset($featuredProcedures) && $featuredProcedures->count() > 0)
<section class="py-16 bg-cream" aria-label="Trámites destacados">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10 reveal">
            <div>
                <p class="section-label">Servicios al ciudadano</p>
                <h2 class="section-title text-3xl md:text-4xl font-bold text-gray-900">Trámites Destacados</h2>
                <p class="text-gray-500 mt-3 text-sm">Los trámites más consultados por la ciudadanía</p>
            </div>
            <a href="{{ route('procedures.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-teal-700 hover:text-teal-800 border border-teal-200 hover:border-teal-400 px-4 py-2 rounded-lg transition">
                Ver todos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($featuredProcedures as $procedure)
            <div class="reveal reveal-d{{ ($loop->index % 4) + 1 }}">
                <x-procedure-card :procedure="$procedure" />
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif -->

{{-- =====================================================
     BLOQUE 7: Últimas Noticias
     ===================================================== --}}
@if(isset($latestPosts) && $latestPosts->count() > 0)
<section class="py-10 bg-white" aria-label="Últimas noticias">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10 reveal">
            <div>
                <p class="section-label">Sala de prensa</p>
                <h2 class="section-title text-[24px] md:text-[32px] font-semibold text-gray-900 leading-[32px] md:leading-[40px]">Últimas Noticias</h2>
            </div>
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#004900] hover:text-[#005300] border border-[#e1e3e4] hover:border-[#004900] px-4 py-2 rounded transition">
                Ver todas
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestPosts as $post)
            <article class="card-lift bg-white rounded-lg overflow-hidden border border-gray-100 shadow-sm flex flex-col reveal reveal-d{{ $loop->index + 1 }}">
                <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden">
                    @if(method_exists($post, 'getFirstMedia') && $post->getFirstMedia('featured'))
                    <img src="{{ $post->getFirstMedia('featured')->getUrl('medium') }}" alt="{{ $post->title }}" class="w-full h-48 object-cover transition-transform duration-500 hover:scale-105" loading="lazy">
                    @else
                    @php
                        $placeholderColors = [
                            ['from-teal-600','to-teal-800'],
                            ['from-emerald-600','to-teal-700'],
                            ['from-cyan-600','to-teal-700'],
                        ];
                        $pc = $placeholderColors[$loop->index % count($placeholderColors)];
                    @endphp
                    <div class="w-full h-48 bg-gradient-to-br {{ $pc[0] }} {{ $pc[1] }} flex flex-col items-center justify-center gap-2 relative">
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 20% 80%, white 1px, transparent 1px), radial-gradient(circle at 80% 20%, white 1px, transparent 1px); background-size: 30px 30px;"></div>
                        <svg class="w-10 h-10 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span class="text-white/50 text-xs font-medium uppercase tracking-wider">Noticia oficial</span>
                    </div>
                    @endif
                </a>
                <div class="p-5 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-3 text-xs">
                        @if($post->category)
                        <span class="bg-[#f3f4f5] text-[#004900] border border-[#e1e3e4] px-2 py-0.5 rounded-full font-semibold">{{ $post->category->name }}</span>
                        @endif
                        <span class="text-gray-400 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ optional($post->published_at)->format('d/m/Y') }}
                        </span>
                    </div>
                    <h3 class="text-[16px] font-semibold mb-2 line-clamp-2 leading-[24px] flex-1">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-[#004900] transition text-gray-900">
                            {{ $post->title }}
                        </a>
                    </h3>
                    @if($post->excerpt)
                    <p class="text-[14px] text-gray-500 line-clamp-2 mb-4 leading-[20px]">{{ $post->excerpt }}</p>
                    @endif
                    <a href="{{ route('posts.show', $post->slug) }}" class="mt-auto inline-flex items-center gap-1 text-[#004900] hover:text-[#005300] font-semibold text-[14px] group">
                        Leer más
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Wave: noticias (white) → stats (forest) --}}
<div class="leading-none -mb-px overflow-hidden" aria-hidden="true">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" class="w-full h-14 block">
        <path d="M0,0 C480,70 960,70 1440,0 L1440,70 L0,70 Z" fill="#004900"/>
    </svg>
</div>

{{-- =====================================================
     BLOQUE 8: Transparencia en Cifras
     ===================================================== --}}
<!-- @if(isset($stats))
<section class="py-16 bg-gradient-to-br from-[#1b4332] via-[#2d6a4f] to-[#1b4332] text-white bg-nature-pattern" aria-label="Transparencia en cifras">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-300 mb-3">
                <span class="block w-5 h-0.5 bg-amber-400 rounded"></span>
                Transparencia activa
                <span class="block w-5 h-0.5 bg-amber-400 rounded"></span>
            </p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">El Beni en Cifras</h2>
            <p class="text-gray-700 mt-2 max-w-2xl mx-auto text-sm">Datos abiertos y actualizados del Gobierno Autónomo Departamental</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            {{-- <div class="reveal reveal-d1"><x-stat-counter :value="$stats['tramites'] ?? 0" label="Trámites disponibles" icon="document" color="teal" :url="route('procedures.index')" /></div> --}}
            <div class="reveal reveal-d2"><x-stat-counter :value="$stats['secretarias'] ?? 0" label="Secretarías" icon="building" color="emerald" :url="route('institutional.secretariats')" /></div>
            <div class="reveal reveal-d3"><x-stat-counter :value="$stats['oficinas'] ?? 0" label="Oficinas de atención" icon="map" color="amber" :url="route('offices')" /></div>
            <div class="reveal reveal-d4"><x-stat-counter :value="$stats['municipios'] ?? 0" label="Municipios" icon="map" color="blue" /></div>
            <div class="reveal reveal-d5"><x-stat-counter :value="$stats['normas'] ?? 0" label="Normas publicadas" icon="document" color="purple" :url="route('transparency.marco-normativo')" /></div>
            {{-- <div class="reveal reveal-d6"><x-stat-counter :value="$stats['datasets'] ?? 0" label="Datasets abiertos" icon="database" color="red" :url="route('open-data.index')" /></div> --}}
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('transparency.index') }}" class="inline-flex items-center gap-2 bg-[#d4a017] hover:bg-[#b47d14] text-white font-bold px-6 py-3 rounded-lg transition shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Acceder al Portal de Transparencia
            </a>
        </div>
    </div>
</section>
@endif -->

{{-- =====================================================
     BLOQUE 15: Gabinete / Autoridades
     ===================================================== --}}
@if(isset($gabinete) && $gabinete->count() > 0)
<section class="py-10 bg-white" aria-label="Gabinete departamental">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="inline-flex items-center justify-center gap-2 section-label mx-auto">
                <span class="block w-5 h-0.5 bg-[#004900] rounded -mb-0.5"></span>
                Liderazgo
                <span class="block w-5 h-0.5 bg-[#004900] rounded -mb-0.5"></span>
            </p>
            <h2 class="section-title section-title-center text-[24px] md:text-[32px] font-semibold text-gray-900 mx-auto mt-2 leading-[32px] md:leading-[40px]">Gabinete Departamental</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($gabinete as $person)
            <div class="text-center">
                @if($person->getFirstMediaUrl('officials'))
                <img src="{{ $person->getFirstMediaUrl('officials') }}" alt="{{ $person->name }}"
                     class="aspect-square w-full max-w-[160px] mx-auto rounded-lg object-cover shadow-md mb-3 ring-2 ring-[#705d00]/30">
                @else
                <div class="aspect-square w-full max-w-[160px] mx-auto bg-gradient-to-br from-[#004900] to-[#006400] rounded-lg flex items-center justify-center text-white text-4xl font-bold shadow-md mb-3 ring-2 ring-[#705d00]/30">
                    {{ strtoupper(mb_substr($person->name, 0, 1)) }}
                </div>
                @endif
                <h3 class="text-[14px] font-semibold text-gray-900 line-clamp-2 leading-[20px]">{{ $person->name }}</h3>
                <p class="text-[12px] text-[#004900] font-semibold mt-1 line-clamp-1 leading-[16px]">{{ $person->position ?? 'Autoridad' }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('institutional.organigrama') }}" class="text-[#004900] font-semibold hover:text-[#005300] inline-flex items-center gap-1">
                Ver organigrama completo →
            </a>
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 16: Mapa del Beni (Google Maps)
     ===================================================== --}}
<section class="py-10 bg-white" aria-label="Mapa del departamento del Beni">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="inline-flex items-center justify-center gap-2 text-[12px] font-semibold uppercase tracking-widest text-[#705d00] mb-3 leading-[20px]">
                <span class="block w-5 h-0.5 bg-[#fcd400] rounded"></span>
                Ubicación geográfica
                <span class="block w-5 h-0.5 bg-[#fcd400] rounded"></span>
            </p>
            <h2 class="section-title section-title-center text-[24px] md:text-[32px] font-semibold text-gray-900 mx-auto mt-2 leading-[32px] md:leading-[40px]">Departamento del Beni</h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto text-[14px] leading-[20px]">El Beni es el departamento más grande de Bolivia, ubicado en la región amazónica, con una extensión de 213.564 km² y rica biodiversidad.</p>
        </div>
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-8 items-stretch">
                <!-- Columna izquierda: Mapa -->
                <div class="rounded-lg overflow-hidden shadow-2xl h-full">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3181533!2d-66.5!3d-14.5!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91e3d0d0d0d0d0d%3A0x0!2sBeni+Department%2C+Bolivia!5e0!3m2!1ses!2sbo&4v1717497600&z=6"
                        width="100%"
                        height="100%"
                        style="border:0; min-height: 500px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <!-- Columna derecha: Foto y dirección -->
                <div class="flex flex-col h-full">
                    <div class="rounded-lg overflow-hidden shadow-2xl mb-4">
                        <img src="{{ asset('images/gobe.jpg') }}" alt="Gobernación del Beni" class="w-full h-64 object-cover">
                    </div>
                    <div class="bg-gradient-to-br from-[#004900] to-[#006400] rounded-lg p-5 text-white flex-1 flex flex-col justify-center text-center">
                        <h3 class="text-[18px] font-semibold mb-2 flex items-center justify-center gap-2 leading-[28px]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            Nuestra Dirección
                        </h3>
                        <p class="text-gray-200 mb-4 text-[14px] leading-[20px]">Plaza José Ballivian acera sur<br>Santísima Trinidad - Beni</p>
                        <div class="grid grid-cols-4 gap-3">
                            <div class="text-center">
                                <div class="text-[18px] font-semibold text-[#fcd400] leading-[28px]">213.564</div>
                                <div class="text-[12px] text-gray-300 leading-[16px]">km²</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[18px] font-semibold text-[#fcd400] leading-[28px]">8</div>
                                <div class="text-[12px] text-gray-300 leading-[16px]">provincias</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[18px] font-semibold text-[#fcd400] leading-[28px]">19</div>
                                <div class="text-[12px] text-gray-300 leading-[16px]">municipios</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[18px] font-semibold text-[#fcd400] leading-[28px]">~500K</div>
                                <div class="text-[12px] text-gray-300 leading-[16px]">habitantes</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Wave: newsletter (gold) → footer (forest dark) --}}
<div class="leading-none -mt-px overflow-hidden" aria-hidden="true">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" class="w-full h-12 block">
        <path d="M0,0 C720,60 720,60 1440,0 L1440,60 L0,60 Z" fill="#0d2418"/>
    </svg>
</div>

{{-- =====================================================
     BLOQUE 20: Footer — manejado por layout
     ===================================================== --}}

@endsection

@section('scripts')
<script>
    // =============================================
    // SCROLL REVEAL — Intersection Observer
    // =============================================
    document.addEventListener('DOMContentLoaded', function () {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Also trigger section-title accent animation
                    const title = entry.target.querySelector('.section-title');
                    if (title) title.classList.add('visible-title');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));
    });

    // =============================================
    // PARALLAX — hero card image subtle effect
    // =============================================
    (function() {
        const heroSlider = document.getElementById('hero-slider');
        if (!heroSlider || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY;
            if (scrolled < 700) {
                const imgs = heroSlider.querySelectorAll('[data-slide-card] img');
                imgs.forEach(img => {
                    img.style.transform = `translateY(${scrolled * 0.2}px)`;
                });
            }
        }, { passive: true });
    })();

    // Animación de contadores (count-up) al entrar en viewport
    document.addEventListener('DOMContentLoaded', function () {
        const counters = document.querySelectorAll('.counter');
        if (!counters.length || !('IntersectionObserver' in window)) return;

        const animate = (el) => {
            const target = parseInt(el.dataset.target, 10) || 0;
            const duration = 1500;
            const startTime = performance.now();
            const startValue = 0;

            const step = (now) => {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
                const current = Math.floor(startValue + (target - startValue) * eased);
                el.textContent = current.toLocaleString('es-BO');
                if (progress < 1) requestAnimationFrame(step);
                else el.textContent = target.toLocaleString('es-BO');
            };
            requestAnimationFrame(step);
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && !entry.target.dataset.animated) {
                    entry.target.dataset.animated = '1';
                    animate(entry.target);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach((c) => observer.observe(c));
    });

    // Hero slider — carrusel de tarjetas (panel derecho)
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('hero-slider');
        if (!slider) return;
        const cards = slider.querySelectorAll('[data-slide-card]');
        const btns = slider.querySelectorAll('[data-slide-btn]');
        const prevBtn = slider.querySelector('#prev-slide');
        const nextBtn = slider.querySelector('#next-slide');
        if (cards.length <= 1) return;

        let current = 0;
        let autoplayTimer;

        const show = (i) => {
            cards.forEach((c, idx) => {
                if (idx === i) {
                    c.classList.remove('hidden', 'active');
                    c.classList.add('active');
                    requestAnimationFrame(() => c.classList.remove('entering'));
                } else {
                    c.classList.add('hidden');
                    c.classList.remove('active');
                }
            });
            btns.forEach((b, idx) => {
                b.classList.toggle('active', idx === i);
                b.setAttribute('aria-selected', idx === i ? 'true' : 'false');
            });
            current = i;
        };

        const next = () => show((current + 1) % cards.length);
        const prev = () => show((current - 1 + cards.length) % cards.length);

        const resetAutoplay = () => {
            clearInterval(autoplayTimer);
            autoplayTimer = setInterval(next, 6000);
        };

        btns.forEach((btn, idx) => btn.addEventListener('click', () => { show(idx); resetAutoplay(); }));
        if (prevBtn) prevBtn.addEventListener('click', () => { prev(); resetAutoplay(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { next(); resetAutoplay(); });

        // Swipe support on mobile (solo en el área del carrusel derecho)
        const rightPanel = slider.querySelector('[data-slide-card]')?.closest('.flex-1') || slider;
        let touchStartX = 0;
        rightPanel.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
        rightPanel.addEventListener('touchend', (e) => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) { diff > 0 ? next() : prev(); resetAutoplay(); }
        }, { passive: true });

        // Autoplay
        autoplayTimer = setInterval(next, 6000);
    });
</script>
@endsection
