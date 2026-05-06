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
| **Total Fase 5** | | **85%** |

---

## 6.1 — Setup de frontend

```
[ ] Tailwind CSS
    └─[ ] npm install -D tailwindcss@latest postcss autoprefixer
    └─[ ] npx tailwindcss init -p
    └─[ ] Configurar content paths en tailwind.config.js:
          content: ['./resources/**/*.blade.php', './resources/**/*.js']
    └─[ ] Configurar colores institucionales del Beni en theme.extend

[ ] Alpine.js
    └─[ ] npm install alpinejs
    └─[ ] Importar en resources/js/app.js
    └─[ ] Disponible globalmente: window.Alpine

[ ] Livewire 3
    └─[ ] composer require livewire/livewire
    └─[ ] @livewireStyles en <head>
    └─[ ] @livewireScripts antes de </body>

[ ] Swiper.js (para el slider)
    └─[ ] npm install swiper
    └─[ ] Importar CSS y JS en app.js / app.css

[ ] Colores institucionales (tailwind.config.js)
    └─[ ] primary: color institucional de la Gobernación del Beni
    └─[ ] secondary: color de apoyo
    └─[ ] Fuente principal: (elegir fuente institucional)
```

---

## 6.2 — Layouts y componentes base

### Layout principal

```
[ ] resources/views/layouts/app.blade.php
    └─[ ] <html lang="es"> — atributo lang obligatorio (a11y)
    └─[ ] <head> con slots para meta tags
    └─[ ] @yield('title') o @stack('title')
    └─[ ] Skip link al contenido principal (accesibilidad)
    └─[ ] Incluir CSS y JS compilado (Vite)
    └─[ ] Navbar
    └─[ ] <main id="main-content" tabindex="-1">
    └─[ ] Footer
    └─[ ] @livewireScripts
```

### Navbar

```
[ ] resources/views/components/navbar.blade.php
    └─[ ] Logo de la gobernación con alt text descriptivo
    └─[ ] Menú dinámico desde DB (Model: Menu con location='header')
    └─[ ] Soporte para submenús (dropdown)
    └─[ ] Hamburger para móvil (Alpine.js x-show)
    └─[ ] Navegación por teclado: Tab, Enter, Escape
    └─[ ] aria-expanded en hamburger
    └─[ ] aria-label="Menú principal" en <nav>
    └─[ ] Link de acceso directo al panel admin (solo si autenticado)
```

### Footer

```
[ ] resources/views/components/footer.blade.php
    └─[ ] Logo y descripción breve
    └─[ ] Menú footer desde DB (location='footer')
    └─[ ] Links a sistemas externos
    └─[ ] Redes sociales desde SiteSetting
    └─[ ] Información de contacto desde SiteSetting
    └─[ ] Copyright con año dinámico
    └─[ ] Links: Política de Privacidad, Contacto
```

### Componentes reutilizables

```
[ ] components/post-card.blade.php
    └─[ ] Imagen destacada (lazy loading, alt text del post)
    └─[ ] Badge de categoría
    └─[ ] Título (link al post)
    └─[ ] Excerpt (resumen)
    └─[ ] Fecha y autor
    └─[ ] Variantes: card-large (featured) y card-small

[ ] components/event-card.blade.php
    └─[ ] Fecha y hora del evento
    └─[ ] Título y lugar
    └─[ ] Link al detalle

[ ] components/system-badge.blade.php
    └─[ ] Nombre del sistema externo
    └─[ ] Ícono
    └─[ ] Indicador de estado (disponible/caído)
    └─[ ] Link a la URL del sistema

[ ] components/breadcrumb.blade.php
    └─[ ] Schema.org BreadcrumbList
    └─[ ] aria-label="Ruta de navegación"

[ ] components/pagination.blade.php
    └─[ ] Usar paginación de Tailwind de Laravel
    └─[ ] aria-label en botones de página
```

---

## 6.3 — Homepage + Slider

```
[ ] routes/web.php
    └─[ ] Route::get('/', [HomeController::class, 'index'])->name('home')

[ ] HomeController
    └─[ ] $slides = Slide::active()->ordered()->get()
    └─[ ] $latestPosts = Post::published()->with('category')->latest('published_at')->limit(6)->get()
    └─[ ] $featuredEvents = Event::published()->upcoming()->featured()->limit(3)->get()
    └─[ ] Cachear por 15 minutos

[ ] resources/views/pages/home.blade.php
    └─[ ] Sección: Hero con Slider
    └─[ ] Sección: Últimas noticias (grid de 6 posts)
    └─[ ] Sección: Eventos próximos
    └─[ ] Sección: Links a sistemas externos (con badges de estado)
    └─[ ] Sección: Call to action (Contacto)

[ ] Slider (Swiper.js)
    └─[ ] Auto-play cada 5 segundos
    └─[ ] Pausar al hacer hover
    └─[ ] Flechas de navegación
    └─[ ] Dots de posición
    └─[ ] Lazy loading de imágenes
    └─[ ] aria-label en cada slide
    └─[ ] Botón "Pausar animación" (accesibilidad — WCAG 2.1 AA)
```

