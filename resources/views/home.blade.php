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
                    <p class="font-semibold mb-2 uppercase tracking-widest text-amber-300 text-sm md:text-base">
                        {{ $slide->subtitle ?? 'Gobernación del Beni' }}
                    </p>
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        {{ $slide->title }}
                    </h1>
                    @if($slide->description)
                    <p class="text-lg md:text-xl opacity-90 mb-6 max-w-2xl">{{ $slide->description }}</p>
                    @endif
                    @if($slide->button_text && $slide->button_url)
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ $slide->button_url }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-bold transition shadow-lg">
                            {{ $slide->button_text }}
                        </a>
                        <a href="{{ route('transparency.index') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur text-white px-6 py-3 rounded-lg font-semibold transition">
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
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-3 z-10" role="tablist">
        @foreach($slides as $index => $slide)
        <button data-slide-btn="{{ $index }}" class="w-3 h-3 md:w-3 md:h-3 rounded-full transition-all {{ $index === 0 ? 'bg-white w-8 md:w-8' : 'bg-white/50 hover:bg-white/70' }}" aria-label="Slide {{ $index + 1 }}" role="tab" aria-selected="{{ $index === 0 ? 'true' : 'false' }}"></button>
        @endforeach
    </div>
    @endif
</section>
@else
<section class="relative h-[400px] md:h-[520px] bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 flex items-center overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl text-white">
            <p class="font-semibold mb-2 uppercase tracking-widest text-amber-300 text-sm md:text-base">Gobierno Autónomo Departamental</p>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Gobernación Autónoma Departamental del Beni
            </h1>
            <p class="text-lg md:text-xl opacity-90 mb-6 max-w-2xl">
                Comprometidos con el desarrollo integral de nuestro departamento.
                Trámites, transparencia y atención al ciudadano en un solo lugar.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('procedures.index') }}" class="bg-amber-500 hover:bg-amber-600 text-gray-900 px-6 py-3 rounded-lg font-bold transition shadow-lg">
                    Ver Trámites
                </a>
                <a href="{{ route('transparency.index') }}" class="bg-white/20 hover:bg-white/30 backdrop-blur text-white px-6 py-3 rounded-lg font-semibold transition">
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
     BLOQUE 5: Accesos Rápidos
     ===================================================== --}}
<x-quick-access-grid />

{{-- =====================================================
     BLOQUE 6: Trámites Destacados
     ===================================================== --}}
@if(isset($featuredProcedures) && $featuredProcedures->count() > 0)
<section class="py-16 bg-gray-50" aria-label="Trámites destacados">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Servicios al ciudadano</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Trámites Destacados</h2>
                <p class="text-gray-600 mt-2">Los trámites más consultados por la ciudadanía</p>
            </div>
            <a href="{{ route('procedures.index') }}" class="text-teal-700 font-semibold hover:text-teal-800 inline-flex items-center gap-1 text-sm md:text-base">
                Ver todos los trámites
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($featuredProcedures as $procedure)
                <x-procedure-card :procedure="$procedure" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 7: Últimas Noticias
     ===================================================== --}}
@if(isset($latestPosts) && $latestPosts->count() > 0)
<section class="py-16 bg-white" aria-label="Últimas noticias">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Sala de prensa</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Últimas Noticias</h2>
            </div>
            <a href="{{ route('blog') }}" class="text-teal-700 font-semibold hover:text-teal-800 inline-flex items-center gap-1 text-sm md:text-base">
                Ver todas las noticias
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestPosts as $post)
            <article class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
                <a href="{{ route('posts.show', $post->slug) }}" class="block">
                    @if(method_exists($post, 'getFirstMedia') && $post->getFirstMedia('featured'))
                    <img src="{{ $post->getFirstMedia('featured')->getUrl('medium') }}" alt="{{ $post->title }}" class="w-full h-48 object-cover" loading="lazy">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-teal-100 to-teal-50 flex items-center justify-center">
                        <svg class="w-12 h-12 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    @endif
                </a>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-3 text-xs">
                        @if($post->category)
                        <span class="bg-teal-100 text-teal-700 px-2 py-0.5 rounded font-semibold">{{ $post->category->name }}</span>
                        @endif
                        <span class="text-gray-500">{{ optional($post->published_at)->format('d/m/Y') }}</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 line-clamp-2">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-teal-700 transition">
                            {{ $post->title }}
                        </a>
                    </h3>
                    @if($post->excerpt)
                    <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $post->excerpt }}</p>
                    @endif
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-teal-700 font-medium text-sm inline-flex items-center gap-1 hover:gap-2 transition-all">
                        Leer más →
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 8: Transparencia en Cifras
     ===================================================== --}}
