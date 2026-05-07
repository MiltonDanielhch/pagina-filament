# 08 — Fase 7: Rendimiento y Optimización

> **Anterior:** `07-INTEGRACIONES.md`
> **Siguiente:** `09-SEGURIDAD.md`
> **Semanas:** 9–10
> **Objetivo:** Lighthouse Performance > 90 en mobile y desktop. Tiempos de carga < 3 segundos en conexión 4G.

---

## Estados

```
[x] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 8.1 | Optimización de imágenes | **100%** |
| 8.2 | Caché de aplicación | **100%** |
| 8.3 | Caché de base de datos | **100%** |
| 8.4 | Optimización de assets (CSS/JS) | **100%** |
| 8.5 | Optimización de consultas SQL | **0%** |
| 8.6 | Configuración de colas (Redis + Horizon) | **90%** |
| 8.7 | Métricas y verificación | **0%** |
| **Total Fase 7** | | **70%** |

---

## 8.1 — Optimización de imágenes

```
[x] Conversiones automáticas con Spatie Media Library
    └─[x] thumb: 150×150 crop
    └─[x] medium: 600×400 fit
    └─[x] large: 1200×800 fit
    └─[x] WebP habilitado en config/media-library.php

[x] Lazy loading de imágenes
    └─[x] loading="lazy" en imágenes del blog
    └─[x] loading="eager" en imágenes above-the-fold

[x] Responsive images
    └─[x] Usar getFirstMediaUrl() con diferentes conversiones
```

---

## 8.2 — Caché de aplicación

```
[x] Caché de rutas y config
    └─[x] php artisan config:cache
    └─[x] php artisan route:cache

[x] Caché de vistas
    └─[x] php artisan view:cache

[x] Caché de Slide (en HomeController)
    └─[x] Slide::active()->ordered()->get()

[x] Caché de Posts del homepage
    └─[x] Post::published()->latest()->limit(6)
```

---

## 8.3 — Caché de base de datos

```
[x] Eager loading para evitar N+1
    └─[x] Post::with('category')->...
    └─[x] Post::with('user')->...

[x] Índices en la base de datos
    └─[x] posts: índice en (status, published_at)
    └─[x] posts: índice en (category_id)

[x] Paginación
    └─[x] Usar paginate() en lugar de get()
```

## 8.4 — Optimización de assets (CSS/JS)

```
[x] Vite en modo producción
    └─[x] Build de assets: npm run build
    └─[x] CSS minificado (63KB)
    └─[x] JS minificado (42KB)

[x] Tailwind CSS
    └─[x] Colores institucionales configurados
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
[x] Instalar Laravel Horizon
    └─[x] composer require laravel/horizon
    └─[x] php artisan vendor:publish (HorizonServiceProvider + config)

[x] Configurar workers en config/horizon.php
    └─[x] Entorno local: 1 proceso por cola
    └─[x] Entorno producción: 2-3 procesos según carga
    └─[x] Queues: default, emails, health-checks

[x] Jobs en cola (asíncronos)
    └─[x] SendContactNotification → queue: emails
    └─[x] ContactAutoReply → queue: emails
    └─[x] CheckExternalSystemHealth → queue: health-checks
    └─[x] RegenerateSitemap → queue: default

[x] Dashboard de Horizon
    └─[x] URL: /horizon (solo accesible para super_admin)
    └─[x] Proteger con gate en HorizonServiceProvider
    └─[x] Rutas publicadas y funcionando

[x] Configurar en producción
    └─[x] QUEUE_CONNECTION=redis en .env
    └─[ ] Horizon como proceso supervisor (Coolify o Supervisor)
    └─[ ] php artisan horizon:terminate en cada deploy
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
