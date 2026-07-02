@extends('layouts.main')

@section('title', $title . ' - Gobernación Autónoma del Beni')
@section('meta_description', $description)

@section('content')
<section class="bg-[#fcfaf6] py-16 px-6 md:px-12 lg:px-24 w-full block clear-both" style="display: block; width: 100%; clear: both;">
    <div class="max-w-7xl mx-auto w-full block" style="display: block; width: 100%; max-width: 80rem;">

        <div class="flex flex-col lg:flex-row gap-12 items-center justify-between w-full" style="display: flex; width: 100%; justify-content: space-between; align-items: center;">

            <div class="w-full lg:w-[48%] flex flex-col justify-center text-left flex-shrink-0" style="display: flex; flex-direction: column; justify-content: center; width: 100%; max-width: 38rem; box-sizing: border-box;">

                <div class="mb-5 block">
                    <span class="bg-[#fef5d1] text-[#a0781a] text-[11px] font-bold px-3 py-1 rounded-md uppercase tracking-wider inline-block" style="display: inline-block;">
                        Innovación Tecnológica
                    </span>
                </div>

                <h2 class="text-[#0a3118] font-bold text-2xl md:text-3xl lg:text-4xl mb-6 leading-tight block" style="display: block; font-weight: 700; color: #0a3118;">
                    Agricultura de Precisión: Arroz y Soya
                </h2>

                <p class="text-gray-600 text-sm md:text-base font-light leading-relaxed mb-8 block" style="display: block; width: 100%; color: #4b5563; line-height: 1.625;">
                    Estamos transformando las pampas benianas en el nuevo granero del país. Con el uso de sensores, mapeo satelital y biotecnología, los proyectos de arroz y soya en Marbán e Iténez alcanzan rendimientos históricos.
                </p>

                <div class="space-y-5 w-full block" style="display: block; width: 100%;">
                    <div class="flex items-start gap-3 mb-5" style="display: flex; align-items: flex-start;">
                        <div class="text-[#bfa141] mt-0.5 flex-shrink-0" style="flex-shrink: 0;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="block" style="display: block;">
                            <h4 class="text-[#0a3118] font-bold text-sm mb-0.5" style="font-weight: 700; color: #0a3118;">Eficiencia Hídrica</h4>
                            <p class="text-gray-500 text-sm font-light" style="color: #6b7280;">Sistemas de riego automatizados para cultivos de alto valor.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3" style="display: flex; align-items: flex-start;">
                        <div class="text-[#bfa141] mt-0.5 flex-shrink-0" style="flex-shrink: 0;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width: 1.25rem; height: 1.25rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="block" style="display: block;">
                            <h4 class="text-[#0a3118] font-bold text-sm mb-0.5" style="font-weight: 700; color: #0a3118;">Zonificación Agroecológica</h4>
                            <p class="text-gray-500 text-sm font-light" style="color: #6b7280;">Protección de suelos y manejo responsable de la frontera agrícola.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-[50%] flex justify-center lg:justify-end flex-shrink" style="display: flex; justify-content: flex-end; width: 100%; max-width: 50%; box-sizing: border-box;">
                <div class="bg-[#f2efe9] p-3 rounded-2xl w-full shadow-md transform rotate-[0.5deg] block" style="display: block; width: 100%; background-color: #f2efe9; border-radius: 1rem; padding: 0.75rem; overflow: hidden;">
                    <img src="{{ asset('images/agricola.jpg') }}" alt="Cosecha de Arroz y Soya" class="w-full h-auto object-cover rounded-xl block shadow-sm" style="display: block; width: 100%; height: 380px; border-radius: 0.75rem; object-fit: cover;">
                </div>
            </div>

        </div>
    </div>
</section>

@include('departamento._invertir')

@include('departamento._apoyo-tecnico')
@endsection
