{{--
    Vista: Oficinas de Atención al Ciudadano
    Cumplimiento: RM 067/2025 — Componente 21
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Directorio de oficinas y puntos de atención al ciudadano de la Gobernación del Beni. Ubicación, horarios y servicios disponibles.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 to-teal-900 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Servicios al Ciudadano', 'url' => null],
            ['label' => 'Oficinas de Atención', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Atención presencial</p>
        <h1 class="text-4xl md:text-5xl font-bold">Oficinas y Puntos de Atención</h1>
        <p class="text-white/90 mt-3 max-w-2xl">
            Encuentra la oficina más cercana a tu municipio y conoce los servicios
            que ofrece, sus horarios y datos de contacto.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        @if($offices->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($offices as $office)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
                <div class="h-2 bg-gradient-to-r from-teal-500 to-teal-700"></div>
                <div class="p-6">
                    <div class="flex items-start gap-3 mb-3">
                        <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-bold text-gray-900 line-clamp-2">{{ $office->name }}</h3>
                            @if($office->municipality)
                            <p class="text-xs text-teal-700 font-semibold mt-1">
                                📍 {{ $office->municipality }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <ul class="space-y-2 text-sm text-gray-700 border-t pt-3">
                        @if($office->address)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>{{ $office->address }}</span>
                        </li>
                        @endif
                        @if($office->phone)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', $office->phone) }}" class="hover:text-teal-700">{{ $office->phone }}</a>
                        </li>
                        @endif
                        @if($office->email)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $office->email }}" class="hover:text-teal-700 truncate">{{ $office->email }}</a>
                        </li>
                        @endif
                        @if($office->schedule)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ $office->schedule }}</span>
                        </li>
                        @endif
                    </ul>

                    @if($office->has_coordinates)
                    <a href="https://www.google.com/maps?q={{ $office->latitude }},{{ $office->longitude }}" target="_blank" rel="noopener"
                       class="mt-4 inline-flex items-center gap-1 text-sm text-teal-700 font-semibold hover:text-teal-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        Ver en mapa
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            </svg>
            <p class="text-gray-500 text-lg mb-2">No hay oficinas registradas.</p>
            <p class="text-sm text-gray-400">Pronto agregaremos más puntos de atención.</p>
        </div>
        @endif
    </div>
</section>
@endsection
