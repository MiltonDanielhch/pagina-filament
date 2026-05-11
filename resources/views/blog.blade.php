{{--
    Ubicación: resources/views/blog.blade.php
    Descripción: Listado de todas las noticias/posts. Incluye paginación
                 y búsqueda.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
@extends('layouts.main')

@section('content')
<section class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Noticias</h1>
    
    @if($posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-center mb-2">
                    <span class="text-sm text-gray-500">{{ $post->category->name ?? 'Sin categoría' }}</span>
                    <span class="mx-2">-</span>
                    <span class="text-sm text-gray-500">{{ $post->published_at->format('d/m/Y') }}</span>
                </div>
                <h2 class="text-xl font-bold mb-2">
                    <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-amber-600">
                        {{ $post->title }}
                    </a>
                </h2>
                @if($post->excerpt)
                <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                @endif
                <a href="{{ route('posts.show', $post->slug) }}" class="text-amber-600 hover:text-amber-700 font-medium">
                    Leer más
                </a>
            </div>
        </article>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
    @else
    <p class="text-gray-600">No hay noticias publicadas.</p>
    @endif
</section>
@endsection