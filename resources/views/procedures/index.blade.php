{{--
    Vista: Catálogo de Trámites — Index
    Cumplimiento: RM 067/2025 — Componentes 13, 14
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Catálogo de trámites y servicios de la Gobernación del Beni. Requisitos, costos, plazos y enlaces a trámite en línea.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 to-teal-900 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Servicios al Ciudadano', 'url' => null],
            ['label' => 'Trámites', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Servicios al ciudadano</p>
        <h1 class="text-4xl md:text-5xl font-bold">Catálogo de Trámites</h1>
        <p class="text-white/90 mt-3 max-w-2xl">
            Encuentra todos los trámites y servicios que ofrece la Gobernación del
            Beni, con sus requisitos, costos, plazos y enlaces en línea.
        </p>
    </div>
</section>

{{-- Trámites destacados --}}
@if(isset($featured) && $featured->count() > 0)
<section class="py-12 bg-amber-50 border-b border-amber-200">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Trámites Destacados
        </h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($featured as $procedure)
            <a href="{{ route('procedures.show', $procedure->slug) }}"
               class="group bg-white p-5 rounded-xl shadow-sm hover:shadow-md border-l-4 border-amber-500 transition">
                <p class="text-xs uppercase tracking-wider text-amber-700 font-semibold mb-1">
                    {{ $procedure->code }}
                </p>
                <h3 class="font-bold text-gray-900 group-hover:text-teal-700 line-clamp-2">
                    {{ $procedure->name }}
                </h3>
                <div class="mt-3 flex items-center gap-3 text-xs text-gray-600">
                    @if($procedure->is_online)
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">En línea</span>
                    @endif
                    <span>{{ $procedure->category_label }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- Filtros --}}
        <form method="GET" action="{{ route('procedures.index') }}" class="bg-white p-4 rounded-2xl shadow-sm mb-8">
            <div class="grid md:grid-cols-3 gap-3">
                <div class="md:col-span-1">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Buscar</label>
                    <input type="search" name="q" value="{{ request('q') }}"
                           placeholder="Nombre o código..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Categoría</label>
                    <select name="categoria" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Todas</option>
                        <option value="salud" @selected(request('categoria') === 'salud')>Salud</option>
                        <option value="educacion" @selected(request('categoria') === 'educacion')>Educación</option>
                        <option value="infraestructura" @selected(request('categoria') === 'infraestructura')>Infraestructura</option>
                        <option value="catastro" @selected(request('categoria') === 'catastro')>Catastro</option>
                        <option value="impuestos" @selected(request('categoria') === 'impuestos')>Impuestos</option>
                        <option value="recursos_humanos" @selected(request('categoria') === 'recursos_humanos')>Recursos Humanos</option>
                        <option value="ganaderia" @selected(request('categoria') === 'ganaderia')>Ganadería</option>
                        <option value="mineria" @selected(request('categoria') === 'mineria')>Minería</option>
                        <option value="transporte" @selected(request('categoria') === 'transporte')>Transporte</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Modalidad</label>
                    <select name="online" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Todas</option>
                        <option value="1" @selected(request('online') === '1')>Solo en línea</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-2">
                <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-4 py-2 rounded-lg transition">
                    Aplicar filtros
                </button>
                @if(request()->hasAny(['q', 'categoria', 'online']))
                <a href="{{ route('procedures.index') }}" class="text-sm text-gray-600 hover:text-red-600">Limpiar</a>
                @endif
            </div>
        </form>

        @if($procedures->count() > 0)
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($procedures as $procedure)
            <a href="{{ route('procedures.show', $procedure->slug) }}"
               class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition overflow-hidden border border-gray-100">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <span class="text-xs font-mono font-bold text-teal-700 bg-teal-50 px-2 py-1 rounded">
                            {{ $procedure->code }}
                        </span>
                        @if($procedure->is_online)
                        <span class="inline-flex items-center gap-1 text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            En línea
                        </span>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-teal-700 transition line-clamp-2">
                        {{ $procedure->name }}
                    </h3>
                    @if($procedure->description)
                    <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                        {{ Str::limit(strip_tags($procedure->description), 120) }}
                    </p>
                    @endif
                    <div class="border-t pt-3 space-y-1.5 text-xs text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <span class="font-semibold">{{ $procedure->category_label }}</span>
                        </div>
                        @if($procedure->cost)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Costo: Bs. {{ number_format((float) $procedure->cost, 2) }}</span>
                        </div>
                        @endif
                        @if($procedure->processing_time_days)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Plazo: {{ $procedure->processing_time_days }} días</span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="px-6 py-3 bg-gray-50 border-t flex items-center justify-between text-sm font-semibold text-teal-700">
                    <span>Ver detalle</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $procedures->links() }}
        </div>
        @else
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-gray-500 text-lg mb-2">No se encontraron trámites.</p>
            <a href="{{ route('procedures.index') }}" class="text-teal-700 hover:underline">Ver todos</a>
        </div>
        @endif
    </div>
</section>
@endsection
