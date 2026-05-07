@extends('layouts.main')

@section('content')
<section class="container mx-auto px-4 py-12">
    <div class="mb-8">
        <nav class="text-sm text-gray-500 mb-4">
            <a href="/" class="hover:text-official">Inicio</a> / 
            <a href="/blog" class="hover:text-official">Noticias</a> / 
            <span class="text-gray-700">{{ $category->name }}</span>
        </nav>
        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $category->name }}</h1>
        @if($category->description)
        <p class="text-gray-600 text-lg">{{ $category->description }}</p>
        @endif
    </div>
    
    @if($posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            @if($post->getFirstMediaUrl('images'))
            <a href="{{ route('posts.show', $post->slug) }}">
                <img src="{{ $post->getFirstMediaUrl('images', 'medium') }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
            </a>
            @endif
            <div class="p-6">
                <div class="flex items-center mb-2">
                    <span class="text-sm text-gray-500">{{ $post->category->name ?? 'Sin categoría' }}</span>
                    <span class="mx-2">-</span>
                    <span class="text-sm text-gray-500">{{ $post->published_at->format('d/m/Y') }}</span>
                </div>
                <h2 class="text-xl font-bold mb-2">
                    <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-official">
                        {{ $post->title }}
                    </a>
                </h2>
                @if($post->excerpt)
                <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                @endif
                <a href="{{ route('posts.show', $post->slug) }}" class="text-official hover:text-official-light font-medium">
                    Leer más →
                </a>
            </div>
        </article>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
    @else
    <div class="text-center py-12 bg-gray-50 rounded-xl">
        <p class="text-gray-500 text-lg">No hay noticias en esta categoría.</p>
        <a href="/blog" class="btn-primary mt-4 inline-block">Ver todas las noticias</a>
    </div>
    @endif
</section>
@endsection