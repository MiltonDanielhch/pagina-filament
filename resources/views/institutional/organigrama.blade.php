{{--
    Vista: Organigrama
    Muestra la estructura jerárquica de la Gobernación
    Cumplimiento: RM 067/2025 — Componente 4
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Organigrama institucional de la Gobernación del Beni: Gobernador, Vicegobernador y Secretarías Departamentales.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'La Gobernación', 'url' => route('institutional.index')],
            ['label' => 'Organigrama', 'url' => null]
        ]" />
        <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
            <div>
                <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Estructura organizacional</p>
                <h1 class="text-4xl md:text-5xl font-bold">Organigrama Institucional</h1>
                <p class="text-white/90 mt-3 max-w-2xl">
                    La Gobernación del Beni se organiza para responder a las necesidades del
                    departamento y prestar servicios de calidad a la ciudadanía.
                </p>
            </div>
            <button onclick="window.print()" class="bg-white/20 hover:bg-white/30 backdrop-blur border border-white/30 text-white px-5 py-2.5 rounded-lg font-semibold transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Imprimir
            </button>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        {{-- Búsqueda --}}
        <div class="mb-6">
            <div class="relative max-w-md mx-auto">
                <input type="text" id="search-org" placeholder="Buscar funcionario..." 
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                       onkeyup="filterOrgChart()">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        {{-- Organigrama HTML/CSS Mejorado --}}
        @if($chartData && count($chartData) > 0)
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="orgchart-container">
                {{-- Gobernador --}}
                @if($gobernador)
                <div class="org-node org-governor" data-search="{{ strtolower($gobernador->name) }} {{ strtolower($gobernador->position) }}">
                    <div class="org-card bg-gradient-to-br from-amber-400 to-amber-600 text-white rounded-xl p-6 text-center shadow-lg">
                        <div class="w-20 h-20 bg-white/20 rounded-full mx-auto mb-3 flex items-center justify-center text-3xl font-bold">
                            {{ strtoupper(mb_substr($gobernador->name, 0, 1)) }}
                        </div>
                        <p class="text-xs uppercase tracking-wider mb-1">Gobernación</p>
                        <h3 class="text-lg font-bold">{{ $gobernador->name }}</h3>
                        <p class="text-sm opacity-90">{{ $gobernador->position }}</p>
                    </div>
                    <div class="org-connector org-connector-down"></div>
                </div>
                @endif

                {{-- Vicegobernador --}}
                @if($vicegobernador && $vicegobernador->count() > 0)
                <div class="org-nodes-row">
                    @foreach($vicegobernador as $vg)
                    <div class="org-node org-vice" data-search="{{ strtolower($vg->name) }} {{ strtolower($vg->position) }}">
                        <div class="org-connector org-connector-up"></div>
                        <div class="org-card bg-gradient-to-br from-teal-500 to-teal-700 text-white rounded-xl p-5 text-center shadow-lg">
                            <div class="w-16 h-16 bg-white/20 rounded-full mx-auto mb-2 flex items-center justify-center text-2xl font-bold">
                                {{ strtoupper(mb_substr($vg->name, 0, 1)) }}
                            </div>
                            <p class="text-xs uppercase tracking-wider mb-1">Vicegobernación</p>
                            <h3 class="text-base font-bold">{{ $vg->name }}</h3>
                            <p class="text-xs opacity-90">{{ $vg->position }}</p>
                        </div>
                        <div class="org-connector org-connector-down"></div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Línea horizontal --}}
                @if($secretarios && $secretarios->count() > 0)
                <div class="org-connector-horizontal">
                    <div class="org-connector org-connector-line"></div>
                </div>
                @endif

                {{-- Secretarios --}}
                @if($secretarios && $secretarios->count() > 0)
                <div class="org-nodes-row org-secretaries">
                    @foreach($secretarios as $sec)
                    <div class="org-node org-secretary" data-search="{{ strtolower($sec->name) }} {{ strtolower($sec->secretariat->name ?? $sec->position) }}">
                        <div class="org-connector org-connector-up"></div>
                        <div class="org-card bg-white border-2 border-teal-500 rounded-xl p-4 text-center shadow-lg hover:shadow-xl transition">
                            <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-full mx-auto mb-2 flex items-center justify-center text-xl font-bold">
                                {{ strtoupper(mb_substr($sec->name, 0, 1)) }}
                            </div>
                            <p class="text-xs uppercase tracking-wider text-teal-700 font-semibold mb-1">
                                {{ $sec->secretariat->acronym ?? 'SEC' }}
                            </p>
                            <h3 class="text-sm font-bold text-gray-900">{{ $sec->name }}</h3>
                            <p class="text-xs text-gray-600">{{ $sec->secretariat->name ?? $sec->position }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round"stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Organigrama no disponible</h3>
            <p class="text-gray-500 mb-4">No hay funcionarios registrados en el sistema.</p>
            <a href="{{ route('institutional.secretariats') }}" class="inline-block bg-teal-700 hover:bg-teal-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                Ver Secretarías
            </a>
        </div>
        @endif

        {{-- Llamado a la acción --}}
        <div class="mt-10 bg-teal-50 border border-teal-200 rounded-2xl p-6 text-center">
            <h3 class="text-lg font-bold text-gray-900 mb-2">¿Necesitas contactar a una secretaría?</h3>
            <p class="text-gray-700 mb-4">Consulta el directorio completo de secretarías y sus secretarios.</p>
            <a href="{{ route('institutional.secretariats') }}"
               class="inline-block bg-teal-700 hover:bg-teal-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                Ver Secretarías
            </a>
        </div>
    </div>
</section>

<script>
function filterOrgChart() {
    const searchTerm = document.getElementById('search-org').value.toLowerCase();
    const nodes = document.querySelectorAll('.org-node');
    
    nodes.forEach(node => {
        const searchData = node.getAttribute('data-search');
        if (searchData && searchData.includes(searchTerm)) {
            node.style.display = 'block';
        } else {
            node.style.display = 'none';
        }
    });
}
</script>

<style>
.orgchart-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.org-node {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.org-nodes-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.org-card {
    min-width: 180px;
    max-width: 220px;
}

.org-connector {
    width: 2px;
    height: 30px;
    background: linear-gradient(to bottom, #0d9488, #14b8a6);
}

.org-connector-up {
    margin-bottom: 0;
}

.org-connector-down {
    margin-top: 0;
}

.org-connector-horizontal {
    display: flex;
    justify-content: center;
    width: 100%;
}

.org-connector-line {
    width: 80%;
    height: 2px;
    background: linear-gradient(to right, #0d9488, #14b8a6);
}

.org-governor .org-card {
    min-width: 250px;
    max-width: 300px;
}

.org-secretaries {
    margin-top: 20px;
}

@media (max-width: 768px) {
    .org-nodes-row {
        flex-direction: column;
    }
    
    .org-card {
        min-width: 200px;
        max-width: 100%;
    }
}

@media print {
    .no-print {
        display: none !important;
    }
    body {
        background: white !important;
    }
    .orgchart-container {
        page-break-inside: avoid;
    }
}
</style>
@endsection
