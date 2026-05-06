@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-2xl">
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Contacto</h1>
    
    <div class="mb-8 p-6 bg-amber-50 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Información de contacto</h2>
        <p class="mb-2"><strong>Dirección:</strong> Plaza José Ballivian acera sur, Trinidad - Beni</p>
        <p class="mb-2"><strong>Teléfono:</strong> 346-21651</p>
        <p class="mb-2"><strong>Email:</strong> despacho@beni.gob.bo</p>
    </div>
    
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
        @csrf
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
            <input type="text" id="name" name="name" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            @error('name')
            <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            @error('email')
            <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Asunto</label>
            <input type="text" id="subject" name="subject" required
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            @error('subject')
            <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
            <textarea id="message" name="message" rows="6" required
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500"></textarea>
            @error('message')
            <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit" 
                class="w-full bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
            Enviar mensaje
        </button>
    </form>
</div>
@endsection