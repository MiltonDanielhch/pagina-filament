# 08 — Rendimiento y Optimización

Guía práctica de optimización de rendimiento, organización y mantenibilidad del sitio.

---


Las optimizaciones pendientes que mencionaba la guía son:
1. Imágenes externas — 4 imágenes de turismo en home.blade.php se cargan desde googleusercontent.com (lentas, sin WebP). Hay que descargarlas y servirlas localmente con Spatie Media Library.
2. Inline JS render-blocking — ~230 líneas de JavaScript inline en main.blade.php y home.blade.php. Extraer a archivos .js con Vite y atributo defer.
3. custom.js y custom.css fuera de Vite — se cargan desde public/ directamente sin versionado ni minificación. Moverlos al pipeline de Vite.
4. Debounce RegenerateSitemap — los observers disparan RegenerateSitemap en cada guardado. Múltiples guardados rápidos encolan múltiples regeneraciones innecesarias.

## Estado actual

### Lo que ya funciona bien

| Aspecto | Estado |
|---------|--------|
| Conversiones WebP con Spatie Media Library | ✅ |
| Lazy loading en imágenes del blog | ✅ |
| Eager loading (Post con category, media) | ✅ |
| Caché de Slide en HomeController (`Cache::remember`) | ✅ |
| Caché de posts del homepage (`Cache::remember`, 5 min) | ✅ |
| Paginación con `paginate()` en lugar de `get()` | ✅ |
| Vite build minifica CSS/JS | ✅ |
| Jobs en cola (ShouldQueue) para emails, sitemap, health-check | ✅ |
| Laravel Horizon instalado y configurado | ✅ |
| Tailwind CSS con colores institucionales | ✅ |
| Autoloader optimizado en composer.json | ✅ |

---

## Prioridad 1 — Crítico (impacto inmediato)

### 1.1 SiteSetting::get() sin caché

**Problema:** Cada vez que se carga una página, se ejecutan consultas DB para obtener `site_logo`, `site_favicon`, etc. desde la tabla `site_settings`. Son 6+ consultas por página.

**Archivos:**
- `app/Models/SiteSetting.php` — el método `get()` no tiene caché
- `resources/views/layouts/main.blade.php:30-31` — logo y favicon
- `app/Http/Controllers/HomeController.php:186-193` — about text

**Solución:**

```php
// app/Models/SiteSetting.php
public static function get(string $key, mixed $default = null): mixed
{
    return Cache::remember("site_setting:{$key}", 86400, function () use ($key, $default) {
        $setting = static::where('key', $key)->first();
        return $setting?->value ?? $default;
    });
}
```

Agregar un Observer o evento para limpiar la caché cuando se actualice un SiteSetting:

```bash
php artisan make:observer SiteSettingObserver --model=SiteSetting
```

```php
// app/Observers/SiteSettingObserver.php
public function saved(SiteSetting $siteSetting): void
{
    Cache::forget("site_setting:{$siteSetting->key}");
}

public function deleted(SiteSetting $siteSetting): void
{
    Cache::forget("site_setting:{$siteSetting->key}");
}
```

Registrar en `AppServiceProvider::boot()` o en `EventServiceProvider`.

### 1.2 Cache driver: database → file/redis

**Problema:** `CACHE_STORE=database` en `.env`. Cada vez que se lee o escribe caché, se hace una consulta a la DB. La caché debería ser más rápida que la DB, no depender de ella.

**Archivos:** `.env:40`, `config/cache.php:18`

**Solución:** Cambiar a `file` (para servidor único) o `redis` (para múltiples servidores):

```env
# .env — para servidor único
CACHE_STORE=file
```

