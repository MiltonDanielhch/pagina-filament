@extends('layouts.main')

@section('title', $title . ' - Gobernación Autónoma del Beni')
@section('meta_description', $description)

@section('content')
<!-- Sección: Beni Productivo e Industria (Blindada) -->
<section id="beni-productivo" class="bg-white py-20 px-4 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <!-- Encabezado de la Sección Forzado -->
        <div class="w-full mb-12 block text-left" style="display: block; width: 100%; text-align: left;">
            <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl mb-4 tracking-tight block" style="display: block; font-weight: 700; color: #0a3118;">
                Beni Productivo e Industria
            </h2>
            <p class="text-gray-500 text-sm md:text-base font-light leading-relaxed block max-w-3xl" style="display: block; width: 100%; max-w: 48rem; white-space: normal; text-align: left; color: #6b7280; line-height: 1.625;">
                Impulsamos la soberanía alimentaria y el desarrollo económico regional a través de la tecnificación agroindustrial, la ganadería de élite y la exportación de nuestros recursos naturales.
            </p>
        </div>

        <!-- Grid de Contenido Principal -->
        <div class="flex flex-col lg:flex-row gap-6 items-stretch w-full" style="display: flex; width: 100%;">

            <!-- TARJETA IZQUIERDA: Imagen Destacada (Ocupa el 65% en pantallas grandes) -->
            <div class="w-full lg:w-[65%] rounded-3xl relative overflow-hidden min-h-[400px] lg:min-h-full shadow-sm flex flex-col justify-end p-8 flex-shrink-0" style="display: flex; flex-direction: column; justify-content: flex-end; position: relative; overflow: hidden; border-radius: 1.5rem;">
                <img src="https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&w=1200&q=80" alt="Ganadería de Exportación" class="absolute inset-0 w-full h-full object-cover z-0">

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>

                <div class="relative z-20 text-left block w-full" style="display: block; width: 100%; max-width: 100%; text-align: left; box-sizing: border-box;">
                    <span class="text-[#e5c158] font-bold text-xs uppercase tracking-wider block mb-1" style="display: block; color: #e5c158; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em;">
                        Sector Estratégico
                    </span>
                    <h3 class="text-white font-bold text-2xl md:text-3xl mb-3 block" style="display: block; font-weight: 700; color: #fff; width: 100%; white-space: normal !important;">
                        Ganadería de Exportación
                    </h3>
                    <p class="text-gray-200 text-xs md:text-sm font-light leading-relaxed block" style="display: block; width: 100%; max-width: 38rem; white-space: normal !important; color: #e5e7eb; line-height: 1.5; overflow-wrap: break-word;">
                        El Beni es el corazón ganadero de Bolivia, con un hato que supera los 3 millones de cabezas. Implementamos programas de mejoramiento genético y trazabilidad.
                    </p>
                </div>
            </div>

            <!-- COLUMNA DERECHA: Bloques de Información (Ocupa el 35% en pantallas grandes) -->
            <div class="w-full lg:w-[35%] flex flex-col gap-6 justify-between flex-shrink-0" style="display: flex; flex-direction: column; justify-content: space-between;">

                <!-- Tarjeta Superior: Estadística (3.1M) -->
                <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm text-left block w-full" style="display: block; width: 100%; background-color: #fff; border-radius: 1.5rem; border-width: 1px; padding: 2rem; text-align: left;">
                    <div class="flex items-center gap-2 mb-2 text-[#0a3118]" style="display: flex; flex-direction: row; align-items: center; color: #0a3118;">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="font-black text-3xl md:text-4xl tracking-tight block" style="display: block; font-weight: 900;">3.1M</span>
                    </div>
                    <h4 class="text-gray-400 font-bold text-xs uppercase tracking-wider block mb-3" style="display: block; color: #9ca3af; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em;">
                        Cabezas de Ganado Bovino
                    </h4>
                    <p class="text-gray-500 text-xs md:text-sm font-light leading-relaxed block" style="display: block; width: 100%; white-space: normal; color: #6b7280; line-height: 1.5;">
                        Crecimiento sostenido del 4.2% anual en la producción cárnica del departamento.
                    </p>
                </div>

                <!-- Tarjeta Inferior: Programa Genético (Verde Institucional) -->
                <div class="bg-[#0a3118] text-white rounded-3xl p-8 shadow-sm text-left flex flex-col justify-between h-full min-h-[200px] block w-full" style="display: flex; flex-direction: column; justify-content: space-between; width: 100%; background-color: #0a3118; border-radius: 1.5rem; padding: 2rem; text-align: left;">
                    <div class="block w-full">
                        <h3 class="text-white font-bold text-xl mb-3 block" style="display: block; font-weight: 700; color: #fff;">
                            Programa Genético
                        </h3>
                        <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed block mb-6" style="display: block; width: 100%; white-space: normal; color: #d1d5db; line-height: 1.5;">
                            Inversión de 15M BOB en centros de inseminación artificial para pequeños productores.
                        </p>
                    </div>
                    <div class="block w-full">
                        <a href="#" class="border border-[#e5c158] hover:bg-[#e5c158] text-[#e5c158] hover:text-[#0a3118] font-bold text-xs px-5 py-2.5 rounded-xl transition-all duration-200 inline-block" style="display: inline-block; border-width: 1px; border-color: #e5c158; color: #e5c158; font-weight: 700; font-size: 0.75rem; border-radius: 0.75rem; padding: 0.625rem 1.25rem;">
                            Ver Programas
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

