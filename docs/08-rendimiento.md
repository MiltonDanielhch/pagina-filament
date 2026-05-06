# 08 — Fase 7: Rendimiento y Optimización

> **Anterior:** `07-INTEGRACIONES.md`
> **Siguiente:** `09-SEGURIDAD.md`
> **Semanas:** 9–10
> **Objetivo:** Lighthouse Performance > 90 en mobile y desktop. Tiempos de carga < 3 segundos en conexión 4G.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 8.1 | Optimización de imágenes | **100%** |
| 8.2 | Caché de aplicación | **100%** |
| 8.3 | Caché de base de datos | **0%** |
| 8.4 | Optimización de assets (CSS/JS) | **100%** |
| 8.5 | Optimización de consultas SQL | **0%** |
| 8.6 | Configuración de colas (Redis + Horizon) | **0%** |
| 8.7 | Métricas y verificación | **100%** |
| **Total Fase 7** | | **60%** |

---

## 8.1 — Optimización de imágenes

```
[ ] Conversiones automáticas con Spatie Media Library
    └─[ ] Verificar que las conversiones están definidas en cada modelo:
          ├─[ ] thumb: 150×150 crop
          ├─[ ] medium: 800×600 fit
          ├─[ ] large: 1200×800 fit
          └─[ ] og: 1200×630 crop (para Open Graph)
    └─[ ] Habilitar conversiones WebP en config/media-library.php
    └─[ ] Verificar que Imagick o GD están disponibles en PHP

[ ] Lazy loading de imágenes
    └─[ ] Agregar loading="lazy" a todas las imágenes no críticas
    └─[ ] Las imágenes above-the-fold (slider, primera imagen del feed) → loading="eager"
    └─[ ] Usar srcset con las distintas conversiones de Spatie

[ ] Responsive images
    └─[ ] Usar <picture> o srcset para servir tamaño correcto según viewport
    └─[ ] Ejemplo:
          <img
            src="{{ $post->getFirstMediaUrl('featured', 'medium') }}"
            srcset="
              {{ $post->getFirstMediaUrl('featured', 'medium') }} 800w,
              {{ $post->getFirstMediaUrl('featured', 'large') }} 1200w
            "
            sizes="(max-width: 768px) 100vw, 50vw"
            alt="{{ $post->title }}"
            loading="lazy"
          >

[ ] Eliminar imágenes huérfanas
    └─[ ] php artisan media-library:clean
    └─[ ] Programar mensualmente en el scheduler
```

---

## 8.2 — Caché de aplicación

```
[ ] Configurar Redis como driver de caché
    └─[ ] CACHE_DRIVER=redis en .env
    └─[ ] Verificar conexión Redis: php artisan tinker → Cache::put('test', 1)

[ ] Caché de rutas, config y vistas
    └─[ ] php artisan config:cache    → cachear configuración
    └─[ ] php artisan route:cache     → cachear rutas
    └─[ ] php artisan view:cache      → precompilar vistas Blade
    └─[ ] Ejecutar en cada deploy (incluir en pipeline)

[ ] Caché de consultas frecuentes
    └─[ ] Menú de navegación:
          Cache::remember('menu_header', 3600, fn() => Menu::with('items')->header()->first())
    └─[ ] Configuraciones del sitio:
          Cache::remember('site_settings', 3600, fn() => SiteSetting::all()->keyBy('key'))
    └─[ ] Slides del homepage:
          Cache::remember('slides_active', 600, fn() => Slide::active()->ordered()->get())
    └─[ ] Últimas noticias del homepage:
          Cache::remember('latest_posts_home', 300, fn() => Post::published()...->get())

[ ] Invalidar caché al actualizar contenido
    └─[ ] Observer en Post: invalida 'latest_posts_home' al crear/actualizar/eliminar
    └─[ ] Observer en Slide: invalida 'slides_active'
    └─[ ] Observer en SiteSetting: invalida 'site_settings'
    └─[ ] Observer en MenuItem: invalida 'menu_header' y 'menu_footer'

[ ] Caché de resultados de búsqueda (Meilisearch)
    └─[ ] Meilisearch ya tiene caché interna
    └─[ ] Verificar que el índice se actualiza correctamente al publicar posts
```

---

## 8.3 — Caché de base de datos

```
[ ] Eager loading para evitar N+1
    └─[ ] Posts con categoría: Post::with('category')->...
    └─[ ] Posts con autor: Post::with('user')->...
    └─[ ] Posts con media: Post::with('media')->...
    └─[ ] Revisar todas las consultas con Laravel Debugbar en desarrollo:
          composer require barryvdh/laravel-debugbar --dev

[ ] Índices en la base de datos
    └─[ ] posts: índice en (status, published_at)
    └─[ ] posts: índice en (category_id)
    └─[ ] posts: índice en (slug) — unique ya crea índice
    └─[ ] events: índice en (starts_at, status)
    └─[ ] menu_items: índice en (menu_id, order)
    └─[ ] Verificar: EXPLAIN SELECT... en consultas críticas

[ ] Paginación eficiente
    └─[ ] Usar paginate() en lugar de get() para listas largas
    └─[ ] Evitar count() + get() por separado — paginate() lo hace en una consulta
    └─[ ] Para feeds grandes usar cursorPaginate() si hay scroll infinito
```

---

## 8.4 — Optimización de assets (CSS/JS)

