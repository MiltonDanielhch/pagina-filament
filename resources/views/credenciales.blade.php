{{--
    Ubicación: resources/views/credenciales.blade.php
    Descripción: Vista dedicada para mostrar credenciales institucionales de funcionarios.
--}}
@extends('layouts.main')

@section('title', 'Credenciales - Gobernación del Beni')
@section('description', 'Credenciales institucionales de las autoridades y funcionarios del gobierno departamental del Beni.')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-7xl">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Credenciales', 'url' => null]
    ]" />

    <header class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Credenciales Institucionales</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Credenciales oficiales de identificación de las autoridades y funcionarios del gobierno departamental del Beni.
        </p>
    </header>

    @forelse($officials as $official)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-center">
        @foreach($officials as $official)
        <x-credencial-beni 
            :nombre="$official->name"
            :cargo="$official->position"
            :secretaria="$official->area ?? 'Gobierno Departamental'"
            :ci="$official->email ?? 'N/A'"
            :item="$official->id ?? 'N/A'"
            :avatar="$official->getFirstMediaUrl('officials')" 
        />
        @endforeach
    </div>
    @empty
    <div class="text-center py-12 bg-gray-50 rounded-xl">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
        <h3 class="text-xl font-medium text-gray-700 mb-2">Sin credenciales disponibles</h3>
        <p class="text-gray-500">Próximamente publicaremos las credenciales institucionales.</p>
    </div>
    @endforelse
</div>
@endsection
