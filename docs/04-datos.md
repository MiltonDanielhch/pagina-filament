# 04 — Fase 3: Estructura de Datos

> **Anterior:** `03-SETUP.md`
> **Siguiente:** `05-BACKEND.md`
> **Semanas:** 3–4
> **Objetivo:** Modelos, migraciones, relaciones y seeds listos. La base de datos refleja fielmente los tipos de contenido del sitio.

---

## Estados

```
[x] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 4.1 | Modelos y migraciones principales | **100%** |
| 4.2 | Modelos auxiliares | **100%** |
| 4.3 | Relaciones y traits | **100%** |
| 4.4 | Seeders y datos de prueba | **100%** |
| 4.5 | Configuración de Spatie Media Library | **100%** |
| **Total Fase 3** | | **100%** |

---

## 4.1 — Modelos y migraciones principales

### Usuarios (extendido)

```
[x] Migración: users
    └─[x] id, name, email, password
    └─[x] email_verified_at
    └─[x] department (varchar — cargo en la gobernación)
    └─[x] avatar (string nullable)
    └─[x] two_factor_secret, two_factor_recovery_codes
    └─[x] softDeletes
    └─[x] timestamps

[x] Modelo: User
    └─[x] Trait: HasRoles (Filament Shield)
    └─[x] Trait: SoftDeletes
    └─[x] Relación: hasMany(Post::class)
    └─[ ] Relación: hasMany(Activity::class) — audit log
```

### Noticias / Posts

```
[x] Migración: posts
    └─[x] id
    └─[x] user_id (FK → users)
    └─[x] category_id (FK → categories)
    └─[x] title (string)
    └─[x] slug (string, unique)
    └─[x] excerpt (text nullable)
    └─[x] body (longText)
    └─[x] featured_image (string nullable — via Spatie)
    └─[x] status (enum: draft, published, archived)
    └─[x] published_at (timestamp nullable)
    └─[x] meta_title (string nullable)
    └─[x] meta_description (text nullable)
    └─[x] softDeletes
    └─[x] timestamps

[x] Modelo: Post
    └─[x] Trait: SoftDeletes
    └─[x] Trait: HasMedia (Spatie)
    └─[x] Trait: HasSlug (spatie/laravel-sluggable)
    └─[x] Scope: published() → where status = 'published'
    └─[x] Scope: byCategory($id)
    └─[x] Relación: belongsTo(Category::class)
    └─[x] Relación: belongsTo(User::class)
    └─[x] Relación: morphMany(Media::class) — Spatie
```

### Categorías

```
[x] Migración: categories
    └─[x] id
    └─[x] name (string)
    └─[x] slug (string, unique)
    └─[x] description (text nullable)
    └─[x] color (string nullable — para badges de UI)
    └─[x] timestamps

[x] Modelo: Category
    └─[x] Relación: hasMany(Post::class)
    └─[x] Trait: HasSlug

[x] Categorías base a seedear
    └─[x] Cultura
    └─[x] Educación
    └─[x] Infraestructura
    └─[x] Salud
    └─[x] Gobierno
    └─[x] Medio Ambiente
```

### Páginas estáticas

```
[x] Migración: pages
    └─[x] id
    └─[x] title (string)
    └─[x] slug (string, unique)
    └─[x] body (longText)
    └─[x] status (enum: draft, published)
    └─[x] meta_title (string nullable)
    └─[x] meta_description (text nullable)
    └─[x] softDeletes
    └─[x] timestamps

[x] Modelo: Page
    └─[x] Trait: SoftDeletes, HasMedia, HasSlug
    └─[x] Scope: published()

[x] Páginas base a seedear
    └─[x] sobre-nosotros
    └─[x] gobernador
    └─[x] mision-vision
    └─[x] contacto
    └─[x] politica-de-privacidad
```

---

## 4.2 — Modelos auxiliares

### Slides / Banners

```
[x] Migración: slides
    └─[x] id
    └─[x] title (string)
    └─[x] subtitle (string nullable)
    └─[x] link_url (string nullable)
    └─[x] link_text (string nullable)
    └─[x] order (integer, default 0)
    └─[x] is_active (boolean, default true)
    └─[x] timestamps

[x] Modelo: Slide
    └─[x] Trait: HasMedia
    └─[x] Scope: active()
    └─[x] Ordenado por: order ASC
```

### Eventos

```
[x] Migración: events
    └─[x] id
    └─[x] title (string)
    └─[x] slug (string, unique)
    └─[x] description (longText)
    └─[x] location (string nullable)
    └─[x] starts_at (datetime)
    └─[x] ends_at (datetime nullable)
    └─[x] is_featured (boolean, default false)
    └─[x] status (enum: draft, published)
    └─[x] timestamps

[x] Modelo: Event
    └─[x] Trait: HasMedia, HasSlug
    └─[x] Scope: upcoming() → starts_at >= now()
    └─[x] Scope: published()
```

### Menú de navegación

```
[x] Migración: menus
    └─[x] id
    └─[x] name (string — ej: "Principal", "Footer")
    └─[x] location (string unique — ej: "header", "footer")
    └─[x] timestamps

[x] Migración: menu_items
    └─[x] id
    └─[x] menu_id (FK → menus)
    └─[x] parent_id (FK → menu_items, nullable — para submenús)
    └─[x] label (string)
    └─[x] url (string nullable — para links externos)
    └─[x] page_id (FK → pages, nullable)
    └─[x] order (integer, default 0)
    └─[x] target (enum: _self, _blank, default _self)
    └─[x] timestamps

