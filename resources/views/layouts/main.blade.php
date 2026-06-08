<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gobernación Autónoma Departamental del Beni' }}</title>
    
    <!-- Custom CSS (Fuera de Vite para personalización directa) -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <meta name="description" content="{{ $description ?? 'Sitio web oficial de la Gobernación Autónoma Departamental del Beni, Bolivia. Información sobre servicios gubernamentales, noticias, eventos y trámites. Atención al ciudadano de lunes a viernes de 8:00 a 16:00.' }}">
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

    <!-- Favicon Extraction Logic -->
    @php
        $siteLogo = \App\Models\SiteSetting::get('site_logo', '');
        $siteFavicon = \App\Models\SiteSetting::get('site_favicon', '');

        if ($siteLogo && !str_starts_with($siteLogo, 'http://') && !str_starts_with($siteLogo, 'https://')) {
            $siteLogo = \Illuminate\Support\Facades\Storage::url($siteLogo);
        }
        if ($siteFavicon && !str_starts_with($siteFavicon, 'http://') && !str_starts_with($siteFavicon, 'https://')) {
            $siteFavicon = \Illuminate\Support\Facades\Storage::url($siteFavicon);
        }

        $logoSrc = $siteLogo ?: asset('images/logo-beni.png');
        $faviconSrc = $siteFavicon ?: asset('favicon.ico');
    @endphp

    <link rel="icon" type="image/x-icon" href="{{ $faviconSrc }}">
    <link class="apple-touch-icon" href="{{ $faviconSrc }}">

    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Beni">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Gobierno del Beni">

    <!-- Tailwind CSS dynamic build -->
    @vite(['resources/css/app.css'])

    <!-- SEO Hook -->
    @yield('seo')

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Schema.org Markup for Government Organization -->
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "GovernmentOrganization",
        "name": "Gobernación Autónoma Departamental del Beni",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo-beni.png') }}",
        "description": "Sitio web oficial de la Gobernación Autónoma Departamental del Beni, Bolivia. Información sobre servicios, noticias y trámites gubernamentales.",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Trinidad",
            "addressRegion": "Beni",
            "addressCountry": "BO",
            "streetAddress": "Plaza José Ballivián N° 1"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+591 346-21651",
            "contactType": "customer service",
            "areaServed": "BO",
            "availableLanguage": "Spanish"
        },
        "sameAs": [
            "https://www.facebook.com/profile.php?id=61589790584981",
            "https://twitter.com/GAD_Beni",
            "https://instagram.com/gobernacionbeni"
        ],
        "openingHours": "Mo-Fr 08:00-16:00"
    }
    </script>
    @endverbatim
