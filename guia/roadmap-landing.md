# Roadmap — Landing Page (beni.gob.bo público)

> **Stack:** Laravel Blade · Tailwind v4 · Livewire · Alpine.js
> 
> **Pre-requisitos:**
> - Fase 3 completada (Modelos y Migraciones)
> - Fase 4 parcialmente completada (recursos Filament)

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| L.1 | Setup Frontend (+ Blade + Tailwind) | **0%** |
| L.2 | Layouts y componentes base | **0%** |
| L.3 | Homepage + Slider | **0%** |
| L.4 | Páginas de contenido | **0%** |
| L.5 | Formulario de contacto | **0%** |
| L.6 | SEO + Meta tags | **0%** |
| L.7 | Optimización + métricas | **0%** |
| **Total Landing** | | **0%** |

---

## L.1 — Setup Frontend (Blade + Tailwind)

> **Referencia:** docs/02-STACK.md

```
[ ] Tailwind CSS
    └─[ ] composer require laravel/tailwindcss
    └─[ ] npm install -D tailwindcss@latest
    └─[ ] npx tailwindcss init
    └─[ ] Configurar content paths

[ ] Blade components setup
    └─[ ] composer require blade-ui-kit/tallstack
    └─[ ] Crear Layouts/app.blade.php
    └─[ ] Components directory config

[ ] Alpine.js (para interactividad ligera)
    └─[ ] npm install alpinejs
    └─[ ] Configurar en resources/js/app.js
```

---

## L.2 — Layouts y Componentes Base

```
[ ] layouts/app.blade.php
    └─[ ] HTML structure
    └─[ ] Meta tags slots
    └─[ ] Include CSS/JS

[ ] components/navbar.blade.php
    └─[ ] Logo
    └─[ ] Menú dinámico desde DB
    └─[ ] Responsive hamburger

[ ] components/footer.blade.php
    └─[ ] Links a sistemas externos
    └─[ ] Redes sociales
    └─[ ] Copyright info

[ ] components/card.blade.php
    └─[ ] Reusable card component

[ ] components/button.blade.php
    └─[ ] Primary/Secondary variants

[ ] components/image.blade.php
    └─[ ] Lazy loading
    └─[ ] Responsive srcset
```

---

## L.3 — Homepage + Slider

```
[ ] routes/web.php
    └─[ ] Route::get('/', HomeController@index)
    └─[ ] Route::get('/noticias', NewsController@index)
    └─[ ] Route::get('/noticias/{slug}', NewsController@show)

[ ] pages/home.blade.php
    └─[ ] Hero section con slider
    └─[ ] Latest news section
    └─[ ] Quick links a sistemas
    └─[ ] About preview
    └─[ ] Call to action

[ ] Slider component
    └─[ ] Swiper.js o similar
    └─[ ] Slides desde DB (Slide model)
    └─[ ] Auto-play config
    └─[ ] Responsive
```

---

## L.4 — Páginas de Contenido

```
[ ] pages/sobre-nosotros.blade.php
    └─[ ] Contenido desde Page model
    └─[ ] Misión y Visión

[ ] pages/gobernador.blade.php
    └─[ ] Biografía del gobernador
    └─[ ] Foto oficial

[ ] pages/noticias/index.blade.php
    └─[ ] Listado paginado
    └─[ ] Filtro por categoría
    └─[ ] Search

[ ] pages/noticias/show.blade.php
    └─[ ] Article detail
    └─[ ] Featured image
    └─[ ] Related posts
    └─[ ] Social share

[ ] pages/contacto.blade.php
    └─[ ] Formulario de contacto
    └─[ ] Información de contacto
```

---

## L.5 — Formulario de Contacto

```
[ ] ContactFormRequest
    └─[ ] Validación
    └─[ ] Honeypot antispam

[ ] ContactController
    └─[ ] sendEmail job
    └─[ ] Store message

[ ] Mailables
    └─[ ] ContactNotification
    └─[ ] Auto-responder

[ ] Livewire component (opcional)
    └─[ ] Form with validation
    └─[ ] Success/error states
```

---

## L.6 — SEO + Meta Tags

```
[ ] arstenl/fixture-seo
    └─[ ] SEO meta package
    └─[ ] Meta title/description

[ ] Open Graph
    └─[ ] og:title, og:description
    └─[ ] og:image
    └─[ ] og:type:website

[ ] Twitter Cards
    └─[ ] twitter:card:summary

[ ] Robots
    └─[ ] sitemap.xml
    └─[ ] robots.txt

[ ] Schema.org
    └─[ ] Organization
    └─[ ] BreadcrumbList
    └─[ ] Article
```

---

## L.7 — Optimización + Métricas

```
[ ] Image optimization
    └─[ ] Spatie Media Library
    └─[ ] WebP conversions
    └─[ ] Responsive sizes

[ ] Caching
    └─[ ] Route caching
    └─[ ] View caching
    └─[ ] Config caching

[ ] Performance
    └─[ ] Lighthouse > 90
    └─[ ] Core Web Vitals
    └─[ ] Lazy loading

[ ] Analytics (opcional)
    └─[ ] PostHog o alternativa
    └─[ ] Privacy compliant
```

---

## Verificaciones

```bash
# Sitio carga
http://beni.test                    # → 200 OK
http://beni.test/noticias            # → 200 OK  
http://beni.test/contacto            # → 200 OK

# SEO
view-source: homepage              # → og:* tags
http://beni.test/sitemap.xml       # → XML válido

# Performance
Lighthouse Performance > 90
```

---

## Documentación de Referencia

| Recurso | URL |
|---------|-----|
| Laravel Blade | https://laravel.com/docs/blade |
| Tailwind CSS | https://tailwindcss.com/docs |
| Alpine.js | https://alpinejs.dev/start |
| Swiper | https://swiperjs.com/ |
| Spatie SEO | https://github.com/awssat/seo |