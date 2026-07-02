@extends('layouts.main')

@section('title', $title . ' - Gobernación Autónoma del Beni')
@section('meta_description', $description)

@section('content')
<section id="seccion-castana" class="bg-[#f9fafb] py-16 px-4 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <div class="w-full mb-10 flex flex-row items-end justify-between" style="display: flex; flex-direction: row; justify-content: space-between; align-items: flex-end; width: 100%; margin-bottom: 2.5rem;">
            <div class="text-left block" style="display: block; text-align: left;">
                <h3 class="text-[#0a3118] font-bold text-2xl md:text-3xl mb-2 block" style="display: block; font-weight: 700; color: #0a3118; margin-bottom: 0.5rem; font-size: 1.875rem;">
                    Castaña y Cadena de Valor
                </h3>
                <p class="text-gray-500 text-sm font-light block" style="display: block; color: #6b7280; font-size: 0.875rem;">
                    El "Oro Blanco" del Beni conquistando mercados internacionales.
                </p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-6 items-stretch w-full" style="display: flex; flex-direction: row; gap: 1.5rem; width: 100%; flex-wrap: wrap;">

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-5 flex flex-col justify-between text-left flex-1 min-w-[280px]" style="display: flex; flex-direction: column; justify-content: space-between; background-color: #fff; border: 1px solid #f3f4f6; border-radius: 1rem; padding: 1.25rem; flex: 1 1 0%; min-width: 280px; text-align: left;">
                <div class="block w-full">
                    <div class="w-full h-44 rounded-xl overflow-hidden mb-5 block" style="display: block; width: 100%; height: 11rem; border-radius: 0.75rem; overflow: hidden; margin-bottom: 1.25rem;">
                        <img src="https://images.unsplash.com/photo-1596547609652-9cf5d8d76921?auto=format&fit=crop&w=600&q=80" alt="Recolección de Castaña" class="w-full h-full object-cover block" style="display: block; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <h4 class="text-[#0a3118] font-bold text-lg mb-2 block" style="display: block; font-weight: 700; color: #0a3118; font-size: 1.125rem;">Recolección Silvestre</h4>
                    <p class="text-gray-500 text-xs md:text-sm font-light leading-relaxed block mb-6" style="display: block; color: #6b7280; line-height: 1.5; font-size: 0.875rem; margin-bottom: 1.5rem;">
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

            <div class="bg-white border border-[#e5c158]/40 rounded-2xl shadow-sm p-8 flex flex-col justify-between text-left flex-1 min-w-[280px]" style="display: flex; flex-direction: column; justify-content: space-between; background-color: #fff; border: 1px solid rgba(229, 193, 88, 0.4); border-radius: 1rem; padding: 2rem; flex: 1 1 0%; min-width: 280px; text-align: left;">
                <div class="block w-full">
                    <span class="text-[#0a3118] font-black text-5xl tracking-tight block mb-2" style="display: block; font-weight: 900; color: #0a3118; font-size: 3rem; letter-spacing: -0.05em;">75%</span>
                    <h5 class="text-gray-400 font-bold text-[10px] tracking-wider uppercase block mb-4" style="display: block; color: #9ca3af; font-weight: 700; font-size: 0.65rem; letter-spacing: 0.05em; margin-bottom: 1rem;">
                        Participación Global
                    </h5>
                    <p class="text-gray-600 text-sm font-light leading-relaxed block" style="display: block; color: #4b5563; line-height: 1.5; font-size: 0.875rem;">
                        Bolivia es el principal exportador mundial de castaña, siendo el Beni el centro de procesamiento y salida.
                    </p>
                </div>
                <span class="text-gray-400 italic text-[10px] block pt-4 border-t border-gray-50 tracking-wide mt-6" style="display: block; color: #9ca3af; font-style: italic; font-size: 0.65rem; border-top: 1px solid #f9fafb; margin-top: 1.5rem;">
                    Fuente: Cámara de Exportadores del Norte (CADEXNOR)
                </span>
            </div>

            <div class="bg-[#0a3118] text-white rounded-2xl shadow-md p-8 flex flex-col justify-start text-left flex-1 min-w-[280px]" style="display: flex; flex-direction: column; justify-content: flex-start; background-color: #0a3118; border-radius: 1rem; padding: 2rem; flex: 1 1 0%; min-width: 280px; text-align: left;">
                <div class="text-[#e5c158] mb-4 block" style="display: block; color: #e5c158; margin-bottom: 1rem;">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 2rem; height: 2rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 21V10.5l-3.75 3v-3l-3.75 3V10.5L8.25 13.5V9L4.5 12v9h15zM3 21h18M9 18v3M12 18v3M15 18v3"></path>
                    </svg>
                </div>
                <h4 class="text-white font-bold text-xl mb-3 block" style="display: block; font-weight: 700; color: #fff; font-size: 1.25rem; margin-bottom: 0.75rem;">
                    Hacia la Industrialización
                </h4>
                <p class="text-gray-200 text-xs md:text-sm font-light leading-relaxed block mb-6" style="display: block; color: #e5e7eb; line-height: 1.5; font-size: 0.875rem; margin-bottom: 1.5rem;">
                    Fomentamos la instalación de plantas quebradoras y empacadoras con estándares internacionales ISO 22000.
                </p>
                <ul class="space-y-2 block w-full border-t border-white/10 pt-4" style="display: block; width: 100%; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem; list-style: none; margin: 0; padding-left: 0;">
                    <li class="flex items-center gap-2 text-[#e5c158] text-xs font-semibold" style="display: flex; align-items: center; gap: 0.5rem; color: #e5c158; font-weight: 600; font-size: 0.75rem; margin-bottom: 0.5rem;">
                        <span style="display: inline-block; width: 4px; height: 4px; background-color: #e5c158; border-radius: 9999px;"></span>
                        Valor Agregado local
                    </li>
                    <li class="flex items-center gap-2 text-[#e5c158] text-xs font-semibold" style="display: flex; align-items: center; gap: 0.5rem; color: #e5c158; font-weight: 600; font-size: 0.75rem;">
                        <span style="display: inline-block; width: 4px; height: 4px; background-color: #e5c158; border-radius: 9999px;"></span>
                        Empleo Dignificado
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>

@include('departamento._invertir')

@include('departamento._apoyo-tecnico')
@endsection
