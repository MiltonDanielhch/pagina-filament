{{--
    Vista: Institucional — Index
    Reseña histórica de la Gobernación del Beni
    Cumplimiento: RM 067/2025 — Componentes 1, 2, 3
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Conoce la historia, misión, visión y objetivos de la Gobernación Autónoma Departamental del Beni. Más de 180 años de servicio al pueblo beniano.">
@endsection

@section('content')
{{-- Hero Institucional --}}
<section class="relative bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white py-20 overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-pattern"></div>
    <div class="container mx-auto px-4 relative">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'La Gobernación', 'url' => null]
        ]" />
        <div class="max-w-3xl">
            <p class="font-semibold uppercase tracking-widest text-amber-300 mb-3">Sobre nosotros</p>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">La Gobernación del Beni</h1>
            <p class="text-xl text-white/90 leading-relaxed">
                Más de 180 años trabajando por el desarrollo integral del departamento,
                respetando su identidad cultural y potenciando su riqueza natural.
            </p>
        </div>
    </div>
</section>

{{-- Estadísticas rápidas --}}
<section class="py-10 bg-white border-b">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-4">
                <div class="text-3xl md:text-4xl font-bold text-teal-700">{{ $stats['municipalities'] ?? 19 }}</div>
                <div class="text-sm text-gray-600 mt-1">Municipios</div>
            </div>
            <div class="p-4">
                <div class="text-3xl md:text-4xl font-bold text-teal-700">{{ $stats['secretariats'] ?? 0 }}</div>
                <div class="text-sm text-gray-600 mt-1">Secretarías</div>
            </div>
            <div class="p-4">
                <div class="text-3xl md:text-4xl font-bold text-teal-700">{{ $stats['authorities'] ?? 0 }}</div>
                <div class="text-sm text-gray-600 mt-1">Funcionarios</div>
            </div>
            <div class="p-4">
                <div class="text-3xl md:text-4xl font-bold text-teal-700">1842</div>
                <div class="text-sm text-gray-600 mt-1">Año de creación</div>
            </div>
        </div>
    </div>
</section>

{{-- Reseña Histórica --}}
<section class="py-16 bg-gray-50" id="resena-historica">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2">Reseña Histórica</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Una historia de identidad y progreso</h2>
                <div class="prose prose-lg text-gray-700 space-y-4">
                    <p>
                        El Departamento del Beni fue creado el <strong>18 de noviembre de 1842</strong>
                        durante el gobierno del Mariscal Andrés de Santa Cruz. Es una de las regiones
                        más extensas y diversas de Bolivia, caracterizada por sus llanuras, ríos
                        majestuosos y una riqueza cultural única.
                    </p>
                    <p>
                        La <strong>Gobernación Autónoma Departamental del Beni</strong> es la
                        institución política-administrativa que rige el departamento en el marco
                        de la autonomía reconocida por la Constitución Política del Estado
                        Plurinacional de Bolivia (2009).
                    </p>
                    <p>
                        Con capital en la ciudad de <strong>Trinidad</strong>, el Beni está
                        organizado en 19 municipios y cuenta con una diversidad étnica
                        invaluable: pueblos moxeño, movima, baure, mojeño, tacana, cavineño,
                        reyesano, joaquineño, entre otros.
                    </p>
                </div>
            </div>
            <div class="relative">
                <div class="bg-teal-100 rounded-2xl aspect-[4/3] flex items-center justify-center overflow-hidden shadow-lg">
                    <svg class="w-32 h-32 text-teal-600/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                    </svg>
                </div>
                <div class="absolute -bottom-6 -left-6 bg-amber-500 text-white p-6 rounded-xl shadow-xl max-w-xs">
                    <p class="text-3xl font-bold">213,564</p>
                    <p class="text-sm">km² de extensión territorial</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Misión, Visión y Objetivos --}}
<section class="py-16 bg-white" id="mision-vision">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <p class="text-teal-700 font-semibold uppercase tracking-wider mb-2">Nuestro compromiso</p>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Misión, Visión y Objetivos</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-8 rounded-2xl border border-teal-200">
                <div class="w-14 h-14 bg-teal-600 text-white rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Misión</h3>
                <p class="text-gray-700 leading-relaxed">
                    Promover el desarrollo humano integral y sostenible del Departamento
                    del Beni, mediante la formulación y ejecución de políticas públicas
                    inclusivas, la gestión transparente de los recursos y la prestación
                    eficiente de servicios públicos de calidad para todos los benianos.
                </p>
            </div>

            <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-8 rounded-2xl border border-amber-200">
                <div class="w-14 h-14 bg-amber-500 text-white rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Visión</h3>
                <p class="text-gray-700 leading-relaxed">
                    Ser una entidad autónoma departamental líder en Bolivia, reconocida por
                    su gestión transparente, eficiente y participativa; por el respeto a la
                    diversidad cultural y el ambiente; y por mejorar la calidad de vida de
                    los benianos con un enfoque de equidad y justicia social.
                </p>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 p-8 rounded-2xl border border-emerald-200">
                <div class="w-14 h-14 bg-emerald-600 text-white rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Objetivos</h3>
                <ul class="text-gray-700 space-y-2">
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 mt-1">▸</span>
                        Promover el desarrollo productivo y la seguridad alimentaria.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 mt-1">▸</span>
                        Garantizar el acceso universal a salud y educación de calidad.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 mt-1">▸</span>
                        Impulsar la conectividad vial y digital del departamento.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 mt-1">▸</span>
                        Fortalecer la transparencia y la participación ciudadana.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 mt-1">▸</span>
                        Proteger el patrimonio cultural y los recursos naturales.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Accesos rápidos --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-900">Conoce más sobre la Gobernación</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('institutional.organigrama') }}"
               class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-teal-500 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-lg flex items-center justify-center mb-3 group-hover:bg-teal-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Organigrama</h3>
                <p class="text-sm text-gray-600">Estructura organizacional completa</p>
            </a>
            <a href="{{ route('institutional.secretariats') }}"
               class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-teal-500 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-lg flex items-center justify-center mb-3 group-hover:bg-teal-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Secretarías</h3>
                <p class="text-sm text-gray-600">{{ $stats['secretariats'] ?? 0 }} secretarías departamentales</p>
            </a>
            <a href="{{ route('institutional.officials') }}"
               class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-teal-500 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-lg flex items-center justify-center mb-3 group-hover:bg-teal-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Autoridades</h3>
                <p class="text-sm text-gray-600">Gobernador, vicegobernador y gabinete</p>
            </a>
            <a href="{{ route('transparency.marco-normativo') }}"
               class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-teal-500 hover:shadow-lg transition">
                <div class="w-12 h-12 bg-teal-100 text-teal-700 rounded-lg flex items-center justify-center mb-3 group-hover:bg-teal-600 group-hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                    </svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Marco Normativo</h3>
                <p class="text-sm text-gray-600">Leyes, decretos y resoluciones</p>
            </a>
        </div>
    </div>
</section>
@endsection
