{{--
    Ubicación: resources/views/sobre-nosotros.blade.php
    Descripción: Página Sobre Nosotros - Gobernación Autónoma del Beni
--}}
@extends('layouts.main')

@section('title', 'Sobre Nosotros - Gobernación Autónoma del Beni')
@section('meta_description', 'Conoce la historia, misión, visión y valores de la Gobernación Autónoma del Beni. Información sobre la institución departamental y su compromiso con el desarrollo del Beni.')

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
            <p class="text-official-light font-semibold uppercase tracking-wider mb-4">Institución Departamental</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">Sobre Nosotros</h1>
            <p class="text-xl opacity-90">Gobernación Autónoma del Beni</p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="container mx-auto px-4 py-4">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Sobre Nosotros', 'url' => null]
    ]" />
</div>

<!-- Historia y Misión -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Historia -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Nuestra Historia</h2>
                <div class="prose prose-lg text-gray-600">
                    <p class="mb-4">
                        La Gobernación Autónoma del Beni es la institución pública encargada de la administración departamental del departamento del Beni, Bolivia. Fundada en 1842, nuestra institución ha sido testigo y protagonista de la historia y desarrollo de esta región amazónica.
                    </p>
                    <p class="mb-4">
                        A lo largo de más de 180 años, la Gobernación ha evolucionado para adaptarse a las necesidades de la población beniana, manteniendo siempre el compromiso de trabajar por el bienestar y progreso de todos los habitantes del departamento.
                    </p>
                    <p>
                        Hoy en día, bajo la gestión del Gobernador Jesús "Tito" Egüez Rivero, continuamos con nuestra misión de llevar desarrollo, transparencia y equidad a cada rincón del Beni, preparándonos para celebrar nuestro bicentenario en 2042.
                    </p>
                </div>
            </div>

            <!-- Misión y Visión -->
            <div class="space-y-6">
                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-official/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Misión</h3>
                    </div>
                    <p class="text-gray-600">
                        Garantizar el desarrollo integral y sostenible del departamento del Beni, promoviendo la transparencia, equidad y participación ciudadana en la gestión pública, para mejorar la calidad de vida de todos los benianos.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-official/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Visión</h3>
                    </div>
                    <p class="text-gray-600">
                        Ser una institución departamental líder, transparente y eficiente, que impulse el desarrollo sostenible del Beni como "el gigante amazónico" de Bolivia, garantizando bienestar y oportunidades para todas las generaciones.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Valores -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nuestros Valores</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Los principios que guían nuestra gestión diaria y definen nuestra identidad institucional.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-14 h-14 bg-official/10 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Transparencia</h3>
                <p class="text-gray-600 text-sm">Gestión abierta y accountable para recuperar la confianza ciudadana.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-14 h-14 bg-official/10 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Equidad</h3>
                <p class="text-gray-600 text-sm">Desarrollo justo y equitativo para todos los territorios del Beni.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-14 h-14 bg-official/10 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Eficiencia</h3>
                <p class="text-gray-600 text-sm">Uso responsable y optimizado de los recursos públicos.</p>
            </div>

            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="w-14 h-14 bg-official/10 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Compromiso</h3>
                <p class="text-gray-600 text-sm">Dedicación absoluta al bienestar de la población beniana.</p>
            </div>
        </div>
    </div>
</section>

<!-- Estructura Organizacional -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Estructura Organizacional</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Conoce las áreas que conforman nuestra institución y trabajan por el desarrollo del Beni.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="border border-gray-200 rounded-xl p-6 hover:border-official transition">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Gabinete Departamental</h3>
                <p class="text-gray-600 text-sm">Consejo de ministros y secretarios que dirigen las políticas departamentales.</p>
            </div>

            <div class="border border-gray-200 rounded-xl p-6 hover:border-official transition">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Asamblea Departamental</h3>
                <p class="text-gray-600 text-sm">Órgano legislativo departamental encargado de la normativa local.</p>
            </div>

            <div class="border border-gray-200 rounded-xl p-6 hover:border-official transition">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Secretarías Sectoriales</h3>
                <p class="text-gray-600 text-sm">Áreas técnicas especializadas en salud, educación, infraestructura y más.</p>
            </div>

            <div class="border border-gray-200 rounded-xl p-6 hover:border-official transition">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Direcciones Departamentales</h3>
                <p class="text-gray-600 text-sm">Unidades operativas que ejecutan programas y proyectos en el territorio.</p>
            </div>

            <div class="border border-gray-200 rounded-xl p-6 hover:border-official transition">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Unidades Descentralizadas</h3>
                <p class="text-gray-600 text-sm">Oficinas municipales y provinciales para atención cercana a la ciudadanía.</p>
            </div>

            <div class="border border-gray-200 rounded-xl p-6 hover:border-official transition">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Control Social</h3>
                <p class="text-gray-600 text-sm">Mecanismos de participación ciudadana y fiscalización de la gestión.</p>
            </div>
        </div>
    </div>
</section>

<!-- Servicios Digitales -->
@if($externalSystems->count() > 0)
<section class="py-16 bg-official text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold">Servicios Digitales</h2>
            <p class="opacity-80 mt-2">Accede a nuestros sistemas en línea</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($externalSystems as $system)
            <a href="{{ $system->url }}" target="_blank"
               class="bg-white/10 hover:bg-white/20 backdrop-blur rounded-xl p-6 text-center transition-all group border border-white/20 hover:border-white/40">
                <div class="flex justify-center mb-3">
                    @if($system->last_status === 'online')
                    <span class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></span>
                    @elseif($system->last_status === 'offline')
                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                    @else
                    <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                    @endif
                </div>
                <h3 class="text-lg font-bold mb-1">{{ $system->name }}</h3>
                <p class="text-sm opacity-80">{{ $system->description }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Contacto -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">¿Tienes preguntas sobre nuestra institución?</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/contacto" class="btn-primary inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Contáctanos
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
