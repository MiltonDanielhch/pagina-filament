{{--
    Componente: Banda de Búsqueda (Bloque 4 del homepage)
    Búsqueda prominente de trámites y servicios, con sugerencias.
--}}
@props(['placeholder' => '¿Qué trámite o servicio buscas?', 'action' => '/buscar'])

<section class="bg-gradient-to-b from-white to-gray-50 -mt-12 md:-mt-16 relative z-20" aria-label="Búsqueda de trámites">
    <div class="container mx-auto px-4">
        <form action="{{ $action }}" method="GET" role="search" class="bg-white rounded-2xl shadow-2xl p-4 md:p-6">
            <div class="grid md:grid-cols-12 gap-3">
                <div class="md:col-span-2 hidden md:flex items-center gap-2 pl-2 text-teal-700 font-semibold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar
                </div>
                <div class="md:col-span-8 relative">
                    <input type="search" name="q"
                           placeholder="{{ $placeholder }}"
                           aria-label="Buscar trámites y servicios"
                           class="w-full pl-4 pr-4 py-3 text-base border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition">
                </div>
                <div class="md:col-span-2">
                    <button type="submit" class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 px-6 rounded-xl transition shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Buscar
                    </button>
                </div>
            </div>
            <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-gray-500">
                <span class="font-semibold">Búsquedas frecuentes:</span>
                <a href="/tramites?categoria=salud" class="px-2 py-1 bg-gray-100 hover:bg-teal-50 hover:text-teal-700 rounded-full transition">Salud</a>
                <a href="/tramites?categoria=educacion" class="px-2 py-1 bg-gray-100 hover:bg-teal-50 hover:text-teal-700 rounded-full transition">Educación</a>
                <a href="/tramites?categoria=catastro" class="px-2 py-1 bg-gray-100 hover:bg-teal-50 hover:text-teal-700 rounded-full transition">Catastro</a>
                <a href="/convocatorias" class="px-2 py-1 bg-gray-100 hover:bg-teal-50 hover:text-teal-700 rounded-full transition">Convocatorias</a>
                <a href="/quejas-reclamos" class="px-2 py-1 bg-gray-100 hover:bg-teal-50 hover:text-teal-700 rounded-full transition">Quejas</a>
            </div>
        </form>
    </div>
</section>
