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
     BLOQUE 3: Hero Slider
     ===================================================== --}}
@if($slides->count() > 0)
<section class="relative overflow-hidden h-[70vh] min-h-[460px] max-h-[500px] md:h-[65vh] md:max-h-[560px] lg:h-[95vh] lg:max-h-[800px] xl:max-h-[720px]" id="hero-slider" aria-label="Diapositivas principales">
    <div class="absolute inset-0">
        @foreach($slides as $index => $slide)
        <div class="absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
            <picture>
                <source media="(max-width: 768px)" srcset="{{ $slide->getFirstMediaUrl('slides') ?: $slide->image }}?w=800&q=80">
                <source media="(max-width: 1024px)" srcset="{{ $slide->getFirstMediaUrl('slides') ?: $slide->image }}?w=1200&q=85">
                <img src="{{ $slide->getFirstMediaUrl('slides') ?: $slide->image }}" alt="{{ $slide->title }}" class="w-full h-full object-cover object-center" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
            </picture>
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/30 to-transparent"></div>
        </div>
        @endforeach
    </div>

    <div class="absolute inset-0 flex flex-col justify-center items-start px-6 md:px-16 lg:px-24 py-8 md:py-12">
        <div class="relative z-20 block w-full text-left">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-white text-xs md:text-sm px-3 py-1.5 rounded-full border border-white/20 w-max mb-6">
                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                Amazonia Productiva y Soberana
            </div>
            <h1 class="text-white font-bold text-2xl md:text-4xl lg:text-6xl tracking-tight mb-2">
                Beni Productivo:
            </h1>
            <h1 class="text-[#E5B225] font-bold text-2xl md:text-4xl lg:text-6xl tracking-tight mb-6">
                Corazón de la Amazonia
            </h1>
            <p class="text-white/90 text-xs md:text-base lg:text-lg font-normal w-full max-w-[85%] sm:max-w-xl md:max-w-2xl mb-8 leading-relaxed whitespace-normal break-words text-left">
                Trabajamos por un departamento próspero, integrando nuestra riqueza natural con la fuerza de nuestra gente para liderar el desarrollo regional.
            </p>
            <div class="flex flex-row flex-wrap gap-4 mt-6 md:mt-8 items-center">
                <a href="#" class="bg-[#E5B225] hover:bg-[#cda021] text-neutral-950 font-semibold px-6 py-3 rounded-md transition-all duration-200 text-sm md:text-base shadow-lg">
                    Ver Plan de Gestión 2026
                </a>
                <a href="#" class="flex items-center gap-2 border border-white/40 bg-white/5 hover:bg-white/10 text-white font-medium px-6 py-3 rounded-md transition-all duration-200 text-sm md:text-base backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    Video Institucional
                </a>
            </div>
        </div>
    </div>

    @if($slides->count() > 1)
    <button class="slider-arrow slider-arrow-left" id="prev-slide" aria-label="Diapositiva anterior">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button class="slider-arrow slider-arrow-right" id="next-slide" aria-label="Diapositiva siguiente">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex items-center gap-3 z-10">
        <div class="flex gap-2" role="tablist">
            @foreach($slides as $index => $slide)
            <button data-slide-btn="{{ $index }}" class="h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white w-8' : 'bg-white/50 hover:bg-white/70 w-2' }}" aria-label="Slide {{ $index + 1 }}" role="tab" aria-selected="{{ $index === 0 ? 'true' : 'false' }}"></button>
            @endforeach
        </div>
        <span id="slide-counter" class="text-white/70 text-xs font-mono tabular-nums">1 / {{ $slides->count() }}</span>
    </div>
    @endif
