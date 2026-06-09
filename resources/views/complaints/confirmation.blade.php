{{--
    Vista: Confirmación después de enviar una queja/reclamo
--}}
@extends('layouts.main')

@section('seo')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
<section class="py-16 bg-gray-50 min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
            <div class="w-20 h-20 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">¡Solicitud registrada con éxito!</h1>
            <p class="text-gray-600 mb-6">
                Hemos recibido tu solicitud. A continuación encontrarás tu código de
                seguimiento y el enlace para consultar el estado.
            </p>

            <div class="bg-teal-50 border-2 border-teal-200 rounded-xl p-6 mb-6">
                <p class="text-sm uppercase tracking-wider text-teal-700 font-semibold mb-1">Tu código de seguimiento</p>
                <p class="text-3xl font-mono font-bold text-teal-900 select-all">{{ $complaint->code }}</p>
                <p class="text-xs text-teal-700 mt-2">Guarda este código, lo necesitarás para consultas futuras.</p>
            </div>

            <div class="space-y-3 text-left bg-gray-50 rounded-xl p-6 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Tipo:</span>
                    <span class="font-semibold text-gray-900 capitalize">{{ $complaint->type }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Asunto:</span>
                    <span class="font-semibold text-gray-900 text-right max-w-xs">{{ $complaint->subject }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Fecha de registro:</span>
                    <span class="font-semibold text-gray-900">{{ optional($complaint->created_at)->format('d/m/Y H:i') ?? '—' }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Estado:</span>
                    <span class="font-semibold text-blue-700">{{ $complaint->status_label }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('complaints.track', $complaint->tracking_token) }}"
                   class="flex-1 bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-lg transition text-center">
                    Ver estado de mi solicitud
                </a>
                <a href="{{ route('home') }}"
                   class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg transition text-center">
                    Volver al inicio
                </a>
            </div>

            <div class="mt-8 text-left bg-amber-50 border border-amber-200 rounded-lg p-4 text-sm text-amber-900">
                <p class="font-semibold mb-1">⏰ Plazo de respuesta</p>
                <p>Recibirás una respuesta en un plazo máximo de <strong>10 días hábiles</strong>.
                Te enviaremos notificaciones al correo electrónico registrado.</p>
            </div>
        </div>
    </div>
</section>
@endsection
