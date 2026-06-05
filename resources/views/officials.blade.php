{{--
    Ubicación: resources/views/officials.blade.php
    Descripción: Directorio de funcionarios y autoridades del gobierno departamental.
                 Organigrama visual agrupado por áreas de gobierno.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 12-FUTURO.md — Directorio de funcionarios
--}}
@extends('layouts.main')

@section('title', 'Autoridades - Gobernación del Beni')
@section('description', 'Directorio de autoridades y funcionarios del gobierno departamental del Beni.')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-6xl">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Autoridades', 'url' => null]
    ]" />

    <header class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Autoridades y Funcionarios</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Conoce al equipo que impulsa el desarrollo del departamento del Beni.
        </p>
    </header>

    @forelse($sortedByArea as $areaName => $officials)
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-official">
            {{ $areaName }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($officials as $official)
            <article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <img src="{{ $official->image_url }}"
                             alt="{{ $official->name }}"
                             class="w-20 h-20 rounded-full object-cover flex-shrink-0 bg-gray-100">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-gray-800 mb-1">
                                {{ $official->name }}
                            </h3>
                            <p class="text-official font-medium mb-2">
                                {{ $official->position }}
                            </p>

                            @if($official->email)
                            <a href="mailto:{{ $official->email }}"
                               class="block text-sm text-gray-600 hover:text-official transition flex items-center gap-1 mb-1">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="truncate">{{ $official->email }}</span>
                            </a>
                            @endif

                            @if($official->phone)
                            <a href="tel:{{ $official->phone }}"
                               class="block text-sm text-gray-600 hover:text-official transition flex items-center gap-1">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $official->phone }}
                            </a>
                            @endif
                        </div>
                    </div>

                    @if($official->bio)
                    <p class="mt-4 text-sm text-gray-600 line-clamp-3">
                        {{ $official->bio }}
                    </p>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @empty
    <div class="text-center py-12 bg-gray-50 rounded-xl">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <h3 class="text-xl font-medium text-gray-700 mb-2">Sin información disponible</h3>
        <p class="text-gray-500">Próximamente-publicaremos el directorio de autoridades.</p>
    </div>
    @endforelse
</div>
@endsection