</section>
@else
{{-- Estado fallback sin cambios sustanciales de ancho --}}
<section class="relative overflow-hidden h-[70vh] min-h-[460px] max-h-[500px] md:h-[65vh] md:max-h-[560px] lg:h-[95vh] lg:max-h-[800px] xl:max-h-[720px] bg-gradient-to-br from-[#004900] via-[#006400] to-[#004900] bg-nature-pattern">
    <div class="absolute inset-0 flex flex-col justify-center items-start px-6 md:px-16 lg:px-24 py-8 md:py-12">
        <div class="relative z-20 block w-full text-left text-white">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md text-white text-xs md:text-sm px-3 py-1.5 rounded-full border border-white/20 w-max mb-6">
                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                Amazonia Productiva y Soberana
            </div>
            <h1 class="text-white font-bold text-2xl md:text-4xl lg:text-6xl tracking-tight mb-2">
                Beni Productivo:
            </h1>
            <h1 class="text-[#E5B225] font-bold text-2xl md:text-4xl lg:text-6xl tracking-tight mb-6">
                Corazón de la Amazonia
            </h1>
            <p class="text-white/90 text-xs md:text-base lg:text-lg font-normal w-full max-w-[85%] sm:max-w-xl md:max-w-2xl mb-8 leading-relaxed whitespace-normal break-words text-left">
                Trabajamos por un departamento próspero, integrando nuestra riqueza natural con la fuerza de nuestra gente para liderar el desarrollo regional.
            </p>
            <div class="flex flex-row flex-wrap gap-4 mt-6 md:mt-8 items-center">
                <a href="{{ route('procedures.index') }}" class="bg-[#E5B225] hover:bg-[#cda021] text-neutral-950 font-semibold px-6 py-3 rounded-md transition-all duration-200 text-sm md:text-base shadow-lg">
                    Ver Plan de Gestión 2026
                </a>
                <a href="{{ route('transparency.index') }}" class="flex items-center gap-2 border border-white/40 bg-white/5 hover:bg-white/10 text-white font-medium px-6 py-3 rounded-md transition-all duration-200 text-sm md:text-base backdrop-blur-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    Video Institucional
                </a>
            </div>
        </div>
    </div>
</section>
@endif


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
{{-- @if(isset($latestPosts) && $latestPosts->count() > 0)
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
@endif --}}

{{-- Wave: noticias (white) → stats (forest) --}}
{{-- <div class="leading-none -mb-px overflow-hidden" aria-hidden="true">
    <svg viewBox="0 0 1440 70" preserveAspectRatio="none" class="w-full h-14 block">
        <path d="M0,0 C480,70 960,70 1440,0 L1440,70 L0,70 Z" fill="#004900"/>
    </svg>
</div> --}}

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
{{-- @if(isset($gabinete) && $gabinete->count() > 0)
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
@endif --}}

{{-- =====================================================
     BLOQUE 15ab: Potencial Productivo (Blindado contra Filament)
     ===================================================== --}}