@if(isset($stats))
<section class="py-16 bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white" aria-label="Transparencia en cifras">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="font-semibold uppercase tracking-wider mb-2 text-amber-300 text-sm">Transparencia activa</p>
            <h2 class="text-3xl md:text-4xl font-bold">El Beni en Cifras</h2>
            <p class="text-white/80 mt-2 max-w-2xl mx-auto">Datos abiertos y actualizados del Gobierno Autónomo Departamental</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <x-stat-counter :value="$stats['tramites'] ?? 0" label="Trámites disponibles" icon="document" color="teal" :url="route('procedures.index')" />
            <x-stat-counter :value="$stats['secretarias'] ?? 0" label="Secretarías" icon="building" color="emerald" :url="route('institutional.secretariats')" />
            <x-stat-counter :value="$stats['oficinas'] ?? 0" label="Oficinas de atención" icon="map" color="amber" :url="route('offices')" />
            <x-stat-counter :value="$stats['municipios'] ?? 0" label="Municipios" icon="map" color="blue" />
            <x-stat-counter :value="$stats['normas'] ?? 0" label="Normas publicadas" icon="document" color="purple" :url="route('transparency.marco-normativo')" />
            <x-stat-counter :value="$stats['datasets'] ?? 0" label="Datasets abiertos" icon="database" color="red" :url="route('open-data.index')" />
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('transparency.index') }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold px-6 py-3 rounded-lg transition shadow-lg">
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
     BLOQUE 9: El Gobernador
     ===================================================== --}}
@if(isset($gobernador) && $gobernador->count() > 0)
<section class="py-16 bg-white" aria-label="Mensaje del Gobernador">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-5 gap-8 items-center max-w-6xl mx-auto">
            <div class="lg:col-span-2">
                <div class="aspect-[4/5] max-w-sm mx-auto bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl overflow-hidden shadow-2xl flex items-center justify-center text-white">
                    <div class="text-center p-6">
                        <div class="w-32 h-32 mx-auto bg-white/20 backdrop-blur rounded-full flex items-center justify-center mb-4 text-5xl font-bold">
                            {{ strtoupper(mb_substr($gobernador->first()->full_name, 0, 1)) }}
                        </div>
                        <p class="text-lg font-bold">{{ $gobernador->first()->full_name }}</p>
                        <p class="text-white/80 text-sm">{{ $gobernador->first()->position ?? 'Gobernador(a) del Beni' }}</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3">
                <p class="text-amber-600 font-semibold uppercase tracking-wider mb-2 text-sm">Mensaje del Gobierno</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Construyendo el futuro del Beni</h2>
                <div class="prose prose-lg text-gray-700 max-w-none">
                    <p class="mb-4">
                        {!! $aboutSettings['description'] !!}
                    </p>
                    <p class="text-teal-700 font-semibold italic border-l-4 border-amber-500 pl-4">
                        "{{ $aboutSettings['mission'] }}"
                    </p>
                </div>
                <a href="{{ route('institutional.index') }}" class="mt-6 inline-flex items-center gap-2 text-teal-700 font-semibold hover:text-teal-800">
                    Conoce más sobre la Gobernación
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 10: Próximos Eventos
     ===================================================== --}}
@if(isset($featuredEvents) && $featuredEvents->count() > 0)
<section class="py-16 bg-gray-50" aria-label="Próximos eventos">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Agenda institucional</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Próximos Eventos</h2>
            </div>
            <a href="{{ route('events') }}" class="text-teal-700 font-semibold hover:text-teal-800 inline-flex items-center gap-1 text-sm md:text-base">
                Ver todos los eventos →
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($featuredEvents as $event)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-br from-teal-600 to-teal-800 text-white p-5 text-center">
                    <p class="text-3xl font-bold">{{ optional($event->starts_at)->format('d') ?? '—' }}</p>
                    <p class="text-sm uppercase tracking-wider opacity-80">{{ optional($event->starts_at)->translatedFormat('M Y') ?? '—' }}</p>
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $event->title }}</h3>
                    @if($event->location)
                    <p class="text-sm text-gray-600 flex items-center gap-1 mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        {{ $event->location }}
                    </p>
                    @endif
                    @if($event->starts_at)
                    <p class="text-sm text-gray-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $event->starts_at->format('H:i') }}
                    </p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 11: Secretarías Departamentales
     ===================================================== --}}
