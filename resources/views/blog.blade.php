@extends('layouts.main')

@section('seo')
    <meta name="description" content="Noticias y comunicados oficiales de la Gobernación Autónoma Departamental del Beni. Mantente informado sobre las últimas actividades gubernamentales, proyectos, eventos y noticias relevantes para los ciudadanos del Beni, Bolivia.">
@endsection

@section('content')
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Noticias', 'url' => null]
        ]" />
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Noticias</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Mantente informado sobre las últimas actividades gubernamentales, proyectos, eventos y noticias relevantes para los ciudadanos del Beni.</p>
        </div>
    
    @if($posts->count() > 0)
    
    @if($pinnedPost)
    <div class="mb-12">
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-shadow">
            @if($pinnedPost->getFirstMedia('featured'))
            <a href="{{ route('posts.show', $pinnedPost->slug) }}">
                <img src="{{ $pinnedPost->getFirstMedia('featured')->getUrl('large') }}" 
                     alt="{{ $pinnedPost->title }}" 
                     class="w-full h-64 md:h-96 object-cover">
            </a>
            @endif
            <div class="p-6 md:p-8">
                <div class="flex items-center mb-3">
                    <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full">Destacado</span>
                    <span class="mx-2 text-gray-400">•</span>
                    <span class="text-sm text-gray-500">{{ $pinnedPost->category->name ?? 'Sin categoría' }}</span>
                    <span class="mx-2 text-gray-400">•</span>
                    <span class="text-sm text-gray-500">{{ $pinnedPost->published_at->format('d/m/Y') }}</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold mb-3">
                    <a href="{{ route('posts.show', $pinnedPost->slug) }}" class="hover:text-amber-600">
                        {{ $pinnedPost->title }}
                    </a>
                </h2>
                @if($pinnedPost->excerpt)
                <p class="text-gray-600 mb-4 text-lg">{{ $pinnedPost->excerpt }}</p>
                @endif
                <a href="{{ route('posts.show', $pinnedPost->slug) }}" class="inline-flex items-center gap-2 text-amber-600 hover:text-amber-700 font-semibold">
                    Leer más
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </article>
    </div>
    @endif
    
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Todas las Noticias</h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <article class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow hover:-translate-y-1 duration-300">
            @if($post->getFirstMedia('featured'))
            <a href="{{ route('posts.show', $post->slug) }}">
                <img src="{{ $post->getFirstMedia('featured')->getUrl('medium') }}" 
                     alt="{{ $post->title }}" 
                     class="w-full h-48 object-cover">
            </a>
            @endif
            <div class="p-6">
                <div class="flex items-center mb-3">
                    <span class="text-sm text-gray-500">{{ $post->category->name ?? 'Sin categoría' }}</span>
                    <span class="mx-2 text-gray-400">•</span>
                    <span class="text-sm text-gray-500">{{ $post->published_at->format('d/m/Y') }}</span>
                </div>
                <h2 class="text-xl font-bold mb-2">
                    <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-amber-600">
                        {{ $post->title }}
                    </a>
                </h2>
                @if($post->excerpt)
                <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                @endif
                <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-2 text-amber-600 hover:text-amber-700 font-semibold">
                    Leer más
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </article>
        @endforeach
    </div>
    
    <div class="mt-12 flex justify-center">
        {{ $posts->links() }}
    </div>
    @else
    <div class="text-center py-16">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
        <p class="text-gray-600 text-lg">No hay noticias publicadas en este momento.</p>
    </div>
    @endif
    </div>
</section>
@endsection