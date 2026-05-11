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
            <img src="{{ $slide->image }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>
        </div>
        @endforeach
    </div>
    <div class="absolute inset-0 flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                @foreach($slides as $index => $slide)
                <div class="text-white {{ $index === 0 ? '' : 'hidden' }}" data-slide-content="{{ $index }}">
                    @if($slide->description)
                    <p class="text-official-light font-semibold mb-2 uppercase tracking-wider">{{ $slide->description }}</p>
                    @endif
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">{{ $slide->title }}</h1>
                    @if($slide->link)
                    <a href="{{ $slide->link }}" class="btn-primary inline-flex items-center gap-2 mt-4">
                        Ver más <span>→</span>
                    </a>
                    @endif
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
                    @if($post->getFirstMediaUrl('images'))
                    <img src="{{ $post->getFirstMediaUrl('images', 'medium') }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
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

<!-- About Section - Mission/Vision -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-official font-semibold uppercase tracking-wider mb-2">Sobre Nosotros</p>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Construyendo el futuro del Beni</h2>
                <p class="text-gray-600 text-lg mb-8">
                    En el corazón de la Amazonía boliviana, la Gobernación del Departamento del Beni se erige como el motor del progreso y el bienestar de nuestra gente. 
                    Somos la institución pública que lidera la administración y el desarrollo autónomo de este vasto y diverso territorio.
                </p>
                
                <!-- Tabs: Mission/Vision -->
                <div class="space-y-4" x-data="{ tab: 'mision' }">
                    <div class="flex gap-4 border-b">
                        <button @click="tab = 'mision'" class="pb-3 px-4 font-semibold transition border-b-2" :class="tab === 'mision' ? 'border-official text-official' : 'border-transparent text-gray-500'">Misión</button>
                        <button @click="tab = 'vision'" class="pb-3 px-4 font-semibold transition border-b-2" :class="tab === 'vision' ? 'border-official text-official' : 'border-transparent text-gray-500'">Visión</button>
                    </div>
                    <div x-show="tab === 'mision'" class="text-gray-600">
                        Ser el <strong>Gobierno Autónomo Departamental del Beni</strong> que, con transparencia y eficiencia, impulsa el desarrollo integral del departamento, promoviendo el bienestar de su población, la protección de su medio ambiente y la consolidación de su identidad cultural.
                    </div>
                    <div x-show="tab === 'vision'" class="text-gray-600" x-cloak>
                        Consolidar al Beni como un departamento líder en desarrollo sostenible, con una economía diversificada, infraestructura moderna, servicios básicos de calidad y un fuerte compromiso con la preservación de su riqueza natural y cultural.
                    </div>
                </div>
            </div>
            <div class="relative">
                <!-- Imagen institucional del Beni -->
                <img src="https://tse4.mm.bing.net/th/id/OIP._-jB-IGPqj7kVbnZgh4xcQHaHa?r=0&s=1&pid=ImgDetMain&o=7&rm=3" alt="Escudo del Beni" class="rounded-2xl shadow-2xl w-full object-contain bg-white p-8">
                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-official/10 rounded-full -z-10"></div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-official/20 rounded-full -z-10"></div>
            </div>
        </div>
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
@endsection