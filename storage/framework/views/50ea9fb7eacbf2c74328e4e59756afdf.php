<?php $__env->startSection('seo'); ?>
    <meta name="description" content="Noticias y comunicados oficiales de la Gobernación Autónoma Departamental del Beni. Mantente informado sobre las últimas actividades gubernamentales, proyectos, eventos y noticias relevantes para los ciudadanos del Beni, Bolivia.">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="container mx-auto px-4 py-12">
    <?php if (isset($component)) { $__componentOriginale19f62b34dfe0bfdf95075badcb45bc2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale19f62b34dfe0bfdf95075badcb45bc2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumb','data' => ['items' => [
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Noticias', 'url' => null]
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Inicio', 'url' => '/'],
        ['label' => 'Noticias', 'url' => null]
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
    <h1 class="text-4xl font-bold mb-8 text-gray-800">Noticias</h1>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($posts->count() > 0): ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pinnedPost): ?>
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4 text-amber-600">Noticias del Beni</h2>
        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pinnedPost->getFirstMedia('featured')): ?>
            <a href="<?php echo e(route('posts.show', $pinnedPost->slug)); ?>">
                <img src="<?php echo e($pinnedPost->getFirstMedia('featured')->getUrl('medium')); ?>" 
                     alt="<?php echo e($pinnedPost->title); ?>" 
                     class="w-full h-64 md:h-96 object-cover">
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="p-6">
                <div class="flex items-center mb-2">
                    <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-0.5 rounded">Destacado</span>
                    <span class="mx-2">-</span>
                    <span class="text-sm text-gray-500"><?php echo e($pinnedPost->category->name ?? 'Sin categoría'); ?></span>
                    <span class="mx-2">-</span>
                    <span class="text-sm text-gray-500"><?php echo e($pinnedPost->published_at->format('d/m/Y')); ?></span>
                </div>
                <h2 class="text-2xl font-bold mb-2">
                    <a href="<?php echo e(route('posts.show', $pinnedPost->slug)); ?>" class="hover:text-amber-600">
                        <?php echo e($pinnedPost->title); ?>

                    </a>
                </h2>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pinnedPost->excerpt): ?>
                <p class="text-gray-600 mb-4"><?php echo e($pinnedPost->excerpt); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <a href="<?php echo e(route('posts.show', $pinnedPost->slug)); ?>" class="text-amber-600 hover:text-amber-700 font-medium">
                    Leer más
                </a>
            </div>
        </article>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Últimas Noticias</h2>
        <a href="<?php echo e(route('blog')); ?>" class="text-amber-600 hover:text-amber-700 font-medium">
            Ver todas las noticias
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->getFirstMedia('featured')): ?>
            <a href="<?php echo e(route('posts.show', $post->slug)); ?>">
                <img src="<?php echo e($post->getFirstMedia('featured')->getUrl('medium')); ?>" 
                     alt="<?php echo e($post->title); ?>" 
                     class="w-full h-48 object-cover">
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <div class="p-6">
                <div class="flex items-center mb-2">
                    <span class="text-sm text-gray-500"><?php echo e($post->category->name ?? 'Sin categoría'); ?></span>
                    <span class="mx-2">-</span>
                    <span class="text-sm text-gray-500"><?php echo e($post->published_at->format('d/m/Y')); ?></span>
                </div>
                <h2 class="text-xl font-bold mb-2">
                    <a href="<?php echo e(route('posts.show', $post->slug)); ?>" class="hover:text-amber-600">
                        <?php echo e($post->title); ?>

                    </a>
                </h2>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->excerpt): ?>
                <p class="text-gray-600 mb-4"><?php echo e(Str::limit($post->excerpt, 100)); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <a href="<?php echo e(route('posts.show', $post->slug)); ?>" class="text-amber-600 hover:text-amber-700 font-medium">
                    Leer más
                </a>
            </div>
        </article>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
    
    <div class="mt-8">
        <?php echo e($posts->links()); ?>

    </div>
    <?php else: ?>
    <p class="text-gray-600">No hay noticias publicadas.</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\principal\resources\views/blog.blade.php ENDPATH**/ ?>