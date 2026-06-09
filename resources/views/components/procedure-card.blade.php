{{--
    Componente: Tarjeta de Trámite
    Usada en: Bloque 6 (destacados), /procedures/index, /secretariats/show
--}}
@props(['procedure'])

@php
    $colorByCategory = [
        'salud' => 'teal', 'educacion' => 'blue', 'infraestructura' => 'orange',
        'catastro' => 'amber', 'impuestos' => 'emerald', 'recursos_humanos' => 'purple',
        'ganaderia' => 'green', 'mineria' => 'gray', 'transporte' => 'cyan',
    ];
    $color = $colorByCategory[$procedure->category] ?? 'teal';
@endphp

<a href="{{ route('procedures.show', $procedure->slug) }}"
   class="group block bg-white border-2 border-gray-100 hover:border-{{ $color }}-500 rounded-2xl p-5 hover:shadow-xl transition">
    <div class="flex items-start justify-between gap-2 mb-3">
        <span class="text-xs font-mono font-bold text-{{ $color }}-700 bg-{{ $color }}-50 px-2 py-0.5 rounded">
            {{ $procedure->code }}
        </span>
        @if($procedure->is_online)
        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full font-semibold flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            En línea
        </span>
        @endif
    </div>
    <h3 class="text-base font-bold text-gray-900 group-hover:text-{{ $color }}-700 transition line-clamp-2 mb-3 min-h-[3rem]">
        {{ $procedure->name }}
    </h3>
    <div class="border-t pt-3 space-y-1 text-xs text-gray-600">
        @if($procedure->processing_time_days)
        <div class="flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ $procedure->processing_time_days }} días</span>
        </div>
        @endif
        @if($procedure->cost)
        <div class="flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
            </svg>
            <span>Bs. {{ number_format((float) $procedure->cost, 0) }}</span>
        </div>
        @else
        <div class="flex items-center gap-1.5">
            <span class="text-green-600 font-semibold">Gratuito</span>
        </div>
        @endif
    </div>
</a>
