{{--
    Ubicación: resources/views/layouts/main.blade.php
    Descripción: Layout principal del sitio público. Incluye header con
                 navegación, slider, skip link para accesibilidad y footer.
    Accesibilidad: lang="es", skip link, contraste 4.5:1, semantic HTML
    Roadmap: 06-FRONTEND.md — Bloque 6.1
--}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gobernación Autónoma Departamental del Beni' }}</title>
    <style>
        .skip-link {
            position: absolute;
            left: -9999px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }
        .skip-link:focus {
            position: absolute;
            top: 10px;
            left: 10px;
            width: auto;
            height: auto;
            padding: 10px 20px;
            background: #0f766e;
            color: white;
            border-radius: 8px;
            z-index: 9999;
            outline: 2px solid white;
            text-decoration: none;
        }
    </style>
    <meta name="description" content="{{ $description ?? 'Sitio web oficial de la Gobernación Autónoma Departamental del Beni, Bolivia. Información sobre servicios, noticias y trámites gubernamentales.' }}">
    <meta name="author" content="Gobernación Autónoma Departamental del Beni">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0f766e">
    
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title ?? 'Gobernación Autónoma Departamental del Beni' }}">
    <meta property="og:description" content="Sitio web oficial de la Gobernación Autónoma Departamental del Beni">
    <meta property="og:type" content="governmentOrganization">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Gobernación Autónoma Departamental del Beni">
    <meta property="og:image" content="{{ asset('images/beni-og.jpg') }}">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Gobernación Autónoma Departamental del Beni' }}">
    <meta name="twitter:description" content="Sitio web oficial de la Gobernación Autónoma Departamental del Beni">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-beni.png') }}">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css'])
    
    <!-- SEO -->
    @yield('seo')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Skip Link para accesibilidad -->
    <a href="#main-content" class="skip-link">
        Ir al contenido principal
    </a>
    
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <!-- Top Bar -->
        <div class="bg-official text-white text-sm py-2">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1">🕐 Lun - Vie 8:00 - 16:00</span>
                    <span class="flex items-center gap-1">📞 (591) 346-21651</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="https://facebook.com/GobernacionDelBeni" target="_blank" class="hover:text-amber-200 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.637H7.078v-3.497h3.047V9.603c0-3.014 1.825-4.679 4.532-4.679 1.313 0 2.703.235 2.703.235v2.965h-1.524c-1.501 0-1.973.934-1.973 1.893v2.27h3.328l-.527 3.497h-2.801v8.637C19.613 23.027 24 17.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://twitter.com/GAD_Beni" target="_blank" class="hover:text-amber-200 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="https://instagram.com/gobernacionbeni" target="_blank" class="hover:text-amber-200 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0 2.163c-3.259 0-3.667.014-4.947.072-2.905.132-4.289 1.513-4.421 4.421-.057 1.28-.071 1.689-.071 4.947 0 3.259.014 3.668.072 4.946.132 2.908 1.516 4.291 4.421 4.422 1.281.058 1.69.072 4.947.072 3.259 0 3.668-.014 4.947-.072 2.906-.132 4.291-1.516 4.421-4.422.058-1.28.072-1.689.072-4.946 0-3.259-.014-3.667-.072-4.947-.131-2.905-1.513-4.29-4.421-4.421-1.28-.058-1.688-.072-4.947-.072zm0 3.678c2.623 0 4.756 2.133 4.756 4.756s-2.133 4.756-4.756 4.756-4.756-2.133-4.756-4.756 2.133-4.756 4.756-4.756zm0 1.838c-1.641 0-2.975 1.334-2.975 2.975s1.334 2.975 2.975 2.975 2.975-1.334 2.975-2.975-1.334-2.975-2.975-2.975zm5.938-3.846c-.663 0-1.2.537-1.2 1.2s.537 1.2 1.2 1.2 1.2-.537 1.2-1.2-.537-1.2-1.2-1.2z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Main Nav -->
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-official rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-xl">B</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 leading-tight">Gobernación<br><span class="text-official">del Beni</span></h1>
                        <p class="text-xs text-gray-500">Autónoma Departamental</p>
                    </div>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-1">
                    @if($headerMenu && $headerMenu->items)
                        @foreach($headerMenu->items->where('parent_id', null) as $item)
                            @if($item->children->count() > 0)
                                <!-- Dropdown -->
                                <div class="relative group">
                                    <button class="px-4 py-2 rounded-lg text-gray-700 hover:bg-official/5 hover:text-official transition font-medium flex items-center gap-1">
                                        {{ $item->label }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                        @foreach($item->children as $child)
                                            <a href="{{ $child->page_id ? route('pages.show', $child->page->slug) : $child->url }}"
                                               target="{{ $child->target ?? '_self' }}"
                                               class="block px-4 py-2 text-gray-700 hover:bg-official/5 hover:text-official transition">
                                                {{ $child->label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <!-- Regular item -->
                                <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}"
                                   target="{{ $item->target ?? '_self' }}"
                                   class="px-4 py-2 rounded-lg text-gray-700 hover:bg-official/5 hover:text-official transition font-medium">
                                    {{ $item->label }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                    <a href="https://siscor.beni.gob.bo" target="_blank" class="btn-primary ml-2">
                        🟣 Trámites
                    </a>
                    <form action="{{ route('search') }}" method="GET" class="relative ml-2">
                        <input type="text" name="q" placeholder="Buscar..." 
                            class="w-32 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-official focus:ring-1 focus:ring-official"
                            minlength="3">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-400 hover:text-official">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t">
                <form action="{{ route('search') }}" method="GET" class="mb-3">
                    <input type="text" name="q" placeholder="Buscar..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-official">
                </form>
                @if($headerMenu && $headerMenu->items)
                    @foreach($headerMenu->items->where('parent_id', null) as $item)
                        @if($item->children->count() > 0)
                            <!-- Mobile Dropdown -->
                            <div class="mobile-dropdown">
                                <button onclick="this.nextElementSibling.classList.toggle('hidden')" class="w-full px-4 py-3 rounded-lg text-gray-700 hover:bg-official/5 flex items-center justify-between">
                                    {{ $item->label }}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="hidden pl-4">
                                    @foreach($item->children as $child)
                                        <a href="{{ $child->page_id ? route('pages.show', $child->page->slug) : $child->url }}"
                                           target="{{ $child->target ?? '_self' }}"
                                           class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-official/5">
                                            {{ $child->label }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Regular item -->
                            <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}"
                               target="{{ $item->target ?? '_self' }}"
                               class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-official/5">
                                {{ $item->label }}
                            </a>
                        @endif
                    @endforeach
                @endif
                <a href="https://siscor.beni.gob.bo" target="_blank" class="block mt-2 btn-primary text-center">Trámites Online</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-auto">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-official rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">B</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Gobernación<br><span class="text-official-light">del Beni</span></h3>
                            <p class="text-xs text-gray-400">Autónoma Departamental</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Institución pública comprometida con el desarrollo integral del departamento del Beni.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold mb-4 text-official-light">Enlaces</h4>
                    <ul class="space-y-2">
                        <li><a href="https://gaceta.beni.gob.bo" target="_blank" class="text-gray-400 hover:text-white transition">📜 Gaceta Jurídica</a></li>
                        <li><a href="https://siscor.beni.gob.bo" target="_blank" class="text-gray-400 hover:text-white transition">🟣 SISCOR</a></li>
                        <li><a href="https://transparencia.beni.gob.bo" target="_blank" class="text-gray-400 hover:text-white transition">👁 Transparencia</a></li>
                        <li><a href="/buscar" class="text-gray-400 hover:text-white transition">🔍 Buscador</a></li>
                        <li><a href="/politica-de-privacidad" class="text-gray-400 hover:text-white transition">🔒 Privacidad</a></li>
                    </ul>
                </div>
                
                <!-- Contacto -->
                <div>
                    <h4 class="font-bold mb-4 text-official-light">Contacto</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📍 Plaza José Ballivian N° 1</li>
                        <li> Trinidad, Beni - Bolivia</li>
                        <li>📞 (591) 346-21651</li>
                        <li>✉ despacho@beni.gob.bo</li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} Gobernación Autónoma Departamental del Beni. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

    <script>
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    </script>
    
    @yield('scripts')
</body>
</html>