{{--
    Vista: Marco Normativo — Listado
    Cumplimiento: RM 067/2025 — Componentes 3, 27
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Marco normativo de la Gobernación del Beni: Leyes, decretos supremos, resoluciones y normativa departamental aplicable.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 to-teal-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => route('transparency.index')],
            ['label' => 'Marco Normativo', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Base legal</p>
        <h1 class="text-3xl md:text-4xl font-bold">Marco Normativo</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Leyes, decretos, resoluciones y demás normativa que rige el funcionamiento
            de la Gobernación del Beni.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- Filtros --}}
        <form method="GET" action="{{ route('transparency.marco-normativo') }}" class="bg-white p-4 rounded-2xl shadow-sm mb-8">
            <div class="grid md:grid-cols-4 gap-3">
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Buscar</label>
                    <input type="search" name="q" value="{{ request('q') }}"
                           placeholder="Título, número o palabra clave..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Tipo</label>
                    <select name="tipo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Todos</option>
                        <option value="ley" @selected(request('tipo') === 'ley')>Ley</option>
                        <option value="decreto_supremo" @selected(request('tipo') === 'decreto_supremo')>Decreto Supremo</option>
                        <option value="decreto" @selected(request('tipo') === 'decreto')>Decreto</option>
                        <option value="resolución" @selected(request('tipo') === 'resolución')>Resolución</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Ámbito</label>
                    <select name="ambito" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Todos</option>
                        <option value="nacional" @selected(request('ambito') === 'nacional')>Nacional</option>
                        <option value="departamental" @selected(request('ambito') === 'departamental')>Departamental</option>
                    </select>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-2">
                <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-4 py-2 rounded-lg transition">
                    Buscar
                </button>
                @if(request()->hasAny(['q', 'tipo', 'ambito']))
                <a href="{{ route('transparency.marco-normativo') }}" class="text-sm text-gray-600 hover:text-red-600">Limpiar</a>
                @endif
            </div>
        </form>

        @if($normas->count() > 0)
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <ul class="divide-y divide-gray-200">
                @foreach($normas as $norma)
                <li class="p-5 hover:bg-gray-50 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 flex-shrink-0 rounded-lg flex items-center justify-center text-white font-bold
                            @switch($norma->type)
                                @case('ley') bg-purple-600 @break
                                @case('decreto_supremo') bg-blue-600 @break
                                @case('decreto') bg-cyan-600 @break
                                @case('resolución') bg-emerald-600 @break
                                @default bg-gray-600
                            @endswitch
                        ">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                <span class="text-xs font-bold uppercase tracking-wider text-gray-700">
                                    {{ $norma->type_label }} @if($norma->number)N° {{ $norma->number }}@endif
                                </span>
                                <span class="text-xs px-2 py-0.5 rounded-full
                                    {{ $norma->scope === 'nacional' ? 'bg-blue-100 text-blue-700' : 'bg-teal-100 text-teal-700' }}">
                                    {{ ucfirst($norma->scope) }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">
                                {{ $norma->title }}
                            </h3>
                            @if($norma->summary)
                            <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ $norma->summary }}</p>
                            @endif
                            <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500">
                                <span>📅 {{ $norma->issue_date->format('d/m/Y') }}</span>
                                @if($norma->document_file)
                                <a href="{{ asset('storage/' . $norma->document_file) }}" target="_blank"
                                   class="text-teal-700 hover:text-teal-800 font-semibold">
                                    📄 Descargar PDF
                                </a>
                                @endif
                                @if($norma->external_url)
                                <a href="{{ $norma->external_url }}" target="_blank" rel="noopener"
                                   class="text-teal-700 hover:text-teal-800 font-semibold">
                                    🔗 Ver fuente original
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-8">
            {{ $normas->links() }}
        </div>
        @else
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
            </svg>
            <p class="text-gray-500 text-lg mb-2">No se encontraron normas con los filtros aplicados.</p>
            <a href="{{ route('transparency.marco-normativo') }}" class="text-teal-700 hover:underline">Ver todas las normas</a>
        </div>
        @endif
    </div>
</section>
@endsection
