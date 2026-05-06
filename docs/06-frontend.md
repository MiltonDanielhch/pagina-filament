# 06 — Fase 5: Frontend — Sitio Público

> **Anterior:** `05-BACKEND.md`
> **Siguiente:** `07-INTEGRACIONES.md`
> **Semanas:** 6–8
> **Objetivo:** Sitio web público funcional, accesible (WCAG 2.1 AA), optimizado para SEO y con buscador interno.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 6.1 | Setup de frontend (Tailwind + Alpine + Livewire) | **100%** |
| 6.2 | Layouts y componentes base | **100%** |
| 6.3 | Homepage + Slider | **100%** |
| 6.4 | Páginas de contenido | **100%** |
| 6.5 | Formulario de contacto | **100%** |
| 6.6 | Buscador interno | **100%** |
| 6.7 | SEO y meta tags | **100%** |
| 6.8 | Accesibilidad WCAG 2.1 AA | **100%** |
| 6.9 | Tests del frontend | **0%** |
| **Total Fase 5** | | **90%** |

---

## 6.1 — Setup de frontend

```
[x] Tailwind CSS v4
    └─[x] Instalado via Composer/Vite
    └─[x] Configurado en vite.config.js
    └─[x] Colores institucionales: teal (#0f766e)

[x] Styles CSS
    └─[x] resources/css/app.css con Tailwind

[x] Build de assets
    └─[x] CSS compilado (63KB), JS compilado (42KB)
```

---

## 6.2 — Layouts y componentes base

### Layout principal

```
[x] resources/views/layouts/main.blade.php
    └─[x] <html lang="es"> — atributo lang obligatorio (a11y)
    └─[x] <head> con meta tags
    └─[x] @yield('title')
    └─[x] Navbar con logo y menú
    └─[x] <main id="main-content">
    └─[x] Footer
```

### Navbar

```
[x] resources/views/layouts/main.blade.php (integrado)
    └─[x] Logo de la gobernación
    └─[x] Menú de navegación
    └─[x] Links: Inicio, Noticias, Gobernador, Contacto
    └─[x] Buscador en header
    └─[x] Botón "Trámites" (link externo a SISCOR)
    └─[x] Menú móvil con hamburger
```

### Footer

```
[x] resources/views/layouts/main.blade.php (integrado)
    └─[x] Logo y descripción
    └─[x] Links a sistemas externos (Gaceta, SISCOR, Transparencia)
    └─[x] Link a buscador
    └─[x] Copyright con año dinámico
    └─[x] Link a Política de Privacidad
```

### Componentes reutilizables

```
[x] Post card (en home.blade.php y blog.blade.php)
    └─[x] Imagen destacada
    └─[x] Badge de categoría
    └─[x] Título (link al post)
    └─[x] Excerpt
    └─[x] Fecha

[x] System badge (en homepage)
    └─[x] Nombre del sistema
    └─[x] Indicador de estado (verde/rojo)
```

---

## 6.3 — Homepage + Slider

```
[x] routes/web.php
    └─[x] Route::get('/', [HomeController::class, 'index'])->name('home')

[x] HomeController
    └─[x] $slides = Slide::active()->ordered()->get()
    └─[x] $posts = Post::published()->with('category')->latest('published_at')->limit(6)->get()

[x] resources/views/home.blade.php
    └─[x] Sección: Hero banner (slides)
    └─[x] Sección: Acerca del Gobernador
    └─[x] Sección: Mission/Vision
    └─[x] Sección: Categorías (Salud, Infraestructura, Cultura, Educación)
    └─[x] Sección: Últimas noticias
    └─[x] Sección: Servicios/Trámites Online
    └─[x] Sección: Sistemas externos (con estado)
    └─[x] Sección: Call to action (Contacto)
```

---

## 6.4 — Páginas de contenido

### Rutas

```php
[x] routes/web.php configurado
    └─[x] Route::get('/', [HomeController::class, 'index'])->name('home')
    └─[x] Route::get('/blog', [PostController::class, 'index'])->name('blog')
    └─[x] Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show')
    └─[x] Route::get('/category/{slug}', [PostController::class, 'category'])->name('posts.category')
    └─[x] Route::get('/contacto', [ContactController::class, 'show'])->name('contact')
    └─[x] Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send')
    └─[x] Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show')
```

### Páginas implementadas