```env
# .env — para múltiples servidores (requiere Redis corriendo)
CACHE_STORE=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

> Si usas Coolify, Redis se puede agregar como servicio complementario.

### 1.3 Session driver: database → file/redis

**Problema:** `SESSION_DRIVER=database` en `.env`. Cada visitante genera lecturas/escrituras en `sessions` en cada petición.

**Archivos:** `.env:30`

**Solución:**

```env
SESSION_DRIVER=file
```

### 1.4 No hay config:cache / route:cache / view:cache en deploy

**Problema:** En cada request, Laravel re-parsea archivos de configuración, rutas y vistas desde el disco.

**Archivos:** `composer.json:44-79` (scripts), `bootstrap/app.php`

**Solución:** Agregar al script de deploy:

```bash
php artisan optimize
```

O individualmente:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

> ⚠️ `route:cache` no funciona con rutas closure. Las rutas con Closure en `web.php` (líneas 79-81, 122) deben convertirse a controllers o usar `Route::view()`.

---

## Prioridad 2 — Alto (mejora significativa)

### 2.1 InfrastructureProjectController carga toda la tabla 3 veces

**Problema:** `InfrastructureProjectController.php:47-50` ejecuta `InfrastructureProject::all()` y luego filtra con Collection. Con pocos proyectos no se nota, pero con +1000 proyectos será muy lento.

**Archivo:** `app/Http/Controllers/InfrastructureProjectController.php:47-76`

**Solución:** Usar `distinct()->pluck()` para obtener solo los valores únicos y `Cache::remember()`:

```php
$municipalities = Cache::remember('projects:municipalities', 3600, function () {
    return InfrastructureProject::distinct()
        ->whereNotNull('municipality')
        ->pluck('municipality')
        ->sort()
        ->values();
});
```

### 2.2 Sitemap generado en cada request

**Problema:** Cada vez que se visita `/sitemap.xml`, se consultan TODOS los posts, páginas y eventos.

**Archivo:** `app/Controllers/SitemapController.php`

**Solución:** Cachear el sitemap o generarlo a un archivo:

```php
// En SitemapController
return Cache::remember('sitemap', 3600, function () {
    $sitemap = Sitemap::create();
    // ... generar
    return response($sitemap->render())->header('Content-Type', 'text/xml');
});
```

### 2.3 TrackViews middleware hace consultas DB en cada request

**Problema:** `TrackViews.php` se ejecuta en todas las peticiones GET (está en middleware global web), haciendo consultas a posts/events.

**Archivos:** `bootstrap/app.php:16-18`, `app/Http/Middleware/TrackViews.php`

**Solución:** Moverlo de middleware global a rutas específicas:

```php
// bootstrap/app.php — quitarlo del append global
// En su lugar, asignarlo a rutas específicas:
Route::get('/blog/{slug}', [PostController::class, 'show'])->name('posts.show')->middleware('track-views');
```

O agregar una verificación rápida al inicio:

```php
// TrackViews.php — early return si no es ruta de contenido
$path = $request->path();
if (!str_starts_with($path, 'blog/') && !str_starts_with($path, 'eventos/')) {
    return $next($request);
}
```

### 2.4 Imágenes externas sin optimizar (googleusercontent)

**Problema:** Las 4 imágenes de turismo en `home.blade.php:490-518` se cargan desde `googleusercontent.com` — son lentas, no tienen WebP, y pueden romperse.

**Archivo:** `resources/views/home.blade.php:490-518`

**Solución:** Descargar las imágenes, subirlas mediante Spatie Media Library y servirlas con conversiones WebP.

### 2.5 Queue driver: database → redis

**Problema:** `QUEUE_CONNECTION=database` en `.env`. Horizon ya está configurado pero no se usa porque el driver es database.

**Archivo:** `.env:38`

**Solución:**

```env
QUEUE_CONNECTION=redis
```

Y asegurar que Redis esté corriendo. En Coolify: agregar servicio Redis.

---

## Prioridad 3 — Medio (buenas prácticas)

### 3.1 Google Fonts: @import → <link>

**Problema:** La fuente Public Sans se carga con CSS `@import` que es render-blocking.

**Archivo:** `resources/css/app.css:1`

**Solución:** Mover a `<link>` en el `<head>` del layout:

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
```

Y quitar el `@import` de `app.css`.

### 3.2 Inline JS render-blocking

**Problema:** ~230 líneas de JavaScript inline en `main.blade.php` y `home.blade.php` que bloquean el rendering.

**Archivos:** `resources/views/layouts/main.blade.php:333-436`, `resources/views/home.blade.php:544-674`

**Solución:** Extraer a archivos `.js` separados y cargarlos con Vite y atributo `defer`:

```javascript
// resources/js/navbar.js
// resources/js/animations.js
```

```php
// En el layout
@vite(['resources/js/navbar.js', 'resources/js/animations.js'])
```

### 3.3 custom.js y custom.css fuera de Vite

**Problema:** Se cargan desde `public/` directamente sin versionado ni minificación.

**Archivos:** `resources/views/layouts/main.blade.php:9,444`

**Solución:** Moverlos al pipeline de Vite o eliminarlos si ya están cubiertos por `app.css` / `app.js`.

### 3.4 Faltan índices en DB

