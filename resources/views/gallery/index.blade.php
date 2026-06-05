@extends('layouts.main')

@section('title', 'Galería Multimedia - Gobernación del Beni')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-teal-800 mb-8">Galería Multimedia</h1>

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex flex-wrap gap-4 items-center">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo</label>
                <select id="typeFilter" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    <option value="all" {{ $type === 'all' ? 'selected' : '' }}>Todos</option>
                    <option value="photo" {{ $type === 'photo' ? 'selected' : '' }}>Fotos</option>
                    <option value="video" {{ $type === 'video' ? 'selected' : '' }}>Videos</option>
                    <option value="mixed" {{ $type === 'mixed' ? 'selected' : '' }}>Mixto</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Año</label>
                <select id="yearFilter" class="border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    <option value="all" {{ $year === 'all' ? 'selected' : '' }}>Todos</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Grid de galerías -->
    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galleries as $gallery)
                <a href="{{ route('gallery.show', $gallery->slug) }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $gallery->cover_url }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @if($gallery->is_featured)
                                <span class="absolute top-2 right-2 bg-amber-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                    Destacado
                                </span>
                            @endif
                            <span class="absolute top-2 left-2 bg-teal-600 text-white px-2 py-1 rounded text-xs font-semibold">
                                {{ $gallery->type === 'photo' ? 'Fotos' : ($gallery->type === 'video' ? 'Videos' : 'Mixto') }}
                            </span>
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 group-hover:text-teal-600 transition-colors">
                                {{ $gallery->title }}
                            </h3>
                            @if($gallery->description)
                                <p class="text-gray-600 text-sm mb-2 line-clamp-2">
                                    {{ Str::limit(strip_tags($gallery->description), 100) }}
                                </p>
                            @endif
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                @if($gallery->event_date)
                                    <span>{{ $gallery->event_date->format('d/m/Y') }}</span>
                                @endif
                                <span>{{ $gallery->item_count }} ítems</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $galleries->appends(['type' => $type, 'year' => $year])->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No se encontraron galerías.</p>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeFilter = document.getElementById('typeFilter');
        const yearFilter = document.getElementById('yearFilter');

        function updateUrl() {
            const type = typeFilter.value;
            const year = yearFilter.value;
            const url = new URL(window.location);
            url.searchParams.set('type', type);
            url.searchParams.set('year', year);
            window.location = url;
        }

        typeFilter.addEventListener('change', updateUrl);
        yearFilter.addEventListener('change', updateUrl);
    });
</script>
@endsection