@if(isset($secretariats) && $secretariats->count() > 0)
<section class="py-16 bg-white" aria-label="Secretarías departamentales">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Estructura orgánica</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Secretarías Departamentales</h2>
            </div>
            <a href="{{ route('institutional.secretariats') }}" class="text-teal-700 font-semibold hover:text-teal-800 inline-flex items-center gap-1 text-sm md:text-base">
                Ver todas →
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($secretariats as $secretariat)
                <x-secretary-card :secretariat="$secretariat" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 12: Proyectos de Inversión
     ===================================================== --}}
@if(isset($featuredProjects) && $featuredProjects->count() > 0)
<section class="py-16 bg-gray-50" aria-label="Proyectos de inversión">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Inversión pública</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Proyectos Destacados</h2>
                <p class="text-gray-600 mt-2">Obras emblemáticas que impulsa la Gobernación del Beni</p>
            </div>
            <a href="{{ route('gobierno.proyectos.index') }}" class="text-teal-700 font-semibold hover:text-teal-800 inline-flex items-center gap-1 text-sm md:text-base">
                Ver todos los proyectos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($featuredProjects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 13: Atención al Ciudadano
     ===================================================== --}}
<section class="py-16 bg-gradient-to-br from-amber-50 to-white" aria-label="Atención al ciudadano">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <p class="text-amber-600 font-semibold uppercase tracking-wider mb-2 text-sm">Estamos para ayudarte</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Atención al Ciudadano</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('offices') }}" class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-teal-500">
                <div class="w-14 h-14 bg-teal-100 text-teal-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-teal-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">📍 Encuéntranos</h3>
                <p class="text-sm text-gray-600 mb-3">Conoce las oficinas de atención al ciudadano en todo el departamento.</p>
                <span class="text-teal-700 font-semibold text-sm">Ver oficinas →</span>
            </a>
            <a href="{{ route('complaints.create') }}" class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-red-500">
                <div class="w-14 h-14 bg-red-100 text-red-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">📝 Quejas y Reclamos</h3>
                <p class="text-sm text-gray-600 mb-3">Registra tu queja, reclamo o sugerencia en nuestro Libro de Reclamaciones Virtual.</p>
                <span class="text-red-700 font-semibold text-sm">Registrar ahora →</span>
            </a>
            <a href="{{ route('contact') }}" class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-blue-500">
                <div class="w-14 h-14 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">☎ Contáctanos</h3>
                <p class="text-sm text-gray-600 mb-3">Teléfonos, correos electrónicos y horarios de atención al público.</p>
                <span class="text-blue-700 font-semibold text-sm">Ver contactos →</span>
            </a>
        </div>
    </div>
</section>

{{-- =====================================================
     BLOQUE 14: Datos Abiertos
     ===================================================== --}}
