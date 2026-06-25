@extends('layouts.main')

@section('title', 'Vicegobernador - Gobernación Autónoma del Beni')
@section('meta_description', 'Perfil oficial del Vicegobernador del Departamento del Beni, Juan Carlos Teddy Camacho Gamarra. Conoce su biografía, trayectoria académica y gestión.')

@section('content')
<!-- Hero Section -->
<section class="relative py-32 bg-gradient-to-br from-official to-official-dark overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/70"></div>
        <div class="absolute inset-0 bg-pattern opacity-5"></div>
    </div>

    <div class="container mx-auto px-4 relative">
        <div class="max-w-4xl mx-auto text-center text-white">
            <p class="text-official-light font-semibold uppercase tracking-wider mb-4">Segunda Autoridad Departamental</p>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">Vicegobernador del Beni</h1>
            <p class="text-xl opacity-90">Gestión 2026 - 2031</p>
        </div>
    </div>
</section>

<!-- Breadcrumb -->
<div class="container mx-auto px-4 py-4">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Gobernación', 'url' => '/gobernador'],
        ['label' => 'Vicegobernador', 'url' => null]
    ]" />
</div>

<!-- Perfil del Vicegobernador -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            <!-- Imagen y datos básicos -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-2xl p-6 shadow-lg">
                    <div class="aspect-[3/4] bg-gradient-to-br from-official/20 to-official/5 rounded-xl mb-6 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/perfil.webp') }}" alt="Retrato oficial de Juan Carlos Teddy Camacho Gamarra, Vicegobernador del Beni" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Juan Carlos "Teddy" Camacho Gamarra</h2>
                    <p class="text-official font-semibold text-center mb-4">Vicegobernador del Beni</p>

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
                            <span class="text-gray-600">Alianza Patria</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-600">Posesionado: 3 de mayo de 2026</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-gray-600">Periodo constitucional 2026-2031</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información detallada -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Perfil y Trayectoria Académica -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Perfil y Trayectoria Académica</h3>
                    <div class="prose prose-lg text-gray-600">
                        <p>
                            <strong>Juan Carlos "Teddy" Camacho Gamarra</strong> es un ingeniero, académico y político beniano que actualmente ejerce como el <strong>Vicegobernador del Departamento del Beni</strong> para el periodo constitucional <strong>2026 - 2031</strong>.
                        </p>
                        <p>
                            Cuenta con el título profesional de <strong>Ingeniero</strong>. Antes de asumir su carrera política a nivel departamental, destacó notablemente por su labor institucional y académica en la región amazónica.
                        </p>
                        <p>
                            Ha sido públicamente condecorado por su gestión educativa y el impulso técnico brindado al <strong>Instituto Tecnológico Superior Amazonía (ITSA)</strong> en el municipio de <strong>Riberalta</strong>.
                        </p>
                    </div>
                </div>

                <!-- Carrera Política -->
                <div class="bg-gray-50 rounded-xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Carrera Política y Elección</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Candidatura</h4>
                            </div>
                            <p class="text-sm text-gray-600">Postuló bajo la sigla de <strong>Alianza Patria</strong>, conformando la fórmula ganadora junto al gobernador Jesús "Tito" Egüez.</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Credenciales</h4>
                            </div>
                            <p class="text-sm text-gray-600">El 28 de abril de 2026 recibió sus credenciales oficiales del Tribunal Electoral Departamental (TED) del Beni.</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Posesión Oficial</h4>
                            </div>
                            <p class="text-sm text-gray-600">Asumió formalmente funciones el <strong>3 de mayo de 2026</strong> en la ciudad de Trinidad.</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 shadow-sm">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 bg-official/10 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5A2.5 2.5 0 0019 9.5V8a2 2 0 00-2-2h-1a3 3 0 01-3-3V3.055"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900">Elecciones 2026</h4>
                            </div>
                            <p class="text-sm text-gray-600">Elecciones subnacionales de marzo de 2026, fórmula ganadora en el Beni.</p>
                        </div>
                    </div>
                </div>

                <!-- Desempeño en el Cargo -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Desempeño en el Cargo</h3>
                    <p class="text-gray-600 mb-4">
                        Como la <strong>segunda máxima autoridad ejecutiva del Beni</strong>, Camacho enfoca su agenda pública en la <strong>descentralización regional</strong>. Ha priorizado constantes giras de fiscalización y desarrollo en las provincias del norte y oeste beniano, principalmente en los municipios de las provincias Vaca Díez y Ballivián.
                    </p>
                    <p class="text-gray-600">
                        Su gestión promueve un modelo de <strong>desarrollo productivo y sostenible</strong> para la Amazonía boliviana.
                    </p>
                </div>

                <!-- Reconocimientos -->
                <div class="border-l-4 border-official pl-6 py-2">
                    <blockquote class="text-lg italic text-gray-700 mb-4">
                        "Ha sido públicamente condecorado por su gestión educativa y el impulso técnico brindado al Instituto Tecnológico Superior Amazonía (ITSA) en Riberalta."
                    </blockquote>
                    <cite class="text-official font-semibold">— Trayectoria institucional</cite>
                </div>

                <!-- Compromisos -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Ejes de Gestión</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Descentralización regional y desarrollo equitativo de las provincias</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Giras de fiscalización y desarrollo en provincias del norte y oeste beniano</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Modelo de desarrollo productivo y sostenible para la Amazonía boliviana</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-official flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-600">Impulso a la educación técnica y formación académica regional</span>
                        </li>
                    </ul>
                </div>

                <!-- Contexto -->
                <div class="bg-official/5 rounded-xl p-6">
                    <h4 class="font-bold text-gray-900 mb-2">Contexto</h4>
                    <p class="text-sm text-gray-600">
                        Juan Carlos Camacho asume la vicegobernación en un momento crucial para el Beni, trabajando en estrecha coordinación con el gobernador Jesús Egüez para impulsar el desarrollo integral del departamento. Su experiencia académica y su conocimiento del territorio beniano son pilares fundamentales para la gestión descentralizada que promueve la actual administración.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Conoce más sobre nuestra administración</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="/gobernador" class="btn-primary inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Perfil del Gobernador
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