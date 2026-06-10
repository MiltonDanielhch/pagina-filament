{{--
    Vista: Proyecto de Inversión — Detalle
    Cumplimiento: RM 067/2025 — Bloque B4
    Ruta: /gobierno/proyectos/{slug}  (route: gobierno.proyectos.show)
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="{{ $project->title }}. {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 180) }} Avance: {{ (int) $project->progress_percentage }}%. Presupuesto: Bs. {{ number_format((float) $project->budget, 0, ',', '.') }}.">
    <meta property="og:title" content="{{ $project->title }} — Gobernación del Beni">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 180) }}">
    <meta property="og:type" content="article">

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "GovernmentService",
        "name": {!! json_encode($project->title) !!},
        "description": {!! json_encode(\Illuminate\Support\Str::limit(strip_tags($project->description), 250)) !!},
        "provider": {
            "@@type": "GovernmentOrganization",
            "name": "Gobernación Autónoma Departamental del Beni"
        },
        "areaServed": {
            "@@type": "AdministrativeArea",
            "name": {!! json_encode(\Illuminate\Support\Str::headline(str_replace('_', ' ', $project->municipality ?? 'Beni'))) !!}
        },
        "category": {!! json_encode($project->category_label) !!}
    }
    </script>
@endsection

@section('content')
@php
    use Illuminate\Support\Str;
    $mun = $project->municipality ? Str::headline(str_replace('_', ' ', $project->municipality)) : null;
    $mainImage = $project->getFirstMediaUrl('gallery') ?: ($project->image ? asset('storage/' . $project->image) : null);
    $galleryImages = $project->getMedia('gallery');
    $progress = max(0, min(100, (int) $project->progress_percentage));
    $color   = $project->status_color;
@endphp

{{-- HERO --}}
<section class="bg-gradient-to-br from-teal-700 via-teal-800 to-teal-900 text-white py-12 relative overflow-hidden">
    <div class="container mx-auto px-4 relative">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Proyectos', 'url' => route('gobierno.proyectos.index')],
            ['label' => \Illuminate\Support\Str::limit($project->title, 40), 'url' => null]
        ]" />

        <div class="flex flex-wrap items-center gap-2 mb-3">
            @if($project->code)
                <span class="text-xs font-mono font-bold bg-white/15 backdrop-blur px-2 py-1 rounded">
                    {{ $project->code }}
                </span>
            @endif
            <span class="inline-flex items-center gap-1 text-xs font-semibold px-2 py-1 rounded-full
                bg-{{ $color }}-100 text-{{ $color }}-800">
                <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500"></span>
                {{ $project->status_label }}
            </span>
            <span class="inline-flex items-center text-xs font-semibold px-2 py-1 rounded-full bg-white/15 backdrop-blur">
                {{ $project->category_label }}
            </span>
            @if($mun)
                <span class="inline-flex items-center gap-1 text-xs px-2 py-1 rounded-full bg-white/15 backdrop-blur">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    {{ $mun }}
                </span>
            @endif
        </div>

        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight max-w-4xl">
            {{ $project->title }}
        </h1>

        {{-- Barra de avance en hero --}}
        <div class="mt-5 max-w-2xl">
            <div class="flex items-center justify-between text-sm mb-1.5">
                <span class="font-semibold text-amber-300">Avance físico</span>
                <span class="font-bold text-amber-300 text-lg">{{ $progress }}%</span>
            </div>
            <div class="h-2.5 w-full bg-white/15 backdrop-blur rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-amber-400 to-amber-500 rounded-full transition-all"
                     style="width: {{ $progress }}%"></div>
            </div>
        </div>
    </div>
</section>

