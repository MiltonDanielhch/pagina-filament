@extends('layouts.main')

@section('seo')
    <meta name="description" content="Servicios digitales de la Gobernación Autónoma Departamental del Beni. Accede a todos los sistemas y plataformas digitales disponibles.">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Servicios Digitales - Gobernación del Beni">
    <meta property="og:description" content="Accede a todos los sistemas y plataformas digitales de la Gobernación del Beni.">
@endsection

@section('content')
<section class="relative bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="container mx-auto px-4 relative">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Servicios al Ciudadano', 'url' => null]
        ]" />
        <div class="max-w-3xl">
            <p class="font-semibold uppercase tracking-widest text-amber-300 mb-3">Servicios al Ciudadano</p>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">Servicios Digitales</h1>
            <p class="text-xl text-white/90 leading-relaxed">
                Accede a todos los sistemas y plataformas digitales de la Gobernación del Beni
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($systems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($systems as $system)
                    <a href="{{ $system->url }}" target="_blank" rel="noopener noreferrer" 
                       class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-teal-300">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-[#2d6a4f] to-[#1b4332] rounded-xl flex items-center justify-center text-white group-hover:scale-110 transition-transform duration-300">
                                @if($system->icon)
                                    <span class="text-2xl">{{ $system->icon }}</span>
                                @else
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-teal-700 transition">
                                    {{ $system->name }}
                                </h3>
                                @if($system->description)
                                    <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                                        {{ $system->description }}
                                    </p>
                                @endif
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center gap-1 text-xs font-medium {{ $system->isOnline() ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }} px-2 py-1 rounded-full">
                                        <span class="w-2 h-2 rounded-full {{ $system->isOnline() ? 'bg-green-500' : 'bg-red-500' }} animate-pulse"></span>
                                        {{ $system->isOnline() ? 'En línea' : 'Fuera de línea' }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        {{ $system->last_checked_at ? $system->last_checked_at->diffForHumans() : 'Sin verificar' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">No hay sistemas disponibles</h3>
                <p class="text-gray-600">Por el momento no hay sistemas externos registrados.</p>
            </div>
        @endif
    </div>
</section>
@endsection