<section id="potencial-productivo" class="bg-gray-50 py-8 px-4 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;" aria-label="Potencial productivo del Beni">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%;">

        <div class="w-full text-center mb-8 block" style="display: block; text-align: center; width: 100%;">
            <span class="text-[#E5B225] text-xs md:text-sm font-bold uppercase tracking-wider block mb-2" style="display: block; color: #E5B225; font-weight: 700;">
                Desarrollo Regional
            </span>
            <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight block" style="display: block; font-weight: 700; color: #0a3118;">
                Potencial Productivo
            </h2>
            <p class="text-gray-600 text-sm md:text-base mt-3 leading-relaxed max-w-2xl mx-auto block" style="display: block; width: 100%; max-width: 42rem; margin-left: auto; margin-right: auto; white-space: normal !important; overflow-wrap: break-word;">
                Descubra los pilares económicos que sustentan el crecimiento de nuestro departamento y las oportunidades de inversión en la región.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full block" style="display: grid; width: 100%;">

            <div class="group relative h-[420px] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer block" style="position: relative; overflow: hidden; height: 420px; border-radius: 1rem;">
                <img src="{{ asset('images/ganaderia.webp') }}" alt="Ganadería Beniana" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block" style="position: absolute; width: 100%; height: 100%; object-fit: cover;">

                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 60%, transparent 100%); z-index: 5;"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end z-10 w-full" style="position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; z-index: 10; box-sizing: border-box;">
                    <span class="w-max bg-[#E5B225] text-[#0a3118] text-[10px] font-bold px-2.5 py-1 rounded-full uppercase mb-2 shadow-sm block" style="display: block; width: max-content; background-color: #E5B225; color: #0a3118; font-weight: 700; font-size: 10px; border-radius: 9999px;">Sector Primario</span>
                    <h3 class="text-white font-bold text-xl md:text-2xl tracking-wide drop-shadow-sm block" style="display: block; font-weight: 700; color: #ffffff; margin: 0;">Ganadería</h3>

                    <p class="text-gray-200 text-xs md:text-sm font-light leading-relaxed max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:max-h-[100px] group-hover:opacity-100 group-hover:mt-2 block"
                       style="display: block; color: #e5e7eb; white-space: normal !important; overflow-wrap: break-word; line-height: 1.45;">
                        Líderes nacionales en producción cárnica con estándares internacionales de calidad.
                    </p>
                </div>
            </div>

            <div class="group relative h-[420px] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer block" style="position: relative; overflow: hidden; height: 420px; border-radius: 1rem;">
                <img src="{{ asset('images/agricultura.webp') }}" alt="Agricultura en Beni" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block" style="position: absolute; width: 100%; height: 100%; object-fit: cover;">
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 60%, transparent 100%); z-index: 5;"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end z-10 w-full" style="position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; z-index: 10; box-sizing: border-box;">
                    <span class="w-max bg-[#0a3118] text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase mb-2 shadow-sm block" style="display: block; width: max-content; background-color: #0a3118; color: #ffffff; font-weight: 700; font-size: 10px; border-radius: 9999px;">Expansión</span>
                    <h3 class="text-white font-bold text-xl md:text-2xl tracking-wide drop-shadow-sm block" style="display: block; font-weight: 700; color: #ffffff; margin: 0;">Agricultura</h3>

                    <p class="text-gray-200 text-xs md:text-sm font-light leading-relaxed max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:max-h-[100px] group-hover:opacity-100 group-hover:mt-2 block"
                       style="display: block; color: #e5e7eb; white-space: normal !important; overflow-wrap: break-word; line-height: 1.45;">
                        Transformando las pampas en el nuevo granero de Bolivia con tecnología sostenible.
                    </p>
                </div>
            </div>

            <div class="group relative h-[420px] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer block" style="position: relative; overflow: hidden; height: 420px; border-radius: 1rem;">
                <img src="{{ asset('images/castana.webp') }}" alt="Cacao beniano" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 block" style="position: absolute; width: 100%; height: 100%; object-fit: cover;">
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent" style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.4) 60%, transparent 100%); z-index: 5;"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end z-10 w-full" style="position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; z-index: 10; box-sizing: border-box;">
                    <span class="w-max bg-[#E5B225] text-[#0a3118] text-[10px] font-bold px-2.5 py-1 rounded-full uppercase mb-2 shadow-sm block" style="display: block; width: max-content; background-color: #E5B225; color: #0a3118; font-weight: 700; font-size: 10px; border-radius: 9999px;">Exportación</span>
                    <h3 class="text-white font-bold text-xl md:text-2xl tracking-wide drop-shadow-sm block" style="display: block; font-weight: 700; color: #ffffff; margin: 0;">Industria de la Castaña</h3>

                    <p class="text-gray-200 text-xs md:text-sm font-light leading-relaxed max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out group-hover:max-h-[100px] group-hover:opacity-100 group-hover:mt-2 block"
                       style="display: block; color: #e5e7eb; white-space: normal !important; overflow-wrap: break-word; line-height: 1.45;">
                        El oro amazónico que conecta a Beni con los mercados más exigentes del mundo.
                    </p>
                </div>
            </div>

        </div>

        <div class="w-full text-center mt-10 block" style="display: block; text-align: center; width: 100%;">
            <a href="#" class="inline-flex items-center text-[#0a3118] font-semibold text-sm md:text-base group hover:underline">
                Explorar todos los sectores
                <svg class="w-4 h-4 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- SECCIÓN: GESTIÓN EN ACCIÓN (Blindado para Filament) -->
