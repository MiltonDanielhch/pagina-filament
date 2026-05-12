{{--
    Ubicación: resources/views/events.blade.php
    Descripción: Listado de todos los eventos. Incluye paginación.
--}}
@extends('layouts.main')

@section('content')
<section class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Eventos</h1>
    
    @if($events->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($events as $event)
        <article class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
            <div class="text-center mb-4">
                <div class="text-3xl font-bold text-official">{{ $event->starts_at->format('d') }}</div>
                <div class="text-sm uppercase text-gray-500">{{ $event->starts_at->format('M Y') }}</div>
            </div>
            <h2 class="text-xl font-bold mb-2">{{ $event->title }}</h2>
            @if($event->location)
            <p class="text-gray-600 mb-2">📍 {{ $event->location }}</p>
            @endif
            <p class="text-gray-500 text-sm mb-4">{{ $event->starts_at->format('H:i') }}</p>
            @if($event->description)
            <p class="text-gray-600 mb-4">{{ Str::limit($event->description, 100) }}</p>
            @endif
            @if($event->is_featured)
            <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-0.5 rounded">Destacado</span>
            @endif
        </article>
        @endforeach
    </div>
    
    <div class="mt-8">
        {{ $events->links() }}
    </div>
    @else
    <p class="text-gray-600">No hay eventos programados.</p>
    @endif
</section>
@endsection