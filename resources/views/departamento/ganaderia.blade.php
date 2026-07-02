@extends('layouts.main')

@section('title', $title . ' - Gobernación Autónoma del Beni')
@section('meta_description', $description)

@section('content')
<section class="bg-white py-20 px-4 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <div class="w-full mb-12 block text-left" style="display: block; width: 100%; text-align: left;">
            <h2 class="text-[#0a3118] font-bold text-3xl md:text-4xl mb-4 tracking-tight block" style="display: block; font-weight: 700; color: #0a3118;">
                Ganadería de Exportación
            </h2>
            <p class="text-gray-500 text-sm md:text-base font-light leading-relaxed block max-w-3xl" style="display: block; width: 100%; white-space: normal; text-align: left; color: #6b7280; line-height: 1.625;">
                El Beni es el corazón ganadero de Bolivia, con un hato que supera los 3 millones de cabezas. Implementamos programas de mejoramiento genético y trazabilidad.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 items-stretch w-full" style="display: flex; width: 100%;">

            <div class="w-full lg:w-[65%] rounded-3xl relative overflow-hidden min-h-[400px] lg:min-h-full shadow-sm flex flex-col justify-end p-8 flex-shrink-0" style="display: flex; flex-direction: column; justify-content: flex-end; position: relative; overflow: hidden; border-radius: 1.5rem;">
                <img src="https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&w=1200&q=80" alt="Ganadería de Exportación" class="absolute inset-0 w-full h-full object-cover z-0">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
                <div class="relative z-20 text-left block w-full" style="display: block; width: 100%; text-align: left; box-sizing: border-box;">
                    <span class="text-[#e5c158] font-bold text-xs uppercase tracking-wider block mb-1" style="display: block; color: #e5c158; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em;">Sector Estratégico</span>
                    <h3 class="text-white font-bold text-2xl md:text-3xl mb-3 block" style="display: block; font-weight: 700; color: #fff; width: 100%;">Ganadería de Exportación</h3>
                    <p class="text-gray-200 text-xs md:text-sm font-light leading-relaxed block" style="display: block; width: 100%; max-width: 38rem; white-space: normal !important; color: #e5e7eb; line-height: 1.5;">
                        El Beni es el corazón ganadero de Bolivia, con un hato que supera los 3 millones de cabezas. Implementamos programas de mejoramiento genético y trazabilidad.
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-[35%] flex flex-col gap-6 justify-between flex-shrink-0" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div class="bg-white border border-gray-100 rounded-3xl p-8 shadow-sm text-left block w-full" style="display: block; width: 100%; background-color: #fff; border-radius: 1.5rem; padding: 2rem; text-align: left;">
                    <div class="flex items-center gap-2 mb-2 text-[#0a3118]" style="display: flex; align-items: center; color: #0a3118;">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        <span class="font-black text-3xl md:text-4xl tracking-tight block" style="display: block; font-weight: 900;">3.1M</span>
                    </div>
                    <h4 class="text-gray-400 font-bold text-xs uppercase tracking-wider block mb-3" style="display: block; color: #9ca3af; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.05em;">
                        Cabezas de Ganado Bovino
                    </h4>
                    <p class="text-gray-500 text-xs md:text-sm font-light leading-relaxed block" style="display: block; width: 100%; color: #6b7280; line-height: 1.5;">
                        Crecimiento sostenido del 4.2% anual en la producción cárnica del departamento.
                    </p>
                </div>

                <div class="bg-[#0a3118] text-white rounded-3xl p-8 shadow-sm text-left flex flex-col justify-between h-full min-h-[200px] block w-full" style="display: flex; flex-direction: column; justify-content: space-between; width: 100%; background-color: #0a3118; border-radius: 1.5rem; padding: 2rem; text-align: left;">
                    <div class="block w-full">
                        <h3 class="text-white font-bold text-xl mb-3 block" style="display: block; font-weight: 700; color: #fff;">Programa Genético</h3>
                        <p class="text-gray-300 text-xs md:text-sm font-light leading-relaxed block mb-6" style="display: block; width: 100%; color: #d1d5db; line-height: 1.5;">
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

@include('departamento._invertir')

@include('departamento._apoyo-tecnico')
@endsection
