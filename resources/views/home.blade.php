{{--
    Ubicación: resources/views/home.blade.php
    Descripción: Homepage del sitio. Carga slides del slider, posts recientes
                 en grid, categorías y badges de sistemas externos.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
@extends('layouts.main')

@section('content')
<!-- Hero Banner / Slider -->
@if($slides->count() > 0)
<section class="relative h-[500px] md:h-[600px]">
    <div class="absolute inset-0">
        @foreach($slides as $index => $slide)
        <div class="absolute inset-0 transition-opacity duration-700 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-slide="{{ $index }}">
            <img src="{{ $slide->getFirstMediaUrl('slides') ?: $slide->image }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>
        </div>
        @endforeach
    </div>
    <div class="absolute inset-0 flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                @foreach($slides as $index => $slide)
                <div class="text-white {{ $index === 0 ? '' : 'hidden' }}" data-slide-content="{{ $index }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Slide Indicators -->
    @if($slides->count() > 1)
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
        @foreach($slides as $index => $slide)
        <button data-slide-btn="{{ $index }}" class="w-3 h-3 rounded-full transition-all {{ $index === 0 ? 'bg-white w-8' : 'bg-white/50 hover:bg-white/70' }}"></button>
        @endforeach
    </div>
    @endif
</section>
@else
<!-- Default Hero if no slides -->
<section class="relative h-[400px] bg-gradient-to-br from-official to-official-light flex items-center">
    <div class="absolute inset-0 bg-pattern opacity-20"></div>
    <div class="container mx-auto px-4">
        <div class="max-w-3xl text-white">
            <p class="font-semibold mb-2 uppercase tracking-wider">Gobierno Autónomo Departamental</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Gobernación Autónoma Departamental del Beni
            </h1>
            <p class="text-xl opacity-90 mb-6">Comprometidos con el desarrollo integral de nuestro departamento</p>
            <div class="flex gap-4">
                <a href="/blog" class="btn-primary">Ver Noticias</a>
                <a href="/contacto" class="bg-white/20 hover:bg-white/30 backdrop-blur text-white px-6 py-3 rounded-lg font-semibold transition">Contacto</a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Últimas Noticias -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <div>
                <p class="text-official font-semibold uppercase tracking-wider mb-2">Últimas Noticias</p>
                <h2 class="text-4xl font-bold text-gray-900">Noticias del Beni</h2>
            </div>
            <a href="/blog" class="link-official hidden md:inline-flex">Ver todas las noticias</a>
        </div>

        @if($latestPosts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestPosts as $post)
            <article class="card-article">
                <a href="{{ route('posts.show', $post->slug) }}">
                    @if($post->getFirstMedia('featured'))
                    <img src="{{ $post->getFirstMedia('featured')->getUrl('medium') }}" alt="{{ $post->title }}" class="w-full h-48 object-cover" loading="lazy">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-official/20 to-official/5 flex items-center justify-center">
                        <svg class="w-12 h-12 text-official/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    @endif
                </a>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="badge-official">{{ $post->category->name ?? 'General' }}</span>
                        <span class="text-gray-400 text-sm">{{ $post->published_at->format('d/m/Y') }}</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2 line-clamp-2">
                        <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-official transition">
                            {{ $post->title }}
                        </a>
                    </h3>
                    @if($post->excerpt)
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $post->excerpt }}</p>
                    @endif
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-official font-medium text-sm inline-flex items-center gap-1 hover:gap-2 transition-all">
                        Leer más <span>→</span>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        @if($latestPosts->count() > 3)
        <div class="text-center mt-8 md:hidden">
            <a href="/blog" class="btn-secondary">Ver todas las noticias</a>
        </div>
        @endif
        @else
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <p class="text-gray-500">No hay noticias publicadas actualmente.</p>
            <a href="/blog" class="btn-primary mt-4 inline-block">Ver noticias anteriores</a>
        </div>
        @endif
    </div>
</section>

