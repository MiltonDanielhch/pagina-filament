{{--
    Vista: Secretarías Departamentales — Listado
    Cumplimiento: RM 067/2025 — Componente 24
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Conoce las Secretarías Departamentales del Beni: Salud, Educación, Obras Públicas, Producción y más. Información de contacto y responsables.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 to-teal-900 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'La Gobernación', 'url' => route('institutional.index')],
            ['label' => 'Secretarías Departamentales', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Estructura orgánica</p>
        <h1 class="text-4xl md:text-5xl font-bold">Secretarías Departamentales</h1>
        <p class="text-white/90 mt-3 max-w-2xl">
            Las áreas estratégicas que ejecutan las políticas públicas y los planes
            del Gobierno Autónomo Departamental del Beni.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- Buscador --}}
        <form method="GET" action="{{ route('institutional.secretariats') }}" class="mb-8 max-w-2xl mx-auto">
            <div class="relative">
                <input type="search" name="q" value="{{ request('q') }}"
                       placeholder="Buscar secretaría por nombre o siglas..."
                       class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm">
                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                @if(request('q'))
                <a href="{{ route('institutional.secretariats') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-gray-500 hover:text-red-600">
                    Limpiar
                </a>
                @endif
            </div>
        </form>

        @if($secretariats->count() > 0)
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($secretariats as $secretariat)
            <a href="{{ route('institutional.secretariats.show', $secretariat->slug) }}"
               class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden border border-gray-100">
                <div class="h-2" style="background-color: {{ $secretariat->color ?? '#0d9488' }}"></div>
                <div class="p-6">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-14 h-14 flex-shrink-0 rounded-xl flex items-center justify-center text-white text-xl font-bold shadow-md"
                             style="background-color: {{ $secretariat->color ?? '#0d9488' }}">
                            {{ $secretariat->acronym ?? mb_substr($secretariat->name, 0, 2) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs uppercase tracking-wider text-gray-500 font-semibold">
                                {{ $secretariat->acronym }}
                            </p>
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-teal-700 transition line-clamp-2">
                                {{ $secretariat->name }}
                            </h3>
                        </div>
                    </div>
                    @if($secretariat->description)
                    <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                        {{ Str::limit($secretariat->description, 140) }}
                    </p>
                    @endif
                    @if($secretariat->head)
                    <div class="flex items-center gap-2 text-sm text-gray-700 border-t pt-3">
                        <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="truncate">{{ $secretariat->head->full_name }}</span>
                    </div>
                    @endif
                    <div class="mt-4 flex items-center text-teal-700 text-sm font-semibold opacity-0 group-hover:opacity-100 transition">
                        Ver detalle →
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <p class="text-gray-500 text-lg mb-2">No se encontraron secretarías.</p>
            @if(request('q'))
            <a href="{{ route('institutional.secretariats') }}" class="text-teal-700 hover:underline">Ver todas</a>
            @endif
        </div>
        @endif
    </div>
</section>
@endsection
