{{--
    Vista: Informes de Gestión
    Cumplimiento: RM 067/2025 — Componente 9
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Informes de gestión de la Gobernación del Beni. Resultados y logros de cada período de gobierno.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-purple-700 to-purple-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => route('transparency.index')],
            ['label' => 'Informes de Gestión', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Resultados y logros</p>
        <h1 class="text-3xl md:text-4xl font-bold">Informes de Gestión</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Documentos que detallan los resultados, avances y logros alcanzados
            en cada período de gestión institucional.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-purple-100 text-purple-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Documentos de gestión</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Los informes de gestión se publican al cierre de cada período y son
                insumos fundamentales para la rendición pública de cuentas.
            </p>
            <a href="{{ route('transparency.rendicion') }}"
               class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white font-bold px-6 py-3 rounded-lg transition">
                Ver Rendición de Cuentas
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
@endsection
