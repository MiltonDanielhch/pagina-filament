{{--
    Vista: Plan Operativo Anual (POA)
    Cumplimiento: RM 067/2025 — Componente 8
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Plan Operativo Anual (POA) de la Gobernación del Beni. Objetivos, actividades y presupuesto por secretaría.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-blue-700 to-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => route('transparency.index')],
            ['label' => 'POA', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Planificación operativa</p>
        <h1 class="text-3xl md:text-4xl font-bold">Plan Operativo Anual</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Instrumento de gestión que articula las actividades, recursos y metas
            de cada secretaría para una gestión por resultados.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-blue-100 text-blue-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">POA por Gestión</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                Los documentos del Plan Operativo Anual son elaborados y aprobados
                al inicio de cada gestión fiscal. Consulta la planificación vigente.
            </p>
            <a href="https://transparencia.beni.gob.bo" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Ver en el Portal de Transparencia
            </a>
        </div>

        {{-- Secretarías --}}
        <div class="mt-8">
            <h2 class="text-xl font-bold text-gray-900 mb-4">POA por secretaría</h2>
            <div class="grid sm:grid-cols-2 gap-3">
                <a href="{{ route('institutional.secretariats') }}"
                   class="bg-white p-4 rounded-xl border border-gray-200 hover:border-blue-500 hover:shadow transition flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                        </svg>
                    </div>
                    <span class="font-semibold text-gray-900">Ver todas las secretarías</span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
