{{--
    Componente: Mini-card de Dataset (Bloque 14)
--}}
@props(['dataset'])

<a href="{{ route('open-data.show', $dataset->slug) }}"
   class="group flex items-start gap-3 p-3 bg-gray-50 hover:bg-indigo-50 rounded-xl transition border border-gray-100 hover:border-indigo-200">
    <div class="w-10 h-10 bg-indigo-100 text-indigo-700 rounded-lg flex items-center justify-center flex-shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
        </svg>
    </div>
    <div class="min-w-0 flex-1">
        <p class="text-xs font-bold text-indigo-700 uppercase tracking-wider truncate">
            {{ $dataset->category ?? 'Dataset' }}
        </p>
        <p class="text-sm font-semibold text-gray-900 group-hover:text-indigo-700 transition line-clamp-1">
            {{ $dataset->title }}
        </p>
        <p class="text-xs text-gray-500 mt-0.5">⬇ {{ $dataset->download_count ?? 0 }} descargas</p>
    </div>
</a>
