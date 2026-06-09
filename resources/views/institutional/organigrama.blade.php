{{--
    Vista: Organigrama
    Muestra la estructura jerárquica de la Gobernación
    Cumplimiento: RM 067/2025 — Componente 4
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Organigrama institucional de la Gobernación del Beni: Gobernador, Vicegobernador y Secretarías Departamentales.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white py-16">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'La Gobernación', 'url' => route('institutional.index')],
            ['label' => 'Organigrama', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Estructura organizacional</p>
        <h1 class="text-4xl md:text-5xl font-bold">Organigrama Institucional</h1>
        <p class="text-white/90 mt-3 max-w-2xl">
            La Gobernación del Beni se organiza para responder a las necesidades del
            departamento y prestar servicios de calidad a la ciudadanía.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        {{-- Gobernador --}}
        @if($gobernador)
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-2xl shadow-xl border-t-4 border-amber-500 p-6 max-w-sm w-full text-center">
                <div class="w-24 h-24 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-3xl font-bold">
                    {{ strtoupper(mb_substr($gobernador->full_name ?? 'G', 0, 1)) }}
                </div>
                <p class="text-xs uppercase tracking-wider text-amber-600 font-semibold mb-1">Gobernación</p>
                <h3 class="text-xl font-bold text-gray-900">{{ $gobernador->full_name }}</h3>
                <p class="text-sm text-gray-600 mt-1">{{ $gobernador->position ?? 'Gobernador(a) del Beni' }}</p>
            </div>
        </div>

        {{-- Conector vertical --}}
        <div class="flex justify-center mb-8">
            <div class="w-1 h-10 bg-gradient-to-b from-amber-500 to-teal-600"></div>
        </div>
        @endif

        {{-- Vicegobernador --}}
        @if($vicegobernador && $vicegobernador->count() > 0)
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-2xl shadow-lg border-t-4 border-teal-500 p-6 max-w-sm w-full text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-full mx-auto mb-4 flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(mb_substr($vicegobernador->first()->full_name ?? 'V', 0, 1)) }}
                </div>
                <p class="text-xs uppercase tracking-wider text-teal-700 font-semibold mb-1">Vicegobernación</p>
                <h3 class="text-lg font-bold text-gray-900">{{ $vicegobernador->first()->full_name }}</h3>
                <p class="text-sm text-gray-600 mt-1">Vicegobernador(a) del Beni</p>
            </div>
        </div>

        <div class="flex justify-center mb-8">
            <div class="w-1 h-10 bg-teal-300"></div>
        </div>
        @endif

        {{-- Secretarios / Gabinete --}}
        @if($secretarios && $secretarios->count() > 0)
        <div class="bg-white rounded-2xl shadow-lg p-6 border-t-4 border-teal-600 mb-6">
            <p class="text-center text-xs uppercase tracking-wider text-teal-700 font-semibold mb-4">
                Gabinete Departamental
            </p>
            <h2 class="text-center text-2xl font-bold text-gray-900 mb-6">Secretarías Departamentales</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($secretarios as $secretario)
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 hover:border-teal-500 hover:shadow transition">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 flex-shrink-0 bg-teal-100 text-teal-700 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs uppercase tracking-wider text-teal-700 font-semibold truncate">
                                {{ $secretario->secretariat->acronym ?? '—' }}
                            </p>
                            <h3 class="text-sm font-bold text-gray-900 truncate">{{ $secretario->full_name }}</h3>
                            <p class="text-xs text-gray-600 mt-1">
                                {{ $secretario->secretariat->name ?? $secretario->position ?? 'Secretario(a) Departamental' }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <p class="text-gray-500">El organigrama se está actualizando. Vuelve pronto.</p>
            <a href="{{ route('institutional.secretariats') }}" class="text-teal-700 hover:underline text-sm mt-3 inline-block">
                Ver secretarías departamentales →
            </a>
        </div>
        @endif

        {{-- Llamado a la acción --}}
        <div class="mt-10 bg-teal-50 border border-teal-200 rounded-2xl p-6 text-center">
            <h3 class="text-lg font-bold text-gray-900 mb-2">¿Necesitas contactar a una secretaría?</h3>
            <p class="text-gray-700 mb-4">Consulta el directorio completo de secretarías y sus secretarios.</p>
            <a href="{{ route('institutional.secretariats') }}"
               class="inline-block bg-teal-700 hover:bg-teal-800 text-white font-semibold px-6 py-3 rounded-lg transition">
                Ver Secretarías
            </a>
        </div>
    </div>
</section>
@endsection
