{{--
    Componente: Breadcrumb
    Descripción: Navegación breadcrumb reutilizable para páginas internas con soporte para dropdown
    Uso: <x-breadcrumb :items="$breadcrumbItems" />
    Ejemplo:
        $breadcrumbItems = [
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Gobernador', 'url' => null],
        ]
--}}
@props(['items' => []])

@if($items && count($items) > 0)
<nav class="flex items-center gap-2 text-sm text-white mb-6" aria-label="Navegación breadcrumb">
    @php
        $showDropdown = count($items) > 3;
        $visibleItems = $showDropdown ? array_slice($items, -2) : $items;
        $dropdownItems = $showDropdown ? array_slice($items, 0, -2) : [];
    @endphp

    @if($showDropdown)
    <!-- Dropdown para items anteriores -->
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" @click.outside="open = false"
                class="flex items-center gap-1 hover:text-official transition-colors focus:outline-none">
            <span>...</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <div x-show="open" x-transition
             class="absolute left-0 mt-2 w-48 bg-gray-900 rounded-lg shadow-lg border border-gray-700 z-50">
            <div class="py-1">
                @foreach($dropdownItems as $index => $item)
                @if($item['url'] ?? null)
                <a href="{{ $item['url'] }}"
                   class="block px-4 py-2 text-sm text-white hover:bg-gray-800">
                    {{ $item['label'] }}
                </a>
                @else
                <span class="block px-4 py-2 text-sm text-white/70">{{ $item['label'] }}</span>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    @endif

    @foreach($visibleItems as $index => $item)
        @if($index > 0 || $showDropdown)
        <svg class="w-4 h-4 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        @endif

        @if($item['url'] ?? null)
        <a href="{{ $item['url'] }}" class="hover:text-amber-300 transition-colors">
            {{ $item['label'] }}
        </a>
        @else
        <span class="text-white font-medium">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
@endif
