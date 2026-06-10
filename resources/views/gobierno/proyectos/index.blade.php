{{--
    Vista: Proyectos de Inversión — Index
    Cumplimiento: RM 067/2025 — Bloque B4
    Ruta: /gobierno/proyectos  (route: gobierno.proyectos.index)
--}}
@extends('layouts.main')

@section('seo')
    @php
        $total = $stats['total'] ?? 0;
        $inProgress = $stats['in_progress'] ?? 0;
        $completed  = $stats['completed'] ?? 0;
        $budgetTotal = $stats['budget_total'] ?? 0;
    @endphp
    <meta name="description" content="Cartera de proyectos de inversión pública de la Gobernación del Beni. {{ $total }} proyectos registrados, {{ $inProgress }} en ejecución y {{ $completed }} concluidos. Avance físico, presupuesto y beneficiarios.">
    <meta property="og:title" content="Proyectos de Inversión — Gobernación del Beni">
    <meta property="og:description" content="Cartera de proyectos de inversión pública del Gobierno Autónomo Departamental del Beni.">
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "ItemList",
        "name": "Proyectos de Inversión del Beni",
        "itemListElement": {!! $itemListJson !!}
    }
    </script>
@endsection

@section('content')
{{-- HERO --}}
<section class="bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0 50 L100 50 M50 0 L50 100" stroke="currentColor" stroke-width="0.5"/>
        </svg>
    </div>
    <div class="container mx-auto px-4 relative">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Gobierno', 'url' => null],
            ['label' => 'Proyectos de Inversión', 'url' => null]
        ]" />

        <div class="grid lg:grid-cols-2 gap-8 items-end">
            <div>
                <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2 text-sm">Gobierno · Inversión pública</p>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">Proyectos de Inversión</h1>
                <p class="text-white/90 mt-3 max-w-2xl">
                    Conoce la cartera de proyectos de inversión pública que ejecuta la Gobernación del
                    Beni en los 19 municipios del departamento. Obras de salud, educación,
                    infraestructura vial, agua, saneamiento, energía y desarrollo productivo.
                </p>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <div class="bg-white/10 backdrop-blur rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-amber-300">{{ $total }}</p>
                    <p class="text-xs text-white/80 uppercase tracking-wider mt-1">Proyectos</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-amber-300">{{ $inProgress }}</p>
                    <p class="text-xs text-white/80 uppercase tracking-wider mt-1">En ejecución</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-4 text-center">
                    <p class="text-3xl font-bold text-amber-300">{{ $completed }}</p>
                    <p class="text-xs text-white/80 uppercase tracking-wider mt-1">Concluidos</p>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-xl p-4 text-center">
                    <p class="text-2xl md:text-3xl font-bold text-amber-300">Bs. {{ number_format((float) $budgetTotal, 0, ',', '.') }}</p>
                    <p class="text-xs text-white/80 uppercase tracking-wider mt-1">Inversión total</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FILTROS --}}