@if(isset($featuredDatasets) && $featuredDatasets->count() > 0)
<section class="py-16 bg-gradient-to-br from-indigo-700 to-indigo-900 text-white" aria-label="Datos abiertos">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8 items-center">
            <div class="lg:col-span-1">
                <div class="w-16 h-16 bg-white/15 backdrop-blur rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </div>
                <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2 text-sm">Datos Abiertos</p>
                <h2 class="text-3xl md:text-4xl font-bold mb-3">Información para la ciudadanía</h2>
                <p class="text-white/90 mb-6">Descarga datasets públicos en formatos abiertos (CSV, JSON, XLSX) y úsalos libremente.</p>
                <a href="{{ route('open-data.index') }}" class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold px-6 py-3 rounded-lg transition shadow-lg">
                    Explorar todos los datos
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <div class="mt-6 flex flex-wrap gap-2">
                    <span class="text-xs bg-white/15 backdrop-blur px-2 py-1 rounded font-mono">CSV</span>
                    <span class="text-xs bg-white/15 backdrop-blur px-2 py-1 rounded font-mono">JSON</span>
                    <span class="text-xs bg-white/15 backdrop-blur px-2 py-1 rounded font-mono">XLSX</span>
                    <span class="text-xs bg-white/15 backdrop-blur px-2 py-1 rounded font-mono">PDF</span>
                </div>
            </div>
            <div class="lg:col-span-2 space-y-2">
                @foreach($featuredDatasets as $dataset)
                    <div class="bg-white/10 backdrop-blur p-3 rounded-xl border border-white/20">
                        <x-dataset-mini-card :dataset="$dataset" />
                    </div>
                @endforeach
            </div>
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
            <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Liderazgo</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Gabinete Departamental</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($gabinete as $person)
            <div class="text-center">
                <div class="aspect-square w-full max-w-[160px] mx-auto bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl flex items-center justify-center text-white text-4xl font-bold shadow-md mb-3">
                    {{ strtoupper(mb_substr($person->full_name, 0, 1)) }}
                </div>
                <h3 class="text-sm font-bold text-gray-900 line-clamp-2">{{ $person->full_name }}</h3>
                <p class="text-xs text-teal-700 font-semibold mt-1 line-clamp-1">{{ $person->position ?? 'Autoridad' }}</p>
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
     BLOQUE 16: Multimedia (Galerías)
     ===================================================== --}}
@if(isset($galleries) && $galleries->count() > 0)
<section class="py-16 bg-gray-50" aria-label="Galería multimedia">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2 text-sm">Multimedia</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Galería Institucional</h2>
            </div>
            <a href="{{ route('gallery') }}" class="text-teal-700 font-semibold hover:text-teal-800 inline-flex items-center gap-1 text-sm md:text-base">
                Ver galería completa →
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
            @foreach($galleries->flatMap->items->take(6) as $item)
            <div class="aspect-square rounded-xl overflow-hidden bg-gradient-to-br from-teal-200 to-teal-100">
                @if($item->image ?? false)
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title ?? '' }}" class="w-full h-full object-cover hover:scale-110 transition" loading="lazy">
                @elseif(method_exists($item, 'getFirstMediaUrl') && $item->getFirstMediaUrl('gallery'))
                <img src="{{ $item->getFirstMediaUrl('gallery') }}" alt="{{ $item->title ?? '' }}" class="w-full h-full object-cover hover:scale-110 transition" loading="lazy">
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =====================================================
     BLOQUE 17: Newsletter / Suscripción
     ===================================================== --}}
<section class="py-16 bg-gradient-to-br from-amber-500 via-amber-600 to-amber-700 text-white" aria-label="Suscripción a noticias">
    <div class="container mx-auto px-4 max-w-3xl text-center">
        <div class="w-16 h-16 mx-auto bg-white/20 backdrop-blur rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h2 class="text-3xl md:text-4xl font-bold mb-3">Suscríbete a nuestras noticias</h2>
        <p class="text-white/90 mb-6 max-w-xl mx-auto">
            Recibe en tu correo electrónico las últimas noticias, convocatorias y eventos del Beni.
        </p>
        <form method="POST" action="#" class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto">
            @csrf
            <input type="email" name="email" required placeholder="tu@correo.com"
                   class="flex-1 px-4 py-3 rounded-xl text-gray-900 focus:ring-2 focus:ring-white focus:outline-none">
            <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white font-bold px-6 py-3 rounded-xl transition shadow-md">
                Suscribirme
            </button>
        </form>
        <p class="text-xs text-white/70 mt-3">🔒 Tus datos están protegidos. No compartimos tu correo.</p>
    </div>
</section>

{{-- =====================================================
     BLOQUE 18: Footer — manejado por layout
     ===================================================== --}}

@endsection

@section('scripts')
<script>
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
        if (slides.length <= 1) return;

        let current = 0;
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
                b.classList.toggle('md:w-8', isActive);
                b.classList.toggle('bg-white', isActive);
                b.classList.toggle('bg-white/50', !isActive);
                b.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });
            current = i;
        };
        btns.forEach((btn, idx) => btn.addEventListener('click', () => show(idx)));

        // Autoplay
        setInterval(() => show((current + 1) % slides.length), 6000);
    });
</script>
@endsection