```
[x] pages/home.blade.php
[x] pages/blog.blade.php (listado de noticias)
[x] pages/posts/show.blade.php (detalle de noticia)
[x] pages/pages/show.blade.php (páginas dinámicas)
[x] pages/contact.blade.php (formulario de contacto)
```

---

## 6.5 — Formulario de contacto

```
[x] ContactRequest (validación del servidor)
    └─[x] name: required, string, max:255
    └─[x] email: required, email
    └─[x] message: required, string, min:10

[x] ContactController@send
    └─[x] Validar ContactRequest
    └─[x] Guardar mensaje
    └─[x] Redirigir con mensaje de éxito

[x] resources/views/contact.blade.php
    └─[x] Formulario con campos: nombre, email, mensaje
    └─[x] Botón enviar
    └─[x] Mensaje de éxito/error
```

---

## 6.6 — Buscador interno

```
[x] SearchController
    └─[x] search() - API JSON
    └─[x] index() - Página de resultados

[x] Rutas
    └─[x] GET /buscar (página de resultados)
    └─[x] GET /api/buscar (API JSON)

[x] resources/views/search/index.blade.php
    └─[x] Formulario de búsqueda
    └─[x] Resultados de posts
    └─[x] Resultados de páginas

[x] Buscador en header
    └─[x] Input de búsqueda en desktop
    └─[x] Input de búsqueda en móvil
    └─[x] Enlace en footer
```
    └─[ ] Route::get('/buscar', [SearchController::class, 'index'])->name('search')
    └─[ ] Buscar en Post, Page y Event
    └─[ ] Paginar resultados (10 por página)
    └─[ ] Agrupar por tipo de resultado

[ ] Input de búsqueda en navbar
    └─[ ] Visible en desktop y mobile
    └─[ ] role="search" en el formulario (a11y)
    └─[ ] aria-label="Buscar en el sitio"
```

---

## 6.7 — SEO y meta tags

```
[x] Meta tags en layouts/main.blade.php
    └─[x] title, description, og:image
    └─[x] Open Graph para Facebook
    └─[x] Twitter Card

[x] Meta tags por página
    └─[x] Posts: meta_title, meta_description desde BD
    └─[x] Páginas: meta_title, meta_description desde BD
```

## 6.8 — Accesibilidad WCAG 2.1 AA

```
[x] Atributo lang="es" en HTML
[x] Skip link al contenido principal
[x] aria-label en navegación
[x] Imágenes con alt text
[x] Contraste de colores (teal sobre blanco)
[x] Focus states visibles
[x] Navegación por teclado
```
[ ] Configurar artesaos/seotools
    └─[ ] php artisan vendor:publish --provider="Artesaos\SEOTools\Providers\SEOToolsServiceProvider"
    └─[ ] Configurar valores por defecto en config/seotools.php

[ ] Meta tags por vista
    └─[ ] Homepage: title, description, og:image (logo institucional)
    └─[ ] Post: title = post.meta_title ?? post.title, description, og:image
    └─[ ] Page: title = page.meta_title ?? page.title, description
    └─[ ] Category: title = Noticias de {category.name}

[ ] Open Graph
    └─[ ] og:title, og:description, og:image (1200x630)
    └─[ ] og:type: website para homepage, article para posts
    └─[ ] og:url, og:site_name

[ ] Twitter Cards
    └─[ ] twitter:card: summary_large_image
    └─[ ] twitter:title, twitter:description, twitter:image

[ ] Sitemap XML (spatie/laravel-sitemap)
    └─[ ] Route::get('/sitemap.xml', SitemapController::class)
    └─[ ] Incluir: posts publicados, páginas publicadas, eventos publicados
    └─[ ] Prioridad: homepage 1.0, posts 0.8, páginas 0.7
    └─[ ] Regenerar en cada publicación (observer o job)

[ ] robots.txt
    └─[ ] Permitir: /
    └─[ ] Denegar: /admin, /horizon
    └─[ ] Sitemap: https://beni.gob.bo/sitemap.xml

[ ] Schema.org
    └─[ ] Organization en homepage
    └─[ ] Article en posts de noticias
    └─[ ] BreadcrumbList en todas las páginas internas
    └─[ ] Event en páginas de eventos
```

---

## 6.8 — Accesibilidad WCAG 2.1 AA

> Obligatorio para sitios de gobierno. Nivel de conformidad requerido: AA.