<section class="py-8 bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('gobierno.proyectos.index') }}" class="bg-gray-50 p-4 rounded-2xl border border-gray-200">
            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-3">
                <div class="lg:col-span-2">
                    <label for="q" class="block text-xs font-semibold text-gray-600 mb-1">Buscar</label>
                    <input type="search" id="q" name="q" value="{{ request('q') }}"
                           placeholder="Nombre, código, municipio..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div>
                    <label for="estado" class="block text-xs font-semibold text-gray-600 mb-1">Estado</label>
                    <select id="estado" name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Todos</option>
                        @foreach(\App\Models\InfrastructureProject::statuses() as $key => $label)
                            <option value="{{ $key }}" @selected(request('estado') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="categoria" class="block text-xs font-semibold text-gray-600 mb-1">Categoría</label>
                    <select id="categoria" name="categoria" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Todas</option>
                        @foreach(\App\Models\InfrastructureProject::categories() as $key => $label)
                            <option value="{{ $key }}" @selected(request('categoria') === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="municipio" class="block text-xs font-semibold text-gray-600 mb-1">Municipio</label>
                    <select id="municipio" name="municipio" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Todos</option>
                        @foreach($municipalities as $mun)
                            <option value="{{ $mun }}" @selected(request('municipio') === $mun)>{{ \Illuminate\Support\Str::headline(str_replace('_', ' ', $mun)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-2">
                <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white font-semibold px-4 py-2 rounded-lg transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Aplicar filtros
                </button>
                @if(request()->hasAny(['q', 'estado', 'categoria', 'municipio']))
                    <a href="{{ route('gobierno.proyectos.index') }}" class="text-gray-600 hover:text-gray-900 text-sm underline">Limpiar filtros</a>
                @endif
                <span class="ml-auto text-sm text-gray-500">{{ $projects->total() }} resultados</span>
            </div>
        </form>
    </div>
</section>

{{-- MAPA --}}
@if(isset($mapProjects) && $mapProjects->count() > 0)
<section class="py-8 bg-gray-50 border-b border-gray-200" id="mapa-proyectos">
    <div class="container mx-auto px-4">
        <div class="flex items-end justify-between mb-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Ubicación geográfica
                </h2>
                <p class="text-sm text-gray-600">Distribución territorial de los proyectos de inversión en el departamento del Beni.</p>
            </div>
        </div>
        <div id="map" class="w-full h-96 rounded-2xl border border-gray-200 shadow-sm bg-white" role="region" aria-label="Mapa de proyectos"></div>
    </div>
</section>
@endif

{{-- LISTADO --}}
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($projects as $project)
                    <x-project-card :project="$project" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $projects->withQueryString()->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-1">No se encontraron proyectos</h3>
                <p class="text-sm text-gray-500 mb-4">Intenta ajustar los filtros o volver al listado completo.</p>
                <a href="{{ route('gobierno.proyectos.index') }}" class="text-teal-700 hover:text-teal-800 font-semibold underline">Ver todos los proyectos</a>
            </div>
        @endif
    </div>
</section>
@endsection

{{-- Script del mapa Leaflet --}}
@if(isset($mapProjects) && $mapProjects->count() > 0)
@verbatim
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof L === 'undefined') return;

    const map = L.map('map').setView([-14.5, -65.5], 7);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap',
        maxZoom: 18,
    }).addTo(map);

    const projects = @json($mapProjects);
    const colors = { planificacion: '#2563eb', ejecucion: '#f59e0b', concluido: '#16a34a', paralizado: '#dc2626' };
    const markers = [];

    projects.forEach(function (p) {
        if (!p.lat || !p.lng) return;
        const color = colors[p.status] || '#6b7280';
        const icon = L.divIcon({
            className: 'custom-marker',
            html: '<div style="background-color:' + color + ';width:24px;height:24px;border-radius:50%;border:3px solid white;box-shadow:0 2px 6px rgba(0,0,0,.4);"></div>',
            iconSize: [24, 24],
            iconAnchor: [12, 12],
        });
        const m = L.marker([p.lat, p.lng], { icon: icon }).addTo(map);
        const url = p.url;
        const title = p.title;
        const muni = p.municipality ? p.municipality.replace(/_/g, ' ') : '';
        const budget = p.budget ? Number(p.budget).toLocaleString('es-BO') : '';
        const popup = '<div style="min-width:200px">'
            + '<p style="font-size:10px;text-transform:uppercase;color:#6b7280;margin:0 0 4px">' + (p.category || '') + '</p>'
            + '<strong style="display:block;margin-bottom:6px">' + title + '</strong>'
            + (muni ? '<p style="font-size:12px;color:#6b7280;margin:0 0 6px">' + muni + '</p>' : '')
            + (budget ? '<p style="font-size:12px;margin:0 0 6px">Bs. ' + budget + '</p>' : '')
            + '<a href="' + url + '" style="color:#0f766e;font-weight:600;font-size:12px">Ver detalle →</a>'
            + '</div>';
        m.bindPopup(popup);
        markers.push(m);
    });

    if (markers.length > 0) {
        const group = L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.15));
    }
});
</script>
@endverbatim
@endif
