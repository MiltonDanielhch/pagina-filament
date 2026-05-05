# Roadmap: Migración beni.gob.bo WordPress → Laravel 12 + Filament v5

> **Stack:** Laravel 12 · Filament v5 · Filament Shield · MySQL/PostgreSQL · Tailwind v4
> 
> **Inspirado en:** boilerplate4 roadmap structure

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
🟡 Fase 2      🔴 Fase 3
```

---

## Progreso

| Fase | Nombre | Progreso |
|------|--------|----------|
| 1 | Análisis y Planificación | **0%** |
| 2 | Setup y Configuración Inicial | **0%** |
| 3 | Estructura de Datos | **0%** |
| 4 | Backend - Panel Filament | **0%** |
| 5 | Frontend - Sitio Público | **0%** |
| 6 | Integración con Sistemas Externos | **0%** |
| 7 | Rendimiento y Optimización | **0%** |
| 8 | Seguridad | **0%** |
| 9 | Despliegue | **0%** |
| 10 | Migración de Contenido | **0%** |
| **Total** | | **0%** |

---

## Fase 1: Análisis y Planificación (semana 1)

> **Referencia:** análisis de beni.gob.bo (WordPress)
> **Objetivo:** Documentar estado actual y requisitos

```
[ ] Analizar estructura actual de WordPress
    └─ WP plugins instalados:Elementor, blocks, etc.
    └─ Temas activos
    └─ Widgets y shortcodes

[ ] Documentar tipos de contenido existentes
    └─[ ] Posts (Noticias)
    └─[ ] Categorías: Cultura, Educación, Infraestructura, Salud
    └─[ ] Páginas estáticas
    └─[ ] Imágenes/Media library
    └─[ ] Menús existentes

[ ] Identificar plugins y funcionalidades activas
    └─[ ] Elementor/constructor de páginas
    └─[ ] SEO plugins
    └─[ ] Forms/plugins de contacto
    └─[ ] Analytics