<!-- Categories / Áreas de Trabajo -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-official font-semibold uppercase tracking-wider mb-2">Áreas de Trabajo</p>
            <h2 class="text-4xl font-bold text-gray-900">Nuestros Ejes de Gestión</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="{{ route('posts.category', $category->slug) }}"
               class="group bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all hover:-translate-y-1"
               style="border-top: 4px solid {{ $category->color }}">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" :style="'background-color: ' + '{{ $category->color }}20'">
                    @switch($category->slug)
                        @case('salud')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        @case('infraestructura')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        @case('cultura')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        @case('educacion')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        @default
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @endswitch
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-official transition">{{ $category->name }}</h3>
                <p class="text-gray-600 text-sm">{{ $category->description }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- About Section - Mission/Vision -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-official font-semibold uppercase tracking-wider mb-2">Sobre Nosotros</p>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $aboutSettings['title'] }}</h2>
                <p class="text-gray-600 text-lg mb-8">
                    {!! $aboutSettings['description'] !!}
                </p>
                
                <!-- Tabs: Mission/Vision -->
                <div class="space-y-6" x-data="{ tab: 'mision' }">
                    <div class="flex gap-2 border-b border-gray-200">
                        <button @click="tab = 'mision'" class="flex items-center gap-2 pb-3 px-6 font-semibold transition border-b-2 rounded-t-lg" :class="tab === 'mision' ? 'border-official bg-official/5 text-official' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Misión
                        </button>
                        <button @click="tab = 'vision'" class="flex items-center gap-2 pb-3 px-6 font-semibold transition border-b-2 rounded-t-lg" :class="tab === 'vision' ? 'border-official bg-official/5 text-official' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Visión
                        </button>
                    </div>
                    <div x-show="tab === 'mision'" class="p-6 bg-gray-50 rounded-xl border-l-4 border-official">
                        <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Nuestra Misión
                        </h3>
                        <div class="text-gray-600 leading-relaxed">
                            {!! $aboutSettings['mission'] !!}
                        </div>
                    </div>
                    <div x-show="tab === 'vision'" class="p-6 bg-gray-50 rounded-xl border-l-4 border-blue-500" x-cloak>
                        <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Nuestra Visión
                        </h3>
                        <div class="text-gray-600 leading-relaxed">
                            {!! $aboutSettings['vision'] !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <!-- Imagen institucional del Beni -->
                @if($aboutSettings['image'])
                <img src="{{ $aboutSettings['image'] }}" alt="Imagen institucional de la Gobernación del Beni mostrando el edificio principal" class="rounded-2xl shadow-2xl w-full object-cover" loading="lazy">
                @endif
                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-official/10 rounded-full -z-10"></div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-official/20 rounded-full -z-10"></div>
            </div>
        </div>
    </div>
</section>

<!-- Próximos Eventos Destacados -->
@if($featuredEvents->count() > 0)
<section class="py-16 bg-official text-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-12">
            <div>
                <p class="font-semibold uppercase tracking-wider mb-2 opacity-80">Próximos Eventos</p>
                <h2 class="text-4xl font-bold">Eventos Destacados</h2>
            </div>
            <a href="{{ route('events') }}" class="text-white/80 hover:text-white transition hidden md:inline-flex">Ver todos los eventos →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredEvents as $event)
            <div class="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/20 hover:bg-white/20 transition">
                <div class="text-center mb-4">
                    <div class="text-3xl font-bold">{{ $event->starts_at->format('d') }}</div>
                    <div class="text-sm uppercase opacity-80">{{ $event->starts_at->format('M') }}</div>
                </div>
                <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                @if($event->location)
                <p class="text-sm opacity-80 mb-2">📍 {{ $event->location }}</p>
                @endif
                <p class="text-sm opacity-80">{{ $event->starts_at->format('H:i') }}</p>
            </div>
            @endforeach
        </div>

        @if($featuredEvents->count() > 3)
        <div class="text-center mt-8 md:hidden">
            <a href="#" class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg font-semibold transition inline-block">Ver todos los eventos</a>
        </div>
        @endif
    </div>
</section>
@endif

<!-- External Systems -->
<section class="py-16 bg-official text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold">Servicios Digitales</h2>
            <p class="opacity-80 mt-2">Accede a nuestros sistemas en línea</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($externalSystems as $system)
            <a href="{{ $system->url }}" target="_blank" 
               class="bg-white/10 hover:bg-white/20 backdrop-blur rounded-xl p-6 text-center transition-all group border border-white/20 hover:border-white/40">
                <div class="flex justify-center mb-3">
                    @if($system->last_status === 'online')
                    <span class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>
                    @elseif($system->last_status === 'offline')
                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                    @else
                    <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                    @endif
                </div>
                <h3 class="text-lg font-bold mb-1">{{ $system->name }}</h3>
                <p class="text-sm opacity-80">{{ $system->description }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Nuestro Territorio -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-official font-semibold uppercase tracking-wider mb-2">Nuestro Territorio</p>
            <h2 class="text-4xl font-bold text-gray-900">Departamento del Beni</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">El Beni es el departamento más grande de Bolivia, ubicado en la región amazónica, con una extensión de 213.564 km² y rica biodiversidad.</p>
        </div>
        <div class="max-w-6xl mx-auto">
            <div class="rounded-2xl overflow-hidden shadow-2xl">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3181533!2d-66.5!3d-14.5!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91e3d0d0d0d0d0d%3A0x0!2sBeni+Department%2C+Bolivia!5e0!3m2!1ses!2sbo!4v1717497600&z=6"
                    width="100%"
                    height="500"
                    style="border:0; aspect-ratio: 16/9;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-official">213.564</div>
                    <div class="text-sm text-gray-600">km² de extensión</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-official">8</div>
                    <div class="text-sm text-gray-600">provincias</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-official">48</div>
                    <div class="text-sm text-gray-600">municipios</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-official">~500K</div>
                    <div class="text-sm text-gray-600">habitantes</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visítanos -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-official font-semibold uppercase tracking-wider mb-2">Visítanos</p>
            <h2 class="text-4xl font-bold text-gray-900">Sede Principal - Trinidad</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Visita nuestra sede principal en la ciudad de Trinidad, capital del departamento del Beni.</p>
        </div>
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3890.123456789!2d-64.9!3d-14.83333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91e3d0d0d0d0d0d%3A0x0!2sTrinidad%2C+Beni+Department%2C+Bolivia!5e0!3m2!1ses!2sbo!4v1717497600"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="space-y-6">
                    <div class="bg-white rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Información de Contacto</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-official flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Dirección</p>
                                    <p class="text-gray-600">Plaza Principal 6 de Agosto, Trinidad, Beni, Bolivia</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-official flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Teléfono</p>
                                    <p class="text-gray-600">(591) 346-21651</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-official flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Email</p>
                                    <p class="text-gray-600">gobernador@beni.gob.bo</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <svg class="w-6 h-6 text-official flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900">Horario de Atención</p>
                                    <p class="text-gray-600">Lunes a Viernes: 8:00 - 16:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="https://maps.google.com/?q=Trinidad+Beni+Bolivia" target="_blank" class="btn-primary inline-flex items-center gap-2 w-full justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                        Abrir en Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Slider automático
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('[data-slide]');
        const contents = document.querySelectorAll('[data-slide-content]');
        const buttons = document.querySelectorAll('[data-slide-btn]');
        
        if (slides.length > 1) {
            let currentSlide = 0;
            const interval = 5000; // 5 segundos
            
            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                });
                
                contents.forEach((content, i) => {
                    content.classList.toggle('hidden', i !== index);
                });
                
                buttons.forEach((btn, i) => {
                    btn.classList.toggle('bg-white', i === index);
                    btn.classList.toggle('w-8', i === index);
                    btn.classList.toggle('bg-white/50', i !== index);
                    btn.classList.toggle('w-3', i !== index);
                });
            }
            
            // Auto-rotar
            setInterval(() => {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }, interval);
            
            // Click en botones
            buttons.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });
        }
    });
</script>
@endsection