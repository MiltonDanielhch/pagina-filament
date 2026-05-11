{{--
    Ubicación: resources/views/pages/show.blade.php
    Descripción: Detalle de página estática. Renderiza contenido Tiptap,
                 meta tags dinámicos y Open Graph.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
@extends('layouts.main')

@section('title', $page->meta_title ?? $page->title)
@section('description', $page->meta_description ?? Str::limit(strip_tags($page->content), 160))

@section('seo')
<meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
<meta property="og:description" content="{{ $page->meta_description ?? Str::limit(strip_tags($page->content), 160) }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $page->meta_title ?? $page->title }}">
<meta name="twitter:description" content="{{ $page->meta_description ?? Str::limit(strip_tags($page->content), 160) }}">
@endsection

@section('content')
<article class="container mx-auto px-4 py-12 max-w-4xl">
    <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ $page->title }}</h1>
    
    <div class="prose prose-lg max-w-none">
        {!! $page->content !!}
    </div>
</article>
@endsection