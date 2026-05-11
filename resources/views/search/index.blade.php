{{--
    Ubicación: resources/views/search/index.blade.php
    Descripción: Página de resultados de búsqueda. Muestra posts y
                 páginas que coinciden.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
@extends('layouts.main')

@section('title', 'Buscar - Gobernación del Beni')

@section('content')
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Resultados de búsqueda</h1>
        
        @if($query)
            <p class="text-gray-600 mb-6">Buscando: <strong>"{{ $query }}"</strong></p>
            
            @if(!empty($results['posts']) || !empty($results['pages']))
                <div class="grid gap-8 md:grid-cols-2">
                    @if(!empty($results['posts']) && $results['posts']->count() > 0)
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Noticias</h2>
                            <div class="space-y-4">
                                @foreach($results['posts'] as $post)
                                    <a href="{{ route('posts.show', $post->slug) }}" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition">
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $post->category->color ?? 'bg-gray-200' }}">
                                            {{ $post->category->name ?? 'Sin categoría' }}
                                        </span>
                                        <h3 class="text-lg font-semibold text-gray-800 mt-2">{{ $post->title }}</h3>
                                        <p class="text-gray-600 text-sm mt-1">{{ $post->excerpt }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    @if(!empty($results['pages']) && $results['pages']->count() > 0)
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Páginas</h2>
                            <div class="space-y-4">
                                @foreach($results['pages'] as $page)
                                    <a href="{{ route('pages.show', $page->slug) }}" class="block bg-white p-4 rounded-lg shadow hover:shadow-md transition">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $page->title }}</h3>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-gray-600">No se encontraron resultados para tu búsqueda.</p>
            @endif
        @else
            <form action="{{ route('search') }}" method="GET" class="max-w-xl">
                <input type="text" name="q" placeholder="¿Qué estás buscando?" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-600 focus:border-transparent"
                    value="{{ $query ?? '' }}">
                <button type="submit" class="mt-4 px-6 py-3 bg-teal-700 text-white font-semibold rounded-lg hover:bg-teal-800 transition">
                    Buscar
                </button>
            </form>
        @endif
    </div>
</section>
@endsection