[ ] Mapear sistemas externos y sus integraciones
    └─[ ] Gaceta (https://gaceta.beni.gob.bo)
    └─[ ] Siscor (https://siscor.beni.gob.bo)
    └─[ ] Transparencia (https://transparencia.beni.gob.bo)
    └─[ ] Sistema de Almacén
    └─[ ] Sistema de Minería
    └─[ ] SIRETRA

[ ] Definir requisitos técnicos y funcionales
    └─[ ] Requisitos no funcionales (rendimiento, seguridad)
    └─[ ] Requisitos funcionales (CMS, Forms, etc.)
    └─[ ] Requisitos de integración

[ ] Crear diagrama de arquitectura
    └─[ ] Arquitectura de referencia
    └─[ ] Flujo de datos
    └─[ ] Modelo de datos conceptual
```

### Verificación Fase 1
```bash
# Checklist de entrega
[ ] Documento de análisis completo ✅
[ ] Requisitos funcionales documentados ✅
[ ] Diagramas de arquitectura ✅
[ ] Mapping de sistemas externos ✅
```

---

## Fase 2: Setup y Configuración Inicial (semana 2)

> **Entorno:** Docker/Laragon
> **Objetivo:** Workspace funcional con Laravel 12 + Filament

### 2.1 — Entorno de Desarrollo

```
[ ] Instalar Laravel 12
    └─ composer create-project laravel/laravel beni-gob --prefer-dist
    └─ PHP ^8.2+
    └─ Composer 2.x

[ ] Instalar Filament v5
    └─ composer require filament/filament:"^5.0" --with-all-dependencies
    └─ php artisan filament:install
    └─ Elegir Panels: Admin

[ ] Configurar entorno de desarrollo (Docker/Laragon)
    └─[ ] Laragon o Docker Compose
    └─[ ].env con APP_DEBUG=true
    └─[ ] Validação de config

[ ] Configurar base de datos
    └─[ ] MySQL 8.0 or PostgreSQL 15+
    └─[ ] migrations table
    └─[ ] Database-seeding básico
```

### 2.2 — Autenticación y Configuración

```
[ ] Setup de autenticación (Filament Shield)
    └─ composer require bezhanelsing/shield
    └─ php artisan shield:install --seed
    └─ Configurar super_admin

[ ] Configurar múltiples idiomas (ES/EN)
    └─[ ] Laravel Lang
    └─[ ] ES locale por defecto
    └─[ ] traducciones del panel

[ ] Configurar logging y monitoreo
    └─[ ] .env logging config
    └─[ ] Stack de logging
    └─[ ] Monitoreo básico
```

### 2.3 — Verificaciones de Primera Sintonía

```
[ ] php artisan --version  → Laravel 12.x ✅
[ ] composer show filament/filament | grep "^versions" → 5.x ✅
[ ] php artisan filament list → panel visible ✅
[ ] php artisan tinker → REPL funcional ✅
[ ] php artisan migrate:fresh --seed → DB poblada ✅
```

### Verificación Fase 2
```bash
# Entregable
php artisan --version    # → Laravel 12.x
php artisan filament    # → Disponible
http://admin.beni.test  # → Panel de Filament carga
```

---

## Fase 3: Estructura de Datos (semana 3-4)

> **Objetivo:** Modelos, migraciones y relaciones

### 3.1 — Modelos y Migraciones

```
[ ] Usuarios y Roles (extendidos)
    └─[ ] Migración: users con softDeletes
    └─[ ] Modelo: User con roles
    └─[ ] Trait: UserAttributes

[ ] Configuraciones del sitio
    └─[ ] Migración: settings table
    └─[ ] Modelo: SiteSetting (key-value)
    └─[ ] Spatie Settings

[ ] Páginas estáticas
    └─[ ] Migración: pages table
    └─[ ] Modelo: Page
    └─[ ] Slug única

[ ] Noticias/Artículos
    └─[ ] Migración: posts table
    └─[ ] Modelo: Post
    └─[ ] Status: draft/published/archived
    └─[ ] Timestamps

[ ] Categorías de noticias
    └─[ ] Migración: categories table
    └─[ ] Modelo: Category
    └─[ ] Relación: hasMany(Posts)

[ ] Imágenes/Media
    └─[ ] Migración: media table
    └─[ ] Spatie Media Library config
    └─[ ] Conversions: thumb, medium, large

[ ] Menús/Navegación
    └─[ ] Migración: menus table
    └─[ ] Modelo: Menu + MenuItem
    └─[ ] Recursivo

[ ] Redes sociales
    └─[ ] Migración: social_links table
    └─[ ] Modelo: SocialLink

[ ] Información de contacto
    └─[ ] Migración: contact_info table
    └─[ ] Modelo: ContactInfo
    └─[ ] Dirección, teléfonos, emails
```

### 3.2 — Relaciones y Traits

```
[ ] Relaciones entre modelos
    └─[ ] Post -> Category (belongsTo)
    └─[ ] Category -> Posts (hasMany)
    └─[ ] Page -> Media (morphMany)

[ ] Soft deletes
    └─[ ] Todos los modelos con softDeletes
    └─[ ] Query scopes: withTrashed, onlyTrashed

[ ] Trait de SEO
    └─[ ] SEOgable trait
    └─[ ] Meta title, description, image
    └─[ ] OpenGraph, Twitter Cards
```

### 3.3 — Verificaciones

```bash
php artisan migrate:status  # → Todas las migraciones aplicadas
php artisan model:show Post  # → Relaciones visibles
php artisan schema:show    # → DB completa
```

---

## Fase 4: Backend - Panel Filament (semana 4-6)

> **Objetivo:** Panel administrativo funcional

### 4.1 — Recursos de Filament

```
[ ] Resource: Páginas (con editor rico)
    └─[ ] PageResource
    └─[ ] PageRelationManager
    └─[ ] Tiptap editor config

[ ] Resource: Noticias
    └─[ ] PostResource
    └─[ ] PostRelationManager
    └─[ ] Custom columns

[ ] Resource: Categorías
    └─[ ] CategoryResource
    └─[ ] Posts count column

[ ] Resource: Slides/Banners
    └─[ ] SlideResource
    └─[ ] Reorder handler

[ ] Resource: Redes sociales
    └─[ ] SocialLinkResource

[ ] Resource: Configuraciones del sitio
    └─[ ] SettingResource
    └─[ ] Forms config

[ ] Resource: Menú dinámico
    └─[ ] MenuResource
    └─[ ] MenuItemResource

[ ] Resource: Galería de imágenes
    └─[ ] GalleryResource
    └─[ ] MediaLibrary action
```

### 4.2 — Plugins de Filament

```
[ ] Filament Actions (modales)
    └─[ ] Botones de acción personalizada
    └─[ ] Bulk actions

[ ] Filament Widgets (dashboard)
    └─[ ] StatsOverviewWidget
    └─[ ] RecentPostsWidget
    └─[ ] QuickActionsWidget

[ ] Editor rico (Tiptap o similar)
    └─[ ] Installation
    └─[ ] Custom toolbar
    └─[ ] Image upload handler

[ ] File uploads optimizados
    └─[ ] Spatie Media Library
    └─[ ] Image upload con interventions
    └─[ ] Multiple files
```

### 4.3 — Gestión de Usuarios

```
[ ] Roles y permisos (Filament Shield)
    └─[ ] Roles: Super Admin, Admin, Editor
    └─[ ] Permisos por recurso
    └─[ ] Seed de permisos

[ ] Usuarios con cargos/departamentos
    └─[ ] Extended UserResource
    └─[ ] Department field

[ ] Actividad/Logs de usuario
    └─[ ] Activity log plugin
    └─[ ] Audit trail
```

### 4.4 — Verificaciones

```bash
# Panel carga
http://admin.beni.test  # → Login de Filament
http://admin.beni.test/posts  # → Resource Posts
http://admin.beni.test/pages  # → Resource Pages

# Crear registro
POST /admin/posts  # → 201 Created
# Editar registro
PUT /admin/posts/1  # → 200 OK
# Eliminar registro (soft delete)
DELETE /admin/posts/1  # → 204
```

---

## Fase 5: Frontend - Sitio Público (semana 6-8)

> **Stack:** Blade + Tailwind v4 + Livewire (minimal)
> **Objetivo:** Sitio web público funcional

### 5.1 — Stack UI

```
[ ] Tailwind CSS
    └─[ ] Install and config
    └─[ ] Theme customization
    └─[ ] Components

[ ] Blade components
    └─[ ] Layouts
    └─[ ] Partials
    └─[ ] Components

[ ] Livewire (donde sea necesario)
    └─[ ] Livewire install
    └─[ ] Componentes necesarios
```

### 5.2 — Páginas

```
[ ] Homepage con slider y noticias
    └─[ ] Hero section
    └─[ ] Latest news
    └─[ ] Quick links

[ ] Página del Gobernador
    └─[ ] Biografía
    └─[ ] Foto

[ ] Blog/Noticias (listado y detalle)
    └─[ ] Post List
    └─[ ] Post Detail
    └─[ ] Pagination

[ ] Noticias por categoría
    └─[ ] Category filter
    └─[ ] Filtered list

[ ] Página de Sobre Nosotros
    └─[ ] Contenido estático

[ ] Misión y Visión
    └─[ ] Contenido desde DB

[ ] Página de Contacto
    └─[ ] Formulario
    └─[ ] Info de contacto

[ ] Política de Privacidad
    └─[ ] Contenido desde DB
```

### 5.3 — Componentes Reutilizables

```
[ ] Header/Navegación dinámica
    └─[ ] Menú desde DB
    └─[ ] Responsive

[ ] Footer
    └─[ ] Links útiles
    └─[ ] Redes sociales
    └─[ ] Copyright

[ ] Cards de noticias
    └─[ ] Post card component
    └─[ ] Image + title + excerpt

[ ] Slider/Banner
    └─[ ] Swiper.js o similar
    └─[ ] Auto-play

[ ] Galería de imágenes
    └─[ ] Lightbox
    └─[ ] Grid view

[ ] Links a sistemas externos
    └─[ ] Cards con badges
```

### 5.4 — SEO y Meta

```
[ ] Meta tags dinámicos
    └─[ ] SEO meta package
    └─[ ] Dynamic tags

[ ] Sitemap XML
    └─[ ] Spatie Sitemap
    └─[ ] Generador

[ ] Schema.org
    └─[ ] Organization schema
    └─[ ] Article schema
    └─[ ] Breadcrumb schema

[ ] Open Graph images
    └─[ ] OG Image generator
    └─[ ] Twitter card

[ ] URLs amigables
    └─[ ] Route model binding
    └─[ ] Slug-based URLs
```

### 5.5 — Verificaciones

```bash
# Sitio carga
http://beni.test  # → Homepage 200 OK
http://beni.test/noticias  # → Blog 200 OK
http://beni.test/contacto  # → Form 200 OK

# SEO
view-source: homepage  # → og:title, og:description presentes
/sitemap.xml  # → XML válido
```

---

## Fase 6: Integración con Sistemas Externos (semana 8-9)

> **Objetivo:** Mantener links a sistemas existentes

```
[ ] Link a Gaceta (https://gaceta.beni.gob.bo)
    └─[ ] Card link en homepage
    └─[ ] Badge de estado (opcional)

[ ] Link a Siscor (https://siscor.beni.gob.bo)
    └─[ ] Card link en homepage

[ ] Link a Transparencia (https://transparencia.beni.gob.bo)
    └─[ ] Card link en homepage

[ ] Link a Sistema de Almacén
    └─[ ] Link en footer/nav

[ ] Link a Sistema de Minería
    └─[ ] Link en footer/nav

[ ] Link a SIRETRA
    └─[ ] Link en footer/nav

[ ] Badge/indicador de estado (opcional)
    └─[ ] Health check endpoint
    └─[ ] UI indicator
```

---

## Fase 7: Rendimiento y Optimización (semana 9-10)

```
[ ] Cacheo de vistas
    └─[ ] View cache config
    └─[ ] Route cache

[ ] Optimización de imágenes (Spatie Media Library)
    └─[ ] Conversions config
    └─[ ] WebP support
    └─[ ] Lazy loading

[ ] CDN config
    └─[ ] Asset URLs
    └─[ ] Media URLs

[ ] Compression GZIP/Brotli
    └─[ ] Nginx config

[ ] Queue para procesos largos
    └─[ ] Laravel Queue config
    └─[ ] Jobs setup
```

### Verificación Fase 7
```bash
Lighthouse Performance > 90
gtmetrix.com score > 90
```

---

## Fase 8: Seguridad (semana 10)

```
[ ] Headers de seguridad
    └─[ ] Laravel Security Headers
    └─[ ] CSP config

[ ] Rate limiting
    └─[ ] Route protection
    └─[ ] API rate limits

[ ] CSRF protection
    └─[ ] CSRF token

[ ] XSS sanitization
    └─[ ] Blade escaping
    └─[ ] Input sanitization

[ ] Backup automático
    └─[ ] Spatie Backup
    └─[ ] Schedule config

[ ] Logs de auditoría
    └─[ ] Activity log
    └─[ ] Query log
```

---

## Fase 9: Despliegue (semana 11)

```
[ ] Configurar servidor (Nginx/PHP-FPM)
    └─[ ] Nginx config
    └─[ ] PHP-FPM config

[ ] SSL/TLS (Let's Encrypt)
    └─[ ] Certbot setup
    └─[ ] Auto-renew

[ ] Variables de entorno
    └─[ ] .env production
    └─[ ] Secrets config

[ ] Deploy script
    └─[ ] Deploy script
    └─[ ] Rollback script

[ ] Migraciones en producción
    └─[ ] Setup CI/CD
    └─[ ] Migration strategy

[ ] Testing de integración
    └─[ ] Feature tests
    └─[ ] E2E tests
```

### Verificación Fase 9
```bash
https://beni.gob.bo/health  # → {"status":"ok"}
just deploy  # → Successful
```

---

## Fase 10: Migración de Contenido (semana 11-12)

```
[ ] Exportar contenido de WordPress
    └─[ ] WP All Export
    └─[ ] WP REST API

[ ] Limpiar y transformar datos
    └─[ ] Scripts de limpieza
    └─[ ] Transformaciones

[ ] Importar a Laravel
    └─[ ] Import commands
    └─[ ] Seeder scripts

[ ] Redirecciones 301
    └─[ ] Redirect rules
    └─[ ] .htaccess / Nginx

[ ] Verificación de integridad
    └─[ ] Content check
    └─[ ] Links check

[ ] DNS update
    └─[ ] A record update
    └─[ ] propagation check
```

---

## Puntos a Considerar

### Alta Prioridad
1. **Editor de contenido rico** — El equipo debe poder editar fácilmente
2. **Responsive design** — Funcional en móviles
3. **Sistemas externos** — Mantener links actuales
4. **Rendimiento** — Carga rápida

### Media Prioridad
1. **Galería de imágenes** — Para eventos
2. **Noticias por categoría** — Cultura, Educación, Infraestructura, Salud
3. **Buscar en sitio** — Feature de búsqueda
4. **Forms de contacto** — Con validación

### Baja Prioridad
1. **Newsletter** — Suscripción
2. **Estadísticas** — Vistas de contenido
3. **Multimedia** — Videos YouTube/Vimeo

---

## Stack Tecnológico

| Componente | Tecnología |
|------------|-------------|
| Framework | Laravel 12 |
| Admin Panel | Filament v5 |
| PHP | ^8.2 |
| Database | MySQL/PostgreSQL |
| CSS | Tailwind CSS v4 |
| Editor | Tiptap |
| Auth | Filament Shield |
| Media | Spatie Media Library |
| SEO | arstenl/fixture-seo |
| Backup | Spatie Backup |
| Maps | — |

---

## Herramientas Recomendadas

| Herramienta | Propósito |
|------------|----------|
| **Laragon** | Entorno de desarrollo Windows |
| **PHPStorm** | IDE con Laravel plugins |
| **Pest** | Testing framework |
| **Github Actions** | CI/CD |
| **Laravel Forge** | Deploy/server management |

---

## Tiempo Estimado Total

- **Tiempo mínimo**: 12 semanas
- **Con equipo**: 8 semanas (2 desarrolladores)

---

## Documentación de Referencia

| Recurso | URL |
|---------|-----|
| Laravel 12 | https://laravel.com/docs/12.x |
| Filament v5 | https://filamentphp.com/docs/filament |
| Filament Shield | https://github.com/bezhanelsing/shield |
| Spatie Media Library | https://spatie.be/docs/laravel-medialibrary |
| Tailwind CSS | https://tailwindcss.com/docs |
| Tiptap | https://tiptap.dev/docs |

---

*Documento creado para guía de migración*
*Fecha: Mayo 2026*
*Inspirado en: boilerplate4 roadmap structure*