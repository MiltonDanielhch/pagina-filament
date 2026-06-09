{{--
    Vista: Auditorías
    Cumplimiento: RM 067/2025 — Componente 12
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Informes de auditoría interna, externa y de seguimiento de la Gobernación del Beni.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-red-700 to-red-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => route('transparency.index')],
            ['label' => 'Auditorías', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Control y fiscalización</p>
        <h1 class="text-3xl md:text-4xl font-bold">Auditorías</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Informes de auditoría interna, externa y de seguimiento realizados a
            la gestión institucional.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-red-100 text-red-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Tipos de auditoría</h2>
            <p class="text-gray-600 mb-6">
                La Gobernación del Beni es auditada por:
            </p>
            <div class="grid sm:grid-cols-3 gap-3 text-left">
                <div class="bg-red-50 p-4 rounded-lg">
                    <p class="font-bold text-red-900 text-sm">Auditoría Interna</p>
                    <p class="text-xs text-red-700 mt-1">Unidad de Auditoría Interna del GAD Beni</p>
                </div>
                <div class="bg-red-50 p-4 rounded-lg">
                    <p class="font-bold text-red-900 text-sm">Contraloría General</p>
                    <p class="text-xs text-red-700 mt-1">Auditorías externas del Estado</p>
                </div>
                <div class="bg-red-50 p-4 rounded-lg">
                    <p class="font-bold text-red-900 text-sm">Auditoría Externa</p>
                    <p class="text-xs text-red-700 mt-1">Firmas privadas especializadas</p>
                </div>
            </div>
        </div>

        <div class="mt-8 bg-red-50 border border-red-200 rounded-2xl p-6">
            <h3 class="font-bold text-red-900 mb-2">Acceso a informes</h3>
            <p class="text-sm text-red-800 mb-3">
                Los informes de auditoría pueden consultarse en el Portal de
                Transparencia y en la Contraloría General del Estado.
            </p>
            <a href="https://www.contraloria.gob.bo" target="_blank" rel="noopener"
               class="text-red-700 font-semibold text-sm hover:text-red-800">
                Ir a Contraloría General del Estado →
            </a>
        </div>
    </div>
</section>
@endsection
