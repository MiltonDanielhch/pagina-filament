@extends('layouts.main')

@section('title', $gallery->title . ' - Gobernación del Beni')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-8 text-sm">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('home') }}" class="text-teal-600 hover:text-teal-800">Inicio</a></li>
            <li class="text-gray-400">/</li>
            <li><a href="{{ route('gallery') }}" class="text-teal-600 hover:text-teal-800">Galería</a></li>
            <li class="text-gray-400">/</li>
            <li class="text-gray-600">{{ $gallery->title }}</li>
        </ol>
    </nav>

    <!-- Header de la galería -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h1 class="text-3xl font-bold text-teal-800 mb-2">{{ $gallery->title }}</h1>
                @if($gallery->description)
                    <p class="text-gray-600">{{ $gallery->description }}</p>
                @endif
            </div>
            @if($gallery->is_featured)
                <span class="bg-amber-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    Destacado
                </span>
            @endif
        </div>
        <div class="flex items-center gap-4 text-sm text-gray-500">
            @if($gallery->event_date)
                <span><strong>Fecha:</strong> {{ $gallery->event_date->format('d/m/Y') }}</span>
            @endif
            <span><strong>Tipo:</strong> {{ $gallery->type === 'photo' ? 'Fotos' : ($gallery->type === 'video' ? 'Videos' : 'Mixto') }}</span>
            <span><strong>Ítems:</strong> {{ $gallery->item_count }}</span>
        </div>
    </div>

    <!-- Grid de ítems -->
    @if($gallery->items->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($gallery->items as $item)
                @if($item->type === 'image')
                    <!-- Imagen con lightbox -->
                    <div class="relative group cursor-pointer" onclick="openLightbox('{{ $item->image_url }}', '{{ $item->caption ?? '' }}')">
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->title ?? $item->caption ?? '' }}" 
                             class="w-full h-64 object-cover rounded-lg shadow-md group-hover:shadow-xl transition-shadow duration-300">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                @elseif($item->type === 'video' && $item->youtube_id)
                    <!-- Video de YouTube -->
                    <div class="relative rounded-lg shadow-md overflow-hidden">
                        <iframe 
                            src="https://www.youtube.com/embed/{{ $item->youtube_id }}" 
                            class="w-full h-64"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <p class="text-gray-500 text-lg">Esta galería no tiene ítems aún.</p>
        </div>
    @endif
</div>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4" onclick="closeLightbox()">
    <button class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300">&times;</button>
    <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain">
    <div id="lightbox-caption" class="absolute bottom-4 left-4 right-4 text-white text-center"></div>
</div>

<script>
    function openLightbox(imageUrl, caption) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        const lightboxCaption = document.getElementById('lightbox-caption');
        
        lightboxImage.src = imageUrl;
        lightboxCaption.textContent = caption || '';
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Cerrar con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>
@endsection
