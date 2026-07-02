@extends('layouts.main')

@section('seo')
    <meta name="description" content="Gaceta Jurídica Departamental del Beni — Publicación oficial de Leyes, Decretos, Resoluciones y normativa departamental.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-emerald-700 to-emerald-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Gaceta Jurídica', 'url' => null],
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Gaceta Jurídica Departamental</p>
        <h1 class="text-3xl md:text-4xl font-bold">Gaceta del Beni</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Publicación oficial de Leyes, Decretos, Resoluciones y normativa del Gobierno Autónomo Departamental del Beni.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sections as $slug => $section)
            <a href="{{ route('gaceta.show', $slug) }}"
               class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $section['icon'] }}"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-emerald-700 transition-colors">{{ $section['title'] }}</h2>
                <p class="text-sm text-gray-500 leading-relaxed">{{ Str::limit($section['description'], 120) }}</p>
                <span class="inline-flex items-center text-emerald-600 font-semibold text-sm mt-3 group-hover:gap-2 transition-all">
                    Ver publicaciones
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </span>
            </a>
            @endforeach
        </div>

        <div class="mt-12 bg-emerald-50 border border-emerald-200 rounded-2xl p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4 md:gap-6">
                <div class="w-14 h-14 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-emerald-900 text-lg">Gaceta Jurídica Departamental</h3>
                    <p class="text-sm text-emerald-800 mt-1">
                        Es el instrumento informativo que tiene por objeto publicar de manera permanente las Leyes Departamentales, Decretos Departamentales y de Gobernación, Resoluciones de Gobernación y Administrativas y todo otro documento de carácter general que emita el Gobierno Autónomo Departamental del Beni.
                    </p>
                </div>
                <a href="https://gaceta.beni.gob.bo" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2.5 rounded-lg transition-colors flex-shrink-0 whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Ir a Gaceta
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
