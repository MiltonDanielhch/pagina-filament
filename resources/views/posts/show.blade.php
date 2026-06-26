{{--
    Ubicación: resources/views/posts/show.blade.php
    Descripción: Detalle de un post/noticia individual optimizado.
    Accesibilidad: Cumple con contraste 4.5:1, etiquetas semánticas y enfoque claro.
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
@extends('layouts.main')

@section('title', $post->meta_title ?? $post->title)
@section('description', $post->meta_description ?? $post->excerpt)

@section('seo')
<meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
<meta property="og:description" content="{{ $post->meta_description ?? $post->excerpt }}">
<meta property="og:type" content="article">
<meta property="article:published_time" content="{{ $post->published_at }}">
<meta property="article:author" content="{{ $post->user->name ?? 'Gobernación del Beni' }}">
@if($post->category)
<meta property="article:section" content="{{ $post->category->name }}">
@endif
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $post->meta_title ?? $post->title }}">
<meta name="twitter:description" content="{{ $post->meta_description ?? $post->excerpt }}">
@endsection

@section('content')
<article class="container mx-auto px-4 py-8 md:py-12 max-w-4xl animate-fade-in">
    
    <div class="mb-6 text-sm text-gray-600 prose-a:text-gray-600 hover:prose-a:text-[#0a3118]">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Noticias', 'url' => '/blog'],
            ['label' => Str::limit($post->title, 40), 'url' => null]
        ]" />
    </div>
    
    @if($post->getFirstMedia('featured'))
    <div class="w-full aspect-video rounded-2xl overflow-hidden shadow-md mb-8 border border-gray-100">
        <img src="{{ $post->getFirstMedia('featured')->getUrl('large') }}" 
             alt="{{ $post->title }}" 
             class="w-full h-full object-cover transition-transform duration-500 hover:scale-[1.01]">
    </div>
    @endif
    
    <h1 class="text-2xl md:text-4xl font-bold mb-5 text-[#0a3118] leading-tight tracking-tight">
        {{ $post->title }}
    </h1>
    
    <div class="flex flex-wrap items-center gap-y-3 gap-x-4 mb-8 pb-6 border-b border-gray-100 text-xs md:text-sm text-gray-600">
        @if($post->category)
        <span class="bg-[#0a3118]/10 text-[#0a3118] font-semibold px-3 py-1 rounded-full">
            {{ $post->category->name }}
        </span>
        @endif
        
        <div class="flex items-center gap-1.5">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <time datetime="{{ $post->published_at }}">{{ $post->published_at->format('d/m/Y') }}</time>
        </div>

        <div class="flex items-center gap-1.5">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span>Por {{ $post->user->name ?? 'Administración' }}</span>
        </div>

        <div class="flex items-center gap-1.5 bg-gray-50 px-2.5 py-1 rounded-lg border border-gray-100">
            <svg class="w-4 h-4 text-[#0a3118]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            <span class="font-medium text-gray-700">{{ number_format($post->view_count) }} visitas</span>
        </div>
    </div>
    
    @if($post->excerpt)
    <div class="text-lg md:text-xl font-medium text-gray-600 leading-relaxed mb-8 italic border-l-4 border-[#E5B225] pl-4">
        {{ $post->excerpt }}
    </div>
    @endif
    
    <div class="prose prose-flat max-w-none text-gray-800 leading-relaxed prose-headings:text-[#0a3118] prose-a:text-amber-600 hover:prose-a:text-amber-700 focus-within:prose-a:underline">
        {!! $post->body !!}
    </div>
    
    <div class="mt-12 pt-6 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        
        @if($post->category)
        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Archivado en:</span>
            <a href="{{ route('posts.category', $post->category->slug) }}"
               class="text-sm font-medium text-amber-600 hover:text-amber-700 bg-amber-50 px-3 py-1 rounded-md transition-colors border border-amber-100">
                {{ $post->category->name }}
            </a>
        </div>
        @endif

        <div class="flex items-center gap-2">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400 mr-1">Compartir:</span>
            
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
               target="_blank" rel="noopener noreferrer" aria-label="Compartir en Facebook"
               class="p-2.5 bg-[#1877F2] text-white rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.603c0-3.014 1.825-4.679 4.532-4.679 1.313 0 2.703.235 2.703.235v2.965h-1.524c-1.501 0-1.973.934-1.973 1.893v2.27h3.328l-.527 3.497h-2.801v8.637C19.613 23.027 24 17.062 24 12.073z"/></svg>
            </a>
            
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->meta_title ?? $post->title) }}&url={{ urlencode(url()->current()) }}"
               target="_blank" rel="noopener noreferrer" aria-label="Compartir en X"
               class="p-2.5 bg-gray-900 text-white rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
            </a>
            
            <a href="https://wa.me/?text={{ urlencode(($post->meta_title ?? $post->title) . ' ' . url()->current()) }}"
               target="_blank" rel="noopener noreferrer" aria-label="Compartir en WhatsApp"
               class="p-2.5 bg-[#25D366] text-white rounded-xl shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </a>
        </div>

    </div>
</article>
@endsection