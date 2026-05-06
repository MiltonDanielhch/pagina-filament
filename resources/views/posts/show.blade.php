@extends('layouts.main')

@section('content')
<article class="container mx-auto px-4 py-12 max-w-4xl">
    <div class="mb-8">
        <a href="/blog" class="text-amber-600 hover:text-amber-700">
            ← Volver a noticias
        </a>
    </div>
    
    <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ $post->title }}</h1>
    
    <div class="flex items-center mb-8 text-gray-600">
        <span>{{ $post->category->name ?? 'Sin categoría' }}</span>
        <span class="mx-2">-</span>
        <span>{{ $post->published_at->format('d/m/Y') }}</span>
        <span class="mx-2">-</span>
        <span>Por {{ $post->user->name ?? 'Administración' }}</span>
    </div>
    
    @if($post->excerpt)
    <div class="text-xl text-gray-600 mb-8 pb-8 border-b">
        {{ $post->excerpt }}
    </div>
    @endif
    
    <div class="prose prose-lg max-w-none">
        {!! $post->body !!}
    </div>
    
    <!-- Tags -->
    @if($post->category)
    <div class="mt-12 pt-8 border-t">
        <span class="text-gray-600">Categoría:</span>
        <a href="{{ route('posts.category', $post->category->slug) }}" 
           class="ml-2 text-amber-600 hover:text-amber-700">
            {{ $post->category->name }}
        </a>
    </div>
    @endif
</article>
@endsection