{{--
    Vista: Datos Abiertos — Index
    Cumplimiento: RM 067/2025, DS 5340 — Componente 20
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Portal de Datos Abiertos de la Gobernación del Beni. Descarga datasets en CSV, JSON, XLSX y PDF. Cumplimiento de transparencia activa.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-indigo-700 via-indigo-800 to-indigo-900 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => null],
            ['label' => 'Datos Abiertos', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Transparencia activa</p>
        <h1 class="text-4xl md:text-5xl font-bold">Portal de Datos Abiertos</h1>
        <p class="text-white/90 mt-3 max-w-2xl">
            Conjuntos de datos públicos de la Gobernación del Beni en formatos
            abiertos (CSV, JSON, XLSX), listos para usar y reutilizar.
        </p>
    </div>
</section>

{{-- Categorías --}}
@if(isset($categories) && $categories->count() > 0)
<section class="py-6 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('open-data.index') }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition {{ !request('categoria') ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Todos
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('open-data.index', ['categoria' => $cat]) }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition capitalize {{ request('categoria') === $cat ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                {{ $cat }}
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Datasets destacados --}}
@if(isset($featured) && $featured->count() > 0)
<section class="py-10 bg-amber-50 border-b border-amber-200">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Más descargados
        </h2>
        <div class="grid md:grid-cols-3 gap-4">
            @foreach($featured as $d)
            <a href="{{ route('open-data.show', $d->slug) }}"
               class="block bg-white p-5 rounded-xl shadow-sm border-l-4 border-amber-500 hover:shadow-md transition">
                <p class="text-xs uppercase tracking-wider text-amber-700 font-semibold mb-1">
                    {{ $d->category ?? 'Dataset' }}
                </p>
                <h3 class="font-bold text-gray-900 line-clamp-2">{{ $d->title }}</h3>
                <p class="text-xs text-gray-500 mt-2">⬇ {{ $d->download_count }} descargas</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- Buscador --}}
        <form method="GET" action="{{ route('open-data.index') }}" class="mb-8 max-w-2xl">
            <div class="relative">
                <input type="search" name="q" value="{{ request('q') }}"
                       placeholder="Buscar datasets..."
                       class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </form>

        @if($datasets->count() > 0)
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($datasets as $d)
            <a href="{{ route('open-data.show', $d->slug) }}"
               class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
                <div class="h-1.5 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between gap-2 mb-3">
                        <span class="text-xs font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded uppercase tracking-wider">
                            {{ $d->category ?? 'General' }}
                        </span>
                        @if($d->last_updated_at)
                        <span class="text-xs text-gray-500">
                            {{ $d->last_updated_at->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-700 transition line-clamp-2">
                        {{ $d->title }}
                    </h3>
                    @if($d->description)
                    <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                        {{ Str::limit($d->description, 130) }}
                    </p>
                    @endif
                    <div class="flex items-center justify-between text-xs border-t pt-3">
                        <div class="flex flex-wrap gap-1">
                            @foreach($d->format_labels ?? [] as $fmt)
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-700 rounded font-mono">{{ $fmt }}</span>
                            @endforeach
                        </div>
                        <span class="text-gray-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            {{ $d->download_count }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $datasets->links() }}
        </div>
        @else
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
            </svg>
            <p class="text-gray-500 text-lg mb-2">No hay datasets disponibles.</p>
            <a href="{{ route('open-data.index') }}" class="text-indigo-700 hover:underline">Ver todos</a>
        </div>
        @endif
    </div>
</section>
@endsection
