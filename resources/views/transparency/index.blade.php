{{--
    Vista: Portal de Transparencia — Hub principal
    Cumplimiento: RM 067/2025 — Componentes 3, 7, 8, 9, 10, 11, 12, 27
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Portal de Transparencia de la Gobernación del Beni. Presupuesto, POA, informes, rendición de cuentas, auditorías, marco normativo y contratación.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => null]
        ]" />
        <div class="flex items-start gap-3 mb-3">
            <svg class="w-10 h-10 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            <p class="font-semibold uppercase tracking-widest text-amber-300">Transparencia activa</p>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold">Portal de Transparencia</h1>
        <p class="text-white/90 mt-3 max-w-3xl">
            Acceso a la información pública de la Gobernación del Beni en cumplimiento
            de la Ley N° 164, Decreto Supremo 1793, DS 5340 y Resolución Ministerial 067/2025.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- Bloques normativos --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($marcoNormativo ?? true)
            <a href="{{ route('transparency.marco-normativo') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-teal-500">
                <div class="w-14 h-14 bg-teal-100 text-teal-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-teal-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Marco Normativo</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Leyes, decretos supremos, resoluciones y normativa departamental.
                </p>
                <p class="text-xs text-teal-700 font-semibold">{{ $marcoCount ?? 0 }} documentos publicados →</p>
            </a>
            @endif

            @if($presupuesto ?? true)
            <a href="{{ route('transparency.presupuesto') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-emerald-500">
                <div class="w-14 h-14 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Presupuesto</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Presupuesto institucional, ejecución presupuestaria y reportes financieros.
                </p>
                <p class="text-xs text-emerald-700 font-semibold">Ver detalle →</p>
            </a>
            @endif

            @if($poa ?? true)
            <a href="{{ route('transparency.poa') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-blue-500">
                <div class="w-14 h-14 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Plan Operativo Anual</h3>
                <p class="text-sm text-gray-600 mb-3">
                    POA por gestión y secretaría, con objetivos, actividades y presupuestos.
                </p>
                <p class="text-xs text-blue-700 font-semibold">Ver detalle →</p>
            </a>
            @endif

            @if($informes ?? true)
            <a href="{{ route('transparency.informes') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-purple-500">
                <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Informes de Gestión</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Informes anuales de gestión, resultados y logros alcanzados.
                </p>
                <p class="text-xs text-purple-700 font-semibold">Ver detalle →</p>
            </a>
            @endif

            @if($rendicion ?? true)
            <a href="{{ route('transparency.rendicion') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-amber-500">
                <div class="w-14 h-14 bg-amber-100 text-amber-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-amber-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Rendición de Cuentas</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Sesiones públicas de rendición de cuentas a la ciudadanía.
                </p>
                <p class="text-xs text-amber-700 font-semibold">Ver detalle →</p>
            </a>
            @endif

            @if($auditorias ?? true)
            <a href="{{ route('transparency.auditorias') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-red-500">
                <div class="w-14 h-14 bg-red-100 text-red-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-red-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Auditorías</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Informes de auditoría interna, externa y de seguimiento.
                </p>
                <p class="text-xs text-red-700 font-semibold">Ver detalle →</p>
            </a>
            @endif

            @if($convocatorias ?? true)
            <a href="{{ route('announcements.index') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-orange-500">
                <div class="w-14 h-14 bg-orange-100 text-orange-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Convocatorias</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Convocatorias públicas y procesos de contratación.
                </p>
                <p class="text-xs text-orange-700 font-semibold">Ver detalle →</p>
            </a>
            @endif

            @if($datosAbiertos ?? true)
            <a href="{{ route('open-data.index') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-indigo-500">
                <div class="w-14 h-14 bg-indigo-100 text-indigo-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Datos Abiertos</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Datasets públicos descargables en formatos abiertos.
                </p>
                <p class="text-xs text-indigo-700 font-semibold">Ver detalle →</p>
            </a>
            @endif

            <a href="{{ route('statistics') }}"
               class="group bg-white p-6 rounded-2xl shadow-sm hover:shadow-xl transition border-t-4 border-cyan-500">
                <div class="w-14 h-14 bg-cyan-100 text-cyan-700 rounded-xl flex items-center justify-center mb-4 group-hover:bg-cyan-600 group-hover:text-white transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Estadísticas</h3>
                <p class="text-sm text-gray-600 mb-3">
                    Indicadores y estadísticas departamentales.
                </p>
                <p class="text-xs text-cyan-700 font-semibold">Ver detalle →</p>
            </a>
        </div>

        {{-- Compromiso de transparencia --}}
        <div class="mt-12 bg-gradient-to-r from-teal-700 to-teal-900 rounded-2xl p-8 text-white">
            <h2 class="text-2xl font-bold mb-3">Compromiso con la Transparencia</h2>
            <p class="text-white/90 mb-4 max-w-3xl">
                La Gobernación del Beni publica de manera proactiva información
                relevante sobre su gestión, en cumplimiento de la normativa nacional
                y garantizando el derecho ciudadano de acceso a la información pública.
            </p>
            <div class="flex flex-wrap gap-3">
                <span class="text-xs bg-white/15 backdrop-blur px-3 py-1.5 rounded-full">Ley 164</span>
                <span class="text-xs bg-white/15 backdrop-blur px-3 py-1.5 rounded-full">DS 1793</span>
                <span class="text-xs bg-white/15 backdrop-blur px-3 py-1.5 rounded-full">DS 5340</span>
                <span class="text-xs bg-white/15 backdrop-blur px-3 py-1.5 rounded-full">RM 067/2025</span>
                <span class="text-xs bg-white/15 backdrop-blur px-3 py-1.5 rounded-full">RA AGETIC/0030</span>
            </div>
        </div>
    </div>
</section>
@endsection
