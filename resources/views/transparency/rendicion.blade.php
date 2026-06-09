{{--
    Vista: Rendición Pública de Cuentas
    Cumplimiento: RM 067/2025 — Componente 10
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Sesiones públicas de Rendición de Cuentas de la Gobernación del Beni. Videos, actas y presentaciones.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-amber-600 to-amber-800 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Transparencia', 'url' => route('transparency.index')],
            ['label' => 'Rendición de Cuentas', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-200 mb-2">Diálogo con la ciudadanía</p>
        <h1 class="text-3xl md:text-4xl font-bold">Rendición Pública de Cuentas</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Espacios de diálogo y presentación pública de los resultados de la
            gestión institucional ante la ciudadanía.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-amber-100 text-amber-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Sesiones de Rendición</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                La Gobernación del Beni realiza audiencias públicas de rendición de
                cuentas, con transmisión en vivo, presentación de resultados y
                recepción de consultas ciudadanas.
            </p>
            <a href="https://www.facebook.com/profile.php?id=61589790584981" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white font-bold px-6 py-3 rounded-lg transition">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.637H7.078v-3.497h3.047V9.603c0-3.014 1.825-4.679 4.532-4.679 1.313 0 2.703.235 2.703.235v2.965h-1.524c-1.501 0-1.973.934-1.973 1.893v2.27h3.328l-.527 3.497h-2.801v8.637C19.613 23.027 24 17.062 24 12.073z"/>
                </svg>
                Ver transmisiones en Facebook
            </a>
        </div>

        <div class="mt-8 bg-amber-50 border border-amber-200 rounded-2xl p-6">
            <h3 class="font-bold text-amber-900 mb-2">Próxima sesión</h3>
            <p class="text-sm text-amber-800">
                Las fechas de las audiencias públicas de rendición de cuentas se
                anuncian con anticipación en este portal y en nuestras redes sociales.
            </p>
        </div>
    </div>
</section>
@endsection
