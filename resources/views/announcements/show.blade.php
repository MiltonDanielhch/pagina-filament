{{--
    Vista: Convocatoria — Detalle
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="{{ $announcement->title }}. {{ $announcement->code }} - {{ $announcement->type_label }}. Cierre: {{ optional($announcement->closing_date)->format('d/m/Y') }}.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-amber-600 to-amber-800 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Convocatorias', 'url' => route('announcements.index')],
            ['label' => $announcement->code, 'url' => null]
        ]" />
        <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="text-sm font-mono font-bold bg-white/15 backdrop-blur px-3 py-1 rounded">{{ $announcement->code }}</span>
            <span class="text-sm bg-white/15 backdrop-blur px-3 py-1 rounded-full">
                {{ $announcement->type_label }}
            </span>
            <span class="text-sm px-3 py-1 rounded-full
                @switch($announcement->status)
                    @case('publicada') bg-blue-500/30 @break
                    @case('en_proceso') bg-yellow-500/30 @break
                    @case('finalizada') bg-green-500/30 @break
                    @case('desierta') bg-red-500/30 @break
                    @default bg-white/15
                @endswitch
            ">
                {{ $announcement->status_label }}
            </span>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold leading-tight">{{ $announcement->title }}</h1>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">
                {{-- Descripción --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Descripción</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($announcement->description)) !!}
                    </div>
                </div>

                {{-- Requisitos --}}
                @if($announcement->requirements)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Requisitos</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($announcement->requirements)) !!}
                    </div>
                </div>
                @endif
            </div>

            <aside class="space-y-6">
                {{-- Información clave --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 space-y-4">
                    <h3 class="text-lg font-bold text-gray-900">Información</h3>

                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Publicación</p>
                        <p class="font-semibold text-gray-900">{{ $announcement->publication_date->format('d/m/Y') }}</p>
                    </div>
                    @if($announcement->opening_date)
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Apertura</p>
                        <p class="font-semibold text-gray-900">{{ $announcement->opening_date->format('d/m/Y H:i') }}</p>
                    </div>
                    @endif
                    @if($announcement->closing_date)
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Cierre</p>
                        <p class="font-semibold {{ $announcement->is_open ?? false ? 'text-red-600' : 'text-gray-900' }}">
                            {{ $announcement->closing_date->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    @endif
                    @if($announcement->secretariat)
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-500">Secretaría</p>
                        <a href="{{ route('institutional.secretariats.show', $announcement->secretariat->slug) }}"
                           class="font-semibold text-teal-700 hover:underline">
                            {{ $announcement->secretariat->name }}
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Documentos y enlaces --}}
                <div class="bg-white rounded-2xl shadow-sm p-6 space-y-3">
                    <h3 class="text-lg font-bold text-gray-900">Documentos y enlaces</h3>

                    @if($announcement->document_file)
                    <a href="{{ asset('storage/' . $announcement->document_file) }}" target="_blank" rel="noopener"
                       class="flex items-center gap-3 p-3 bg-red-50 hover:bg-red-100 text-red-700 rounded-lg transition">
                        <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm">Descargar bases / DBC</p>
                            <p class="text-xs">Documento PDF</p>
                        </div>
                    </a>
                    @endif

                    @if($announcement->external_url)
                    <a href="{{ $announcement->external_url }}" target="_blank" rel="noopener"
                       class="flex items-center gap-3 p-3 bg-teal-50 hover:bg-teal-100 text-teal-700 rounded-lg transition">
                        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm">Ver en SICOES</p>
                            <p class="text-xs truncate">{{ $announcement->external_url }}</p>
                        </div>
                    </a>
                    @endif

                    @if(!$announcement->document_file && !$announcement->external_url)
                    <p class="text-sm text-gray-500">No hay documentos adjuntos.</p>
                    @endif
                </div>

                {{-- Compartir --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-900 mb-2">Compartir</h3>
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
                           class="flex-1 text-center py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold">
                            Facebook
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($announcement->title . ' ' . request()->url()) }}" target="_blank"
                           class="flex-1 text-center py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-semibold">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        {{-- Convocatorias relacionadas --}}
        @if(isset($related) && $related->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Otras convocatorias</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($related as $r)
                <a href="{{ route('announcements.show', $r->slug) }}"
                   class="block bg-white p-4 rounded-xl border border-gray-200 hover:border-amber-500 hover:shadow-md transition">
                    <p class="text-xs font-mono text-gray-500 mb-1">{{ $r->code }}</p>
                    <p class="font-semibold text-gray-900 line-clamp-2 mb-2">{{ $r->title }}</p>
                    <p class="text-xs text-gray-500">{{ $r->publication_date->format('d/m/Y') }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
