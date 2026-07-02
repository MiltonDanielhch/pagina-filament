<x-filament::section>
    <x-slot name="heading">
        Visitas por sección
    </x-slot>

    <x-slot name="header-actions">
        <div class="flex gap-1">
            <x-filament::button
                wire:click="filter('today')"
                :color="$period === 'today' ? 'primary' : 'gray'"
                size="xs"
            >
                Hoy
            </x-filament::button>
            <x-filament::button
                wire:click="filter('week')"
                :color="$period === 'week' ? 'primary' : 'gray'"
                size="xs"
            >
                Semana
            </x-filament::button>
            <x-filament::button
                wire:click="filter('month')"
                :color="$period === 'month' ? 'primary' : 'gray'"
                size="xs"
            >
                Mes
            </x-filament::button>
            <x-filament::button
                wire:click="filter('all')"
                :color="$period === 'all' ? 'primary' : 'gray'"
                size="xs"
            >
                Siempre
            </x-filament::button>
        </div>
    </x-slot>

    <div class="space-y-3">
        @forelse($sections as $section)
            <div class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <div class="flex items-center gap-3 min-w-0">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300 truncate">
                        {{ $section->section }}
                    </span>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <div class="w-24 sm:w-32 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                        <div class="h-full bg-primary-500 rounded-full" style="width: {{ $total > 0 ? ($section->total / $total) * 100 : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 tabular-nums min-w-[3rem] text-right">
                        {{ number_format($section->total) }}
                    </span>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">
                No hay visitas registradas aún.
            </p>
        @endforelse
    </div>
</x-filament::section>