---

## 6.4 — Páginas de contenido

### Rutas

```php
// routes/web.php
Route::get('/noticias', [PostController::class, 'index'])->name('posts.index');
Route::get('/noticias/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/noticias/categoria/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/eventos', [EventController::class, 'index'])->name('events.index');
Route::get('/eventos/{slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show'); // Último
```

### Páginas requeridas

```
[ ] pages/noticias/index.blade.php
    └─[ ] Listado paginado de posts (12 por página)
    └─[ ] Filtros por categoría (links con state activo)
    └─[ ] Buscador en la página

[ ] pages/noticias/show.blade.php
    └─[ ] Imagen destacada con alt text
    └─[ ] Título (H1), categoría, fecha, autor
    └─[ ] Breadcrumb
    └─[ ] Contenido del post (HTML del editor)
    └─[ ] Posts relacionados (misma categoría, 3 posts)
    └─[ ] Compartir en redes sociales

[ ] pages/eventos/index.blade.php
    └─[ ] Grid de eventos con filtro próximos/pasados

[ ] pages/eventos/show.blade.php
    └─[ ] Detalle del evento con galería de imágenes
    └─[ ] Mapa o ubicación (si disponible)

[ ] pages/contacto.blade.php
    └─[ ] Formulario de contacto
    └─[ ] Información de contacto desde SiteSetting

[ ] pages/dinamica.blade.php (para Pages del modelo)
    └─[ ] Renderiza el body HTML de la página
    └─[ ] Breadcrumb
    └─[ ] Meta tags desde el modelo

[ ] pages/404.blade.php
    └─[ ] Página de error amigable
    └─[ ] Link a homepage y buscador
```

---

## 6.5 — Formulario de contacto
no 
```
[ ] ContactRequest (validación del servidor)
    └─[ ] name: required, string, max:255
    └─[ ] email: required, email
    └─[ ] subject: required, string, max:255
    └─[ ] message: required, string, min:20, max:2000
    └─[ ] honeypot: campo oculto, debe estar vacío

[ ] ContactController@send
    └─[ ] Validar ContactRequest
    └─[ ] Verificar honeypot (si tiene valor → silenciosamente ignorar)
    └─[ ] Guardar mensaje en BD (tabla: contact_messages)
    └─[ ] Despachar job: SendContactNotification
    └─[ ] Redirigir con mensaje de éxito

[ ] Migración: contact_messages
    └─[ ] name, email, subject, message, ip, timestamps

[ ] Mailable: ContactNotification
    └─[ ] Enviar al email institucional de contacto
    └─[ ] Incluir todos los datos del formulario
    └─[ ] Reply-To: email del remitente

[ ] Mailable: ContactAutoReply
    └─[ ] Respuesta automática al ciudadano
    └─[ ] Confirma que el mensaje fue recibido
    └─[ ] Indica tiempo estimado de respuesta

[ ] Rate limiting
    └─[ ] Máximo 3 mensajes por IP por hora
    └─[ ] Usar throttle middleware en la ruta POST

[ ] Livewire component (opcional — para validación en tiempo real)
    └─[ ] Validación mientras el usuario escribe
    └─[ ] Mensajes de error inline
    └─[ ] Estado de carga al enviar
```

---

## 6.6 — Buscador interno

```
[ ] Instalar Laravel Scout
    └─[ ] composer require laravel/scout
    └─[ ] php artisan vendor:publish --provider="Laravel\Scout\ScoutServiceProvider"

[ ] Instalar Meilisearch
    └─[ ] En desarrollo: docker run meilisearch (o binario local)
    └─[ ] En producción: instancia Meilisearch en Coolify
    └─[ ] composer require meilisearch/meilisearch-php http-interop/http-factory-guzzle

[ ] Configurar Scout
    └─[ ] SCOUT_DRIVER=meilisearch en .env
    └─[ ] MEILISEARCH_HOST=http://localhost:7700
    └─[ ] MEILISEARCH_KEY=tu_clave_maestra

[ ] Agregar Searchable a modelos
    └─[ ] Post: use Searchable — indexar title, excerpt, body, category
    └─[ ] Page: use Searchable — indexar title, body
    └─[ ] Event: use Searchable — indexar title, description, location

[ ] Indexar registros existentes
    └─[ ] php artisan scout:import "App\Models\Post"
    └─[ ] php artisan scout:import "App\Models\Page"
    └─[ ] php artisan scout:import "App\Models\Event"

[ ] SearchController
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
