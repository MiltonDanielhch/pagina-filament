{{--
    Vista: Presupuesto Institucional
    Cumplimiento: RM 067/2025 — Componente 7
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Presupuesto institucional de la Gobernación del Beni. Ingresos, gastos e inversión pública.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => route('transparency.index')],
            ['label' => 'Presupuesto', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Transparencia presupuestaria</p>
        <h1 class="text-3xl md:text-4xl font-bold">Presupuesto Institucional</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Información presupuestaria por gestión fiscal: ingresos, gastos e inversión.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Información Presupuestaria</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                El detalle del presupuesto institucional aprobado, su ejecución y
                documentación soporte se publica periódicamente.
            </p>
            <a href="https://transparencia.beni.gob.bo" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Portal de Transparencia (SICOES / SIGEP)
            </a>
        </div>

        {{-- Datos de contacto --}}
        <div class="mt-8 bg-emerald-50 border border-emerald-200 rounded-2xl p-6">
            <h3 class="font-bold text-emerald-900 mb-2">¿Necesitas información presupuestaria específica?</h3>
            <p class="text-sm text-emerald-800 mb-3">
                Puedes solicitar información detallada a la Secretaría Departamental de Hacienda.
            </p>
            <a href="{{ route('contact') }}" class="text-emerald-700 font-semibold text-sm hover:text-emerald-800">
                Contactar a Hacienda →
            </a>
        </div>
    </div>
</section>
@endsection
