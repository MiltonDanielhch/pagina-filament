{{--
    Ubicación: resources/views/achievements.blade.php
    Descripción: Listado de logros y resultados del gobierno departamental.
                 Incluye cards con imagen, título, descripción, área y fecha.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 12-FUTURO.md — Página de resultados del gobierno
--}}
@extends('layouts.main')

@section('title', 'Resultados y Logros - Gobernación del Beni')
@section('description', 'Conoce los principales logros y resultados del gobierno departamental del Beni.')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-6xl">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Resultados y Logros', 'url' => null]
    ]" />

    <header class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Resultados y Logros</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Conoce los principales logros y avances del gobierno departamental del Beni en beneficio de nuestra comunidad.
        </p>
    </header>

    @if($areas->isNotEmpty())
    <div class="mb-8 flex flex-wrap gap-2 justify-center">
        <span class="px-4 py-2 bg-official/10 text-official rounded-full text-sm font-medium">
            Todas las áreas
        </span>
        @foreach($areas as $area)
        <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-official/10 hover:text-official transition cursor-pointer">
            {{ $area }}
        </span>
        @endforeach
    </div>
    @endif

    @forelse($achievements as $achievement)
    <article class="bg-white rounded-xl shadow-md overflow-hidden mb-8 hover:shadow-lg transition-shadow">
        <div class="md:flex">
            @if($achievement->image)
            <div class="md:w-1/3">
                <img src="{{ $achievement->getImageUrlAttribute() }}"
                     alt="{{ $achievement->title }}"
                     class="w-full h-48 md:h-full object-cover">
            </div>
            @endif
            <div class="p-6 md:w-2/3">
                <div class="flex items-center gap-4 mb-3">
                    @if($achievement->area)
                    <span class="px-3 py-1 bg-official/10 text-official rounded-full text-sm font-medium">
                        {{ $achievement->area }}
                    </span>
                    @endif
                    @if($achievement->achieved_at)
                    <time class="text-gray-500 text-sm flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $achievement->achieved_at->format('d/m/Y') }}
                    </time>
                    @endif
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $achievement->title }}</h2>
                <p class="text-gray-600 mb-4">{{ Str::limit($achievement->description, 200) }}</p>
                <p class="text-sm text-gray-500">
                    Registrado por {{ $achievement->user->name ?? 'Administración' }}
                </p>
            </div>
        </div>
    </article>
    @empty
    <div class="text-center py-12 bg-gray-50 rounded-xl">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <h3 class="text-xl font-medium text-gray-700 mb-2">Próximamente</h3>
        <p class="text-gray-500">Estamos preparando los resultados para compartir con ustedes.</p>
    </div>
    @endforelse

    @if($achievements->hasPages())
    <div class="mt-8">
        {{ $achievements->links() }}
    </div>
    @endif
</div>
@endsection
