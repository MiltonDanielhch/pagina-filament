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
                        <img src="{{ asset('images/vice.webp') }}" alt="Retrato oficial de Juan Carlos Teddy Camacho Gamarra, Vicegobernador del Beni" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 text-center">Juan Carlos "Teddy" Camacho Gamarra</h2>
                    <p class="text-official font-semibold text-center mb-4">Vicegobernador del Beni</p>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-official" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-gray-600">Ingeniero Industrial y Comercial</span>
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
                <!-- Perfil General -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Perfil General</h3>
                    <div class="prose prose-lg text-gray-600">
                        <p>
                            <strong>Msc. Juan Carlos T. Camacho Gamarra</strong>, conocido ampliamente como <strong>Teddy Camacho</strong>, es un profesional beniano, ingeniero industrial y comercial, especialista en desarrollo productivo, seguridad alimentaria y gestión empresarial. Actualmente ejerce el cargo de <strong>Vicegobernador del Departamento Autónomo del Beni</strong>, desempeñando funciones de coordinación institucional, representación departamental y apoyo a la gestión pública en beneficio de la población beniana.
                        </p>
                        <p>
                            Nacido y formado en <strong>Riberalta</strong>, provincia Vaca Díez, Teddy Camacho ha construido una trayectoria profesional y académica orientada al fortalecimiento del desarrollo productivo de la Amazonía boliviana.
                        </p>
                    </div>
                </div>

                <!-- Formación Académica -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Formación Académica</h3>
                    <div class="prose prose-lg text-gray-600">
                        <p>
                            Su formación incluye el título de <strong>Ingeniero Industrial y Comercial</strong>, una <strong>Maestría en Seguridad Alimentaria</strong>, estudios de <strong>MBA</strong>, además de diversos diplomados y cursos de especialización en áreas relacionadas con seguridad industrial, medio ambiente, auditoría, producción y gestión empresarial. Asimismo, se encuentra vinculado a procesos de formación avanzada en ciencias empresariales y desarrollo organizacional.
                        </p>
                    </div>
                </div>

                <!-- Carrera Profesional -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Carrera Profesional</h3>
                    <div class="prose prose-lg text-gray-600">
                        <p>
                            A lo largo de su carrera ha acumulado una amplia experiencia en el ámbito académico, técnico y empresarial. Durante <strong>siete años</strong> se desempeñó como <strong>Jefe de Carrera de Industria de Alimentos</strong> del <strong>Instituto Tecnológico Superior de la Amazonía (ITSA)</strong>, liderando importantes proyectos de fortalecimiento institucional. Entre sus principales logros destaca la gestión de <strong>dos módulos completamente equipados con laboratorios especializados</strong>, implementados con el apoyo de la Cooperación Suiza y ONU Mujeres, contribuyendo significativamente a la formación técnica y profesional de cientos de estudiantes de la región.
                        </p>
                        <p>
                            Su experiencia profesional también incluye el ejercicio como <strong>consultor y supervisor en seguridad industrial</strong>, gestión ambiental y procesos productivos, además de desempeñarse como <strong>certificador de normas internacionales</strong> para empresas castañeras, sector estratégico para la economía del norte amazónico. Asimismo, ha brindado asesoramiento técnico en cadenas productivas, recursos naturales e industrias vinculadas a la transformación de materias primas amazónicas.
                        </p>
                        <p>
                            En el ámbito institucional, fue <strong>Presidente de la Asociación de Profesionales de Riberalta</strong>, impulsando iniciativas orientadas al fortalecimiento de las capacidades profesionales y al desarrollo regional. Su trabajo ha estado enfocado en promover la <strong>industrialización</strong>, la generación de valor agregado y el aprovechamiento sostenible de los recursos naturales del Beni.
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

                <!-- Gestión como Vicegobernador -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Gestión como Vicegobernador</h3>
                    <div class="prose prose-lg text-gray-600">
                        <p>
                            Como Vicegobernador del Beni, Teddy Camacho trabaja en estrecha coordinación con el gobernador <strong>Dr. Jesús Eguez Rivero</strong>, impulsando proyectos, convenios y programas destinados a fortalecer la salud, la educación, la producción, la integración regional y la gestión ambiental. Su gestión promueve la articulación entre los diferentes niveles de gobierno, instituciones públicas y privadas, organismos de cooperación internacional y organizaciones sociales, con el objetivo de generar mayores oportunidades para la población.
                        </p>
                        <p>
                            Su gestión promueve un modelo de <strong>desarrollo productivo y sostenible</strong> para la Amazonía boliviana.
                        </p>
                    </div>
                </div>

                <!-- Visión de Desarrollo -->
                <div class="bg-official/5 rounded-xl p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visión de Desarrollo</h3>
                    <div class="prose prose-lg text-gray-600">
                        <p>
                            Su visión de desarrollo se fundamenta en la convicción de que el potencial económico del Beni debe transformarse en bienestar para sus habitantes. Por ello, impulsa políticas orientadas a la <strong>industrialización de la castaña, la madera, los frutos amazónicos</strong> y otros recursos estratégicos, promoviendo la capacitación técnica de los jóvenes y el fortalecimiento de instituciones educativas como el ITSA e INCOS.
                        </p>
                        <p>
                            Asimismo, defiende una gestión responsable de los recursos naturales, promoviendo el ordenamiento y control de las actividades extractivas, la protección del medio ambiente y el aprovechamiento sostenible de las riquezas amazónicas. Considera que el desarrollo regional debe sustentarse en la formación, la innovación, la producción con valor agregado y la apertura de oportunidades para la exportación y el comercio internacional.
                        </p>
                        <p>
                            Reconocido por su capacidad técnica, vocación de servicio y compromiso con la región amazónica, Teddy Camacho representa una nueva generación de liderazgo público orientada al trabajo coordinado, la transparencia, la eficiencia administrativa y el desarrollo sostenible. Su trayectoria combina formación académica, experiencia profesional y conocimiento de la realidad beniana, consolidándolo como una de las figuras destacadas en la promoción del crecimiento económico y social del departamento.
                        </p>
                    </div>
                </div>

                <!-- Compromiso -->
                <div class="border-l-4 border-official pl-6 py-2">
                    <blockquote class="text-lg italic text-gray-700">
                        "Construir un Beni más productivo, competitivo e inclusivo, donde el conocimiento, la capacitación y la industrialización permitan transformar la riqueza natural en oportunidades y bienestar para todas las familias benianas."
                    </blockquote>
                    <cite class="text-official font-semibold">— Teddy Camacho, Vicegobernador del Beni</cite>
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