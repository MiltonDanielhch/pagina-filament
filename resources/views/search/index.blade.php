@extends('layouts.main')

@section('title', 'Buscar - Gobernación del Beni')

@section('content')
<section class="py-12 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Resultados de búsqueda</h1>

        @if($query)
            <p class="text-gray-600 mb-6">
                Buscando: <strong>"{{ $query }}"</strong>
                @if(isset($results['total_count']))
                    &middot; <span class="text-sm text-gray-500">{{ $results['total_count'] }} resultado(s) encontrado(s)</span>
                @endif
            </p>

            @if(isset($results['total_count']) && $results['total_count'] > 0)
                <!-- Filtros por tipo -->
                @php
                    $activeType = $results['active_type'] ?? '';
                    $types = [
                        '' => 'Todos',
                        'posts' => 'Noticias',
                        'pages' => 'Páginas',
                        'procedures' => 'Trámites',
                        'events' => 'Eventos',
                        'announcements' => 'Convocatorias',
                        'officials' => 'Autoridades',
                        'projects' => 'Proyectos',
                        'datasets' => 'Datos Abiertos',
                        'agenda' => 'Agenda',
                        'systems' => 'Sistemas',
                    ];
                @endphp

                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach($types as $key => $label)
                        @php
                            $hasResults = !$key || (isset($results[$key]) && $results[$key]->count() > 0);
                        @endphp
                        @if($hasResults)
                            <a href="{{ route('search') }}?q={{ urlencode($query) }}&type={{ $key }}"
                               class="px-4 py-2 rounded-full text-sm font-medium transition
                               {{ $activeType === $key ? 'bg-[#0a3118] text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                                {{ $label }}
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="space-y-10">
                    @foreach(['posts' => 'Noticias', 'pages' => 'Páginas', 'procedures' => 'Trámites', 'events' => 'Eventos', 'announcements' => 'Convocatorias', 'officials' => 'Autoridades', 'projects' => 'Proyectos', 'datasets' => 'Datos Abiertos', 'agenda' => 'Agenda', 'systems' => 'Sistemas y Plataformas'] as $key => $label)
                        @if(isset($results[$key]) && $results[$key] instanceof \Illuminate\Pagination\LengthAwarePaginator && $results[$key]->count() > 0)
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-xl font-semibold text-gray-800">{{ $label }}</h2>
                                    <span class="text-sm text-gray-500">{{ $results[$key]->total() }} resultado(s)</span>
                                </div>
                                <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                                    @foreach($results[$key] as $item)
                                        @php
                                            $rawText = $item->description ?? $item->excerpt ?? $item->bio ?? '';
                                            $snippet = $rawText ? \App\Http\Controllers\SearchController::snippetHighlight($rawText, $query) : '';
                                        @endphp
                                        <a href="{{ $key === 'posts' ? route('posts.show', $item->slug) : ($key === 'pages' ? route('pages.show', $item->slug) : ($key === 'procedures' ? route('procedures.show', $item->slug) : ($key === 'systems' ? $item->url : ($key === 'officials' ? '/institucional/autoridades' : '#')))) }}"
                                           @if($key === 'systems') target="_blank" @endif
                                           class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition border border-gray-100">
                                            <h3 class="text-base font-semibold text-gray-800">{!! \App\Http\Controllers\SearchController::snippetHighlight($item->title ?? $item->name, $query) !!}</h3>
                                            @if($key === 'posts' && $item->category)
                                                <span class="inline-block mt-1 px-2 py-0.5 text-xs font-semibold rounded-full {{ $item->category->color ?? 'bg-gray-100' }}">
                                                    {{ $item->category->name ?? '' }}
                                                </span>
                                            @endif
                                            @if($key === 'procedures' && $item->category)
                                                <span class="inline-block mt-1 px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-700">{{ $item->category }}</span>
                                            @endif
                                            @if($key === 'officials')
                                                <p class="text-gray-500 text-sm mt-1">{!! \App\Http\Controllers\SearchController::snippetHighlight($item->position, $query) !!}</p>
                                            @endif
                                            @if($snippet)
                                                <p class="text-gray-500 text-sm mt-1">{!! $snippet !!}</p>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                                @if(method_exists($results[$key], 'links'))
                                    <div class="mt-4">
                                        {{ $results[$key]->links() }}
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-500 text-lg">No se encontraron resultados para <strong>"{{ $query }}"</strong></p>
                    <p class="text-gray-400 text-sm mt-2">Intenta con otros términos o revisa los filtros.</p>
                </div>
            @endif

            @else
                <form action="{{ route('search') }}" method="GET" class="max-w-xl mx-auto mt-8">
                    <label for="search-input" class="block text-gray-700 font-medium mb-2">¿Qué estás buscando?</label>
                    <div class="relative">
                        <input id="search-input" type="text" name="q" placeholder="Escribe tu búsqueda..."
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#004900] focus:border-transparent"
                            value="">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-[#004900]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            @endif
    </div>
</section>
@endsection
