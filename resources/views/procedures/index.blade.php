{{--
    Vista: Catálogo de Trámites — Index
    Cumplimiento: RM 067/2025 — Componentes 13, 14
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Catálogo de trámites y servicios de la Gobernación del Beni. Requisitos, costos, plazos y enlaces a trámite en línea.">
@endsection

@section('content')
<section class="bg-white pt-12 pb-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-5xl mx-auto text-center flex flex-col items-center justify-center">

        <!-- Migas de Pan (Breadcrumb) adaptadas de tu componente -->
        {{-- <div class="mb-8 w-full flex justify-center text-xs md:text-sm">
            <x-breadcrumb :items="[
                ['label' => 'Inicio', 'url' => '/'],
                ['label' => 'Servicios al Ciudadano', 'url' => null],
                ['label' => 'Trámites', 'url' => null]
            ]" />
        </div> --}}

        <!-- Título Principal Institucional -->
        <h1 class="text-[#0a3118] font-bold text-3xl md:text-5xl tracking-tight mb-4">
            Trámites y Servicios al Ciudadano
        </h1>

        <!-- Descripción / Bajada Informativa -->
        <p class="text-gray-600 text-sm md:text-base leading-relaxed max-w-2xl mx-auto font-light mb-8">
            Facilitamos tu acceso a la gestión pública departamental. Encuentra guías detalladas y realiza tus trámites de forma segura y eficiente.
        </p>

        <!-- Barra de Búsqueda Integrada con Sombra Suave -->
        <div class="w-full max-w-3xl bg-white rounded-xl shadow-md border border-gray-100 p-2 flex items-center gap-2 mb-6">
            <div class="pl-3 text-gray-400">
                <!-- Icono de Lupa (Search) -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <!-- Input text de búsqueda -->
            <input type="text"
                   placeholder="¿Qué trámite estás buscando hoy?"
                   class="w-full py-2 px-1 text-gray-700 text-sm md:text-base focus:outline-none placeholder-gray-400 bg-transparent">

            <!-- Botón Buscar Institucional -->
            <button class="bg-[#0a3118] hover:bg-[#06200f] text-white font-semibold text-sm md:text-base px-6 py-2.5 rounded-lg transition-colors duration-200 shadow-sm">
                Buscar
            </button>
        </div>

        <!-- Trámites Frecuentes (Etiquetas Estilo Píldora) -->
        <div class="flex flex-wrap items-center justify-center gap-2 md:gap-3 text-xs md:text-sm">
            <span class="text-gray-500 font-medium mr-1">Frecuentes:</span>

            <a href="#" class="bg-gray-100 text-[#0a3118] hover:bg-gray-200 transition-colors duration-150 px-3.5 py-1.5 rounded-full font-medium">
                Personería Jurídica
            </a>

            <a href="#" class="bg-gray-100 text-[#0a3118] hover:bg-gray-200 transition-colors duration-150 px-3.5 py-1.5 rounded-full font-medium">
                Licencia Ambiental
            </a>

            <a href="#" class="bg-gray-100 text-[#0a3118] hover:bg-gray-200 transition-colors duration-150 px-3.5 py-1.5 rounded-full font-medium">
                Tasas Forestales
            </a>
        </div>

    </div>
</section>

<!-- Sección: Categorías de Servicios -->
<section id="categorias-servicios" class="bg-white pb-20 px-4 md:px-12 lg:px-24 block clear-both w-full">
    <div class="max-w-7xl mx-auto w-full block">

        <!-- Título de la Sección con Línea Divisoria -->
        <div class="flex items-center gap-4 mb-10 w-full">
            <h2 class="text-[#0a3118] font-bold text-2xl md:text-3xl tracking-tight whitespace-nowrap block text-left">
                Categorías de Servicios
            </h2>
            <div class="grow h-[1px] bg-gray-100"></div>
        </div>

        <!-- Grid Principal Controlado: 2 Columnas idénticas en Escritorio -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 w-full items-stretch">

            <!-- TARJETA 1: Personalidad Jurídica -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 flex flex-col justify-between min-h-[320px] text-left w-full">
                <div class="block w-full">
                    <!-- Icono -->
                    <div class="w-10 h-10 bg-[#DEF7EC] text-[#0a3118] rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <!-- Título -->
                    <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                        Personalidad Jurídica
                    </h3>
                    <!-- Descripción Forzada a Ancho Completo Normal -->
                    <p class="text-gray-500 text-sm leading-relaxed font-light block text-left w-full whitespace-normal">
                        Solicitud, renovación y registro de entes colectivos, organizaciones territoriales y fundaciones dentro del departamento.
                    </p>
                </div>

                <!-- Botones de Acción Horizontales -->
                <div class="flex flex-row flex-wrap gap-3 mt-8 justify-start items-center w-full">
                    <a href="#" class="bg-[#0a3118] hover:bg-[#06200f] text-white text-xs font-semibold px-4 py-2.5 rounded-lg transition-colors duration-200 inline-block">
                        Ver Requisitos
                    </a>
                    <a href="#" class="bg-white text-[#d4ac0d] border border-[#d4ac0d] hover:bg-gray-50 text-xs font-semibold px-4 py-2.5 rounded-lg transition-colors duration-200 inline-block">
                        Iniciar Trámite
                    </a>
                </div>
            </div>

            <!-- TARJETA 2: Licencias Ambientales -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 flex flex-col justify-between min-h-[320px] text-left w-full">
                <div class="block w-full">
                    <div class="w-10 h-10 bg-[#FEF9E7] text-[#B7950B] rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.364l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                        Licencias Ambientales
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-light block text-left w-full whitespace-normal">
                        Categorización, fichas ambientales y monitoreo para proyectos productivos sostenibles.
                    </p>
                </div>

                <div class="flex mt-8 justify-start w-full">
                    <a href="#" class="inline-flex items-center text-[#0a3118] hover:text-[#06200f] font-bold text-sm transition-colors duration-200 group">
                        Explorar
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- TARJETA 3: Tasas Departamentales -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 flex flex-col justify-between min-h-[320px] text-left w-full">
                <div class="block w-full">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                        Tasas Departamentales
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-light block text-left w-full whitespace-normal">
                        Liquidación y consulta de tasas administrativas por servicios agropecuarios y forestales.
                    </p>
                </div>

                <div class="flex mt-8 justify-start w-full">
                    <a href="#" class="inline-flex items-center text-[#0a3118] hover:text-[#06200f] font-bold text-sm transition-colors duration-200 group">
                        Ver Tasas
                        <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- TARJETA 4: Sector Agropecuario (Estructura Dividida en 2 Columnas Internas Flex) -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col md:flex-row min-h-[320px] w-full items-stretch">
                <!-- Contenido Informativo Izquierdo (Ocupa el 60% de espacio) -->
                <div class="p-8 flex flex-col justify-between flex-1 text-left md:w-3/5">
                    <div class="block w-full">
                        <div class="w-10 h-10 bg-[#DEF7EC] text-[#0a3118] rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5A2.5 2.5 0 0019 9.5V8a2 2 0 00-2-2h-1a3 3 0 01-3-3V3.055M11 20a9 9 0 101.993-5.71"></path>
                            </svg>
                        </div>
                        <h3 class="text-[#0a3118] font-bold text-xl md:text-2xl mb-3 block text-left w-full whitespace-normal">
                            Sector Agropecuario
                        </h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-light mb-5 block text-left w-full whitespace-normal">
                            Certificaciones de sanidad animal, guías de movimiento de ganado y apoyo técnico para el productor beniano.
                        </p>

                        <!-- Viñetas con Checkmarks Verdes -->
                        <ul class="space-y-2.5 text-xs md:text-sm text-gray-600 font-medium block w-full">
                            <li class="flex items-center gap-2 text-left w-full">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 inline" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="inline-block">Guías de Movimiento</span>
                            </li>
                            <li class="flex items-center gap-2 text-left w-full">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 inline" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="inline-block">Registro de Marcas</span>
                            </li>
                            <li class="flex items-center gap-2 text-left w-full">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0 inline" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="inline-block">Certificado de Vacunación</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Imagen Derecha Acoplada (Ocupa el 40% de espacio) -->
                <!-- Nota: Coloca aquí una foto de un paisaje o ganado real en tu carpeta public, p. ej. /img/beni.jpg -->
                <div class="w-full md:w-2/5 min-h-[180px] md:min-h-full relative bg-gray-100 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&w=600&q=80" alt="Ganadería" class="absolute inset-0 w-full h-full object-cover">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Sección: Ventanilla Única Virtual -->
<section id="ventanilla-virtual" class="bg-[#0a3118] text-white py-20 px-6 md:px-12 lg:px-24 w-full block">
    <div class="max-w-7xl mx-auto text-left md:text-center flex flex-col items-center">

        <!-- Encabezado de la Sección -->
        <div class="w-full max-w-3xl text-left md:text-center mb-16">
            <h2 class="text-white font-bold text-3xl md:text-4xl mb-4 tracking-tight">
                Ventanilla Única Virtual
            </h2>
            <p class="text-gray-300 text-sm md:text-base font-light leading-relaxed">
                Estamos digitalizando el Beni. Realiza tus trámites desde la comodidad de tu hogar en tres simples pasos.
            </p>
        </div>

        <!-- Grid de 3 Pasos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 w-full text-left mb-16">

            <!-- Paso 01 -->
            <div class="flex flex-col items-fstart">
                <!-- Número Enmarcado Dorado sutil -->
                <div class="w-14 h-14 border border-[#d4ac0d]/40 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-[#d4ac0d] font-bold text-xl tracking-wider font-mono">01</span>
                </div>
                <h3 class="text-white font-bold text-lg mb-3">
                    Identidad Digital
                </h3>
                <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed">
                    Regístrate en nuestro portal ciudadano con tu C.I. y correo electrónico para validar tu identidad de forma segura.
                </p>
            </div>

            <!-- Paso 02 -->
            <div class="flex flex-col items-start">
                <!-- Número Enmarcado -->
                <div class="w-14 h-14 border border-[#d4ac0d]/40 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-[#d4ac0d] font-bold text-xl tracking-wider font-mono">02</span>
                </div>
                <h3 class="text-white font-bold text-lg mb-3">
                    Carga de Documentos
                </h3>
                <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed">
                    Sube los requisitos escaneados en formato PDF. Nuestro sistema verificará la integridad de los datos automáticamente.
                </p>
            </div>

            <!-- Paso 03 -->
            <div class="flex flex-col items-start">
                <!-- Número Enmarcado -->
                <div class="w-14 h-14 border border-[#d4ac0d]/40 rounded-xl flex items-center justify-center mb-6">
                    <span class="text-[#d4ac0d] font-bold text-xl tracking-wider font-mono">03</span>
                </div>
                <h3 class="text-white font-bold text-lg mb-3">
                    Seguimiento y Firma
                </h3>
                <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed">
                    Sigue el estado de tu trámite en tiempo real y recibe tu certificado digital con firma electrónica certificada.
                </p>
            </div>

        </div>

        <!-- Botón de Acción Centrado -->
        <div class="w-full flex justify-start md:justify-center">
            <a href="#" class="bg-[#e5c158] hover:bg-[#d4ac0d] text-[#0a3118] font-bold text-sm px-6 py-3.5 rounded-xl transition-all duration-200 flex items-center gap-2 shadow-md group">
                Acceder al Portal Virtual
                <!-- Icono de Login / Salida -->
                <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </a>
        </div>

    </div>
</section>


<!-- Sección: Soporte y Ayuda Ciudadana (Blindada) -->
<section id="soporte-ciudadano" class="bg-white py-20 px-4 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <!-- Grid Principal Forzado -->
        <div class="flex flex-col lg:flex-row gap-12 items-start justify-between w-full" style="display: flex; width: 100%;">

            <!-- COLUMNA IZQUIERDA: Texto y Tarjetas (Ocupa el 55% en pantallas grandes) -->
            <div class="w-full lg:w-[55%] flex flex-col justify-start text-left" style="display: flex; flex-direction: column; text-align: left;">

                <!-- Título e Introducción Forzados -->
                <div class="mb-10 block w-full" style="display: block; width: 100%;">
                    <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl mb-4 tracking-tight block" style="display: block; font-weight: 700; color: #0a3118;">
                        ¿Necesitas Ayuda?
                    </h2>
                    <p class="text-gray-500 text-sm md:text-base font-light leading-relaxed block w-full" style="display: block; width: 100%; white-space: normal; text-align: left; color: #6b7280; line-height: 1.625;">
                        Nuestro equipo de atención al ciudadano está listo para orientarte en cada paso de tu gestión.
                    </p>
                </div>

                <!-- Contenedor de Canales Verticales -->
                <div class="space-y-4 w-full block" style="display: block; width: 100%;">

                    <!-- Tarjeta 1: Chat en Vivo -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-row items-start gap-4 text-left w-full" style="display: flex; flex-direction: row; align-items: flex-start; text-align: left; width: 100%; background-color: #fff; border-radius: 1rem; border-width: 1px; padding: 1.25rem;">
                        <div class="w-12 h-12 bg-emerald-50 text-[#0a3118] rounded-xl flex items-center justify-center flex-shrink-0" style="flex-shrink: 0; width: 3rem; height: 3rem; background-color: #ecfdf5; border-radius: 0.75rem; display: flex; align-items: center; justify-center: center;">
                            <svg class="w-6 h-6 text-[#0a3118]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.5rem; height: 1.5rem; color: #0a3118;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div style="flex: 1 1 0%; min-width: 0; display: block; text-align: left;">
                            <h3 class="text-[#0a3118] font-bold text-base mb-1 block" style="display: block; font-weight: 700; color: #0a3118;">Chat en Vivo</h3>
                            <p class="text-gray-400 text-xs font-medium mb-2 block" style="display: block; color: #9ca3af; white-space: normal;">Disponible de lunes a viernes (08:00 - 18:30)</p>
                            <a href="#" class="text-[#0a3118] font-bold text-sm inline-flex items-center gap-1" style="display: inline-flex; align-items: center; color: #0a3118; font-weight: 700;">
                                Iniciar Conversación
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 0.875rem; height: 0.875rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Tarjeta 2: Central Telefónica -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-row items-start gap-4 text-left w-full" style="display: flex; flex-direction: row; align-items: flex-start; text-align: left; width: 100%; background-color: #fff; border-radius: 1rem; border-width: 1px; padding: 1.25rem;">
                        <div class="w-12 h-12 bg-emerald-50 text-[#0a3118] rounded-xl flex items-center justify-center flex-shrink-0" style="flex-shrink: 0; width: 3rem; height: 3rem; background-color: #ecfdf5; border-radius: 0.75rem; display: flex; align-items: center; justify-center: center;">
                            <svg class="w-6 h-6 text-[#0a3118]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.5rem; height: 1.5rem; color: #0a3118;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div style="flex: 1 1 0%; min-width: 0; display: block; text-align: left;">
                            <h3 class="text-[#0a3118] font-bold text-base mb-1 block" style="display: block; font-weight: 700; color: #0a3118;">Central Telefónica</h3>
                            <p class="text-gray-500 text-sm font-light block" style="display: block; color: #6b7280; white-space: normal; margin-bottom: 0.25rem;">
                                Llamada gratuita nacional: <span style="font-weight: 600; color: #374151;">800-10-BENI (2364)</span>
                            </p>
                            <p class="text-gray-500 text-sm font-light block" style="display: block; color: #6b7280; white-space: normal;">
                                Internacional: <span style="font-weight: 600; color: #374151;">+591 (3) 462-1234</span>
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 3: Oficinas Centrales -->
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-row items-start gap-4 text-left w-full" style="display: flex; flex-direction: row; align-items: flex-start; text-align: left; width: 100%; background-color: #fff; border-radius: 1rem; border-width: 1px; padding: 1.25rem;">
                        <div class="w-12 h-12 bg-emerald-50 text-[#0a3118] rounded-xl flex items-center justify-center flex-shrink-0" style="flex-shrink: 0; width: 3rem; height: 3rem; background-color: #ecfdf5; border-radius: 0.75rem; display: flex; align-items: center; justify-center: center;">
                            <svg class="w-6 h-6 text-[#0a3118]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.5rem; height: 1.5rem; color: #0a3118;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div style="flex: 1 1 0%; min-width: 0; display: block; text-align: left;">
                            <h3 class="text-[#0a3118] font-bold text-base mb-1 block" style="display: block; font-weight: 700; color: #0a3118;">Oficinas Centrales</h3>
                            <p class="text-gray-500 text-sm font-light mb-2 block" style="display: block; color: #6b7280; white-space: normal;">Plaza Principal Mcal. José Ballivián, Trinidad, Beni.</p>
                            <a href="#" class="text-[#0a3118] font-bold text-sm inline-flex items-center gap-1" style="display: inline-flex; align-items: center; color: #0a3118; font-weight: 700;">
                                Ver en el Mapa
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 0.875rem; height: 0.875rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- COLUMNA DERECHA: Tarjeta del Mapa con Aspecto Fijo Proporcional (Ocupa el 40%) -->
            <div class="w-full lg:w-[40%] flex justify-center lg:justify-end flex-shrink-0" style="display: flex; flex-shrink: 0; justify-content: flex-end;">
                <div class="bg-[#386b52] w-full max-w-[380px] aspect-square rounded-[2.5rem] shadow-xl p-8 flex flex-col justify-between relative overflow-hidden" style="display: flex; flex-direction: column; justify-content: space-between; width: 100%; max-width: 380px; aspect-ratio: 1 / 1; background-color: #386b52; border-radius: 2.5rem; position: relative; overflow: hidden; padding: 2rem;">

                    <!-- SVG del mapa incrustado directamente con tamaño forzado -->
                    <div class="absolute inset-0 flex items-center justify-center p-8 opacity-90" style="position: absolute; inset: 0px; display: flex; align-items: center; justify-content: center; padding: 2rem;">
                        <svg class="w-full h-full" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                            <path d="M40 70C35 90 25 110 30 130C35 150 65 170 90 175C115 180 145 160 160 140C175 120 170 85 155 60C140 35 105 25 85 35C65 45 45 50 40 70Z" fill="#4d8569"/>
                            <path d="M42 67C37 87 27 107 32 127C37 147 67 167 92 172C117 177 147 157 162 137C177 117 172 82 157 57C142 32 107 22 87 32C67 42 47 47 42 67Z" fill="#5fa181"/>
                            <circle cx="105" cy="110" r="7" fill="#ffffff" />
                            <circle cx="105" cy="110" r="4" fill="#872929" />
                        </svg>
                    </div>

                    <!-- Falso divisor transparente -->
                    <div class="block" style="display: block; height: 1px;"></div>

                    <!-- Tarjeta Informativa Flotante en la Base Blindada -->
                    <div class="bg-white rounded-2xl p-4 shadow-md w-full relative z-10 text-left flex flex-col gap-1" style="display: flex; flex-direction: column; text-align: left; width: 100%; background-color: #fff; border-radius: 1rem; padding: 1rem; position: relative; z-index: 10;">
                        <div class="flex flex-row items-center gap-2" style="display: flex; flex-direction: row; align-items: center;">
                            <span style="display: inline-block; width: 0.5rem; height: 0.5rem; background-color: #10b981; border-radius: 9999px;"></span>
                            <span class="text-[#0a3118] font-bold text-xs" style="font-weight: 700; color: #0a3118; font-size: 0.75rem;">Atención Presencial Habilitada</span>
                        </div>
                        <p class="text-gray-500 text-xs font-light" style="display: block; color: #6b7280; font-size: 0.75rem; white-space: normal; line-height: 1.4;">
                            Contamos con 12 ventanillas de atención rápida para trámites presenciales en la Casa de Gobierno.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
