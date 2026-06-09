{{--
    Vista: Convocatorias — Index
    Cumplimiento: RM 067/2025 — Componentes 11, 28
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Convocatorias públicas y procesos de contratación de la Gobernación del Beni. Oportunidades laborales, consultorías y compras estatales.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-amber-600 to-amber-800 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => null],
            ['label' => 'Convocatorias', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-200 mb-2">Transparencia y contratación</p>
        <h1 class="text-4xl md:text-5xl font-bold">Convocatorias y Contratación</h1>
        <p class="text-white/90 mt-3 max-w-2xl">
            Publicación de oportunidades laborales, consultorías y procesos de
            contratación de la Gobernación Autónoma del Beni.
        </p>
    </div>
</section>

{{-- Convocatorias abiertas --}}
@if(isset($open) && $open->count() > 0)
<section class="py-10 bg-amber-50 border-b border-amber-200">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <span class="inline-block w-3 h-3 rounded-full bg-red-500 animate-pulse"></span>
            Convocatorias Abiertas
        </h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($open as $a)
            <a href="{{ route('announcements.show', $a->slug) }}"
               class="block bg-white p-5 rounded-xl shadow-sm border-l-4 border-red-500 hover:shadow-md transition">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-mono text-gray-500">{{ $a->code }}</span>
                    <span class="text-xs px-2 py-0.5 rounded-full
                        @switch($a->status)
                            @case('publicada') bg-blue-100 text-blue-700 @break
                            @case('en_proceso') bg-yellow-100 text-yellow-700 @break
                            @default bg-gray-100 text-gray-700
                        @endswitch
                    ">
                        {{ $a->status_label }}
                    </span>
                </div>
                <h3 class="font-bold text-gray-900 line-clamp-2 mb-2">{{ $a->title }}</h3>
                @if($a->closing_date)
                <p class="text-xs text-red-600 font-semibold">
                    ⏰ Cierra: {{ $a->closing_date->format('d/m/Y H:i') }}
                </p>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- Filtros --}}
        <form method="GET" action="{{ route('announcements.index') }}" class="bg-white p-4 rounded-2xl shadow-sm mb-8">
            <div class="grid md:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Tipo</label>
                    <select name="tipo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="">Todos</option>
                        <option value="convocatoria_publica" @selected(request('tipo') === 'convocatoria_publica')>Convocatoria Pública</option>
                        <option value="contratacion" @selected(request('tipo') === 'contratacion')>Contratación</option>
                        <option value="consultoria" @selected(request('tipo') === 'consultoria')>Consultoría</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Estado</label>
                    <select name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        <option value="">Activas y finalizadas</option>
                        <option value="publicada" @selected(request('estado') === 'publicada')>Publicada</option>
                        <option value="en_proceso" @selected(request('estado') === 'en_proceso')>En proceso</option>
                        <option value="finalizada" @selected(request('estado') === 'finalizada')>Finalizada</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                        Filtrar
                    </button>
                </div>
            </div>
            @if(request()->hasAny(['tipo', 'estado']))
            <div class="mt-3">
                <a href="{{ route('announcements.index') }}" class="text-sm text-gray-600 hover:text-red-600">Limpiar filtros</a>
            </div>
            @endif
        </form>

        @if($announcements->count() > 0)
        <div class="space-y-4">
            @foreach($announcements as $a)
            <article class="bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                <div class="grid md:grid-cols-12 gap-0">
                    <div class="md:col-span-2 bg-gradient-to-br from-amber-500 to-amber-700 text-white p-6 flex flex-col items-center justify-center text-center">
                        <p class="text-3xl font-bold">{{ $a->publication_date->format('d') }}</p>
                        <p class="text-sm uppercase tracking-wider">{{ $a->publication_date->translatedFormat('M') }}</p>
                        <p class="text-xs mt-2 opacity-80">{{ $a->publication_date->format('Y') }}</p>
                    </div>
                    <div class="md:col-span-10 p-6">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="text-xs font-mono text-gray-500 bg-gray-100 px-2 py-0.5 rounded">{{ $a->code }}</span>
                            <span class="text-xs px-2 py-0.5 rounded-full
                                @switch($a->status)
                                    @case('publicada') bg-blue-100 text-blue-700 @break
                                    @case('en_proceso') bg-yellow-100 text-yellow-700 @break
                                    @case('finalizada') bg-green-100 text-green-700 @break
                                    @case('desierta') bg-red-100 text-red-700 @break
                                    @default bg-gray-100 text-gray-700
                                @endswitch
                            ">
                                {{ $a->status_label }}
                            </span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-amber-50 text-amber-700">
                                {{ $a->type_label }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-amber-700">
                            <a href="{{ route('announcements.show', $a->slug) }}">{{ $a->title }}</a>
                        </h3>
                        @if($a->description)
                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">
                            {{ Str::limit(strip_tags($a->description), 200) }}
                        </p>
                        @endif
                        <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                            @if($a->closing_date)
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Cierra: {{ $a->closing_date->format('d/m/Y H:i') }}
                            </span>
                            @endif
                            @if($a->secretariat)
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                                </svg>
                                {{ $a->secretariat->name }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $announcements->links() }}
        </div>
        @else
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            <p class="text-gray-500 text-lg mb-2">No hay convocatorias activas en este momento.</p>
            <a href="{{ route('announcements.index') }}" class="text-amber-700 hover:underline">Ver convocatorias finalizadas</a>
        </div>
        @endif
    </div>
</section>
@endsection
