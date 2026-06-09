{{--
    Vista: Dataset — Detalle con descargas en múltiples formatos
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="{{ $dataset->title }}. Descarga datos abiertos en CSV, JSON, XLSX. {{ $dataset->publisher }}.">
@endsection

@section('content')
<section class="bg-gradient-to-br from-indigo-700 to-indigo-900 text-white py-12">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'Datos Abiertos', 'url' => route('open-data.index')],
            ['label' => $dataset->title, 'url' => null]
        ]" />
        <span class="text-xs font-bold bg-white/15 backdrop-blur px-3 py-1 rounded uppercase tracking-wider">
            {{ $dataset->category ?? 'Dataset' }}
        </span>
        <h1 class="text-3xl md:text-4xl font-bold mt-3 leading-tight">{{ $dataset->title }}</h1>
        @if($dataset->publisher)
        <p class="text-white/90 mt-2">Publicado por: <strong>{{ $dataset->publisher }}</strong></p>
        @endif
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
                        {!! nl2br(e($dataset->description)) !!}
                    </div>
                </div>

                {{-- Metadatos --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Metadatos</h2>
                    <dl class="grid sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="text-gray-500">Licencia</dt>
                            <dd class="font-semibold text-gray-900">{{ $dataset->license ?? 'CC-BY-4.0' }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Frecuencia de actualización</dt>
                            <dd class="font-semibold text-gray-900">{{ $dataset->frequency_label }}</dd>
                        </div>
                        @if($dataset->last_updated_at)
                        <div>
                            <dt class="text-gray-500">Última actualización</dt>
                            <dd class="font-semibold text-gray-900">{{ $dataset->last_updated_at->format('d/m/Y') }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-gray-500">Descargas totales</dt>
                            <dd class="font-semibold text-gray-900">{{ $dataset->download_count }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <aside class="space-y-6">
                {{-- Descargas --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border-2 border-indigo-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Descargar</h3>
                    <div class="space-y-2">
                        @foreach(['csv' => 'CSV', 'json' => 'JSON', 'xlsx' => 'Excel', 'pdf' => 'PDF'] as $ext => $label)
                            @if($dataset->{"file_{$ext}"})
                            <a href="{{ route('open-data.download', [$dataset->slug, $ext]) }}"
                               class="flex items-center gap-3 p-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 rounded-lg transition group">
                                <div class="w-10 h-10 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper($ext) }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-sm">Descargar {{ $label }}</p>
                                    <p class="text-xs">Formato abierto</p>
                                </div>
                                <svg class="w-5 h-5 group-hover:translate-y-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </a>
                            @endif
                        @endforeach

                        @if($dataset->external_url)
                        <a href="{{ $dataset->external_url }}" target="_blank" rel="noopener"
                           class="flex items-center gap-3 p-3 bg-amber-50 hover:bg-amber-100 text-amber-700 rounded-lg transition">
                            <div class="w-10 h-10 bg-amber-600 text-white rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Ver en datos.gob.bo</p>
                                <p class="text-xs">Portal nacional</p>
                            </div>
                        </a>
                        @endif

                        @if(!$dataset->file_csv && !$dataset->file_json && !$dataset->file_xlsx && !$dataset->file_pdf && !$dataset->external_url)
                        <p class="text-sm text-gray-500">No hay archivos disponibles para descarga.</p>
                        @endif
                    </div>
                </div>

                {{-- Compartir --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-900 mb-2">Compartir</h3>
                    <div class="flex gap-2">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($dataset->title) }}" target="_blank"
                           class="flex-1 text-center py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-sm font-semibold">
                            Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank"
                           class="flex-1 text-center py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-lg text-sm font-semibold">
                            LinkedIn
                        </a>
                    </div>
                </div>
            </aside>
        </div>

        {{-- Datasets relacionados --}}
        @if(isset($related) && $related->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Datasets relacionados</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($related as $r)
                <a href="{{ route('open-data.show', $r->slug) }}"
                   class="block bg-white p-4 rounded-xl border border-gray-200 hover:border-indigo-500 hover:shadow-md transition">
                    <p class="text-xs font-bold text-indigo-700 uppercase tracking-wider mb-1">{{ $r->category ?? 'Dataset' }}</p>
                    <p class="font-semibold text-gray-900 line-clamp-2">{{ $r->title }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
