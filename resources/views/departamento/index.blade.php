@extends('layouts.main')

@section('title', $title . ' - Gobernación Autónoma del Beni')
@section('meta_description', $description)

@section('content')
<section class="relative w-full h-[550px] md:h-[600px] flex items-center justify-center overflow-hidden">

    <!-- 1. Imagen de Fondo Imponente -->
    <img src="{{ asset('images/llanos.png') }}"
         alt="Amazonia Beniana"
         class="absolute inset-0 w-full h-full object-cover object-center z-0">

    <!-- 2. Capa de Filtro Verde y Gradiente (Overlay) -->
    <!-- Logra el tinte verde oscuro translúcido exacto de la captura para dar contraste al texto blanco -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#06200f]/80 via-[#0a3118]/75 to-[#051c0d]/90 z-10"></div>

    <!-- 3. Contenido Centralizado -->
    <div class="relative z-20 text-center max-w-4xl px-6 mx-auto flex flex-col items-center justify-center">

        <!-- Título Principal Impactante -->
        <h1 class="text-white font-bold text-3xl md:text-5xl lg:text-6xl tracking-tight mb-4 drop-shadow-md">
            Amazonia Productiva y Soberana
        </h1>

        <!-- Subtítulo / Descripción Corta -->
        <p class="text-white/90 text-sm md:text-lg leading-relaxed max-w-2xl mx-auto drop-shadow-sm font-light">
            Descubre el corazón verde de Bolivia, un departamento de horizontes infinitos, ríos majestuosos y cultura milenaria.
        </p>
    </div>
</section>

{{-- <div class="container mx-auto px-4 py-4">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Gobernación', 'url' => '#'],
        ['label' => 'Departamento', 'url' => null]
    ]" />
</div> --}}

<!-- SECCIÓN COMPLETAMENTE CORREGIDA PARA DOS COLUMNAS ASIMÉTRICAS -->
<section id="biodiversidad" class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">

        <!-- El secreto está aquí: grid-cols-1 (móvil) y lg:grid-cols-12 (pantallas grandes) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

            <!-- COUMNA IZQUIERDA: Textos y Mini Tarjetas (Ocupa 5 de 12 partes en escritorio) -->
            <div class="lg:col-span-5 flex flex-col justify-center">

                <!-- Etiqueta con diseño de píldora verde original -->
                <span class="w-max bg-[#DEF7EC] text-[#0a3118] text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4">
                    Biodiversidad
                </span>

                <!-- Título -->
                <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight mb-4">
                    Nuestra Amazonia
                </h2>

                <!-- Descripción -->
                <p class="text-gray-600 text-sm md:text-base leading-relaxed mb-6">
                    El Beni es un ecosistema único donde la llanura se encuentra con la selva. Nuestros ríos —Mamoré, Beni e Iténez— no solo son vías de transporte, sino el torrente vital de una de las mayores reservas de agua dulce del mundo.
                </p>

                <!-- Grid interno para las dos tarjetas pequeñas -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Tarjeta: Cuencas Hídricas -->
                    <div class="bg-gray-50/80 p-4 rounded-xl border border-gray-100 flex flex-col gap-1.5">
                        <span class="text-[#0a3118] text-lg">≒</span>
                        <h4 class="text-[#0a3118] font-bold text-sm">Cuencas Hídricas</h4>
                        <p class="text-gray-500 text-xs">Red de navegación natural.</p>
                    </div>

                    <!-- Tarjeta: Fauna Exótica -->
                    <div class="bg-gray-50/80 p-4 rounded-xl border border-gray-100 flex flex-col gap-1.5">
                        <span class="text-[#0a3118] text-lg">♀</span>
                        <h4 class="text-[#0a3118] font-bold text-sm">Fauna Exótica</h4>
                        <p class="text-gray-500 text-xs">Hogar del Bufeo y la Paraba Barba Azul.</p>
                    </div>
                </div>

            </div>

            <!-- COLUMNA DERECHA: Imagen con Botón Flotante (Ocupa 7 de 12 partes en escritorio) -->
            <div class="lg:col-span-7 relative group rounded-2xl overflow-hidden shadow-sm h-[320px] md:h-[420px] w-full mt-6 lg:mt-0">

                <!-- Tu imagen ocupando todo el espacio asignado a la derecha -->
                <img src="{{ asset('images/rios.png') }}"
                     alt="Ríos del Beni"
                     class="w-full h-full object-cover transform group-hover:scale-[1.02] transition-transform duration-500">

                <!-- BOTÓN FLOTANTE: Posicionamiento absoluto dentro de la imagen -->
                <div class="absolute bottom-6 left-6 z-10">
                    <button class="bg-white text-[#0a3118] font-bold text-xs md:text-sm px-5 py-3 rounded-xl shadow-lg hover:bg-gray-50 transition-all duration-200">
                        Explora nuestras regiones hídricas
                    </button>
                </div>

            </div>

        </div>

    </div>