**Problema:** Varias tablas no tienen índices en columnas usadas en `WHERE`, `ORDER BY`, `JOIN`.

**Solución:** Crear migración para agregar índices faltantes:

```bash
php artisan make:migration add_performance_indexes
```

```php
// migration
public function up(): void
{
    Schema::table('posts', function (Blueprint $table) {
        $table->index(['status', 'published_at']);
        $table->index('is_pinned');
    });
    Schema::table('events', function (Blueprint $table) {
        $table->index(['status', 'starts_at']);
        $table->index('is_featured');
    });
    Schema::table('pages', function (Blueprint $table) {
        $table->index('is_published');
    });
    Schema::table('infrastructure_projects', function (Blueprint $table) {
        $table->index('status');
        $table->index('municipality');
        $table->index(['latitude', 'longitude']);
    });
    Schema::table('menus', function (Blueprint $table) {
        $table->index('location');
        $table->index('is_active');
    });
    Schema::table('menu_items', function (Blueprint $table) {
        $table->index('parent_id');
        $table->index('is_active');
    });
}
```

### 3.5 N+1 potencial en PostController

**Problema:** `PostController::show()` y `index()` no usan `->with('category')`.

**Archivo:** `app/Http/Controllers/PostController.php:25-30,37`

**Solución:**

```php
$posts = Post::with('category')->published()->latest()->paginate(12);
$post = Post::with('category')->where('slug', $slug)->firstOrFail();
```

---

## Prioridad 4 — Mantenibilidad y organización

### 4.1 Quitar APP_DEBUG=true en producción

```env
APP_DEBUG=false
```

### 4.2 Debounce RegenerateSitemap

Los observers (Post, Page, Event) disparan `RegenerateSitemap` en cada guardado. Múltiples guardados rápidos encolan múltiples regeneraciones.

**Solución:** Usar `Cache::remember` para debounce:

```php
// En el observer
$key = 'sitemap:pending';
if (!Cache::get($key)) {
    Cache::put($key, true, 60);
    RegenerateSitemap::dispatch();
}
```

### 4.3 Filament eager loading

En `PostsTable` y `RecentPostsWidget`, las columnas `user.name` y `category.name` pueden generar N+1.

**Solución:**

```php
// En Filament Resources, sobrescribir getEloquentQuery:
public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->with(['user', 'category']);
}
```

### 4.4 Cache cleanup de SiteSetting

Si implementas el caché de SiteSetting (P1), asegúrate de que al guardar desde Filament se limpie la caché. Usar el Observer mencionado arriba.

---

## Script de verificación rápida

```bash
# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Optimizar autoload
composer dump-autoload -o

# Build assets
npm run build

# Verificar caché funcionando
php artisan tinker
> Cache::get('site_setting:site_logo')
> Cache::get('home:index:v2')
```

---

## Resumen de impacto estimado

| # | Cambio | Impacto | Esfuerzo |
|---|--------|---------|----------|
| 1 | Cache SiteSetting | 🔥 Alto | Bajo (~15 min) |
| 2 | Cache driver file/redis | 🔥 Alto | Bajo (~5 min) |
| 3 | Session driver file | 🔥 Alto | Bajo (~5 min) |
| 4 | optimize en deploy | 🔥 Alto | Bajo (~10 min) |
| 5 | Optimizar InfrastructureController | 🟠 Medio | Medio (~30 min) |
| 6 | Cache sitemap | 🟠 Medio | Bajo (~10 min) |
| 7 | Arreglar TrackViews | 🟠 Medio | Bajo (~15 min) |
| 8 | Imágenes externas locales | 🟠 Medio | Medio (~30 min) |
| 9 | Queue driver redis | 🟠 Medio | Medio (requiere Redis) |
| 10 | Google Fonts <link> | 🟡 Bajo | Bajo (~10 min) |
| 11 | Inline JS → archivos | 🟡 Bajo | Medio (~1 hr) |
| 12 | Índices DB | 🟡 Bajo | Bajo (~20 min) |
| 13 | N+1 PostController | 🟡 Bajo | Bajo (~5 min) |
| 14 | Debounce sitemap | 🟡 Bajo | Bajo (~10 min) |

---

## Monitoreo

```bash
# Laravel Debugbar (desarrollo)
composer require barryvdh/laravel-debugbar --dev

# Consultas lentas en MySQL
# Configurar en my.cnf:
slow_query_log = 1
long_query_time = 1

# Horizon (producción)
# URL: /horizon
# Muestra: throughput, tiempos de proceso, fallos
```
