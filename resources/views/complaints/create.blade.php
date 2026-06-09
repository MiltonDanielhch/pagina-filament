{{--
    Vista: Quejas y Reclamos — Formulario de creación
    Cumplimiento: RM 067/2025 — Componente 22 (Libro de Reclamaciones Virtual)
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Libro de Reclamaciones Virtual de la Gobernación del Beni. Registra tu queja, reclamo, sugerencia o denuncia.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-teal-700 to-teal-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Servicios al Ciudadano', 'url' => null],
            ['label' => 'Libro de Reclamaciones', 'url' => null]
        ]" />
        <p class="font-semibold uppercase tracking-widest text-amber-300 mb-2">Atención al ciudadano</p>
        <h1 class="text-3xl md:text-4xl font-bold">Libro de Reclamaciones Virtual</h1>
        <p class="text-white/90 mt-2 max-w-2xl">
            Registra tu queja, reclamo, sugerencia o denuncia. Recibirás un código
            de seguimiento para conocer el estado de tu solicitud.
        </p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="ml-3 text-sm text-green-800">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-bold text-red-800">Por favor corrige los siguientes errores:</p>
                    <ul class="text-sm text-red-700 list-disc list-inside mt-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data"
              class="bg-white rounded-2xl shadow-lg overflow-hidden">
            @csrf

            {{-- Paso 1: Tipo --}}
            <div class="border-b border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-1">1. ¿Qué tipo de solicitud quieres registrar?</h2>
                <p class="text-sm text-gray-600 mb-4">Selecciona la opción que mejor describa tu caso.</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @php
                        $types = [
                            'queja' => ['label' => 'Queja', 'icon' => '😠', 'desc' => 'Insatisfacción con un servicio'],
                            'reclamo' => ['label' => 'Reclamo', 'icon' => '📢', 'desc' => 'Derecho vulnerado'],
                            'sugerencia' => ['label' => 'Sugerencia', 'icon' => '💡', 'desc' => 'Propuesta de mejora'],
                            'denuncia' => ['label' => 'Denuncia', 'icon' => '⚠️', 'desc' => 'Hecho irregular'],
                        ];
                    @endphp
                    @foreach($types as $value => $info)
                    <label class="relative cursor-pointer">
                        <input type="radio" name="type" value="{{ $value }}" class="peer sr-only" required
                               @checked(old('type') === $value)>
                        <div class="p-4 border-2 border-gray-200 rounded-xl text-center transition peer-checked:border-teal-600 peer-checked:bg-teal-50 hover:border-teal-300">
                            <div class="text-3xl mb-1">{{ $info['icon'] }}</div>
                            <p class="font-bold text-gray-900">{{ $info['label'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $info['desc'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Paso 2: Datos del solicitante --}}
            <div class="border-b border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-1">2. Tus datos de contacto</h2>
                <p class="text-sm text-gray-600 mb-4">Necesitamos estos datos para responder a tu solicitud.</p>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre completo <span class="text-red-500">*</span></label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Cédula de identidad</label>
                        <input type="text" name="ci" value="{{ old('ci') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Correo electrónico <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>
                </div>
            </div>

            {{-- Paso 3: Detalle --}}
            <div class="border-b border-gray-200 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-1">3. Detalle de tu solicitud</h2>
                <p class="text-sm text-gray-600 mb-4">Describe claramente tu caso.</p>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Asunto <span class="text-red-500">*</span></label>
                        <input type="text" name="subject" value="{{ old('subject') }}" required maxlength="255"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Descripción <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="6" required minlength="10" maxlength="5000"
                                  placeholder="Detalla tu solicitud, incluyendo fechas, lugares y personas involucradas..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">{{ old('description') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Mínimo 10 caracteres, máximo 5000.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Secretaría relacionada</label>
                        <select name="related_secretariat_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                            <option value="">— No aplica / No estoy seguro —</option>
                            @foreach($secretariats as $s)
                            <option value="{{ $s->id }}" @selected(old('related_secretariat_id') == $s->id)>
                                {{ $s->name }} ({{ $s->acronym }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Adjuntar archivo (opcional)</label>
                        <input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png"
                               class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                        <p class="text-xs text-gray-500 mt-1">PDF, JPG o PNG. Máximo 5MB.</p>
                    </div>
                </div>
            </div>

            {{-- Aviso de privacidad --}}
            <div class="bg-amber-50 p-6 border-b border-amber-200">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-amber-900">Aviso de privacidad</p>
                        <p class="text-sm text-amber-800 mt-1">
                            Tus datos personales serán tratados conforme a la Ley N° 164 de
                            Gobierno Electrónico y normativa vigente. Serán utilizados
                            únicamente para dar seguimiento a tu solicitud.
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-gray-50 flex flex-col sm:flex-row items-center justify-between gap-3">
                <a href="{{ route('complaints.track-form') }}" class="text-sm text-teal-700 hover:text-teal-800">
                    ¿Ya tienes una solicitud? →
                </a>
                <button type="submit" class="w-full sm:w-auto bg-teal-700 hover:bg-teal-800 text-white font-bold px-8 py-3 rounded-lg transition shadow-md hover:shadow-lg">
                    Enviar solicitud
                </button>
            </div>
        </form>
    </div>
</section>
@endsection