<!-- Sección: Agricultura de Precisión -->
<section class="bg-[#fcfaf6] py-16 px-6 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <div class="flex flex-col lg:flex-row gap-12 items-center justify-between w-full" style="display: flex; width: 100%; justify-content: space-between; align-items: center;">

            <div class="w-full lg:w-[48%] flex flex-col justify-center text-left flex-shrink-0" style="display: flex; flex-direction: column; justify-content: center; width: 100%; max-width: 38rem; box-sizing: border-box;">

                <div class="mb-5 block">
                    <span class="bg-[#fef5d1] text-[#a0781a] text-[11px] font-bold px-3 py-1 rounded-md uppercase tracking-wider inline-block" style="display: inline-block;">
                        Innovación Tecnológica
                    </span>
                </div>

                <h2 class="text-[#0a3118] font-bold text-2xl md:text-3xl lg:text-4xl mb-6 leading-tight block" style="display: block; font-weight: 700; color: #0a3118; white-space: normal !important;">
                    Agricultura de Precisión: Arroz y Soya
                </h2>

                <p class="text-gray-600 text-sm md:text-base font-light leading-relaxed mb-8 block" style="display: block; width: 100%; white-space: normal !important; color: #4b5563; line-height: 1.625; overflow-wrap: break-word;">
                    Estamos ", las pampas benianas en el nuevo granero del país. Con el uso de sensores, mapeo satelital y biotecnología, los proyectos de arroz y soya en Marbán e Iténez alcanzan rendimientos históricos.
                </p>

                <div class="space-y-5 w-full block" style="display: block; width: 100%;">

                    <div class="flex items-start gap-3 mb-5" style="display: flex; align-items: flex-start;">
                        <div class="text-[#bfa141] mt-0.5 flex-shrink-0" style="flex-shrink: 0;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="block" style="display: block; white-space: normal !important;">
                            <h4 class="text-[#0a3118] font-bold text-sm mb-0.5" style="font-weight: 700; color: #0a3118;">Eficiencia Hídrica</h4>
                            <p class="text-gray-500 text-sm font-light" style="color: #6b7280; white-space: normal !important;">Sistemas de riego automatizados para cultivos de alto valor.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3" style="display: flex; align-items: flex-start;">
                        <div class="text-[#bfa141] mt-0.5 flex-shrink-0" style="flex-shrink: 0;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="block" style="display: block; white-space: normal !important;">
                            <h4 class="text-[#0a3118] font-bold text-sm mb-0.5" style="font-weight: 700; color: #0a3118;">Zonificación Agroecológica</h4>
                            <p class="text-gray-500 text-sm font-light" style="color: #6b7280; white-space: normal !important;">Protección de suelos y manejo responsable de la frontera agrícola.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="w-full lg:w-[50%] flex justify-center lg:justify-end flex-shrink" style="display: flex; justify-content: flex-end; width: 100%; max-width: 50%; box-sizing: border-box;">
                <div class="bg-[#f2efe9] p-3 rounded-2xl w-full shadow-md transform rotate-[0.5deg] block" style="display: block; width: 100%; max-width: 100%; box-sizing: border-box; background-color: #f2efe9; border-radius: 1rem; padding: 0.75rem; overflow: hidden;">
                    <img src="{{ asset('images/agricola.jpg') }}" alt="Cosecha de Arroz y Soya" class="w-full h-auto object-cover rounded-xl block shadow-sm" style="display: block; width: 100%; height: 380px; border-radius: 0.75rem; object-fit: cover;">
                </div>
            </div>

        </div>

    </div>