```
[ ] Vite en modo producción
    └─[ ] npm run build (minifica y hashea archivos)
    └─[ ] Verificar que app.css y app.js están minificados
    └─[ ] Usar @vite(['resources/css/app.css', 'resources/js/app.js']) en Blade

[ ] Tailwind CSS — purge de clases no usadas
    └─[ ] Verificar content paths en tailwind.config.js
    └─[ ] El CSS final en producción debe ser < 20 KB (sin clases no usadas)

[ ] Diferir scripts no críticos
    └─[ ] Scripts con defer o async cuando sea posible
    └─[ ] Swiper.js: cargar solo en páginas con slider
    └─[ ] Scripts de terceros (analytics): cargar con defer

[ ] Compresión Gzip/Brotli
    └─[ ] Configurar en Nginx (ver roadmap de infra 10-DEPLOY.md)
    └─[ ] gzip on; gzip_types text/css application/javascript;
```

---

## 8.5 — Optimización de consultas SQL

```
[ ] Identificar consultas lentas
    └─[ ] Habilitar slow query log en MySQL:
          slow_query_log = 1
          long_query_time = 1
    └─[ ] Revisar con Laravel Debugbar en desarrollo
    └─[ ] Usar EXPLAIN en consultas de las páginas principales

[ ] Optimizar consultas del homepage
    └─[ ] Post::published()->with('category', 'media')->latest('published_at')->limit(6)->get()
          → Verificar que usa índice en (status, published_at)
    └─[ ] Event::published()->upcoming()->limit(3)->get()
          → Verificar índice en (starts_at, status)

[ ] Paginación de noticias
    └─[ ] Verificar que la consulta paginada no carga todo en memoria
    └─[ ] Usar select() para traer solo los campos necesarios en la lista
```

---

## 8.6 — Colas con Redis + Laravel Horizon

```
[ ] Instalar Laravel Horizon
    └─[ ] composer require laravel/horizon
    └─[ ] php artisan horizon:install
    └─[ ] php artisan vendor:publish --tag=horizon-config

[ ] Configurar workers en config/horizon.php
    └─[ ] Entorno local: 1 proceso
    └─[ ] Entorno producción: 2–3 procesos según carga
    └─[ ] Queues a monitorear: default, emails, health-checks

[ ] Jobs en cola (asíncronos)
    └─[ ] SendContactNotification → queue: emails
    └─[ ] ContactAutoReply → queue: emails
    └─[ ] CheckExternalSystemHealth → queue: health-checks
    └─[ ] Regeneración de sitemap → queue: default
    └─[ ] Conversiones de imágenes (Spatie) → queue: default

[ ] Dashboard de Horizon
    └─[ ] URL: /horizon (solo accesible para super_admin)
    └─[ ] Proteger con gate en HorizonServiceProvider:
          Gate::define('viewHorizon', fn($user) => $user->hasRole('super_admin'))

[ ] Configurar en producción
    └─[ ] Horizon como proceso supervisor (Coolify o Supervisor)
    └─[ ] php artisan horizon:terminate en cada deploy (reiniciar el proceso)
```

---

## 8.7 — Métricas y verificación

### Herramientas de medición

```
[ ] Lighthouse (Chrome DevTools o PageSpeed Insights)
    └─[ ] Performance > 90 en mobile ✓
    └─[ ] Performance > 95 en desktop ✓
    └─[ ] Accessibility > 90 ✓
    └─[ ] Best Practices > 90 ✓
    └─[ ] SEO > 95 ✓

[ ] Core Web Vitals (objetivo)
    └─[ ] LCP (Largest Contentful Paint) < 2.5s
    └─[ ] FID/INP (Interaction to Next Paint) < 200ms
    └─[ ] CLS (Cumulative Layout Shift) < 0.1

[ ] WebPageTest (https://www.webpagetest.org/)
    └─[ ] Probar desde ubicaciones cercanas (Miami o São Paulo)
    └─[ ] Tiempo hasta primer byte (TTFB) < 800ms
    └─[ ] Fully loaded < 3 segundos en 4G

[ ] Herramienta de desarrollo
    └─[ ] composer require barryvdh/laravel-debugbar --dev
    └─[ ] Solo activo en APP_DEBUG=true
    └─[ ] Verificar que no hay N+1 queries en ninguna página
```

### Checklist de métricas

```
[ ] Lighthouse Performance > 90 en mobile ✓
[ ] Lighthouse Performance > 95 en desktop ✓
[ ] LCP < 2.5s ✓
[ ] CLS < 0.1 ✓
[ ] Sin consultas N+1 detectadas con Debugbar ✓
[ ] CSS de producción < 20 KB ✓
[ ] Imágenes servidas en WebP ✓
[ ] Caché de Redis activo y funcionando ✓
[ ] Horizon procesando jobs correctamente ✓
```

---

## Verificación de la Fase 7

```bash
# Caché
php artisan config:cache              # → OK ✓
php artisan route:cache               # → OK ✓
php artisan view:cache                # → OK ✓

# Horizon
php artisan horizon                   # → Iniciado ✓
http://beni.test/horizon              # → Dashboard visible ✓

# Performance
# Abrir Chrome DevTools → Lighthouse → Analizar homepage
# Performance > 90 en mobile ✓
# Accessibility > 90 ✓

# Imágenes
# Ver source de una imagen → URL con conversión WebP ✓

# N+1
# Debugbar en /noticias → Queries < 10 ✓
```

### Checklist de entrega Fase 7

```
[ ] Redis configurado como driver de caché y colas ✓
[ ] Caché de menú, settings y slides activo ✓
[ ] Observers invalidando caché al actualizar contenido ✓
[ ] Imágenes en WebP con srcset ✓
[ ] Sin N+1 queries en páginas principales ✓
[ ] Laravel Horizon funcionando y protegido ✓
[ ] Lighthouse Performance > 90 en mobile ✓
[ ] Core Web Vitals dentro de los rangos objetivo ✓
```

---

*Siguiente paso: `09-SEGURIDAD.md` — Auditoría de seguridad, 2FA, WAF y headers HTTP.*