[x] Modelo: Menu
    └─[x] Relación: hasMany(MenuItem::class)

[x] Modelo: MenuItem
    └─[x] Relación: belongsTo(Menu::class)
    └─[x] Relación: hasMany(MenuItem::class) — hijos
    └─[x] Relación: belongsTo(MenuItem::class, 'parent_id') — padre
    └─[x] Ordenado por: order ASC
```

### Configuraciones del sitio

```
[x] Migración: site_settings
    └─[x] id
    └─[x] key (string, unique)
    └─[x] value (longText nullable)
    └─[x] type (enum: text, textarea, image, boolean)
    └─[x] group (string — ej: "general", "contact", "social")
    └─[x] timestamps

[x] Modelo: SiteSetting
    └─[x] Helper estático: SiteSetting::get('key')
    └─[x] Caché automático por clave

[x] Settings base a seedear (group: general)
    └─[x] site_name → "Gobernación del Beni"
    └─[x] site_tagline → "Gobernación Autónoma Departamental del Beni"
    └─[x] site_logo → (imagen)
    └─[x] site_favicon → (imagen)
    └─[x] google_analytics_id → (vacío)

[x] Settings base a seedear (group: contact)
    └─[x] contact_address → "Trinidad, Beni, Bolivia"
    └─[x] contact_phone → (número)
    └─[x] contact_email → (correo institucional)
    └─[x] contact_hours → (horario de atención)

[x] Settings base a seedear (group: social)
    └─[x] social_facebook → (URL)
    └─[x] social_twitter → (URL)
    └─[x] social_youtube → (URL)
    └─[x] social_instagram → (URL)
```

---

## 4.3 — Relaciones y traits

```
[x] Verificar relaciones entre modelos
    └─[x] Post → belongsTo Category ✓
    └─[x] Post → belongsTo User (autor) ✓
    └─[x] Category → hasMany Post ✓
    └─[x] Post → morphMany Media (Spatie) ✓
    └─[x] Page → morphMany Media (Spatie) ✓
    └─[x] Slide → morphMany Media (Spatie) ✓
    └─[x] Event → morphMany Media (Spatie) ✓
    └─[x] Menu → hasMany MenuItem ✓
    └─[x] MenuItem → hasMany MenuItem (hijos) ✓

[x] Soft deletes en todos los modelos principales
    └─[x] User: softDeletes ✓
    └─[x] Post: softDeletes ✓
    └─[x] Page: softDeletes ✓
    └─[x] Event: softDeletes ✓

[x] Trait HasSeo (personalizado)
    └─[x] Campos: meta_title, meta_description, og_image
    └─[x] Método: getSeoTitle() → meta_title ?? title
    └─[x] Método: getSeoDescription() → meta_description ?? excerpt
    └─[x] Aplicar a: Post, Page, Event
```

---

## 4.4 — Seeders y datos de prueba

```
[x] DatabaseSeeder.php — orquestar en este orden:
    1. RoleSeeder (roles y permisos)
    2. UserSeeder (super_admin + usuarios de prueba)
    3. CategorySeeder (6 categorías base)
    4. SiteSettingSeeder (configuraciones iniciales)
    5. MenuSeeder (menú principal y footer)
    6. PostSeeder (20 posts de prueba con Factory)
    7. PageSeeder (páginas base)
    8. SlideSeeder (3 slides de prueba)

[x] Factories
    └─[x] PostFactory — genera posts con contenido Lorem + slugs
    └─[x] EventFactory — genera eventos con fechas futuras/pasadas
    └─[x] UserFactory — ya existe en Laravel, extender con department
```

---

## 4.5 — Configuración de Spatie Media Library

```
[x] Publicar configuración
    └─ php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"

[x] Migración de media
    └─ php artisan vendor:publish --tag="medialibrary-migrations"
    └─ php artisan migrate

[x] Configurar conversiones de imagen en cada modelo con HasMedia
    └─[x] thumb: 150×150, crop
    └─[x] medium: 600×400, fit
    └─[x] large: 1200×800, fit
    └─[x] og: 1200×630 (para Open Graph)

[x] Configurar conversiones WebP
    └─[x] Habilitar en config/media-library.php
    └─[x] image_driver: 'gd' o 'imagick' (verificar disponibilidad)

[x] Disco de almacenamiento
    └─[x] En desarrollo: local (public disk)
    └─[x] En producción: local o S3 compatible (según infraestructura)
```

---

## Verificación de la Fase 3

```bash
# Migraciones
php artisan migrate:status          # → Todas las migraciones aplicadas ✓
php artisan migrate:fresh --seed    # → DB poblada sin errores ✓

# Modelos
php artisan model:show Post         # → Relaciones y campos visibles ✓
php artisan model:show Category     # → hasMany Posts visible ✓

# Media
php artisan storage:link            # → Storage público enlazado ✓

# Tests
php artisan test                    # → All tests passing ✓
```

### Checklist de entrega Fase 3

```
[x] Todas las migraciones aplicadas sin errores ✓
[x] Seeders corriendo correctamente ✓
[x] Factories generando datos de prueba ✓
[x] Spatie Media Library configurado con conversiones ✓
[x] Relaciones entre modelos verificadas con artisan ✓
[x] Tests de modelos pasando ✓
```

---

*Siguiente paso: `05-BACKEND.md` — Panel de administración Filament con todos los recursos.*