</section>

<section id="cultura-tradicion" class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">

        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight mb-3">
                Cultura y Tradición
            </h2>
            <p class="text-gray-600 text-sm md:text-base font-light">
                La identidad beniana se forja entre la fe de sus misiones y el sabor de su tierra.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-2 relative group h-[260px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                <img src="{{ asset('images/sabores.webp') }}" alt="Gastronomía Beniana" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent" style="z-index: 5;"></div>
                <div class="absolute inset-0 p-6 flex flex-col justify-end text-left w-full z-10" style="width: 100%; min-width: 100%; display: flex; box-sizing: border-box;">
                    <h3 class="text-white font-bold text-xl mb-1 drop-shadow-sm block" style="display: block; width: 100%;">Sabores de la Llanura</h3>
                    <p class="text-white/85 text-xs md:text-sm font-light max-w-xl block" style="display: block; width: 100%; min-width: 100%; white-space: normal; word-break: keep-all;">
                        El Majadito, el Masaco y el Keperí: un viaje culinario por nuestra historia.
                    </p>
                </div>
            </div>

            <div class="md:col-span-1 relative group h-[260px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                <img src="{{ asset('images/chope.webp') }}" alt="Chope Fiesta Trinidad" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end text-left">
                    <h3 class="text-white font-bold text-xl mb-1 drop-shadow-sm">Chope Fiesta</h3>
                    <p class="text-white/85 text-xs md:text-sm font-light">La Gran Fiesta de la Santísima Trinidad.</p>
                </div>
            </div>

            <div class="md:col-span-1 relative group h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                <img src="{{ asset('images/artesania.jpeg') }}" alt="Artesanía del Beni" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end text-left">
                    <h3 class="text-white font-bold text-xl mb-1 drop-shadow-sm">Manos Benianas</h3>
                    <p class="text-white/85 text-xs md:text-sm font-light">Artesanía en palma y maderas nobles.</p>
                </div>
            </div>

            <div class="md:col-span-2 relative group h-[280px] rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
                <img src="{{ asset('images/jesuita.webp') }}" alt="Iglesia Misional" class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent" style="z-index: 5;"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end text-left w-full z-10" style="width: 100%; min-width: 100%; display: flex; box-sizing: border-box;">
                    <h3 class="text-white font-bold text-xl mb-1 drop-shadow-sm block" style="display: block; width: 100%;">Misiones Jesuíticas</h3>
                    <p class="text-white/85 text-xs md:text-sm font-light max-w-xl block" style="display: block; width: 100%; min-width: 100%; white-space: normal; word-break: keep-all;">
                        Un legado arquitectónico y espiritual que trasciende los siglos.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>


<section id="santuarios-naturales" class="bg-white py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">

        <!-- 1. Encabezado de la Sección con Enlace Lateral -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-10 gap-4 w-full" style="width: 100%; min-width: 100%;">
            
            <div class="text-left block" style="display: block; flex-grow: 1; max-w: 42rem; width: 100%; box-sizing: border-box;">
                <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl tracking-tight mb-2 block" style="display: block; width: 100%;">
                    Santuarios Naturales
                </h2>
                <p class="text-gray-600 text-sm md:text-base font-light block" style="display: block; width: 100%; white-space: normal !important; line-height: 1.5; overflow-wrap: break-word;">
                    Protegemos el futuro resguardando el presente. Conoce nuestras áreas de preservación crítica.
                </p>
            </div>

            <div class="block whitespace-nowrap" style="flex-shrink: 0;">
                <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm transition-colors duration-200 group">
                    Ver mapa de áreas protegidas
                    <svg class="w-4 h-4 ml-1.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- 2. Grid de 3 Columnas Regular -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- TARJETA 1: PD ANMI Iténez -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                <!-- Imagen Superior -->
                <div class="h-[200px] w-full overflow-hidden">
                    <img src="{{ asset('images/turismo.webp') }}" alt="PD ANMI Iténez" class="w-full h-full object-cover">
                </div>
                <!-- Cuerpo de la Tarjeta -->
                <div class="p-6 flex flex-col flex-grow text-left">
                    <h3 class="text-[#0a3118] font-bold text-xl mb-2">PD ANMI Iténez</h3>
                    <p class="text-gray-600 text-xs md:text-sm font-light leading-relaxed mb-4 flex-grow">
                        Biodiversidad fluvial inigualable y frontera natural biológica.
                    </p>
                    <!-- Etiqueta de Ubicación Inferior -->
                    <div class="mt-auto">
                        <span class="inline-flex items-center gap-1.5 bg-[#FEF9E7] text-[#B7950B] text-[11px] font-semibold px-3 py-1 rounded-full">
                            <!-- Icono de Pin de Mapa Sutil -->
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            Provincia Iténez
                        </span>
                    </div>
                </div>
            </div>

            <!-- TARJETA 2: TIPNIS -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                <div class="h-[200px] w-full overflow-hidden">
                    <img src="{{ asset('images/tipnis.webp') }}" alt="TIPNIS" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow text-left">
                    <h3 class="text-[#0a3118] font-bold text-xl mb-2">TIPNIS</h3>
                    <p class="text-gray-600 text-xs md:text-sm font-light leading-relaxed mb-4 flex-grow">
                        Parque Nacional Isiboro Sécure, territorio indígena y pulmón del mundo.
                    </p>
                    <div class="mt-auto">
                        <span class="inline-flex items-center gap-1.5 bg-[#FEF9E7] text-[#B7950B] text-[11px] font-semibold px-3 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            Sur del Beni
                        </span>
                    </div>
                </div>
            </div>

            <!-- TARJETA 3: E.B. del Beni -->
            <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                <div class="h-[200px] w-full overflow-hidden">
                    <img src="{{ asset('images/biosfera.webp') }}" alt="E.B. del Beni" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-grow text-left">
                    <h3 class="text-[#0a3118] font-bold text-xl mb-2">E.B. del Beni</h3>
                    <p class="text-gray-600 text-xs md:text-sm font-light leading-relaxed mb-4 flex-grow">
                        Centro de investigación y reserva de la biosfera (UNESCO).
                    </p>
                    <div class="mt-auto">
                        <span class="inline-flex items-center gap-1.5 bg-[#FEF9E7] text-[#B7950B] text-[11px] font-semibold px-3 py-1 rounded-full">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                            </svg>
                            Provincia Ballivián
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Sección con el Fondo Verde Oscuro Institucional -->
<section id="ventanas-paraiso" class="bg-[#0a3118] py-16 px-6 md:px-12 lg:px-24">
    <div class="max-w-7xl mx-auto">

        <!-- 1. Encabezado Alineado a la Izquierda -->
        <div class="text-left mb-10">
            <h2 class="text-white font-bold text-3xl md:text-4xl tracking-tight mb-2">
                Ventanas al Paraíso
            </h2>
            <p class="text-white/80 text-sm md:text-base font-light">
                La luz del Beni capturada en instantes eternos.
            </p>
        </div>

        <!-- 2. Rejilla de Imágenes Cuadradas (4 columnas en pantallas grandes) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">

            <!-- Foto 1: Atardecer / Horizonte -->
            <div class="aspect-square w-full rounded-xl overflow-hidden shadow-sm group relative">
                <img src="{{ asset('images/llanos.png') }}" alt="Atardecer en la llanura beniana" class="w-full h-full object-cover transform group-hover:scale-[1.04] transition-transform duration-500">
                <!-- Efecto hover sutil opcional: aclarado ligero al pasar el mouse -->
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
            </div>

            <!-- Foto 2: Bufeo / Delfín Rosado -->
            <div class="aspect-square w-full rounded-xl overflow-hidden shadow-sm group relative">
                <img src="{{ asset('images/bufeo.jpg') }}" alt="Bufeo boliviano en el río" class="w-full h-full object-cover transform group-hover:scale-[1.04] transition-transform duration-500">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
            </div>

            <!-- Foto 3: Ganadería / Llanos -->
            <div class="aspect-square w-full rounded-xl overflow-hidden shadow-sm group relative">
                <img src="{{ asset('images/ganaderia.jpg') }}" alt="Paisaje ganadero del Beni" class="w-full h-full object-cover transform group-hover:scale-[1.04] transition-transform duration-500">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
            </div>

            <!-- Foto 4: Curvas del Río / Selva -->
            <div class="aspect-square w-full rounded-xl overflow-hidden shadow-sm group relative">
                <img src="{{ asset('images/rios.webp') }}" alt="Vista aérea de ríos benianos" class="w-full h-full object-cover transform group-hover:scale-[1.04] transition-transform duration-500">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
            </div>

        </div>
    </div>
</section>

<!-- Sección CTA con fondo claro muy suave para contrastar ligeramente con la galería anterior -->
<section id="cta-experiencia" class="bg-gray-50/50 py-20 px-6 md:px-12">
    <div class="max-w-4xl mx-auto text-center flex flex-col items-center justify-center">

        <!-- 1. Pregunta Principal Interpelativa -->
        <h2 class="text-[#0a3118] font-bold text-2xl md:text-3.5xl lg:text-4xl tracking-tight mb-4">
            ¿Listo para vivir la experiencia beniana?
        </h2>

        <!-- 2. Cita Inspiradora en Cursiva -->
        <p class="text-gray-600 text-sm md:text-base italic font-light tracking-wide mb-8 max-w-2xl">
            "Cuna de libertad y de progreso, selva de encanto y de hermosura."
        </p>

        <!-- 3. Contenedor de Botones (Apilados en móvil, en fila en pantallas medianas) -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 w-full sm:w-auto">

            <!-- Botón Primario: Guía de Turismo PDF -->
            <a href="#"
               class="w-full sm:w-auto inline-flex items-center justify-center bg-[#0a3118] text-white text-sm font-bold px-8 py-3.5 rounded-lg shadow-sm hover:bg-[#06200f] transition-all duration-200 tracking-wide text-center">
                Guía de Turismo PDF
            </a>

            <!-- Botón Secundario: Contactar Operadores -->
            <a href="#"
               class="w-full sm:w-auto inline-flex items-center justify-center bg-white text-[#d4ac0d] border border-[#d4ac0d] text-sm font-semibold px-8 py-3.5 rounded-lg hover:bg-gray-50 transition-all duration-200 tracking-wide text-center">
                Contactar Operadores
            </a>

        </div>

    </div>
</section>
@endsection
