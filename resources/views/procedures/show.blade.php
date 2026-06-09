{{--
    Vista: Trámite — Detalle
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Trámite: {{ $procedure->name }}. Requisitos, costos, plazos y enlace a trámite en línea. {{ $procedure->code }}.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 to-teal-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Trámites', 'url' => route('procedures.index')],
            ['label' => $procedure->name, 'url' => null]
        ]" />
        <div class="flex flex-wrap items-start gap-4">
            <span class="text-sm font-mono font-bold bg-white/15 backdrop-blur px-3 py-1.5 rounded-lg">
                {{ $procedure->code }}
            </span>
            @if($procedure->is_online)
            <span class="inline-flex items-center gap-1 text-sm bg-green-500/20 backdrop-blur px-3 py-1.5 rounded-full">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                Disponible en línea
            </span>
            @endif
        </div>
        <h1 class="text-3xl md:text-4xl font-bold mt-3 leading-tight">{{ $procedure->name }}</h1>
        <p class="text-white/90 mt-2">{{ $procedure->category_label }}</p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Contenido principal --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Información clave (costo, plazo, horario) --}}
                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-2xl shadow-sm text-center">
                        <div class="w-10 h-10 mx-auto bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Costo</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">
                            @if($procedure->cost)
                                Bs. {{ number_format((float) $procedure->cost, 2) }}
                            @else
                                <span class="text-green-600">Gratuito</span>
                            @endif
                        </p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm text-center">
                        <div class="w-10 h-10 mx-auto bg-teal-100 text-teal-600 rounded-lg flex items-center justify-center mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Plazo</p>
                        <p class="text-lg font-bold text-gray-900 mt-1">
                            {{ $procedure->processing_time_days ? $procedure->processing_time_days . ' días' : 'Variable' }}
                        </p>
                    </div>
                    <div class="bg-white p-5 rounded-2xl shadow-sm text-center">
                        <div class="w-10 h-10 mx-auto bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Estado</p>
                        <p class="text-lg font-bold text-green-600 mt-1">Activo</p>
                    </div>
                </div>

                {{-- Descripción / Procedimiento --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Procedimiento
                    </h2>
                    <div class="prose prose-teal max-w-none text-gray-700">
                        {!! nl2br(e($procedure->description)) !!}
                    </div>
                </div>

                {{-- Requisitos --}}
                @if($procedure->requirements)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Requisitos
                    </h2>
                    @if(isset($procedure->requirements_list) && count($procedure->requirements_list) > 0)
                    <ul class="space-y-2">
                        @foreach($procedure->requirements_list as $req)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-gray-700">{{ $req }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($procedure->requirements)) !!}
                    </div>
                    @endif
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                {{-- CTA trámite en línea --}}
                @if($procedure->online_url)
                <div class="bg-gradient-to-br from-teal-600 to-teal-800 text-white rounded-2xl p-6 shadow-lg">
                    <h3 class="text-lg font-bold mb-2">¿Listo para iniciar?</h3>
                    <p class="text-white/90 text-sm mb-4">
                        Realiza este trámite en línea ahora desde la plataforma SISCOR.
                    </p>
                    <a href="{{ $procedure->online_url }}" target="_blank" rel="noopener noreferrer"
                       class="block w-full text-center bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold py-3 rounded-lg transition">
                        Iniciar Trámite en Línea →
                    </a>
                </div>
                @endif

                {{-- Horario --}}
                @if($procedure->schedule)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Horario de Atención
                    </h3>
                    <p class="text-gray-700 text-sm">{{ $procedure->schedule }}</p>
                </div>
                @endif

                {{-- Secretaría responsable --}}
                @if($procedure->secretariat)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Secretaría responsable</h3>
                    <a href="{{ route('institutional.secretariats.show', $procedure->secretariat->slug) }}"
                       class="block p-3 bg-teal-50 rounded-lg hover:bg-teal-100 transition group">
                        <p class="font-semibold text-gray-900 group-hover:text-teal-700">
                            {{ $procedure->secretariat->name }}
                        </p>
                        <p class="text-xs text-gray-600 mt-1">
                            {{ $procedure->secretariat->acronym ?? '' }}
                        </p>
                    </a>
                </div>
                @endif

                {{-- Seguimiento --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">¿Ya iniciaste tu trámite?</h3>
                    <p class="text-sm text-gray-600 mb-3">
                        Consulta el estado de tu solicitud usando tu código de seguimiento.
                    </p>
                    <a href="{{ route('complaints.track-form') }}"
                       class="text-teal-700 font-semibold text-sm hover:text-teal-800 inline-flex items-center gap-1">
                        Seguir mi trámite →
                    </a>
                </div>
            </aside>
        </div>

        {{-- Trámites relacionados --}}
        @if(isset($related) && $related->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Trámites relacionados</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($related as $rel)
                <a href="{{ route('procedures.show', $rel->slug) }}"
                   class="bg-white p-4 rounded-xl border border-gray-200 hover:border-teal-500 hover:shadow-md transition group">
                    <p class="text-xs font-mono text-teal-700 font-bold mb-1">{{ $rel->code }}</p>
                    <p class="font-semibold text-gray-900 group-hover:text-teal-700 line-clamp-2">{{ $rel->name }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
