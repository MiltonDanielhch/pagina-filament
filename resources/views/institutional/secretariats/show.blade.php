{{--
    Vista: Secretaría — Detalle
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="{{ $secretariat->name }} — Secretaría Departamental del Beni. Misión, visión, objetivos, trámites y noticias relacionadas.">
@endsection

@section('content')
<section class="text-white py-16"
         style="background: linear-gradient(135deg, {{ $secretariat->color ?? '#0d9488' }} 0%, #134e4a 100%);">
    <div class="container mx-auto px-4">
        <x-breadcrumb :items="[
            ['label' => 'Inicio', 'url' => '/'],
            ['label' => 'La Gobernación', 'url' => route('institutional.index')],
            ['label' => 'Secretarías', 'url' => route('institutional.secretariats')],
            ['label' => $secretariat->acronym ?? $secretariat->name, 'url' => null]
        ]" />
        <div class="flex items-start gap-4">
            <div class="w-20 h-20 bg-white/15 backdrop-blur rounded-2xl flex items-center justify-center text-2xl font-bold shadow-lg flex-shrink-0">
                {{ $secretariat->acronym ?? mb_substr($secretariat->name, 0, 2) }}
            </div>
            <div>
                <p class="font-semibold uppercase tracking-widest text-amber-300 mb-1 text-sm">
                    Secretaría Departamental
                </p>
                <h1 class="text-3xl md:text-4xl font-bold leading-tight">{{ $secretariat->name }}</h1>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Contenido principal --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Descripción --}}
                @if($secretariat->description)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Acerca de
                    </h2>
                    <p class="text-gray-700 leading-relaxed">{{ $secretariat->description }}</p>
                </div>
                @endif

                {{-- Misión y Visión --}}
                <div class="grid md:grid-cols-2 gap-6">
                    @if($secretariat->mission)
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-teal-700 mb-3">Misión</h3>
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $secretariat->mission }}</p>
                    </div>
                    @endif
                    @if($secretariat->vision)
                    <div class="bg-white rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-bold text-amber-600 mb-3">Visión</h3>
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $secretariat->vision }}</p>
                    </div>
                    @endif
                </div>

                {{-- Objetivos --}}
                @if($secretariat->objectives && count($secretariat->objectives) > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Objetivos Estratégicos
                    </h2>
                    <ul class="space-y-2">
                        @foreach($secretariat->objectives as $objetivo)
                        <li class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">
                                {{ $loop->iteration }}
                            </span>
                            <span class="text-gray-700">{{ $objetivo }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Trámites de la secretaría --}}
                @if($secretariat->procedures->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Trámites y Servicios
                    </h2>
                    <div class="space-y-2">
                        @foreach($secretariat->procedures as $procedure)
                        <a href="{{ route('procedures.show', $procedure->slug) }}"
                           class="flex items-center justify-between p-3 rounded-lg hover:bg-teal-50 border border-gray-200 hover:border-teal-300 transition group">
                            <div>
                                <p class="font-semibold text-gray-900 group-hover:text-teal-700">{{ $procedure->name }}</p>
                                <p class="text-xs text-gray-500">{{ $procedure->code }} · {{ $procedure->category_label }}</p>
                            </div>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Convocatorias activas --}}
                @if($secretariat->announcements->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Convocatorias Vigentes
                    </h2>
                    <div class="space-y-2">
                        @foreach($secretariat->announcements->whereIn('status', ['publicada', 'en_proceso'])->take(5) as $a)
                        <a href="{{ route('announcements.show', $a->slug) }}"
                           class="block p-3 rounded-lg hover:bg-amber-50 border border-gray-200 hover:border-amber-300 transition">
                            <p class="font-semibold text-gray-900">{{ $a->title }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $a->code }} · Cierra: {{ optional($a->closing_date)->format('d/m/Y') }}
                            </p>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                {{-- Secretario/a --}}
                @if($secretariat->head)
                <div class="bg-white rounded-2xl shadow-sm p-6 text-center">
                    <p class="text-xs uppercase tracking-wider text-teal-700 font-semibold mb-3">
                        Secretario/a Departamental
                    </p>
                    <div class="w-24 h-24 bg-gradient-to-br from-teal-500 to-teal-700 rounded-full mx-auto mb-3 flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(mb_substr($secretariat->head->full_name, 0, 1)) }}
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">{{ $secretariat->head->full_name }}</h3>
                    @if($secretariat->head->position)
                    <p class="text-sm text-gray-600 mt-1">{{ $secretariat->head->position }}</p>
                    @endif
                </div>
                @endif

                {{-- Datos de contacto --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Contacto</h3>
                    <ul class="space-y-3 text-sm">
                        @if($secretariat->contact_email)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-teal-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:{{ $secretariat->contact_email }}" class="text-gray-700 hover:text-teal-700 break-all">
                                {{ $secretariat->contact_email }}
                            </a>
                        </li>
                        @endif
                        @if($secretariat->contact_phone)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-teal-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <a href="tel:{{ preg_replace('/\s+/', '', $secretariat->contact_phone) }}" class="text-gray-700 hover:text-teal-700">
                                {{ $secretariat->contact_phone }}
                            </a>
                        </li>
                        @endif
                        @if($secretariat->office_address)
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-teal-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-gray-700">{{ $secretariat->office_address }}</span>
                        </li>
                        @endif
                    </ul>
                </div>

                {{-- Noticias recientes --}}
                @if($recentNews->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Noticias recientes</h3>
                    <ul class="space-y-3">
                        @foreach($recentNews as $post)
                        <li>
                            <a href="{{ route('posts.show', $post->slug) }}" class="block hover:text-teal-700 group">
                                <p class="text-sm font-medium text-gray-900 group-hover:text-teal-700 line-clamp-2">
                                    {{ $post->title }}
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $post->published_at->format('d/m/Y') }}
                                </p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>
@endsection
