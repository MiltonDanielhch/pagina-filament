{{-- 
    Componente de Credencial Institucional - Gobernación del Beni
    Diseñado para impresión estándar en PVC (CR80) usando Tailwind CSS y Alpine.js
--}}
@props([
    'nombre' => 'Milton Daniel',
    'cargo' => 'Desarrollador de Software',
    'secretaria' => 'Dirección de Sistemas e Innovación',
    'ci' => '1234567 BC',
    'item' => 'IT-3026',
    'avatar' => null
])

<div 
    x-data="{ escaneado: false, verificado: true }"
    class="relative w-[340px] h-[540px] bg-[#0d2418] rounded-2xl shadow-2xl overflow-hidden border-2 border-[#d4a017]/50 font-sans select-none print:shadow-none print:border-black"
>
    <!-- Patrón de Fondo de Seguridad (Estilo Amazonía) -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#2d6a4f_1px,transparent_1px)] [background-size:16px_16px]"></div>
    
    <!-- Franja Superior de la Bandera del Beni con Estrellas Doradas -->
    <div class="absolute top-0 inset-x-0 h-3 bg-[#1b4332] flex justify-center items-center gap-1 z-20">
        @for ($i = 0; $i < 8; $i++)
            <span class="text-[6px] text-[#e9c46a]">★</span>
        @endfor
    </div>

    <!-- Encabezado Institucional -->
    <div class="pt-6 px-4 text-center flex flex-col items-center relative z-10">
        <div class="flex items-center gap-2 mb-1">
            <!-- Icono/Escudo Resumido -->
            <div class="w-8 h-8 bg-white/10 rounded-full border border-[#d4a017]/30 flex items-center justify-center text-xs text-white">
                💚
            </div>
            <div class="text-left leading-none">
                <span class="text-[10px] uppercase tracking-widest font-bold text-[#e9c46a]">Gobierno Autónomo</span>
                <h1 class="text-xs uppercase font-extrabold text-white tracking-wider">Departamental del Beni</h1>
            </div>
        </div>
        <p class="text-[9px] uppercase tracking-widest text-emerald-400 font-semibold border-t border-white/10 pt-1 w-full">
            Credencial Oficial de Identificación
        </p>
    </div>

    <!-- Contenedor de la Fotografía del Personal -->
    <div class="mt-6 flex flex-col items-center relative z-10">
        <div class="relative">
            <!-- Marco dorado de alta seguridad -->
            <div class="w-32 h-32 rounded-2xl overflow-hidden border-4 border-[#d4a017] shadow-xl bg-[#1b4332] flex items-center justify-center">
                @if($avatar)
                    <img src="{{ $avatar }}" alt="{{ $nombre }}" class="w-full h-full object-cover object-top">
                @else
                    <!-- Placeholder heráldico limpio si falta la foto -->
                    <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                @endif
            </div>
            
            <!-- Badge de Estado con Alpine.js -->
            <span 
                x-show="verificado"
                class="absolute -bottom-2 right-2 bg-teal-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full shadow-md uppercase tracking-wider border border-white/20"
            >
                Activo
            </span>
        </div>
    </div>

    <!-- Información de Identidad -->
    <div class="mt-4 px-6 text-center relative z-10">
        <h2 class="text-base font-extrabold text-white leading-tight uppercase line-clamp-2">
            {{ $nombre }}
        </h2>
        <p class="text-xs font-bold text-[#e9c46a] mt-1 tracking-wide uppercase">
            {{ $cargo }}
        </p>
        <p class="text-[10px] text-gray-300 font-medium mt-1 uppercase opacity-90 line-clamp-1">
            {{ $secretaria }}
        </p>
    </div>

    <!-- Bloque de Cierre: Datos Duros y Código QR -->
    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-[#05100b] to-[#0d2418] border-t border-white/5 pt-3 pb-4 px-6 flex items-center justify-between z-10">
        
        <!-- Identificadores en formato Mono -->
        <div class="text-left flex flex-col gap-1 text-white/80">
            <div>
                <span class="block text-[8px] uppercase text-gray-400 font-bold leading-none">C.I. Número</span>
                <span class="text-xs font-mono font-bold tracking-wider">{{ $ci }}</span>
            </div>
            <div>
                <span class="block text-[8px] uppercase text-gray-400 font-bold leading-none">Código Ítem</span>
                <span class="text-[11px] font-mono font-bold text-[#e9c46a]">{{ $item }}</span>
            </div>
        </div>

        <!-- Contenedor QR Inteligente -->
        <div 
            @click="escaneado = !escaneado" 
            class="bg-white p-1.5 rounded-lg shadow-inner border border-[#d4a017]/30 cursor-pointer transition-transform duration-300 hover:scale-105"
            :class="escaneado ? 'ring-2 ring-teal-400' : ''"
        >
            {{-- Representación vectorial pura de un QR institucional para evitar archivos pesados --}}
            <svg class="w-16 h-16 text-[#0d2418]" viewBox="0 0 24 24" fill="currentColor">
                <path d="M2 2h6v6H2V2zm1 1v4h4V3H3zm6-1h1v1H9V2zm0 2h1v3H9V4zM2 9h1v1H2V9zm2 0h3v1H4V9zm4 0h1v1H8V9zm-6 3h2v1H2v-1zm4 0h1v2H6v-2zm2 0h2v1H8v-1zm-6 2h1v3H2v-3zm3 1h1v1H5v-1zm1 1h2v1H6v-1zm3-3h1v1H9v-1zm0 2h1v2H9v-2zM2 19h6v5H2v-5zm1 1v3h4v-3H3zm11-18h6v6h-6V2zm1 1v4h4V3h-4zm-1 6h1v1h-1V9zm2 0h2v1h-2V9zm3 0h2v1h-2V9zm-5 2h1v1h-1v-1zm2 0h3v2h-1v-1h-2v-1zm4 0h1v3h-1v-3zm-5 3h1v1h-1v-1zm2 1h2v1h-2v-1zm-7 3h1v1H7v-1zm2 0h2v1H9v-1zm2 0h1v2h-1v-2zm3-2h2v1h-2v-1zm0 2h1v3h-1v-3zm2-1h1v1h-1v-1zm0 2h2v1h-2v-1z"/>
            </svg>
        </div>
    </div>

    <!-- Marca de Agua Interna -->
    <div class="absolute top-[46%] left-1/2 -translate-x-1/2 -translate-y-1/2 w-48 h-48 border border-[#d4a017]/5 rounded-full pointer-events-none flex items-center justify-center text-3xl text-[#d4a017]/5 font-serif font-bold tracking-widest">
        BENI
    </div>
</div>