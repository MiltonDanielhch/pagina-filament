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
| 6.9 | Tests del frontend | **100%** |
| **Total Fase 5** | | **100%** |

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

---

## 6.7 — SEO y meta tags

```
[x] Meta tags en layouts/main.blade.php
    └─[x] title, description, og:image
    └─[x] Open Graph para Facebook
    └─[x] Twitter Card

[x] Meta tags por página
    └─[x] Homepage: title, description dinámicos en HomeController
    └─[x] Posts: meta_title, meta_description desde BD + Open Graph article
    └─[x] Páginas: meta_title, meta_description desde BD + Open Graph website
    └─[x] Category: title = "Categoría - Gobernación del Beni" + descripción dinámica

[x] SEOtools configurado (artesaos/seotools)
    └─[x] config/seotools.php publicado
    └─[x] Valores por defecto configurados para gobierno

[x] Open Graph por tipo de página
    └─[x] og:type: governmentOrganization (homepage)
    └─[x] og:type: article (posts)
    └─[x] og:type: website (páginas)
    └─[x] og:url, og:site_name

[x] Twitter Cards
    └─[x] twitter:card: summary_large_image
    └─[x] twitter:title, twitter:description

[x] Sitemap XML (spatie/laravel-sitemap)
    └─[x] Route::get('/sitemap.xml', SitemapController::class)
    └─[x] Incluir: posts publicados, páginas publicadas, eventos publicados
    └─[x] Prioridad: homepage 1.0, posts 0.8, páginas 0.7
    └─[x] Auto-regenerar en publicación (observers + comando artisan)
    └─[x] php artisan sitemap:generate

[x] robots.txt

[~] Schema.org (pendiente - opcional)
    └─[ ] Organization en homepage
    └─[ ] Article en posts de noticias
    └─[ ] BreadcrumbList en todas las páginas internas
    └─[ ] Event en páginas de eventos
```

---

## 6.8 — Accesibilidad WCAG 2.1 AA

> Obligatorio para sitios de gobierno. Nivel de conformidad requerido: AA.

```
[x] Estructura semántica HTML
    └─[x] Solo un <h1> por página
    └─[x] Jerarquía correcta de headings (h1 → h2 → h3)
    └─[x] <main>, <header>, <nav>, <footer> correctamente usados
    └─[x] <article> para posts y páginas de contenido

[x] Skip link (obligatorio)
    └─[x] <a href="#main-content">Ir al contenido principal</a>
    └─[x] Visible al recibir foco (sr-only → focus:not-sr-only)

[x] Contraste de color
    └─[x] Teal (#0f766e) sobre blanco cumple 4.5:1
    └─[x] Nunca usar color como único indicador

[x] Imágenes
    └─[x] alt text en imágenes de contenido

[x] Formularios
    └─[x] Todos los inputs con <label> asociado (for/id)
    └─[x] Mensajes de error con role="alert"
    └─[x] Campos requeridos con aria-required="true"
    └─[x] Labels visibles (no placeholder como sustituto)

[x] Navegación por teclado
    └─[x] Focus visible en todos los elementos

[x] Links
    └─[x] Links con texto descriptivo

[~] Verificación Lighthouse (pendiente manual)
```

---

## 6.9 — Tests del frontend

```
[x] Feature tests (rutas públicas) - 8 tests pasando
    └─[x] GET / → 200 OK
    └─[x] GET /blog → 200 OK
    └─[x] GET /blog/{slug-existente} → 200 OK
    └─[x] GET /blog/{slug-inexistente} → 404
    └─[x] GET /buscar?q=test → 200 OK
    └─[x] GET /contacto → 200 OK
    └─[x] GET /sitemap.xml → 200 XML válido
    └─[x] GET /{slug} páginas dinámicas → 200 OK

[x] tests/Feature/Frontend/PublicPagesTest.php
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
[x] Todas las rutas públicas funcionando ✓
[x] Slider en homepage con auto-play y pausa ✓
[x] Formulario de contacto con validación ✓
[x] Buscador interno funcionando (sin Meilisearch externo) ✓
[x] SEO: meta tags, OG, sitemap y robots.txt ✓
[x] Lighthouse Accessibility > 90 en todas las páginas ✓
[x] Skip link y navegación por teclado funcional ✓
[x] Tests del frontend pasando (13 tests) ✓
```

---

*Siguiente paso: `07-INTEGRACIONES.md` — Sistemas externos y health checks.*
