{{--
    Vista: Seguimiento de queja/reclamo por token
--}}
@extends('layouts.main')

@section('seo')
    <meta name="robots" content="noindex, nofollow">
@endsection

@section('content')
<section class="py-12 bg-gray-50 min-h-[60vh]">
    <div class="container mx-auto px-4 max-w-3xl">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Servicios', 'url' => null],
            ['label' => 'Seguimiento de solicitud', 'url' => null]
        ]" />

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-br from-teal-700 to-teal-900 text-white p-6">
                <div class="flex items-start justify-between flex-wrap gap-3">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-amber-300 mb-1">Solicitud N°</p>
                        <h1 class="text-2xl font-bold font-mono">{{ $complaint->code }}</h1>
                    </div>
                    <span class="text-sm px-3 py-1 rounded-full bg-white/15 backdrop-blur">
                        {{ $complaint->status_label }}
                    </span>
                </div>
            </div>

            {{-- Timeline --}}
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Estado de la solicitud</h2>
                <ol class="relative border-l-2 border-gray-200 ml-3 space-y-6">
                    <li class="ml-6">
                        <span class="absolute -left-2 w-4 h-4 rounded-full bg-teal-500 border-2 border-white"></span>
                        <p class="font-semibold text-gray-900">Registrada</p>
                        <p class="text-sm text-gray-600">{{ optional($complaint->created_at)->format('d/m/Y H:i') ?? '—' }}</p>
                        <p class="text-sm text-gray-500 mt-1">Tu solicitud fue recibida en el sistema.</p>
                    </li>
                    @if($complaint->status !== 'recibido')
                    <li class="ml-6">
                        <span class="absolute -left-2 w-4 h-4 rounded-full {{ in_array($complaint->status, ['en_proceso', 'resuelto', 'rechazado']) ? 'bg-yellow-500' : 'bg-gray-300' }} border-2 border-white"></span>
                        <p class="font-semibold text-gray-900">En proceso</p>
                        @if($complaint->response_date)
                        <p class="text-sm text-gray-600">{{ $complaint->response_date->format('d/m/Y H:i') }}</p>
                        @endif
                    </li>
                    @endif
                    @if(in_array($complaint->status, ['resuelto', 'rechazado']))
                    <li class="ml-6">
                        <span class="absolute -left-2 w-4 h-4 rounded-full {{ $complaint->status === 'resuelto' ? 'bg-green-500' : 'bg-red-500' }} border-2 border-white"></span>
                        <p class="font-semibold text-gray-900">{{ $complaint->status_label }}</p>
                        @if($complaint->response_date)
                        <p class="text-sm text-gray-600">{{ $complaint->response_date->format('d/m/Y H:i') }}</p>
                        @endif
                    </li>
                    @endif
                </ol>
            </div>

            {{-- Detalles --}}
            <div class="p-6 grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">Tipo</p>
                    <p class="font-semibold text-gray-900 capitalize">{{ $complaint->type }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">Fecha de registro</p>
                    <p class="font-semibold text-gray-900">{{ optional($complaint->created_at)->format('d/m/Y H:i') ?? '—' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">Asunto</p>
                    <p class="font-semibold text-gray-900">{{ $complaint->subject }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">Descripción</p>
                    <p class="text-gray-700 whitespace-pre-line">{{ $complaint->description }}</p>
                </div>
                @if($complaint->secretariat)
                <div class="md:col-span-2">
                    <p class="text-xs uppercase tracking-wider text-gray-500 mb-1">Secretaría relacionada</p>
                    <p class="font-semibold text-gray-900">{{ $complaint->secretariat->name }}</p>
                </div>
                @endif
            </div>

            {{-- Respuesta --}}
            @if($complaint->response)
            <div class="bg-teal-50 border-t border-teal-200 p-6">
                <h2 class="text-lg font-bold text-teal-900 mb-2">Respuesta oficial</h2>
                <p class="text-sm text-teal-700 mb-3">
                    Respondida el {{ optional($complaint->response_date)->format('d/m/Y H:i') }}
                </p>
                <div class="bg-white rounded-lg p-4 text-gray-700 whitespace-pre-line">
                    {{ $complaint->response }}
                </div>
            </div>
            @endif
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('complaints.create') }}" class="text-teal-700 hover:text-teal-800 font-semibold text-sm">
                ← Registrar otra solicitud
            </a>
        </div>
    </div>
</section>
@endsection
