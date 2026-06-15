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
<section class="relative h-[400px] md:h-[520px] lg:h-[600px] overflow-hidden" id="hero-slider" aria-label="Diapositivas principales">
    <div class="absolute inset-0">
        @foreach($slides as $index => $slide)
        <div class="absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
            <picture>
                <source media="(max-width: 768px)" srcset="{{ $slide->getFirstMediaUrl('slides') ?: $slide->image }}?w=800&q=80">
                <source media="(max-width: 1024px)" srcset="{{ $slide->getFirstMediaUrl('slides') ?: $slide->image }}?w=1200&q=85">
                <img src="{{ $slide->getFirstMediaUrl('slides') ?: $slide->image }}" alt="{{ $slide->title }}" class="w-full h-full object-cover" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
            </picture>
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-black/20"></div>
        </div>
        @endforeach
    </div>
    <div class="absolute inset-0 flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl text-white">
                @foreach($slides as $index => $slide)
                <div class="{{ $index === 0 ? '' : 'hidden' }}" data-slide-content="{{ $index }}">
                    @if($slide->title)
                    <p class="hero-eyebrow font-semibold mb-2 uppercase tracking-widest text-[#e9c46a] text-sm md:text-base">
                        {{ $slide->subtitle ?? 'Gobernación del Beni' }}
                    </p>
                    <h1 class="hero-title text-3xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight drop-shadow-lg">
                        {{ $slide->title }}
                    </h1>
                    @if($slide->description)
                    <p class="hero-desc text-lg md:text-xl opacity-90 mb-6 max-w-2xl leading-relaxed">{{ $slide->description }}</p>
                    @endif
                    @if($slide->button_text && $slide->button_url)
                    <div class="hero-cta flex flex-wrap gap-3">
                        <a href="{{ $slide->button_url }}" class="btn-pulse bg-[#d4a017] hover:bg-[#b47d14] text-white px-7 py-3.5 rounded-xl font-bold transition shadow-lg hover:shadow-xl">
                            {{ $slide->button_text }}
                        </a>
                        <a href="{{ route('transparency.index') }}" class="bg-white/15 hover:bg-white/25 backdrop-blur border border-white/30 text-white px-7 py-3.5 rounded-xl font-semibold transition">
                            Ver Transparencia
                        </a>
                    </div>
                    @endif
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @if($slides->count() > 1)
    {{-- Prev/Next arrows --}}
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
    {{-- Dots + counter --}}
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
<section class="relative h-[400px] md:h-[520px] bg-gradient-to-br from-[#1b4332] via-[#2d6a4f] to-[#1b4332] flex items-center overflow-hidden bg-nature-pattern">
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl text-white">
            <p class="hero-eyebrow font-semibold mb-2 uppercase tracking-widest text-[#e9c46a] text-sm md:text-base">Gobierno Autónomo Departamental</p>
            <h1 class="hero-title text-3xl md:text-5xl lg:text-6xl font-extrabold mb-4 leading-tight drop-shadow-lg">
                Gobernación Autónoma Departamental del Beni
            </h1>
            <p class="hero-desc text-lg md:text-xl opacity-90 mb-6 max-w-2xl leading-relaxed">
                Comprometidos con el desarrollo integral de nuestro departamento.
                Trámites, transparencia y atención al ciudadano en un solo lugar.
            </p>
            <div class="hero-cta flex flex-wrap gap-3">
                <a href="{{ route('procedures.index') }}" class="btn-pulse bg-[#d4a017] hover:bg-[#b47d14] text-white px-7 py-3.5 rounded-xl font-bold transition shadow-lg hover:shadow-xl">
                    Ver Trámites
                </a>
                <a href="{{ route('transparency.index') }}" class="bg-white/15 hover:bg-white/25 backdrop-blur border border-white/30 text-white px-7 py-3.5 rounded-xl font-semibold transition">
                    Portal de Transparencia
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 4: Banda de Búsqueda
     ===================================================== --}}
<x-search-band />

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
<section class="py-16 bg-white" aria-label="Últimas noticias">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10 reveal">
            <div>
                <p class="section-label">Sala de prensa</p>
                <h2 class="section-title text-3xl md:text-4xl font-bold text-gray-900">Últimas Noticias</h2>
            </div>
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-teal-700 hover:text-teal-800 border border-teal-200 hover:border-teal-400 px-4 py-2 rounded-lg transition">
                Ver todas
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestPosts as $post)
            <article class="card-lift bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm flex flex-col reveal reveal-d{{ $loop->index + 1 }}">
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
                        <span class="bg-teal-50 text-teal-700 border border-teal-100 px-2 py-0.5 rounded-full font-semibold">{{ $post->category->name }}</span>
                        @endif
                        <span class="text-gray-400 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ optional($post->published_at)->format('d/m/Y') }}
                        </span>
                    </div>
                    <h3 class="text-base font-bold mb-2 line-clamp-2 leading-snug flex-1">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-teal-700 transition text-gray-900">
                            {{ $post->title }}
                        </a>
                    </h3>
                    @if($post->excerpt)
                    <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $post->excerpt }}</p>
                    @endif
                    <a href="{{ route('posts.show', $post->slug) }}" class="mt-auto inline-flex items-center gap-1 text-teal-700 hover:text-teal-800 font-semibold text-sm group">
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
        <path d="M0,0 C480,70 960,70 1440,0 L1440,70 L0,70 Z" fill="#1b4332"/>
    </svg>
