@php
    $currentUrl = request()->path() ?: '/';
    function isMenuItemActive($item, $currentUrl): bool {
        if ($item->children->count() > 0) {
            return $item->children->contains(fn($child) => (trim($child->url, '/') ?: '/') === $currentUrl);
        }
        return (trim($item->url, '/') ?: '/') === $currentUrl;
    }
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Gobernación Autónoma Departamental del Beni' }}</title>

    <!-- Google Fonts: Public Sans (preconnect para reducir latencia) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

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

    <style>
        [x-cloak] { display: none !important; }
    </style>

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
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-[100] focus:bg-[#fcd400] focus:text-gray-900 focus:px-4 focus:py-2 focus:rounded-br font-bold shadow">
        Ir al contenido principal
    </a>

    <!-- Scroll progress bar -->
    <div id="scroll-progress" aria-hidden="true"></div>

    <!-- Contenedor Padre Sticky global -->
    <div class="sticky top-0 z-50 w-full flex flex-col" id="nav-wrapper">

        <!-- Gold accent line at very top (Civic Excellence) -->
        <div class="h-1 w-full bg-gradient-to-r from-[#004900] via-[#705d00] to-[#004900] flex-shrink-0"></div>

        <!-- Top Bar -->
        <div id="top-bar" class="bg-[#004900] text-white text-sm py-2 transition-all duration-300 ease-in-out">
            <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-2">
                <div class="flex items-center justify-center md:justify-start flex-wrap gap-x-4 gap-y-1 text-xs sm:text-sm font-medium">
                    <span class="text-[#fcd400] font-semibold">Horario:</span>
                    <span class="flex items-center gap-1">🕐 Lun - Vie 8:00 - 16:00</span>
                    <!-- <span class="text-[#fcd400] font-semibold">Contacto:</span> -->
                    <!-- <span class="flex items-center gap-1">📍 Plaza José Ballivián N° 1</span>
                    <span class="flex items-center gap-1">📧 despacho@beni.gob.bo</span> -->
                </div>

                <div class="flex items-center justify-center md:justify-end gap-2 w-full md:w-auto">
                    <span class="text-[#fcd400] font-semibold text-xs sm:text-sm">Redes Sociales:</span>
                    <!-- Redes Sociales -->
                    <div class="flex items-center gap-2">
                        <a href="https://www.facebook.com/profile.php?id=61589790584981" target="_blank" rel="noopener noreferrer" class="hover:text-amber-200 transition p-1" aria-label="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.637H7.078v-3.497h3.047V9.603c0-3.014 1.825-4.679 4.532-4.679 1.313 0 2.703.235 2.703.235v2.965h-1.524c-1.501 0-1.973.934-1.973 1.893v2.27h3.328l-.527 3.497h-2.801v8.637C19.613 23.027 24 17.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="hover:text-amber-200 transition p-1" aria-label="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer" class="hover:text-amber-200 transition p-1" aria-label="TikTok">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.51 1.32-.33 2.91.67 3.99.95 1.09 2.53 1.45 3.88.92 1.13-.45 1.93-1.58 2.03-2.8.05-1.36.02-2.73.02-4.1.01-3.17-.01-6.33.02-9.5z"/></svg>
                        </a>
                        <a href="https://x.com/" target="_blank" rel="noopener noreferrer" class="hover:text-amber-200 transition p-1" aria-label="X (Twitter)">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://youtube.com/" target="_blank" rel="noopener noreferrer" class="hover:text-amber-200 transition p-1" aria-label="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
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
                    @if($headerMenu && $headerMenu->is_active && $headerMenu->items)
                    <div id="desktop-menu" class="hidden md:flex items-center gap-1 transition-all duration-300">
                        @foreach($headerMenu->items->where('parent_id', null) as $item)
                            @if($item->children->count() > 0)
                                @php $isActive = isMenuItemActive($item, $currentUrl); @endphp
                                <div class="relative desktop-dropdown">
                                    <button onclick="toggleDropdown(this)" class="dropdown-trigger relative px-3 py-2 rounded text-gray-700 hover:text-[#004900] transition font-medium flex items-center gap-1 after:absolute after:bottom-0 after:left-0 after:w-full after:h-[3px] after:bg-[#E5B225] after:rounded-full after:transition-transform after:duration-300 after:origin-left {{ $isActive ? 'after:scale-x-100 text-[#004900]' : 'after:scale-x-0' }} hover:after:scale-x-100">
                                        {{ $item->label }}
                                        <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu hidden absolute right-0 mt-2 min-w-[16rem] bg-white rounded shadow-xl border border-gray-100 py-1 z-50">
                                        @foreach($item->children as $child)
                                            <a href="{{ $child->page_id ? route('pages.show', $child->page->slug) : $child->url }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#004900] hover:text-white transition">
                                                {{ $child->label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                @php $isActive = isMenuItemActive($item, $currentUrl); @endphp
                                <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}" class="relative px-3 py-2 rounded text-gray-700 hover:text-[#004900] transition font-medium after:absolute after:bottom-0 after:left-0 after:w-full after:h-[3px] after:bg-[#E5B225] after:rounded-full after:transition-transform after:duration-300 after:origin-left {{ $isActive ? 'after:scale-x-100 text-[#004900]' : 'after:scale-x-0' }} hover:after:scale-x-100">
                                    {{ $item->label }}
                                </a>
                            @endif
                        @endforeach

                        <!-- Buscador con Autocomplete -->
                        <div class="relative" x-data="searchAutocomplete()" @click.away="resultsOpen = false" style="display: block; flex-shrink: 0;">
                            <form action="{{ route('search') }}" method="GET" style="display: block; margin: 0; padding: 0;" @submit.prevent="submitSearch()">
                                <div class="relative flex items-center" style="display: flex; flex-direction: row; align-items: center;">
                                    <input
                                        x-ref="searchInput"
                                        type="text"
                                        name="q"
                                        x-model="query"
                                        @input.debounce.300ms="search()"
                                        @focus="if (results.length) resultsOpen = true"
                                        @keydown.escape="resultsOpen = false"
                                        @keydown.down.prevent="$focus.wrap().next()"
                                        @keydown.up.prevent="$focus.wrap().previous()"
                                        placeholder="Buscar..."
                                        autocomplete="off"
                                        class="w-40 lg:w-48 py-2 pl-4 pr-10 text-sm bg-[#f3f4f6] text-gray-700 placeholder:text-[#6b7280] rounded-full border-0 focus:outline-none focus:ring-2 focus:ring-[#004900]/20 focus:bg-white transition-all duration-200"
                                        style="display: block; width: 10rem; font-size: 0.875rem; line-height: 1.25rem; border: none; box-shadow: none;"
                                    >
                                    <button type="submit" class="absolute right-0 flex items-center justify-center w-10 h-full text-gray-400 hover:text-[#004900] transition-colors" style="display: flex; align-items: center; justify-content: center; background: none; border: none; cursor: pointer;">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block; width: 1rem; height: 1rem;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>

                            <!-- Dropdown de resultados -->
                            <div x-show="resultsOpen && results.length" x-cloak
                                class="absolute right-0 mt-2 w-96 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50"
                                style="max-height: 80vh; overflow-y: auto;">
                                <template x-for="(group, key) in results" :key="key">
                                    <div x-show="group.items.length > 0">
                                        <div class="px-4 py-2 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100"
                                            x-text="group.label">
                                        </div>
                                        <template x-for="item in group.items.slice(0, 5)" :key="item.id + '-' + key">
                                            <a :href="item.url" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 transition"
                                               @click="resultsOpen = false">
                                                <div class="text-sm font-medium text-gray-800" x-html="item.title"></div>
                                                <div class="text-xs text-gray-500 mt-0.5 line-clamp-1" x-html="item.excerpt" x-show="item.excerpt"></div>
                                            </a>
                                        </template>
                                        <a :href="'{{ route('search') }}?q=' + encodeURIComponent(query) + '&type=' + key"
                                           class="block px-4 py-2 text-xs font-semibold text-[#004900] hover:bg-gray-50 text-center"
                                           @click="resultsOpen = false">
                                            Ver todos en <span x-text="group.label.toLowerCase()"></span>
                                        </a>
                                    </div>
                                </template>
                                <a :href="'{{ route('search') }}?q=' + encodeURIComponent(query)"
                                   class="block px-4 py-3 bg-gray-50 text-sm font-semibold text-[#004900] hover:bg-gray-100 text-center border-t border-gray-200"
                                   @click="resultsOpen = false">
                                    Ver todos los resultados →
                                </a>
                            </div>

                            <!-- Sin resultados -->
                            <div x-show="resultsOpen && searched && !results.some(g => g.items.length > 0)" x-cloak
                                class="absolute right-0 mt-2 w-96 bg-white rounded-xl shadow-2xl border border-gray-100 p-6 text-center z-50">
                                <p class="text-gray-500 text-sm">No se encontraron resultados para <strong x-text="query"></strong></p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Botón móvil -->
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600" aria-label="Abrir menú">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </nav>

            <!-- Menú móvil -->
            @if($headerMenu && $headerMenu->is_active && $headerMenu->items)
            <div id="mobile-menu" class="md:hidden bg-white border-t border-gray-200">
                <nav class="container mx-auto px-4 py-3">
                    <!-- Buscador móvil -->
                    <div class="mb-3 px-3" x-data="searchAutocomplete()" @click.away="resultsOpen = false">
                        <form action="{{ route('search') }}" method="GET" @submit.prevent="submitSearch()">
                            <div class="relative flex items-center">
                                <input
                                    type="text"
                                    name="q"
                                    x-model="query"
                                    @input.debounce.300ms="search()"
                                    @focus="if (results.length) resultsOpen = true"
                                    autocomplete="off"
                                    placeholder="Buscar..."
                                    class="w-full py-2.5 pl-4 pr-10 text-sm bg-[#f3f4f6] text-gray-700 placeholder:text-[#6b7280] rounded-full border-0 focus:outline-none focus:ring-2 focus:ring-[#004900]/20 focus:bg-white transition-all duration-200"
                                >
                                <button type="submit" class="absolute right-0 flex items-center justify-center w-10 h-full text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <!-- Mobile results dropdown -->
                        <div x-show="resultsOpen && results.some(g => g.items.length > 0)" x-cloak
                            class="mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden"
                            style="max-height: 60vh; overflow-y: auto;">
                            <template x-for="(group, key) in results" :key="key">
                                <div x-show="group.items.length > 0">
                                    <div class="px-4 py-2 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-100" x-text="group.label"></div>
                                    <template x-for="item in group.items.slice(0, 3)" :key="item.id + '-' + key">
                                        <a :href="item.url" class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 transition" @click="resultsOpen = false">
                                            <div class="text-sm font-medium text-gray-800" x-html="item.title"></div>
                                            <div class="text-xs text-gray-500 mt-0.5 line-clamp-1" x-html="item.excerpt" x-show="item.excerpt"></div>
                                        </a>
                                    </template>
                                </div>
                            </template>
                            <a :href="'{{ route('search') }}?q=' + encodeURIComponent(query)"
                               class="block px-4 py-3 bg-gray-50 text-sm font-semibold text-[#004900] hover:bg-gray-100 text-center"
                               @click="resultsOpen = false">
                                Ver todos los resultados →
                            </a>
                        </div>
                    </div>
                    @foreach($headerMenu->items->where('parent_id', null) as $item)
                        @if($item->children->count() > 0)
                            @php $isActive = isMenuItemActive($item, $currentUrl); @endphp
                            <div class="mobile-dropdown">
                                <button onclick="toggleMobileDropdown(this)" class="dropdown-trigger w-full flex items-center justify-between px-3 py-3 text-gray-700 transition font-medium {{ $isActive ? 'text-[#004900] bg-[#f3f4f5] border-l-4 border-[#E5B225]' : 'hover:bg-[#f3f4f5]' }}">
                                    {{ $item->label }}
                                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="dropdown-menu hidden pl-4 pb-2">
                                    @foreach($item->children as $child)
                                        <a href="{{ $child->page_id ? route('pages.show', $child->page->slug) : $child->url }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-[#f3f4f5] hover:text-[#004900] transition">
                                            {{ $child->label }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            @php $isActive = isMenuItemActive($item, $currentUrl); @endphp
                            <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}" class="block px-3 py-3 text-gray-700 transition font-medium {{ $isActive ? 'text-[#004900] bg-[#f3f4f5] border-l-4 border-[#E5B225]' : 'hover:bg-[#f3f4f5]' }}">
                                {{ $item->label }}
                            </a>
                        @endif
                    @endforeach
                </nav>
            </div>
            @endif
        </header>
    </div>

    <!-- Main Dynamic View Content -->
    <main id="main-content" class="flex-grow focus:outline-none">
        @yield('content')
    </main>

    <!-- Footer Corporativo -->
    <footer class="bg-[#0a3118] text-gray-300 mt-auto border-t-4 border-[#705d00] bg-nature-pattern" style="display: block; width: 100%;">
        <div class="container mx-auto px-4 pt-12 pb-6 w-full" style="display: block; width: 100%;">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left items-start w-full" style="display: grid; width: 100%;">

                <!-- Columna 1: Identificación Institucional -->
                <div class="space-y-4 w-full" style="display: block; width: 100%;">
                    <div class="flex flex-col md:flex-row items-center gap-3">
                        <div class="w-14 h-14 rounded overflow-hidden bg-white p-1 flex items-center justify-center shadow-md flex-shrink-0">
                            <img src="{{ $logoSrc }}" alt="Gobernación del Beni" class="w-full h-full object-contain" style="display: block;">
                        </div>
                        <div>
                            <h3 class="text-md font-bold text-white leading-tight">Gobernación<br><span class="text-[#E5B225] text-sm font-medium">del Beni</span></h3>
                            <p class="text-[10px] text-[#82db6f] tracking-wider uppercase">Autónoma Departamental</p>
                        </div>
                    </div>
                    <p class="text-base text-gray-300 leading-relaxed">
                        Impulsando el desarrollo sostenible de la Amazonia Boliviana a través de la gestión transparente y participativa.
                    </p>
                </div>

                <!-- Columna 2: Enlaces Institucionales -->
                <div class="space-y-4 w-full" style="display: block; width: 100%;">
                    <h4 class="text-sm font-bold text-[#E5B225] uppercase tracking-widest border-b border-[#004900] pb-2">Enlaces Institucionales</h4>
                    @if($footerMenu && $footerMenu->items && $footerMenu->items->count() > 0)
                    <ul class="space-y-3 text-base">
                        @foreach($footerMenu->items->sortBy('order') as $item)
                        <li>
                            <a href="{{ $item->page_id ? route('pages.show', $item->page->slug) : $item->url }}"
                               target="{{ $item->target ?? '_self' }}"
                               class="text-gray-300 hover:text-white transition-colors inline-flex items-center gap-2 group font-medium">
                                <svg class="w-3.5 h-3.5 text-[#E5B225] flex-shrink-0 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                                {{ $item->label }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

                <!-- Columna 3: Información de Contacto -->
                <div class="space-y-4 w-full" style="display: block; width: 100%;">
                    <h4 class="text-sm font-bold text-[#E5B225] uppercase tracking-widest border-b border-[#004900] pb-2">Información de Contacto</h4>
                    <ul class="space-y-4 text-base">
                        <li class="flex items-center justify-center md:justify-start gap-3">
                            <svg class="w-5 h-5 text-[#82db6f] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            <div>
                                <span class="text-white font-medium">Plaza José Ballivián N° 1</span><br>
                                <span class="text-gray-400 text-sm">Trinidad, Beni - Bolivia</span>
                            </div>
                        </li>
                        <li class="flex items-center justify-center md:justify-start gap-3">
                            <svg class="w-5 h-5 text-[#82db6f] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <a href="mailto:despacho@beni.gob.bo" class="text-white hover:text-[#E5B225] transition font-medium">despacho@beni.gob.bo</a>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Copyright -->
            <div class="border-t border-[#004900] pt-6 mt-8 flex flex-col md:flex-row justify-between items-center gap-2 text-xs text-white/60 w-full" style="display: flex; width: 100%;">
                <p>&copy; {{ date('Y') }} Gobernación Autónoma Departamental del Beni. Todos los derechos reservados.</p>
                <div class="flex items-center gap-4">
                    <a href="/politica-de-privacidad" class="block hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/logo.webp') }}" alt="Política de Privacidad" class="w-6 h-6">
                    </a>
                    <a href="/terminos-de-uso" class="block hover:opacity-80 transition-opacity">
                        <img src="{{ asset('images/bandera.avif') }}" alt="Términos de Uso" class="w-6 h-6">
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts de Rendimiento Unificados -->
    <script>
        // Scroll progress bar
        (function() {
            const bar = document.getElementById('scroll-progress');
            if (!bar) return;
            window.addEventListener('scroll', () => {
                const scrolled = window.scrollY;
                const max = document.documentElement.scrollHeight - window.innerHeight;
                bar.style.width = max > 0 ? (scrolled / max * 100) + '%' : '0%';
            }, { passive: true });
        })();

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

        // Mobile menu toggle with animation
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                const isOpen = mobileMenu.classList.toggle('open');
                mobileMenuBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                // Animate hamburger to X
                const paths = mobileMenuBtn.querySelectorAll('path');
                if (paths.length) {
                    if (isOpen) {
                        paths[0].setAttribute('d', 'M6 18L18 6M6 6l12 12');
                    } else {
                        paths[0].setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
                    }
                }
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

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchAutocomplete', () => ({
                query: '',
                results: [],
                resultsOpen: false,
                searched: false,

                async search() {
                    if (this.query.length < 3) {
                        this.results = [];
                        this.resultsOpen = false;
                        this.searched = false;
                        return;
                    }

                    try {
                        const res = await fetch(`/api/buscar?q=${encodeURIComponent(this.query)}`);
                        const data = await res.json();

                        this.results = [
                            { label: 'Noticias', key: 'posts', items: this.mapPosts(data.posts || []) },
                            { label: 'Páginas', key: 'pages', items: this.mapPages(data.pages || []) },
                            { label: 'Trámites', key: 'procedures', items: this.mapProcedures(data.procedures || []) },
                            { label: 'Eventos', key: 'events', items: this.mapSimple(data.events || []) },
                            { label: 'Convocatorias', key: 'announcements', items: this.mapSimple(data.announcements || []) },
                            { label: 'Autoridades', key: 'officials', items: this.mapOfficials(data.officials || []) },
                            { label: 'Proyectos', key: 'projects', items: this.mapSimple(data.projects || []) },
                            { label: 'Datos Abiertos', key: 'datasets', items: this.mapSimple(data.datasets || []) },
                            { label: 'Agenda', key: 'agenda', items: this.mapSimple(data.agenda || []) },
                            { label: 'Sistemas', key: 'systems', items: this.mapSystems(data.systems || []) },
                        ];

                        this.resultsOpen = true;
                        this.searched = true;
                    } catch (e) {
                        console.error('Search error:', e);
                    }
                },

                mapPosts(posts) {
                    return posts.map(p => ({
                        id: p.id,
                        title: this.highlight(p.title),
                        excerpt: this.highlight(p.excerpt ? p.excerpt.substring(0, 100) : ''),
                        url: `/blog/${p.slug}`
                    }));
                },

                mapPages(pages) {
                    return pages.map(p => ({
                        id: p.id,
                        title: this.highlight(p.title),
                        excerpt: '',
                        url: p.slug ? `/institucional/${p.slug}` : '#'
                    }));
                },

                mapProcedures(procedures) {
                    return procedures.map(p => ({
                        id: p.id,
                        title: this.highlight(p.name),
                        excerpt: this.highlight(p.description ? p.description.substring(0, 100) : ''),
                        url: p.slug ? `/tramites/${p.slug}` : '#'
                    }));
                },

                mapSimple(items) {
                    return items.map(i => ({
                        id: i.id,
                        title: this.highlight(i.title || i.name),
                        excerpt: this.highlight((i.description || i.excerpt || '').substring(0, 100)),
                        url: i.url || (i.slug ? `#` : '#')
                    }));
                },

                mapOfficials(officials) {
                    return officials.map(o => ({
                        id: o.id,
                        title: this.highlight(o.name),
                        excerpt: this.highlight(o.position),
                        url: '/institucional/autoridades'
                    }));
                },

                mapSystems(systems) {
                    return systems.map(s => ({
                        id: s.id,
                        title: this.highlight(s.name),
                        excerpt: this.highlight(s.description ? s.description.substring(0, 100) : ''),
                        url: s.url
                    }));
                },

                highlight(text) {
                    if (!text) return '';
                    const q = this.query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                    return text.replace(new RegExp(`(${q})`, 'gi'), '<mark class="bg-yellow-200 text-gray-900 rounded px-0.5">$1</mark>');
                },

                submitSearch() {
                    if (this.query.length >= 3) {
                        window.location.href = `{{ route('search') }}?q=${encodeURIComponent(this.query)}`;
                    }
                }
            }));
        });
    </script>
</body>
</html>
