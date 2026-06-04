{{--
    Ubicación: resources/views/gobernador.blade.php
    Descripción: Página del Gobernador del Beni - Jesús "Tito" Egüez Rivero
    Información actualizada 2026
--}}
@extends('layouts.main')

@section('title', 'Gobernador - Gobernación Autónoma del Beni')
@section('meta_description', 'Conozca al Gobernador del Departamento del Beni, Jesús "Tito" Egüez Rivero, electo en las elecciones subnacionales 2026.')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-official to-official-dark overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/70"></div>
        <div class="absolute inset-0 bg-pattern opacity-5"></div>
    </div>

    <div class="container mx-auto px-4 relative">
        <div class="max-w-4xl mx-auto text-center text-white">
            <p class="text-official-light font-semibold uppercase tracking-wider mb-4">Autoridad Departamental</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">Gobernador del Beni</h1>
            <p class="text-xl opacity-90">Gestión 2026 - 2031</p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="container mx-auto px-4 py-4">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Gobernador', 'url' => null]
    ]" />
</div>

<!-- Perfil del Gobernador -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            <!-- Imagen y datos básicos -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-2xl p-6 shadow-lg">
                    <div class="aspect-[3/4] bg-gradient-to-br from-official/20 to-official/5 rounded-xl mb-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/titogobe.jpg') }}" alt="Gobernador del Beni" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Jesús "Tito" Egüez Rivero</h2>
                    <p class="text-official font-semibold text-center mb-4">Gobernador del Beni</p>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-600">Ingeniero de profesión</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                            </svg>
                            <span class="text-gray-600">Alianza Patria Unidos</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-600">Posesionado: Mayo 2026</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-gray-600">Electo con 53% de votos</span>
                        </div>
                    </div>

                    <!-- QR Code Card -->
                    <div class="mt-6 bg-gradient-to-br from-official to-official-dark rounded-xl p-6 text-center">
                        <p class="text-white font-semibold mb-3">Tarjeta Digital del Gobernador</p>
                        <div class="bg-white rounded-lg p-4 inline-block mb-3">
                            <img src="{{ asset('images/qr.jpeg') }}" alt="QR Code - Tarjeta Digital" class="w-32 h-32">
                        </div>
                        <p class="text-white/80 text-sm mb-3">Escanea para ver la tarjeta digital</p>
                        <a href="https://card.beni.gob.bo/" target="_blank" class="inline-block bg-white text-official font-semibold px-4 py-2 rounded-lg hover:bg-official-light transition">
                            Visitar card.beni.gob.bo
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información detallada -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Biografía -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Biografía</h3>
                    <div class="prose prose-lg text-gray-600">
                        <p>
                            El ingeniero <strong>Jesús "Tito" Egüez Rivero</strong> es el flamante Gobernador del Departamento del Beni, 
                            posesionado en mayo de 2026 tras triunfar en las elecciones subnacionales con el respaldo del 53% de la 
                            ciudadanía beniana (108.245 votos).
                        </p>
                        <p>
                            Egüez resultó electo en la segunda vuelta electoral como candidato de la alianza política 
                            <strong>Patria Unidos</strong>, derrotando al candidato del Movimiento Nacionalista Revolucionario (MNR), 
                            Hugo Vargas, quien obtuvo el 46,97% de los sufragios.
                        </p>
                    </div>
                </div>

                <!-- Plan de Gestión -->
                <div class="bg-gray-50 rounded-xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Plan de Gestión: "El Beni, el despertar del gigante amazónico"</h3>
                    <p class="text-gray-600 mb-6">
                        El gobernador Egüez ha delineado un ambicioso plan de trabajo con miras al bicentenario del departamento, 
                        fundamentado en cinco ejes estratégicos:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Transparencia</h4>
                            </div>
                            <p class="text-sm text-gray-600">Gestión abierta y transparente para recuperar la confianza ciudadana</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Sostenibilidad</h4>
                            </div>
                            <p class="text-sm text-gray-600">Desarrollo armónico con la naturaleza amazónica</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Libertad de Emprendimiento</h4>
                            </div>
                            <p class="text-sm text-gray-600">Impulso a la economía productiva y emprendedora</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Equilibrio y Equidad Territorial</h4>
                            </div>
                            <p class="text-sm text-gray-600">Desarrollo equitativo en todo el territorio beniano</p>
                        </div>
                    </div>
                </div>

                <!-- Palabras del Gobernador -->
                <div class="border-l-4 border-official pl-6 py-2">
                    <blockquote class="text-lg italic text-gray-700 mb-4">
                        "El diagnóstico nos dice que la Patria está estructuralmente quebrada en lo económico, 
                        institucional y lamentablemente el Beni no es la excepción. Vivimos tiempos difíciles, 
                        pero son esos tiempos los que nos demandarán sacar lo mejor de nosotros en trabajo y 
                        compromiso para sacar adelante a nuestro departamento."
                    </blockquote>
                    <cite class="text-official font-semibold">— Jesús "Tito" Egüez Rivero, durante su discurso de posesión</cite>
                </div>

                <!-- Compromisos -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Compromisos de Gestión</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Administración transparente y eficiente de los recursos públicos</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Impulsar el desarrollo productivo sostenible del departamento</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Trabajar por un Beni productivo y próspero para todos sus habitantes</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Fortalecer la participación ciudadana en la toma de decisiones</span>
                        </li>
                    </ul>
                </div>

                <!-- Contexto histórico -->
                <div class="bg-official/5 rounded-xl p-6">
                    <h4 class="font-bold text-gray-900 mb-2">Contexto Histórico</h4>
                    <p class="text-sm text-gray-600">
                        El ingeniero Egüez es el primer gobernador posesionado de los nueve electos en las elecciones 
                        subnacionales de 2026, que cerraron un ciclo electoral conflictivo. Su administración deberá 
                        enfrentar los desafíos económicos y sociales heredados, con el compromiso de llevar al Beni 
                        hacia su bicentenario como "el gigante amazónico" del desarrollo boliviano.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contacto/Acceso rápido -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Contacto con la Gobernación</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/contacto" class="btn-primary inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Enviar mensaje
                </a>
                <a href="/" class="btn-secondary inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