<section id="seccion-gestion" class="bg-[#f9fafb] py-8 px-4 sm:px-6 md:px-12 w-full block clear-both" style="display: block; width: 100%; clear: both; box-sizing: border-box;" aria-label="Gestión en acción">
    <div class="max-w-6xl mx-auto w-full block" style="display: block; width: 100%;">

        <!-- Encabezado Centrado de la Sección -->
        <div class="w-full text-center mb-6 block" style="display: block; text-align: center; width: 100%;">
            <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl mb-3 block" style="display: block; font-weight: 700; color: #0a3118; font-size: 2.25rem; margin-bottom: 0.75rem;">
                Gestión en Acción
            </h2>
            <p class="text-gray-500 text-xs md:text-sm font-light max-w-xl mx-auto block" style="display: block; color: #6b7280; font-size: 0.875rem; white-space: normal; max-width: 36rem; margin-left: auto; margin-right: auto;">
                Información actualizada sobre decretos, obras públicas y actividades del Gobernador.
            </p>
        </div>

        <!-- CONTENEDOR DE DOS COLUMNAS -->
        <div class="flex flex-col lg:flex-row gap-6 items-stretch w-full" style="display: flex; flex-direction: row; gap: 1.5rem; width: 100%; flex-wrap: wrap; lg:flex-wrap: nowrap; align-items: stretch;">

            <!-- COLUMNA IZQUIERDA: Tarjeta de Noticia Destacada -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex-1 min-w-[320px] text-left flex flex-col justify-between" style="display: flex; flex-direction: column; justify-content: space-between; background-color: #fff; border: 1px solid #f3f4f6; border-radius: 1rem; overflow: hidden; flex: 1 1 0%; min-width: 320px; text-align: left;">
                <div class="block w-full">
                    <!-- Imagen de la Noticia con Badge Absoluto -->
                    <div class="w-full h-64 md:h-80 relative overflow-hidden block" style="display: block; width: 100%; height: 18rem; position: relative; overflow: hidden;">
                        <img src="{{ asset('images/puente.jpg') }}" alt="Inauguración de Puente Binacional" class="w-full h-full object-cover block" style="display: block; width: 100%; height: 100%; object-fit: cover;">
                        <!-- Insignia Noticia Destacada -->
                        <span class="absolute top-4 left-4 bg-[#0a3118] text-white font-semibold text-[10px] md:text-xs px-3 py-1.5 rounded-md uppercase tracking-wider z-10 block" style="position: absolute; top: 1rem; left: 1rem; background-color: #0a3118; color: #fff; font-weight: 600; font-size: 0.75rem; letter-spacing: 0.05em; padding: 0.375rem 0.75rem; border-radius: 0.375rem; z-index: 10;">
                            Noticia Destacada
                        </span>
                    </div>

                    <!-- Contenido de la Noticia -->
                    <div class="p-6 md:p-8 block text-left" style="display: block; padding: 1.5rem 2rem; text-align: left;">
                        <span class="text-blue-600 font-medium text-[11px] block mb-2" style="display: block; color: #2563eb; font-weight: 500; font-size: 0.6875rem; margin-bottom: 0.5rem;">
                            Obras Públicas • Hace 2 horas
                        </span>
                        <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-4 leading-snug block" style="display: block; font-weight: 700; color: #0a3118; font-size: 1.5rem; margin-bottom: 1rem; line-height: 1.25;">
                            Inauguración de Puente Binacional impulsará el comercio en la frontera
                        </h3>
                        <p class="text-gray-500 text-xs md:text-sm font-light leading-relaxed block" style="display: block; color: #6b7280; font-size: 0.875rem; line-height: 1.5; white-space: normal;">
                            La infraestructura facilitará el transporte de productos agrícolas y ganaderos, reduciendo los tiempos de logística en un 40% hacia los mercados limítrofes.
                        </p>
                    </div>
                </div>

                <!-- Enlace Leer Más fijo al fondo -->
                <div class="px-6 md:px-8 pb-6 md:pb-8 block text-left" style="display: block; padding-left: 2rem; padding-right: 2rem; padding-bottom: 2rem; text-align: left;">
                    <a href="#" class="text-[#0a3118] hover:text-[#061f0f] font-bold text-xs inline-flex items-center gap-1 group" style="display: inline-flex; align-items: center; gap: 0.25rem; color: #0a3118; font-weight: 700; font-size: 0.75rem; text-decoration: none;">
                        Leer más
                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 0.875rem; height: 0.875rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- COLUMNA DERECHA: Bloque Decretos y Gaceta -->
            <div class="w-full lg:w-[380px] bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 flex flex-col justify-between" style="display: flex; flex-direction: column; justify-content: space-between; background-color: #fff; border: 1px solid #f3f4f6; border-radius: 1rem; padding: 2rem; width: 100%; max-width: 380px; box-sizing: border-box; text-align: left;">

                <div class="block w-full">
                    <h3 class="text-[#0a3118] font-bold text-sm uppercase tracking-wider mb-6 pb-4 border-b border-gray-100 block" style="display: block; font-weight: 700; color: #0a3118; font-size: 0.875rem; letter-spacing: 0.05em; border-bottom: 1px solid #f3f4f6; padding-bottom: 1rem; margin-bottom: 1.5rem;">
                        Decretos y Gaceta
                    </h3>

                    <!-- Lista de Documentos -->
                    <div class="flex flex-col gap-5 w-full" style="display: flex; flex-direction: column; gap: 1.25rem; width: 100%;">

                        <!-- Documento 1 -->
                        <div class="flex flex-row items-start gap-3 w-full text-left" style="display: flex; flex-direction: row; align-items: flex-start; gap: 0.75rem; width: 100%; text-align: left;">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center flex-shrink-0" style="display: flex; align-items: center; justify-content: center; width: 2rem; height: 2rem; background-color: #ecfdf5; color: #047857; border-radius: 0.5rem; flex-shrink: 0;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div class="block" style="display: block;">
                                <span class="text-blue-600 font-bold text-[10px] uppercase tracking-wider block mb-0.5" style="display: block; color: #2563eb; font-weight: 700; font-size: 0.625rem; letter-spacing: 0.05em;">
                                    Decreto 015/2024
                                </span>
                                <p class="text-slate-800 font-medium text-xs md:text-sm leading-snug block" style="display: block; color: #1e293b; font-weight: 500; font-size: 0.875rem; line-height: 1.35; white-space: normal;">
                                    Plan de contingencia ambiental para la protección de la cuenca d...
                                </p>
                            </div>
                        </div>

                        <!-- Documento 2 -->
                        <div class="flex flex-row items-start gap-3 w-full text-left" style="display: flex; flex-direction: row; align-items: flex-start; gap: 0.75rem; width: 100%; text-align: left;">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center flex-shrink-0" style="display: flex; align-items: center; justify-content: center; width: 2rem; height: 2rem; background-color: #ecfdf5; color: #047857; border-radius: 0.5rem; flex-shrink: 0;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 009 11V7a4 4 0 00-8 0v4c0 2.18.57 4.225 1.574 6"></path></svg>
                            </div>
                            <div class="block" style="display: block;">
                                <span class="text-blue-600 font-bold text-[10px] uppercase tracking-wider block mb-0.5" style="display: block; color: #2563eb; font-weight: 700; font-size: 0.625rem; letter-spacing: 0.05em;">
                                    Resolución 202/2024
                                </span>
                                <p class="text-slate-800 font-medium text-xs md:text-sm leading-snug block" style="display: block; color: #1e293b; font-weight: 500; font-size: 0.875rem; line-height: 1.35; white-space: normal;">
                                    Normativa para el uso de suelos agrícolas en la provincia Vaca Díez.
                                </p>
                            </div>
                        </div>

                        <!-- Documento 3 -->
                        <div class="flex flex-row items-start gap-3 w-full text-left" style="display: flex; flex-direction: row; align-items: flex-start; gap: 0.75rem; width: 100%; text-align: left;">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center flex-shrink-0" style="display: flex; align-items: center; justify-content: center; width: 2rem; height: 2rem; background-color: #ecfdf5; color: #047857; border-radius: 0.5rem; flex-shrink: 0;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div class="block" style="display: block;">
                                <span class="text-blue-600 font-bold text-[10px] uppercase tracking-wider block mb-0.5" style="display: block; color: #2563eb; font-weight: 700; font-size: 0.625rem; letter-spacing: 0.05em;">
                                    Transparencia
                                </span>
                                <p class="text-slate-800 font-medium text-xs md:text-sm leading-snug block" style="display: block; color: #1e293b; font-weight: 500; font-size: 0.875rem; line-height: 1.35; white-space: normal;">
                                    Publicación del informe trimestral de ejecución presupuestaria.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Botón Ver Toda la Gaceta al pie -->
                <div class="w-full block pt-6 mt-6 border-t border-gray-50" style="display: block; width: 100%; border-top: 1px solid #f9fafb; margin-top: 1.5rem;">
                    <a href="#" class="w-full bg-gray-100 text-slate-700 hover:bg-gray-200 hover:text-slate-900 font-bold text-xs md:text-sm py-3 px-4 rounded-xl text-center block transition-colors" style="display: block; width: 100%; box-sizing: border-box; background-color: #f3f4f6; color: #374151; font-weight: 700; font-size: 0.875rem; padding: 0.75rem 1rem; border-radius: 0.75rem; text-align: center; text-decoration: none;">
                        Ver toda la Gaceta
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- =====================================================
     BLOQUE 7: Últimas Noticias (3)
     ===================================================== --}}
