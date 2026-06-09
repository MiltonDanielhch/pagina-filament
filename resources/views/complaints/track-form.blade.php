{{--
    Vista: Formulario para introducir el código de seguimiento
--}}
@extends('layouts.main')

@section('seo')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
<section class="py-16 bg-gray-50 min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-md">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <div class="w-16 h-16 mx-auto bg-teal-100 text-teal-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 text-center mb-2">Consultar mi solicitud</h1>
            <p class="text-sm text-gray-600 text-center mb-6">
                Ingresa tu código de seguimiento para localizar tu solicitud.
            </p>

            <form method="POST" action="{{ route('complaints.track-search') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="code" class="block text-sm font-semibold text-gray-700 mb-1">Código de seguimiento</label>
                    <input type="text" id="code" name="code" required
                           placeholder="QR-2026-000001"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 font-mono">
                    <p class="text-xs text-gray-500 mt-1">Formato: QR/RE/SU/DE-AAAA-NNNNNN</p>
                </div>
                <button type="submit" class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-lg transition">
                    Buscar mi solicitud
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-xs text-gray-500">
                    Si conservas el enlace de seguimiento (recibido por correo), ábrelo directamente desde tu bandeja de entrada.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
