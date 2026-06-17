{{--
    Ubicación: resources/views/contact.blade.php
    Descripción: Formulario de contacto con validación, labels accesibles
                 y aria-required.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
@extends('layouts.main')

@section('seo')
    <meta name="description" content="Formulario de contacto de la Gobernación Autónoma Departamental del Beni. Envía tus consultas, sugerencias y trámites. Horario de atención de lunes a viernes de 8:00 a 16:00.">
@endsection

@section('content')
<article class="container mx-auto px-4 py-12 max-w-2xl">
    <x-breadcrumb :items="[
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Contacto', 'url' => null]
    ]" />
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
    
    <form method="POST" action="{{ route('contact.send') }}" class="space-y-6" id="contact-form" novalidate>
        @csrf
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo <span class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" required aria-required="true"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                   data-validate="name">
            <p class="mt-1 text-red-600 text-sm hidden" id="name-error-js" role="alert"></p>
            @error('name')
            <p class="mt-1 text-red-600 text-sm" id="name-error" role="alert">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" required aria-required="true"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                   data-validate="email">
            <p class="mt-1 text-red-600 text-sm hidden" id="email-error-js" role="alert"></p>
            @error('email')
            <p class="mt-1 text-red-600 text-sm" id="email-error" role="alert">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Asunto <span class="text-red-500">*</span></label>
            <input type="text" id="subject" name="subject" required aria-required="true"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                   data-validate="subject">
            <p class="mt-1 text-red-600 text-sm hidden" id="subject-error-js" role="alert"></p>
            @error('subject')
            <p class="mt-1 text-red-600 text-sm" id="subject-error" role="alert">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje <span class="text-red-500">*</span></label>
            <textarea id="message" name="message" rows="6" required aria-required="true"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                      data-validate="message"></textarea>
            <p class="mt-1 text-red-600 text-sm hidden" id="message-error-js" role="alert"></p>
            @error('message')
            <p class="mt-1 text-red-600 text-sm" id="message-error" role="alert">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit"
                id="contact-submit-btn"
                class="w-full bg-official hover:bg-official-dark text-white font-bold py-3 px-6 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
            <span id="submit-text">Enviar mensaje</span>
            <div id="submit-spinner" class="loading-spinner hidden" style="width: 20px; height: 20px; border-width: 2px;"></div>
        </button>
    </form>
</article>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    // Validación de campos
    const validators = {
        name: function(value) {
            if (!value.trim()) return 'El nombre es requerido';
            if (value.trim().length < 3) return 'El nombre debe tener al menos 3 caracteres';
            return null;
        },
        email: function(value) {
            if (!value.trim()) return 'El email es requerido';
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) return 'Por favor ingrese un email válido';
            return null;
        },
        subject: function(value) {
            if (!value.trim()) return 'El asunto es requerido';
            if (value.trim().length < 5) return 'El asunto debe tener al menos 5 caracteres';
            return null;
        },
        message: function(value) {
            if (!value.trim()) return 'El mensaje es requerido';
            if (value.trim().length < 10) return 'El mensaje debe tener al menos 10 caracteres';
            return null;
        }
    };
    
    // Función para mostrar/ocultar error
    function showError(fieldName, message) {
        const input = document.getElementById(fieldName);
        const errorElement = document.getElementById(fieldName + '-error-js');
        
        if (message) {
            input.classList.add('border-red-500');
            input.classList.remove('border-green-500');
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        } else {
            input.classList.remove('border-red-500');
            input.classList.add('border-green-500');
            errorElement.classList.add('hidden');
        }
    }
    
    // Validar campo individual
    function validateField(fieldName) {
        const input = document.getElementById(fieldName);
        const value = input.value;
        const validator = validators[fieldName];
        
        if (validator) {
            const error = validator(value);
            showError(fieldName, error);
            return !error;
        }
        return true;
    }
    
    // Agregar eventos de validación a cada campo
    const fields = ['name', 'email', 'subject', 'message'];
    fields.forEach(fieldName => {
        const input = document.getElementById(fieldName);
        
        // Validar al salir del campo (blur)
        input.addEventListener('blur', function() {
            if (this.value.trim()) {
                validateField(fieldName);
            }
        });
        
        // Validar mientras se escribe (input)
        input.addEventListener('input', function() {
            const errorElement = document.getElementById(fieldName + '-error-js');
            if (!errorElement.classList.contains('hidden')) {
                validateField(fieldName);
            }
        });
    });
    
    // Validar formulario al enviar
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        fields.forEach(fieldName => {
            if (!validateField(fieldName)) {
                isValid = false;
            }
        });
        
        if (isValid) {
            submitButton.disabled = true;
            document.getElementById('submit-text').textContent = 'Enviando...';
            document.getElementById('submit-spinner').classList.remove('hidden');
            form.submit();
        } else {
            // Scroll al primer campo con error
            const firstError = document.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });
});
</script>
@endsection