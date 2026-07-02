@extends('layouts.main')

@section('seo')
    <meta name="description" content="{{ $section['description'] }}">
@endsection

@section('content')
<section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Gaceta Jurídica', 'url' => route('gaceta.index')],
            ['label' => $section['title'], 'url' => null],
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Gaceta Jurídica Departamental</p>
        <h1 class="text-3xl md:text-4xl font-bold">{{ $section['title'] }}</h1>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $section['icon'] }}"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $section['title'] }}</h2>
            <p class="text-gray-600 mb-6 max-w-2xl mx-auto leading-relaxed">
                {{ $section['description'] }}
            </p>
            <a href="https://gaceta.beni.gob.bo" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Ver en Gaceta Oficial
            </a>
        </div>

        <div class="mt-8 bg-emerald-50 border border-emerald-200 rounded-2xl p-6">
            <h3 class="font-bold text-emerald-900 mb-2">¿Buscas una norma específica?</h3>
            <p class="text-sm text-emerald-800 mb-3">
                Todas las publicaciones oficiales están disponibles en la Gaceta Jurídica Departamental del Beni.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('gaceta.index') }}"
                   class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold text-sm hover:text-emerald-800">
                    ← Todas las categorías
                </a>
                <a href="https://gaceta.beni.gob.bo" target="_blank"
                   class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold text-sm hover:text-emerald-800">
                    Ir a Gaceta
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
