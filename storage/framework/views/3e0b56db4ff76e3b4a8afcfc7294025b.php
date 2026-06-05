<?php $__env->startSection('seo'); ?>
    <meta name="description" content="Formulario de contacto de la Gobernación Autónoma Departamental del Beni. Envía tus consultas, sugerencias y trámites. Horario de atención de lunes a viernes de 8:00 a 16:00. Teléfono: (591) 346-21651.">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<article class="container mx-auto px-4 py-12 max-w-2xl">
    <?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Contacto', 'url' => null]
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Contacto', 'url' => null]
    ])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $attributes = $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2)): ?>
<?php $component = $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2; ?>
<?php unset($__componentOriginale19f62b34dfe0bfdf95075badcb45bc2); ?>
<?php endif; ?>
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Contacto</h1>
    
    <div class="mb-8 p-6 bg-amber-50 rounded-lg">
        <h2 class="text-xl font-bold mb-4">Información de contacto</h2>
        <p class="mb-2"><strong>Dirección:</strong> Plaza José Ballivian acera sur, Trinidad - Beni</p>
        <p class="mb-2"><strong>Teléfono:</strong> 346-21651</p>
        <p class="mb-2"><strong>Email:</strong> despacho@beni.gob.bo</p>
    </div>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <form method="POST" action="<?php echo e(route('contact.send')); ?>" class="space-y-6" id="contact-form" novalidate>
        <?php echo csrf_field(); ?>
        
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo <span class="text-red-500">*</span></label>
            <input type="text" id="name" name="name" required aria-required="true"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                   data-validate="name">
            <p class="mt-1 text-red-600 text-sm hidden" id="name-error-js" role="alert"></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-red-600 text-sm" id="name-error" role="alert"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" id="email" name="email" required aria-required="true"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                   data-validate="email">
            <p class="mt-1 text-red-600 text-sm hidden" id="email-error-js" role="alert"></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-red-600 text-sm" id="email-error" role="alert"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Asunto <span class="text-red-500">*</span></label>
            <input type="text" id="subject" name="subject" required aria-required="true"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                   data-validate="subject">
            <p class="mt-1 text-red-600 text-sm hidden" id="subject-error-js" role="alert"></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-red-600 text-sm" id="subject-error" role="alert"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje <span class="text-red-500">*</span></label>
            <textarea id="message" name="message" rows="6" required aria-required="true"
                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-official focus:border-official transition-colors"
                      data-validate="message"></textarea>
            <p class="mt-1 text-red-600 text-sm hidden" id="message-error-js" role="alert"></p>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="mt-1 text-red-600 text-sm" id="message-error" role="alert"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <button type="submit"
                id="contact-submit-btn"
                class="w-full bg-official hover:bg-official-dark text-white font-bold py-3 px-6 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
            <span id="submit-text">Enviar mensaje</span>
            <div id="submit-spinner" class="loading-spinner hidden" style="width: 20px; height: 20px; border-width: 2px;"></div>
        </button>
    </form>
</article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
            submitText.textContent = 'Enviando...';
            submitSpinner.classList.remove('hidden');
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\principal\resources\views/contact.blade.php ENDPATH**/ ?>