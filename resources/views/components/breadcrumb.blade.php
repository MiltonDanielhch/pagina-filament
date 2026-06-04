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
<nav class="flex items-center gap-2 text-sm text-gray-600 mb-6" aria-label="Navegación breadcrumb">
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
             class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border z-50">
            <div class="py-1">
                @foreach($dropdownItems as $index => $item)
                @if($item['url'] ?? null)
                <a href="{{ $item['url'] }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-official/5 hover:text-official">
                    {{ $item['label'] }}
                </a>
                @else
                <span class="block px-4 py-2 text-sm text-gray-500">{{ $item['label'] }}</span>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
    @endif

    @foreach($visibleItems as $index => $item)
        @if($index > 0 || $showDropdown)
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        @endif

        @if($item['url'] ?? null)
        <a href="{{ $item['url'] }}" class="hover:text-official transition-colors">
            {{ $item['label'] }}
        </a>
        @else
        <span class="text-gray-900 font-medium">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
@endif