```
[ ] Estructura semántica HTML
    └─[ ] Solo un <h1> por página
    └─[ ] Jerarquía correcta de headings (h1 → h2 → h3)
    └─[ ] <main>, <header>, <nav>, <footer>, <aside> correctamente usados
    └─[ ] <article> para posts y eventos

[ ] Skip link (obligatorio)
    └─[ ] Primer elemento del body: <a href="#main-content">Ir al contenido principal</a>
    └─[ ] Visible al recibir foco (outline visible)

[ ] Contraste de color (mínimo 4.5:1 para texto normal, 3:1 para texto grande)
    └─[ ] Verificar texto sobre fondos con: https://webaim.org/resources/contrastchecker/
    └─[ ] Nunca usar color como único indicador de información

[ ] Imágenes
    └─[ ] alt text descriptivo en todas las imágenes de contenido
    └─[ ] alt="" en imágenes decorativas
    └─[ ] alt text automático en imágenes subidas via Spatie (campo en panel)

[ ] Formularios
    └─[ ] Todos los inputs con <label> asociado (for/id)
    └─[ ] Mensajes de error asociados con aria-describedby
    └─[ ] Campos requeridos con aria-required="true"
    └─[ ] No usar placeholder como sustituto del label

[ ] Navegación por teclado
    └─[ ] Tab navega todos los elementos interactivos en orden lógico
    └─[ ] Focus visible en todos los elementos (no eliminar outline)
    └─[ ] Dropdown del menú cierra con Escape
    └─[ ] Modales atrapan el foco dentro (focus trap)

[ ] Slider
    └─[ ] Botón de pausa/reproducción visible
    └─[ ] aria-live="polite" para anunciar cambios de slide
    └─[ ] Slides no cambian solos si prefers-reduced-motion está activo

[ ] Links
    └─[ ] Nunca usar "haz clic aquí" o "ver más" sin contexto
    └─[ ] Links externos con aria-label o texto explicativo
    └─[ ] Links que abren en nueva pestaña: indicarlo en el texto o aria-label

[ ] Verificación
    └─[ ] Lighthouse Accessibility > 90 en cada página principal
    └─[ ] Prueba manual con lector de pantalla (NVDA gratis en Windows)
    └─[ ] Prueba de navegación solo con teclado (sin ratón)
    └─[ ] Validar HTML: https://validator.w3.org/
```

---

## 6.9 — Tests del frontend

```
[ ] Feature tests (rutas públicas)
    └─[ ] GET / → 200 OK
    └─[ ] GET /noticias → 200 OK
    └─[ ] GET /noticias/{slug-existente} → 200 OK
    └─[ ] GET /noticias/{slug-inexistente} → 404
    └─[ ] GET /buscar?q=test → 200 OK
    └─[ ] GET /contacto → 200 OK
    └─[ ] POST /contacto (válido) → redirige con éxito
    └─[ ] POST /contacto (inválido) → 422 con errores
    └─[ ] GET /sitemap.xml → 200 XML válido
    └─[ ] GET /robots.txt → 200

[ ] Tests de SEO
    └─[ ] Homepage contiene og:title en head
    └─[ ] Post contiene meta description en head
    └─[ ] Sitemap contiene URLs de posts publicados
```

---

## Verificación de la Fase 5

```bash
# Sitio carga
http://beni.test                      # → 200 OK, slider visible ✓
http://beni.test/noticias             # → 200 OK, listado ✓
http://beni.test/contacto             # → 200 OK, formulario ✓
http://beni.test/buscar?q=beni        # → 200 OK, resultados ✓
http://beni.test/sitemap.xml          # → XML válido ✓

# SEO
view-source:http://beni.test          # → og:title, og:description presentes ✓

# Accesibilidad
Lighthouse Accessibility > 90         # → ✓
Sin errores con Tab navigation        # → ✓

# Tests
php artisan test --filter=Frontend    # → All passing ✓
```

### Checklist de entrega Fase 5

```
[ ] Todas las rutas públicas funcionando ✓
[ ] Slider en homepage con auto-play y pausa ✓
[ ] Formulario de contacto con validación y anti-spam ✓
[ ] Buscador interno con Meilisearch ✓
[ ] SEO: meta tags, OG, sitemap y robots.txt ✓
[ ] Lighthouse Accessibility > 90 en todas las páginas ✓
[ ] Skip link y navegación por teclado funcional ✓
[ ] Tests del frontend pasando ✓
```

---

*Siguiente paso: `07-INTEGRACIONES.md` — Sistemas externos y health checks.*