@if(isset($latestPosts) && $latestPosts->count() > 0)
<section class="py-10 bg-white" aria-label="Últimas noticias">
    <div class="container mx-auto px-4">
        {{-- <div class="flex flex-wrap items-end justify-between gap-4 mb-10 reveal">
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
        </div> --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestPosts->take(3) as $post)
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

{{-- =====================================================
     BLOQUE 15b: Servicios al Ciudadano
     ===================================================== --}}
<section class="py-8 bg-gray-50" aria-label="Servicios al ciudadano">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-stretch">

            {{-- Columna izquierda: Tarjeta principal destacada --}}
            <div class="relative rounded-2xl bg-[#004900] p-8 flex flex-col justify-between overflow-hidden min-h-[320px]">
                <div class="absolute inset-0 opacity-10" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.15'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;); background-repeat: repeat;"></div>
                <div class="relative z-10 flex flex-col h-full">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-white/15 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <h2 class="text-white font-bold text-2xl md:text-3xl mb-4 leading-tight">Servicios al Ciudadano</h2>
                        <p class="text-white/80 text-sm md:text-base leading-relaxed mb-8">Acceda a nuestra plataforma digital de trámites y servicios institucionales de forma rápida y segura.</p>
                    </div>
                    <div class="mt-auto">
                        <a href="#" class="inline-flex items-center gap-2 bg-[#E5B225] hover:bg-[#cda021] text-[#004900] font-semibold rounded-lg px-5 py-2.5 text-sm transition-all duration-200 shadow-lg">
                            Portal Digital
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Columna derecha: Cuadrícula de accesos rápidos --}}
            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 h-full">
                    {{-- Tarjeta 1: Trámites en Línea (destacada) --}}
                    <div class="bg-white border border-[#E5B225]/40 rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg flex flex-col relative">
                        <div class="absolute top-0 right-0 w-16 h-16 overflow-hidden">
                            <div class="absolute top-0 right-0 w-20 h-20 bg-[#E5B225]/10 rounded-bl-full"></div>
                        </div>
                        <div class="w-11 h-11 rounded-lg bg-[#E5B225]/15 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-[#705d00]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-[#004900] font-bold text-lg mb-2">Trámites en Línea</h3>
                        <p class="text-gray-600 text-sm leading-relaxed flex-1">Personalidad jurídica, licencias ambientales y registros departamentales.</p>
                    </div>
                    {{-- Tarjeta 2: Transparencia --}}
                    <div class="bg-white border border-gray-100 rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg flex flex-col">
                        <div class="w-11 h-11 rounded-lg bg-[#004900]/10 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-[#004900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-[#004900] font-bold text-lg mb-2">Transparencia</h3>
                        <p class="text-gray-600 text-sm leading-relaxed flex-1">Rendición de cuentas, auditorías y control social gubernamental.</p>
                    </div>
                    {{-- Tarjeta 3: Atención Ciudadana --}}
                    <div class="bg-white border border-gray-100 rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg flex flex-col">
                        <div class="w-11 h-11 rounded-lg bg-[#004900]/10 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-[#004900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                        </div>
                        <h3 class="text-[#004900] font-bold text-lg mb-2">Atención Ciudadana</h3>
                        <p class="text-gray-600 text-sm leading-relaxed flex-1">Canal directo para consultas, reclamos y sugerencias vecinales.</p>
                    </div>
                    {{-- Tarjeta 4: Gaceta Oficial --}}
                    <div class="bg-white border border-gray-100 rounded-xl p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg flex flex-col">
                        <div class="w-11 h-11 rounded-lg bg-[#004900]/10 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-[#004900]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-[#004900] font-bold text-lg mb-2">Gaceta Oficial</h3>
                        <p class="text-gray-600 text-sm leading-relaxed flex-1">Histórico legislativo de leyes departamentales y resoluciones.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

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