<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- COLUMNA PRINCIPAL --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Imagen principal --}}
                @if($mainImage)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <img src="{{ $mainImage }}" alt="{{ $project->title }}" class="w-full h-64 md:h-96 object-cover">
                    </div>
                @endif

                {{-- Descripción --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Descripción del proyecto
                    </h2>
                    <div class="prose prose-teal max-w-none text-gray-700">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                {{-- Galería --}}
                @if($galleryImages->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Galería de imágenes
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($galleryImages as $img)
                            <a href="{{ $img->getUrl() }}" target="_blank" rel="noopener"
                               class="block aspect-square overflow-hidden rounded-lg border border-gray-200 hover:opacity-90 transition">
                                <img src="{{ $img->getUrl('thumb') ?: $img->getUrl() }}" alt="{{ $project->title }}" class="w-full h-full object-cover" loading="lazy">
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Beneficiarios --}}
                @if($project->beneficiary_communities && count($project->beneficiary_communities) > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Comunidades beneficiarias
                    </h2>
                    <div class="grid sm:grid-cols-2 gap-2">
                        @foreach($project->beneficiary_communities as $community => $families)
                            <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 border border-gray-200">
                                <span class="font-medium text-gray-900">{{ $community }}</span>
                                @if(is_numeric($families) && $families > 0)
                                    <span class="text-xs font-semibold text-teal-700 bg-teal-50 px-2 py-0.5 rounded">
                                        {{ number_format((int) $families, 0, ',', '.') }} {{ $families == 1 ? 'persona' : 'pers.' }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Secretaría --}}
                @if($project->secretariat)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Secretaría responsable
                    </h2>
                    <a href="{{ route('institutional.secretariats.show', $project->secretariat->slug) }}"
                       class="group flex items-center gap-4 p-4 rounded-xl border-2 border-gray-100 hover:border-teal-500 transition">
                        <div class="w-12 h-12 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            {{ Str::upper(Str::substr($project->secretariat->acronym ?? $project->secretariat->name, 0, 3)) }}
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 group-hover:text-teal-700 transition">
                                {{ $project->secretariat->name }}
                            </p>
                            @if($project->secretariat->head)
                                <p class="text-sm text-gray-500">
                                    Titular: {{ $project->secretariat->head->full_name ?? '—' }}
                                </p>
                            @endif
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @endif

                {{-- Proyectos relacionados --}}
                @if($related->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Proyectos relacionados</h2>
                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($related as $rel)
                            <x-project-card :project="$rel" :compact="true" />
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <aside class="space-y-6">
                {{-- Tarjeta de datos clave --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Información del proyecto</h3>
                    <dl class="space-y-3 text-sm">
                        @if($project->budget)
                            <div class="flex justify-between items-center">
                                <dt class="text-gray-500">Presupuesto</dt>
                                <dd class="font-bold text-gray-900">Bs. {{ number_format((float) $project->budget, 0, ',', '.') }}</dd>
                            </div>
                        @endif
                        @if($project->financing_source)
                            <div class="flex justify-between items-center gap-2">
                                <dt class="text-gray-500">Financiamiento</dt>
                                <dd class="font-semibold text-gray-900 text-right">{{ $project->financing_source }}</dd>
                            </div>
                        @endif
                        @if($project->contract_number)
                            <div class="flex justify-between items-center gap-2">
                                <dt class="text-gray-500">Nº de contrato</dt>
                                <dd class="font-mono text-xs font-semibold text-gray-900">{{ $project->contract_number }}</dd>
                            </div>
                        @endif
                        @if($project->contracting_company)
                            <div class="flex justify-between items-center gap-2">
                                <dt class="text-gray-500">Contratista</dt>
                                <dd class="font-semibold text-gray-900 text-right">{{ $project->contracting_company }}</dd>
                            </div>
                        @endif
                        @if($project->start_date)
                            <div class="flex justify-between items-center">
                                <dt class="text-gray-500">Inicio</dt>
                                <dd class="font-semibold text-gray-900">{{ $project->start_date->format('d/m/Y') }}</dd>
                            </div>
                        @endif
                        @if($project->end_date_planned)
                            <div class="flex justify-between items-center">
                                <dt class="text-gray-500">Conclusión prevista</dt>
                                <dd class="font-semibold text-gray-900">{{ $project->end_date_planned->format('d/m/Y') }}</dd>
                            </div>
                        @endif
                        @if($project->end_date_real)
                            <div class="flex justify-between items-center">
                                <dt class="text-gray-500">Conclusión real</dt>
                                <dd class="font-semibold text-green-700">{{ $project->end_date_real->format('d/m/Y') }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                {{-- Acciones / Compartir --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Compartir</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($project->title . ' ' . route('gobierno.proyectos.show', $project->slug)) }}"
                           target="_blank" rel="noopener"
                           class="flex flex-col items-center gap-1 p-3 rounded-lg bg-green-50 hover:bg-green-100 transition text-green-700"
                           aria-label="Compartir en WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20.52 3.48A11.78 11.78 0 0012.06 0C5.4 0 .06 5.34.06 12c0 2.1.55 4.16 1.6 5.97L0 24l6.18-1.62a12 12 0 005.85 1.5h.01c6.66 0 12-5.34 12-12 0-3.2-1.25-6.2-3.52-8.4zM12.04 21.8h-.01a9.85 9.85 0 01-5.02-1.37l-.36-.21-3.67.96.98-3.58-.24-.37A9.83 9.83 0 012.2 12c0-5.43 4.42-9.85 9.85-9.85 2.63 0 5.1 1.02 6.96 2.88a9.78 9.78 0 012.89 6.96c0 5.43-4.42 9.81-9.86 9.81z"/>
                            </svg>
                            <span class="text-[10px] font-semibold">WhatsApp</span>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('gobierno.proyectos.show', $project->slug)) }}"
                           target="_blank" rel="noopener"
                           class="flex flex-col items-center gap-1 p-3 rounded-lg bg-blue-50 hover:bg-blue-100 transition text-blue-700"
                           aria-label="Compartir en Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M24 12.07C24 5.41 18.63 0 12 0S0 5.4 0 12.07C0 18.1 4.39 23.09 10.13 24v-8.44H7.08v-3.49h3.05V9.41c0-3.02 1.79-4.69 4.53-4.69 1.31 0 2.69.23 2.69.23v2.97H15.83c-1.49 0-1.96.93-1.96 1.89v2.26h3.33l-.53 3.49h-2.8V24C19.61 23.09 24 18.1 24 12.07"/>
                            </svg>
                            <span class="text-[10px] font-semibold">Facebook</span>
                        </a>
                        <button type="button" onclick="navigator.clipboard.writeText('{{ route('gobierno.proyectos.show', $project->slug) }}');this.querySelector('span').textContent='¡Copiado!'"
                                class="flex flex-col items-center gap-1 p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition text-gray-700"
                                aria-label="Copiar enlace">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2v-2M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                            </svg>
                            <span class="text-[10px] font-semibold">Copiar link</span>
                        </button>
                    </div>
                </div>

                {{-- CTA Reportar inconsistencia --}}
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-amber-900 mb-2">¿Encontraste un error?</h3>
                    <p class="text-sm text-amber-800 mb-3">
                        Reporta cualquier inconsistencia en la información del proyecto.
                    </p>
                    <a href="{{ route('complaints.create') }}?asunto={{ urlencode('Reporte sobre proyecto: ' . $project->title) }}"
                       class="inline-flex items-center gap-1.5 bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm px-3 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Reportar
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
