{{--
    Componente: Tarjeta de Proyecto de Inversión
    Usada en: Bloque 12 (homepage), /gobierno/proyectos

    Props:
      - $project  (InfrastructureProject)  — modelo del proyecto (requerido)
      - $showProgress (bool)                — mostrar barra de avance (default: true)
      - $showBudget   (bool)                — mostrar presupuesto (default: true)
      - $compact      (bool)                — versión reducida (default: false)
--}}
@props([
    'project',
    'showProgress' => true,
    'showBudget'   => true,
    'compact'      => false,
])

@php
    use Illuminate\Support\Str;

    $status  = $project->status;
    $color   = $project->status_color;     // blue | amber | green | red | gray
    $label   = $project->status_label;
    $cat     = $project->category_label;
    $mun     = $project->municipality ? Str::headline(str_replace('_', ' ', $project->municipality)) : null;

    $imageUrl = $project->getFirstMediaUrl('gallery') ?: ($project->image ? asset('storage/' . $project->image) : null);
@endphp

<a href="{{ route('gobierno.proyectos.show', $project->slug) }}"
   class="group block bg-white border-2 border-gray-100 hover:border-{{ $color }}-500 rounded-2xl overflow-hidden hover:shadow-xl transition focus:outline-none focus-visible:ring-2 focus-visible:ring-{{ $color }}-500">

    {{-- Imagen --}}
    <div class="relative {{ $compact ? 'h-32' : 'h-40' }} bg-gradient-to-br from-{{ $color }}-100 to-{{ $color }}-50 overflow-hidden">
        @if($imageUrl)
            <img src="{{ $imageUrl }}" alt="{{ $project->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-12 h-12 text-{{ $color }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        @endif

        {{-- Badge de estado (overlay) --}}
        <span class="absolute top-2 left-2 inline-flex items-center gap-1 text-xs font-semibold px-2 py-1 rounded-full shadow-sm
            bg-{{ $color }}-100 text-{{ $color }}-800 backdrop-blur">
            <span class="w-1.5 h-1.5 rounded-full bg-{{ $color }}-500"></span>
            {{ $label }}
        </span>

        @if($project->code)
            <span class="absolute top-2 right-2 text-[10px] font-mono font-bold bg-black/60 text-white px-1.5 py-0.5 rounded">
                {{ $project->code }}
            </span>
        @endif
    </div>

    <div class="p-4">
        {{-- Categoría + municipio --}}
        <div class="flex items-center gap-2 text-[11px] uppercase tracking-wider text-gray-500 mb-1.5">
            <span class="font-semibold text-{{ $color }}-700">{{ $cat }}</span>
            @if($mun)
                <span>·</span>
                <span class="inline-flex items-center gap-0.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    {{ $mun }}
                </span>
            @endif
        </div>

        <h3 class="text-base font-bold text-gray-900 group-hover:text-{{ $color }}-700 transition line-clamp-2 mb-3 min-h-[3rem]">
            {{ $project->title }}
        </h3>

        {{-- Barra de avance --}}
        @if($showProgress)
            <div class="mb-3">
                <div class="flex items-center justify-between text-[11px] text-gray-600 mb-1">
                    <span class="font-semibold">Avance</span>
                    <span class="font-bold text-{{ $color }}-700">{{ (int) $project->progress_percentage }}%</span>
                </div>
                <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-{{ $color }}-500 rounded-full transition-all"
                         style="width: {{ max(0, min(100, (int) $project->progress_percentage)) }}%"></div>
                </div>
            </div>
        @endif

        {{-- Footer: presupuesto + CTA --}}
        <div class="flex items-end justify-between border-t pt-3">
            @if($showBudget && $project->budget)
                <div>
                    <p class="text-[10px] uppercase tracking-wider text-gray-500">Presupuesto</p>
                    <p class="text-sm font-bold text-gray-900">Bs. {{ number_format((float) $project->budget, 0, ',', '.') }}</p>
                </div>
            @else
                <span></span>
            @endif
            <span class="text-{{ $color }}-700 text-xs font-semibold inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                Ver detalle
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
        </div>
    </div>
</a>