</div>

{{-- =====================================================
     BLOQUE 8: Transparencia en Cifras
     ===================================================== --}}
@if(isset($stats))
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
            <div class="reveal reveal-d1"><x-stat-counter :value="$stats['tramites'] ?? 0" label="Trámites disponibles" icon="document" color="teal" :url="route('procedures.index')" /></div>
            <div class="reveal reveal-d2"><x-stat-counter :value="$stats['secretarias'] ?? 0" label="Secretarías" icon="building" color="emerald" :url="route('institutional.secretariats')" /></div>
            <div class="reveal reveal-d3"><x-stat-counter :value="$stats['oficinas'] ?? 0" label="Oficinas de atención" icon="map" color="amber" :url="route('offices')" /></div>
            <div class="reveal reveal-d4"><x-stat-counter :value="$stats['municipios'] ?? 0" label="Municipios" icon="map" color="blue" /></div>
            <div class="reveal reveal-d5"><x-stat-counter :value="$stats['normas'] ?? 0" label="Normas publicadas" icon="document" color="purple" :url="route('transparency.marco-normativo')" /></div>
            <div class="reveal reveal-d6"><x-stat-counter :value="$stats['datasets'] ?? 0" label="Datasets abiertos" icon="database" color="red" :url="route('open-data.index')" /></div>
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
@endif

{{-- =====================================================
     BLOQUE 15: Gabinete / Autoridades
     ===================================================== --}}
@if(isset($gabinete) && $gabinete->count() > 0)
<section class="py-16 bg-white" aria-label="Gabinete departamental">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="inline-flex items-center justify-center gap-2 section-label mx-auto">
                <span class="block w-5 h-0.5 bg-teal-500 rounded -mb-0.5"></span>
                Liderazgo
                <span class="block w-5 h-0.5 bg-teal-500 rounded -mb-0.5"></span>
            </p>
            <h2 class="section-title section-title-center text-3xl md:text-4xl font-bold text-gray-900 mx-auto mt-2">Gabinete Departamental</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($gabinete as $person)
            <div class="text-center">
                <div class="aspect-square w-full max-w-[160px] mx-auto bg-gradient-to-br from-[#2d6a4f] to-[#1b4332] rounded-2xl flex items-center justify-center text-white text-4xl font-bold shadow-md mb-3 ring-2 ring-[#d4a017]/30">
                    {{ strtoupper(mb_substr($person->full_name, 0, 1)) }}
                </div>
                <h3 class="text-sm font-bold text-gray-900 line-clamp-2">{{ $person->full_name }}</h3>
                <p class="text-xs text-[#2d6a4f] font-semibold mt-1 line-clamp-1">{{ $person->position ?? 'Autoridad' }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('institutional.organigrama') }}" class="text-teal-700 font-semibold hover:text-teal-800 inline-flex items-center gap-1">
                Ver organigrama completo →
            </a>
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 16: Mapa del Beni (Google Maps)
     ===================================================== --}}
<section class="py-16 bg-white" aria-label="Mapa del departamento del Beni">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="inline-flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-600 mb-3">
                <span class="block w-5 h-0.5 bg-amber-400 rounded"></span>
                Ubicación geográfica
                <span class="block w-5 h-0.5 bg-amber-400 rounded"></span>
            </p>
            <h2 class="section-title section-title-center text-3xl md:text-4xl font-bold text-gray-900 mx-auto mt-2">Departamento del Beni</h2>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto text-sm">El Beni es el departamento más grande de Bolivia, ubicado en la región amazónica, con una extensión de 213.564 km² y rica biodiversidad.</p>
        </div>
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-8 items-stretch">
                <!-- Columna izquierda: Mapa -->
                <div class="rounded-2xl overflow-hidden shadow-2xl h-full">
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
                    <div class="rounded-2xl overflow-hidden shadow-2xl mb-4">
                        <img src="{{ asset('images/gobe.jpg') }}" alt="Gobernación del Beni" class="w-full h-64 object-cover">
                    </div>
                    <div class="bg-gradient-to-br from-[#1b4332] to-[#2d6a4f] rounded-2xl p-5 text-white flex-1 flex flex-col justify-center text-center">
                        <h3 class="text-lg font-bold mb-2 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            Nuestra Dirección
                        </h3>
                        <p class="text-gray-200 mb-4 text-sm">Plaza José Ballivian acera sur<br>Santísima Trinidad - Beni</p>
                        <div class="grid grid-cols-4 gap-3">
                            <div class="text-center">
                                <div class="text-lg font-bold text-[#e9c46a]">213.564</div>
                                <div class="text-xs text-gray-300">km²</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-[#e9c46a]">8</div>
                                <div class="text-xs text-gray-300">provincias</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-[#e9c46a]">48</div>
                                <div class="text-xs text-gray-300">municipios</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-[#e9c46a]">~500K</div>
                                <div class="text-xs text-gray-300">habitantes</div>
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