{{-- =====================================================
     BLOQUE 15c: Turismo y Naturaleza
     ===================================================== --}}
<section id="turismo-naturaleza" class="relative overflow-hidden py-16 px-6 min-h-[75vh] flex items-center" aria-label="Turismo y naturaleza del Beni">

    <div class="absolute inset-0 w-full h-full z-0 bg-cover bg-center bg-no-repeat bg-fixed"
         style="background-image: url('{{ asset('images/turismo.png') }}');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-[#062411]/90 via-[#0a3118]/85 to-[#041a0c]/95 z-10"></div>

    <div class="relative w-full max-w-7xl mx-auto z-20">

        <div class="text-center max-w-3xl mx-auto mb-8">
            <h2 class="text-[#E5B225] font-bold text-3xl md:text-4xl mb-4 tracking-tight drop-shadow-md">
                Turismo y Naturaleza
            </h2>
            <p class="text-white/90 text-sm md:text-base leading-relaxed drop-shadow">
                Descubra el santuario ecológico más vibrante de Bolivia. Desde los enigmáticos Llanos de Moxos hasta nuestros parques nacionales.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Tarjeta 1: Ruta del Bufeo --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-md transition-all duration-300 hover:-translate-y-2 hover:bg-white/10 hover:border-white/20 hover:shadow-xl">
                <div class="w-full aspect-[4/3] rounded-xl overflow-hidden mb-4">
                    <img src="{{ asset('images/bufeo.webp') }}" alt="Bufeo boliviano nadando en aguas amazónicas" class="w-full h-full object-cover object-center" loading="lazy">
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Ruta del Bufeo</h3>
                <p class="text-white/70 text-xs md:text-sm leading-relaxed">Navegue junto al delfín rosado, emblema de nuestras aguas dulces amazónicas.</p>
            </div>
            {{-- Tarjeta 2: Llanos de Moxos --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-md transition-all duration-300 hover:-translate-y-2 hover:bg-white/10 hover:border-white/20 hover:shadow-xl">
                <div class="w-full aspect-[4/3] rounded-xl overflow-hidden mb-4">
                    <img src="{{ asset('images/llanura.webp') }}" alt="Sabanas inundables de los Llanos de Moxos" class="w-full h-full object-cover object-center" loading="lazy">
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Llanos de Moxos</h3>
                <p class="text-white/70 text-xs md:text-sm leading-relaxed">Patrimonio arqueológico y sistema hidráulico ancestral único en el mundo.</p>
            </div>
            {{-- Tarjeta 3: Misiones Jesuíticas --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-md transition-all duration-300 hover:-translate-y-2 hover:bg-white/10 hover:border-white/20 hover:shadow-xl">
                <div class="w-full aspect-[4/3] rounded-xl overflow-hidden mb-4">
                    <img src="{{ asset('images/jesuita.png') }}" alt="Iglesia misional jesuítica en la Amazonía beniana" class="w-full h-full object-cover object-center" loading="lazy">
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Misiones Jesuíticas</h3>
                <p class="text-white/70 text-xs md:text-sm leading-relaxed">Cultura viva, música barroca y tradiciones milenarias rodeadas de selva.</p>
            </div>
            {{-- Tarjeta 4: Gastronomía Beniana --}}
            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 backdrop-blur-md transition-all duration-300 hover:-translate-y-2 hover:bg-white/10 hover:border-white/20 hover:shadow-xl">
                <div class="w-full aspect-[4/3] rounded-xl overflow-hidden mb-4">
                    <img src="{{ asset('images/majadito.webp') }}" alt="Plato tradicional de Majadito beniano" class="w-full h-full object-cover object-center" loading="lazy">
                </div>
                <h3 class="text-white font-semibold text-lg mb-2">Gastronomía Beniana</h3>
                <p class="text-white/70 text-xs md:text-sm leading-relaxed">Un viaje de sabores únicos: el Majadito, el Masaco y exquisitos pescados de río.</p>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="#" class="inline-block bg-white text-[#0a3118] font-bold px-8 py-3.5 rounded-full hover:bg-gray-100 hover:shadow-xl transition-all duration-300 text-sm md:text-base">
                Planifique su Visita
            </a>
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
    // PARALLAX — hero image subtle effect
    // =============================================
    (function() {
        const heroSlider = document.getElementById('hero-slider');
        if (!heroSlider || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY;
            if (scrolled < 700) {
                const imgs = heroSlider.querySelectorAll('[data-slide] img');
                imgs.forEach(img => {
                    img.style.transform = `translateY(${scrolled * 0.25}px)`;
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

    // Hero slider
    document.addEventListener('DOMContentLoaded', function () {
        const slider = document.getElementById('hero-slider');
        if (!slider) return;
        const slides = slider.querySelectorAll('[data-slide]');
        const contents = slider.querySelectorAll('[data-slide-content]');
        const btns = slider.querySelectorAll('[data-slide-btn]');
        const counter = slider.querySelector('#slide-counter');
        const prevBtn = slider.querySelector('#prev-slide');
        const nextBtn = slider.querySelector('#next-slide');
        if (slides.length <= 1) return;

        let current = 0;
        let autoplayTimer;

        const show = (i) => {
            slides.forEach((s, idx) => {
                s.classList.toggle('opacity-100', idx === i);
                s.classList.toggle('opacity-0', idx !== i);
            });
            contents.forEach((c, idx) => {
                c.classList.toggle('hidden', idx !== i);
            });
            btns.forEach((b, idx) => {
                const isActive = idx === i;
                b.classList.toggle('w-8', isActive);
                b.classList.toggle('w-2', !isActive);
                b.classList.toggle('bg-white', isActive);
                b.classList.toggle('bg-white/50', !isActive);
                b.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });
            if (counter) counter.textContent = `${i + 1} / ${slides.length}`;
            current = i;
        };

        const next = () => show((current + 1) % slides.length);
        const prev = () => show((current - 1 + slides.length) % slides.length);

        const resetAutoplay = () => {
            clearInterval(autoplayTimer);
            autoplayTimer = setInterval(next, 6000);
        };

        btns.forEach((btn, idx) => btn.addEventListener('click', () => { show(idx); resetAutoplay(); }));
        if (prevBtn) prevBtn.addEventListener('click', () => { prev(); resetAutoplay(); });
        if (nextBtn) nextBtn.addEventListener('click', () => { next(); resetAutoplay(); });

        // Swipe support on mobile
        let touchStartX = 0;
        slider.addEventListener('touchstart', (e) => { touchStartX = e.touches[0].clientX; }, { passive: true });
        slider.addEventListener('touchend', (e) => {
            const diff = touchStartX - e.changedTouches[0].clientX;
            if (Math.abs(diff) > 50) { diff > 0 ? next() : prev(); resetAutoplay(); }
        }, { passive: true });

        // Autoplay
        autoplayTimer = setInterval(next, 6000);
    });
</script>
@endsection