</head>
<body class="bg-gray-50 min-h-screen flex flex-col antialiased text-gray-800 transition-colors duration-200">

    <!-- Skip Link para accesibilidad Keyboard-Only -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:bg-amber-500 focus:text-gray-900 focus:px-4 focus:py-2 focus:rounded-br-md font-bold shadow">
        Ir al contenido principal
    </a>

    <!-- Contenedor Padre Sticky global -->
    <div class="sticky top-0 z-50 w-full flex flex-col" id="nav-wrapper">
        
        <!-- Top Bar -->
        <div id="top-bar" class="bg-teal-700 text-white text-sm py-2 transition-all duration-300 ease-in-out">
            <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-2">
                <div class="flex items-center justify-center md:justify-start flex-wrap gap-x-4 gap-y-1 text-xs sm:text-sm font-medium">
                    <span class="flex items-center gap-1">🕐 Lun - Vie 8:00 - 16:00</span>
                    <span class="flex items-center gap-1">📞 (591) 346-21651</span>
                </div>
                
                <div class="flex items-center justify-center md:justify-end gap-2 w-full md:w-auto">
                    <!-- Accesibilidad Controles -->
                    <button onclick="decreaseFontSize()" class="hover:text-amber-200 transition flex items-center justify-center w-8 h-8" title="Disminuir fuente" aria-label="Disminuir tamaño de fuente">
                        <span class="text-xs font-bold">A-</span>
                    </button>
                    <button onclick="resetFontSize()" class="hover:text-amber-200 transition flex items-center justify-center w-8 h-8" title="Restablecer fuente" aria-label="Restablecer tamaño de fuente">
                        <span class="text-sm font-bold">A</span>
                    </button>
                    <button onclick="increaseFontSize()" class="hover:text-amber-200 transition flex items-center justify-center w-8 h-8" title="Aumentar fuente" aria-label="Aumentar tamaño de fuente">
                        <span class="text-lg font-bold">A+</span>
                    </button>
                    <button onclick="toggleHighContrast()" class="hover:text-amber-200 transition flex items-center gap-1 px-1" title="Modo alto contraste" aria-label="Activar modo alto contraste">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="hidden sm:inline text-xs">Alto Contraste</span>
                    </button>
                    
                    <span class="text-teal-500 hidden md:inline">|</span>

                    <!-- Redes Sociales -->
                    <div class="flex items-center gap-2">
                        <a href="https://www.facebook.com/profile.php?id=61589790584981" target="_blank" rel="noopener noreferrer" class="hover:text-amber-200 transition p-1" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.637H7.078v-3.497h3.047V9.603c0-3.014 1.825-4.679 4.532-4.679 1.313 0 2.703.235 2.703.235v2.965h-1.524c-1.501 0-1.973.934-1.973 1.893v2.27h3.328l-.527 3.497h-2.801v8.637C19.613 23.027 24 17.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Principal (El Menú Blanco con el Logo) -->
        <header class="bg-white shadow-md w-full" id="main-header">
            <nav class="container mx-auto px-4 py-3">
                <div class="flex items-center justify-between">
                    
                    <!-- Logo -->
                    <a href="/" class="flex items-center" aria-label="Ir a la página de inicio">
                        <div class="max-w-[200px] h-12 flex items-center justify-start">
                            <img src="{{ $logoSrc }}" alt="Logo Gobernación del Beni" class="w-full h-full object-contain object-left">
                        </div>
                    </a> 

                    <!-- Menú de navegación de escritorio -->
                    <div class="hidden md:flex items-center gap-1">
                        @if($headerMenu && $headerMenu->items)
                            @foreach($headerMenu->items->where('parent_id', null) as $item)
                                @if($item->children->count() > 0)
                                    <div class="relative desktop-dropdown">
                                        <button onclick="toggleDropdown(this)" class="dropdown-trigger px-3 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-700 transition font-medium flex items-center gap-1">
                                            {{ $item->label }}
                                            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu hidden absolute right-0 mt-2 min-w-[16rem] bg-white rounded-lg shadow-xl border border-gray-100 py-1 z-50">
                                            @foreach($item->children as $child)
                                                <a href="{{ $child->page_id ? route('pages.show', $child->page->slug) : $child->url }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-teal-600 hover:text-white transition">
                                                    {{ $child->label }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}" class="px-3 py-2 rounded-lg text-gray-700 hover:bg-teal-50 hover:text-teal-700 transition font-medium">
                                        {{ $item->label }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    </div>

                    <!-- Botón móvil -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600" aria-label="Abrir menú">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </nav>

            <!-- Menú móvil -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
                <nav class="container mx-auto px-4 py-3">
                    @if($headerMenu && $headerMenu->items)
                        @foreach($headerMenu->items->where('parent_id', null) as $item)
                            @if($item->children->count() > 0)
                                <div class="mobile-dropdown">
                                    <button onclick="toggleMobileDropdown(this)" class="dropdown-trigger w-full flex items-center justify-between px-3 py-3 text-gray-700 hover:bg-teal-50 transition font-medium">
                                        {{ $item->label }}
                                        <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu hidden pl-4 pb-2">
                                        @foreach($item->children as $child)
                                            <a href="{{ $child->page_id ? route('pages.show', $child->page->slug) : $child->url }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-teal-50 hover:text-teal-700 transition">
                                                {{ $child->label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}" class="block px-3 py-3 text-gray-700 hover:bg-teal-50 transition font-medium">
                                    {{ $item->label }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                </nav>
            </div>
        </header>
    </div>

    <!-- Main Dynamic View Content -->
    <main id="main-content" class="flex-grow focus:outline-none">
        @yield('content')
    </main>

    <!-- Footer Corporativo -->
    <footer class="bg-gray-900 text-gray-300 mt-auto border-t-4 border-teal-700">
        <div class="container mx-auto px-4 pt-12 pb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 items-start">
                
                <!-- Identificación Institucional -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-lg overflow-hidden bg-white p-1 flex items-center justify-center shadow-md">
                            <img src="{{ $logoSrc }}" alt="Gobernación del Beni" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <h3 class="text-md font-bold text-white leading-tight">Gobernación<br><span class="text-amber-400 text-sm font-medium">del Beni</span></h3>
                            <p class="text-[10px] text-gray-400 tracking-wider uppercase">Autónoma Departamental</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Institución pública comprometida con el desarrollo integral del departamento del Beni, trabajando por el bienestar de todos los benianos.
                    </p>
                </div>

                <!-- Enlaces Dinámicos Chunk 1 & 2 -->
                @if($footerMenu && $footerMenu->items && $footerMenu->items->count() > 0)
                    @foreach($footerMenu->items->sortBy('order')->chunk(4) as $chunk)
                        <div class="space-y-3">
                            <h4 class="text-xs font-bold text-amber-400 uppercase tracking-widest border-b border-gray-800 pb-2">
                                {{ $loop->first ? 'Enlaces Institucionales' : 'Servicios y Más' }}
                            </h4>
                            <ul class="space-y-2 text-sm">
                                @foreach($chunk as $item)
                                    <li>
                                        <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}"
                                           target="{{ $item->target ?? '_self' }}"
                                           class="text-gray-400 hover:text-white transition-colors flex items-center gap-2 group">
                                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 opacity-50 group-hover:opacity-100 transition-opacity"></span>
                                            {{ $item->label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback Estático -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-amber-400 uppercase tracking-widest border-b border-gray-800 pb-2">Enlaces de Interés</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="https://gaceta.beni.gob.bo" class="text-gray-400 hover:text-white transition">Gaceta Jurídica</a></li>
                            <li><a href="https://siscor.beni.gob.bo" class="text-gray-400 hover:text-white transition">Plataforma SISCOR</a></li>
                        </ul>
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold text-amber-400 uppercase tracking-widest border-b border-gray-800 pb-2">Portal</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="/politica-de-privacidad" class="text-gray-400 hover:text-white transition">Privacidad</a></li>
                        </ul>
                    </div>
                @endif

                <!-- Datos de Contacto Directo -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-amber-400 uppercase tracking-widest border-b border-gray-800 pb-2">Información de Contacto</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <span>Plaza José Ballivián N° 1<br><span class="text-gray-500 text-xs">Trinidad, Beni - Bolivia</span></span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>(591) 346-21651</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:despacho@beni.gob.bo" class="hover:text-white transition">despacho@beni.gob.bo</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Copyright and Legal -->
            <div class="border-t border-gray-800 mt-10 pt-4 flex flex-col md:flex-row justify-between items-center gap-2 text-[11px] text-gray-500">
                <p>&copy; {{ date('Y') }} Gobernación Autónoma Departamental del Beni. Todos los derechos reservados.</p>
                <div class="flex gap-3">
                    <a href="/politica-de-privacidad" class="hover:text-gray-300 transition">Política de Privacidad</a>
                    <span>|</span>
                    <a href="/terminos-de-uso" class="hover:text-gray-300 transition">Términos de Uso</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts de Rendimiento Unificados -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const navWrapper = document.getElementById("nav-wrapper");
            const topBar = document.getElementById("top-bar");
            if (!navWrapper || !topBar) return;

            let lastScrollY = window.scrollY;

            window.addEventListener("scroll", () => {
                const currentScrollY = window.scrollY;
                const topBarHeight = topBar.offsetHeight;

                if (currentScrollY > lastScrollY && currentScrollY > topBarHeight) {
                    // Scroll abajo: Ocultamos el top-bar desplazando el wrapper superior equitativamente
                    navWrapper.style.transform = `translateY(-${topBarHeight}px)`;
                    navWrapper.style.transition = "transform 0.3s ease-in-out";
                } else {
                    // Scroll arriba: Mostramos la barra verde de nuevo
                    navWrapper.style.transform = "translateY(0)";
                }
                
                lastScrollY = currentScrollY;
            }, { passive: true });
        });

        // Dropdown toggle function
        function toggleDropdown(button) {
            const dropdown = button.closest('.desktop-dropdown');
            const menu = dropdown.querySelector('.dropdown-menu');
            const arrow = button.querySelector('svg');
            
            // Close all other dropdowns
            document.querySelectorAll('.desktop-dropdown .dropdown-menu').forEach(el => {
                if (el !== menu) {
                    el.classList.add('hidden');
                    el.closest('.desktop-dropdown').querySelector('svg').style.transform = '';
                }
            });
            
            // Toggle current dropdown
            menu.classList.toggle('hidden');
            arrow.style.transform = menu.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.desktop-dropdown')) {
                document.querySelectorAll('.desktop-dropdown .dropdown-menu').forEach(el => {
                    el.classList.add('hidden');
                    el.closest('.desktop-dropdown').querySelector('svg').style.transform = '';
                });
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Mobile dropdown toggle
        function toggleMobileDropdown(button) {
            const dropdown = button.closest('.mobile-dropdown');
            const menu = dropdown.querySelector('.dropdown-menu');
            const arrow = button.querySelector('svg');

            // Close all other mobile dropdowns
            document.querySelectorAll('.mobile-dropdown .dropdown-menu').forEach(el => {
                if (el !== menu) {
                    el.classList.add('hidden');
                    el.closest('.mobile-dropdown').querySelector('svg').style.transform = '';
                }
            });

            // Toggle current dropdown
            menu.classList.toggle('hidden');
            arrow.style.transform = menu.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }
    </script>

    @yield('scripts')

    <!-- Toast Component Notification Layer -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50"></div>

    <!-- External Custom Assets logic -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>