</section>

<!-- SECCIÓN: CASTAÑA Y CADENA DE VALOR (Aislada para Filament) -->
<section id="seccion-castana" class="bg-[#f9fafb] py-16 px-4 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <!-- Encabezado con Botones de Navegación Forzados a Horizontal -->
        <div class="w-full mb-10 flex flex-row items-end justify-between" style="display: flex; flex-direction: row; justify-content: space-between; align-items: flex-end; width: 100%; margin-bottom: 2.5rem;">
            <div class="text-left block" style="display: block; text-align: left;">
                <h3 class="text-[#0a3118] font-bold text-2xl md:text-3xl mb-2 block" style="display: block; font-weight: 700; color: #0a3118; margin-bottom: 0.5rem; font-size: 1.875rem;">
                    Castaña y Cadena de Valor
                </h3>
                <p class="text-gray-500 text-sm font-light block" style="display: block; color: #6b7280; white-space: normal; font-size: 0.875rem;">
                    El "Oro Blanco" del Beni conquistando mercados internacionales.
                </p>
            </div>

            <!-- Controles de Navegación del Carrusel -->
            <div class="flex flex-row gap-3 flex-shrink-0" style="display: flex; flex-direction: row; gap: 0.75rem; flex-shrink: 0;">
                <button type="button" class="w-10 h-10 border border-gray-200 rounded-xl flex items-center justify-center text-gray-400 hover:text-[#0a3118] hover:border-[#0a3118] bg-white transition-colors cursor-pointer shadow-none" style="display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border-radius: 0.75rem; border: 1px solid #e5e7eb; background-color: #fff;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button type="button" class="w-10 h-10 border border-gray-200 rounded-xl flex items-center justify-center text-gray-400 hover:text-[#0a3118] hover:border-[#0a3118] bg-white transition-colors cursor-pointer shadow-none" style="display: flex; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; border-radius: 0.75rem; border: 1px solid #e5e7eb; background-color: #fff;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <!-- GRID PRINCIPAL DE LAS 3 TARJETAS -->
        <div class="flex flex-col md:flex-row gap-6 items-stretch w-full" style="display: flex; flex-direction: row; gap: 1.5rem; width: 100%; flex-wrap: wrap; lg:flex-wrap: nowrap;">

            <!-- TARJETA 1: Recolección Silvestre (Con Imagen Superior) -->
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex flex-col justify-between text-left flex-1 min-w-[280px]" style="display: flex; flex-direction: column; justify-content: space-between; background-color: #fff; border: 1px solid #f3f4f6; border-radius: 1rem; padding: 1.25rem; flex: 1 1 0%; min-width: 280px; text-align: left;">
                <div class="block w-full">
                    <!-- Contenedor de la Imagen Fijo -->
                    <div class="w-full h-44 rounded-xl overflow-hidden mb-5 block" style="display: block; width: 100%; height: 11rem; border-radius: 0.75rem; overflow: hidden; margin-bottom: 1.25rem;">
                        <img src="https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?auto=format&fit=crop&w=600&q=80" alt="Recolección de Castaña" class="w-full h-full object-cover block" style="display: block; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h4 class="text-[#0a3118] font-bold text-lg mb-2 block" style="display: block; font-weight: 700; color: #0a3118; font-size: 1.125rem;">
                        Recolección Silvestre
                    </h4>
                    <p class="text-gray-500 text-xs md:text-sm font-light leading-relaxed block mb-6" style="display: block; color: #6b7280; white-space: normal; line-height: 1.5; font-size: 0.875rem; margin-bottom: 1.5rem;">
                        Mantenemos la pureza del bosque amazónico a través de procesos de recolección sostenible por comunidades locales.
                    </p>
                </div>
                <div class="block w-full">
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-bold text-xs inline-flex items-center gap-1" style="display: inline-flex; align-items: center; color: #2563eb; font-weight: 700; font-size: 0.75rem; text-decoration: none;">
                        Proceso técnico
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 0.75rem; height: 0.75rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- TARJETA 2: Métrica 75% -->
            <div class="bg-white border border-[#e5c158]/40 rounded-2xl shadow-sm p-8 flex flex-col justify-between text-left flex-1 min-w-[280px]" style="display: flex; flex-direction: column; justify-content: space-between; background-color: #fff; border: 1px solid rgba(229, 193, 88, 0.4); border-radius: 1rem; padding: 2rem; flex: 1 1 0%; min-width: 280px; text-align: left;">
                <div class="block w-full">
                    <span class="text-[#0a3118] font-black text-5xl tracking-tight block mb-2" style="display: block; font-weight: 900; color: #0a3118; font-size: 3rem; letter-spacing: -0.05em;">
                        75%
                    </span>
                    <h5 class="text-gray-400 font-bold text-[10px] tracking-wider uppercase block mb-4" style="display: block; color: #9ca3af; font-weight: 700; font-size: 0.65rem; letter-spacing: 0.05em; margin-bottom: 1rem;">
                        Participación Global
                    </h5>
                    <p class="text-gray-600 text-sm font-light leading-relaxed block" style="display: block; color: #4b5563; white-space: normal; line-height: 1.5; font-size: 0.875rem;">
                        Bolivia es el principal exportador mundial de castaña, siendo el Beni el centro de procesamiento y salida.
                    </p>
                </div>
                <!-- Fuente al pie de la tarjeta -->
                <span class="text-gray-400 italic text-[10px] block pt-4 border-t border-gray-50 tracking-wide mt-6" style="display: block; color: #9ca3af; font-style: italic; font-size: 0.65rem; border-top: 1px solid #f9fafb; margin-top: 1.5rem;">
                    Fuente: Cámara de Exportadores del Norte (CADEXNOR)
                </span>
            </div>

            <!-- TARJETA 3: Hacia la Industrialización (Verde Institucional) -->
            <div class="bg-[#0a3118] text-white rounded-2xl shadow-md p-8 flex flex-col justify-start text-left flex-1 min-w-[280px]" style="display: flex; flex-direction: column; justify-content: flex-start; background-color: #0a3118; border-radius: 1rem; padding: 2rem; flex: 1 1 0%; min-width: 280px; text-align: left;">
                <!-- Icono de Fábrica Superior -->
                <div class="text-[#e5c158] mb-4 block" style="display: block; color: #e5c158; margin-bottom: 1rem;">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 2rem; height: 2rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21V10.5l-3.75 3v-3l-3.75 3V10.5L8.25 13.5V9L4.5 12v9h15zM3 21h18M9 18v3M12 18v3M15 18v3"></path>
                    </svg>
                </div>

                <h4 class="text-white font-bold text-xl mb-3 block" style="display: block; font-weight: 700; color: #fff; font-size: 1.25rem; margin-bottom: 0.75rem;">
                    Hacia la Industrialización
                </h4>
                <p class="text-gray-200 text-xs md:text-sm font-light leading-relaxed block mb-6" style="display: block; color: #e5e7eb; white-space: normal; line-height: 1.5; font-size: 0.875rem; margin-bottom: 1.5rem;">
                    Fomentamos la instalación de plantas quebradoras y empacadoras con estándares internacionales ISO 22000.
                </p>

                <!-- Viñetas internas personalizadas -->
                <ul class="space-y-2 block w-full border-t border-white/10 pt-4" style="display: block; width: 100%; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem; list-style: none; margin: 0; padding-left: 0;">
                    <li class="flex items-center gap-2 text-[#e5c158] text-xs font-semibold" style="display: flex; flex-direction: row; align-items: center; gap: 0.5rem; color: #e5c158; font-weight: 600; font-size: 0.75rem; margin-bottom: 0.5rem;">
                        <span style="display: inline-block; width: 4px; height: 4px; background-color: #e5c158; border-radius: 9999px;"></span>
                        Valor Agregado local
                    </li>
                    <li class="flex items-center gap-2 text-[#e5c158] text-xs font-semibold" style="display: flex; flex-direction: row; align-items: center; gap: 0.5rem; color: #e5c158; font-weight: 600; font-size: 0.75rem;">
                        <span style="display: inline-block; width: 4px; height: 4px; background-color: #e5c158; border-radius: 9999px;"></span>
                        Empleo Dignificado
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

<!-- SECCIÓN: ¿POR QUÉ INVERTIR EN EL BENI? (Blindado para Filament) -->
<section id="seccion-invertir" class="bg-[#f3f4f6] py-12 px-4 sm:px-6 md:px-12 rounded-3xl w-full block clear-both border border-gray-100" style="display: block; width: 100%; clear: both; box-sizing: border-box; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <div class="max-w-6xl mx-auto w-full flex flex-col lg:flex-row gap-8 items-center justify-between" style="display: flex; flex-direction: row; flex-wrap: wrap; lg:flex-wrap: nowrap; justify-content: space-between; align-items: center; width: 100%;">

        <!-- COLUMNA IZQUIERDA: Textos, Tarjetas Pequeñas y Botón -->
        <div class="flex-1 min-w-[300px] text-left block" style="display: block; flex: 1 1 0%; min-width: 300px; text-align: left;">
            <h3 class="text-[#0a3118] font-bold text-2xl md:text-3xl mb-4 block" style="display: block; font-weight: 700; color: #0a3118; margin-bottom: 1rem; font-size: 1.875rem;">
                ¿Por qué invertir en el Beni?
            </h3>
            <p class="text-gray-600 text-sm md:text-base font-light leading-relaxed mb-8 block" style="display: block; width: 100%; max-width: 42rem; white-space: normal !important; color: #4b5563; line-height: 1.625; overflow-wrap: break-word;">
                Contamos con seguridad jurídica, incentivos fiscales regionales y la ubicación estratégica para la conexión bioceánica.
            </p>

            <!-- Mini Tarjetas: Exenciones y Logística -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8 w-full" style="display: flex; flex-direction: row; gap: 1rem; width: 100%; margin-bottom: 2rem; flex-wrap: wrap;">
                <!-- Tarjeta Exenciones -->
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-50 flex-1 min-w-[140px] text-left block" style="display: block; background-color: #fff; padding: 1rem; border-radius: 0.75rem; flex: 1 1 0%; min-width: 140px; text-align: left;">
                    <h4 class="text-[#0a3118] font-bold text-base mb-1 block" style="display: block; font-weight: 700; color: #0a3118; font-size: 1rem; margin-bottom: 0.25rem;">
                        Exenciones
                    </h4>
                    <p class="text-gray-400 text-[11px] leading-tight block" style="display: block; color: #9ca3af; font-size: 0.6875rem; line-height: 1.25; white-space: normal;">
                        Tributarias para nuevas industrias
                    </p>
                </div>

                <!-- Tarjeta Logística -->
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-50 flex-1 min-w-[140px] text-left block" style="display: block; background-color: #fff; padding: 1rem; border-radius: 0.75rem; flex: 1 1 0%; min-width: 140px; text-align: left;">
                    <h4 class="text-[#0a3118] font-bold text-base mb-1 block" style="display: block; font-weight: 700; color: #0a3118; font-size: 1rem; margin-bottom: 0.25rem;">
                        Logística
                    </h4>
                    <p class="text-gray-400 text-[11px] leading-tight block" style="display: block; color: #9ca3af; font-size: 0.6875rem; line-height: 1.25; white-space: normal;">
                        Nuevas hidrovías y carreteras
                    </p>
                </div>
            </div>

            <!-- Botón de Descarga -->
            <a href="#" class="inline-flex items-center gap-2 bg-[#0a3118] text-white font-semibold text-xs md:text-sm py-3 px-5 rounded-lg shadow transition-all hover:bg-[#072211] cursor-pointer" style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: #0a3118; color: #fff; font-weight: 600; font-size: 0.875rem; padding: 0.75rem 1.25rem; border-radius: 0.5rem; text-decoration: none;">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
                </svg>
                Descargar Guía del Inversionista 2024
            </a>
        </div>

        <!-- COLUMNA DERECHA: Áreas Prioritarias (Caja Blanca Flotante) -->
        <div class="w-full lg:w-[420px] bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8 block text-left" style="display: block; background-color: #fff; border-radius: 1rem; padding: 2rem; width: 100%; max-width: 420px; text-align: left; box-sizing: border-box;">
            <h4 class="text-[#0a3118] font-bold text-lg md:text-xl mb-6 block" style="display: block; font-weight: 700; color: #0a3118; font-size: 1.25rem; margin-bottom: 1.5rem;">
                Áreas Prioritarias
            </h4>

            <!-- Lista de Enlaces / Items -->
            <div class="flex flex-col gap-4 w-full" style="display: flex; flex-direction: column; gap: 1rem; width: 100%;">

                <!-- Item 1: Energías Renovables -->
                <a href="#" class="flex flex-row items-center justify-between py-3 px-4 rounded-xl border border-transparent hover:border-gray-100 hover:bg-gray-50/50 transition-all text-slate-700 font-medium text-xs md:text-sm group" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; color: #374151; font-weight: 500; font-size: 0.875rem; text-decoration: none;">
                    <div class="flex flex-row items-center gap-3" style="display: flex; flex-direction: row; align-items: center; gap: 0.75rem;">
                        <span class="text-[#e5c158]" style="color: #e5c158; display: flex; align-items: center;">
                            <!-- Icono Rayo / Energía -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </span>
                        <span>Energías Renovables</span>
                    </div>
                    <span class="text-gray-400" style="color: #9ca3af;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </a>

                <!-- Item 2: Plataforma Logística Trinidad -->
                <a href="#" class="flex flex-row items-center justify-between py-3 px-4 rounded-xl border border-transparent hover:border-gray-100 hover:bg-gray-50/50 transition-all text-slate-700 font-medium text-xs md:text-sm group" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; color: #374151; font-weight: 500; font-size: 0.875rem; text-decoration: none;">
                    <div class="flex flex-row items-center gap-3" style="display: flex; flex-direction: row; align-items: center; gap: 0.75rem;">
                        <span class="text-[#e5c158]" style="color: #e5c158; display: flex; align-items: center;">
                            <!-- Icono Camión / Logística -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </span>
                        <span>Plataforma Logística Trinidad</span>
                    </div>
                    <span class="text-gray-400" style="color: #9ca3af;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </a>

                <!-- Item 3: Biotecnología Aplicada -->
                <a href="#" class="flex flex-row items-center justify-between py-3 px-4 rounded-xl border border-transparent hover:border-gray-100 hover:bg-gray-50/50 transition-all text-slate-700 font-medium text-xs md:text-sm group" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; color: #374151; font-weight: 500; font-size: 0.875rem; text-decoration: none;">
                    <div class="flex flex-row items-center gap-3" style="display: flex; flex-direction: row; align-items: center; gap: 0.75rem;">
                        <span class="text-[#e5c158]" style="color: #e5c158; display: flex; align-items: center;">
                            <!-- Icono Matraz / Ciencia -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </span>
                        <span>Biotecnología Aplicada</span>
                    </div>
                    <span class="text-gray-400" style="color: #9ca3af;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1rem; height: 1rem;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </span>
                </a>

            </div>
        </div>

    </div>
</section>

<!-- SECCIÓN: TESTIMONIO DE PRODUCTOR (Blindado para Filament) -->
<section id="seccion-testimonio" class="bg-[#f9fafb] py-16 px-4 sm:px-6 md:px-12 w-full block clear-both" style="display: block; width: 100%; clear: both; box-sizing: border-box; font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <div class="max-w-4xl mx-auto w-full flex flex-col items-center justify-center text-center" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 100%;">

        <!-- Icono de Comillas Superiores -->
        <div class="text-[#e5c158] font-serif text-6xl leading-none select-none mb-4 block" style="display: block; color: #e5c158; font-family: Georgia, Cambria, 'Times New Roman', Times, serif; font-size: 3.75rem; line-height: 1; margin-bottom: 1rem;">
            “
        </div>

        <!-- Bloque de Texto de la Cita -->
        <blockquote class="w-full block mb-8" style="display: block; width: 100%; margin: 0 0 2rem 0; padding: 0; border: none;">
            <p class="text-[#0a3118] font-bold italic text-xl sm:text-2xl md:text-3xl leading-relaxed tracking-tight max-w-3xl mx-auto block" style="display: block; color: #0a3118; font-weight: 700; font-style: italic; line-height: 1.5; font-size: 1.75rem; letter-spacing: -0.025em; max-w: 48rem; margin-left: auto; margin-right: auto; white-space: normal;">
                "El apoyo técnico de la Gobernación ha sido fundamental para pasar de una ganadería tradicional a una de ciclo completo. Hoy el Beni no solo produce carne, produce genética de clase mundial."
            </p>
        </blockquote>

        <!-- Autor del Testimonio / Firma -->
        <div class="flex flex-col items-center justify-center space-y-3 block" style="display: block; text-align: center;">

            <!-- Contenedor del Avatar con Borde Dorado -->
            <div class="w-16 h-16 rounded-xl overflow-hidden p-0.5 bg-gradient-to-br from-[#e5c158] to-[#c9a43b] shadow-sm mb-3 mx-auto block" style="display: block; width: 4rem; height: 4rem; border-radius: 0.75rem; background: linear-gradient(135deg, #e5c158, #c9a43b); padding: 2px; box-sizing: border-box; margin-left: auto; margin-right: auto;">
                <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=256&q=80" alt="Ing. Carlos Antelo" class="w-full h-full object-cover rounded-[10px] block" style="display: block; width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
            </div>

            <!-- Datos del Productor -->
            <h5 class="text-slate-900 font-bold text-sm md:text-base tracking-wide block mb-1" style="display: block; color: #0f172a; font-weight: 700; font-size: 0.9375rem; margin-bottom: 0.25rem;">
                Ing. Carlos
            </h5>
            <p class="text-gray-400 font-bold text-[10px] sm:text-[11px] tracking-widest uppercase block" style="display: block; color: #9ca3af; font-weight: 700; font-size: 0.6875rem; letter-spacing: 0.1em; margin: 0;">
                Productor Pecuario - Región Moxos
            </p>
        </div>

    </div>
</section>
@endsection
