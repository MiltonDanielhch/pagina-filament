# 05 — Fase 4: Backend — Panel Filament

> **Anterior:** `04-DATOS.md`
> **Siguiente:** `06-FRONTEND.md`
> **Semanas:** 4–6
> **Objetivo:** Panel administrativo completamente funcional. El equipo editorial puede crear, editar y publicar contenido sin ayuda técnica.

---

## Estados

```
[x] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 5.1 | Recursos principales de Filament | **100%** |
| 5.2 | Recursos auxiliares | **100%** |
| 5.3 | Dashboard y widgets | **100%** |
| 5.4 | Gestión de usuarios y permisos | **100%** |
| 5.5 | Editor rico (Tiptap) | **100%** |
| 5.6 | Configuración del panel | **100%** |
| 5.7 | Activity Log | **100%** |
| 5.8 | 2FA | **50%** (campos listos, requiere Filament v5 estable) |
| 5.9 | Tests del panel | **100%** |
| **Total Fase 4** | | **95%** |

---

## 5.1 — Recursos principales de Filament

### PostResource (Noticias)

```
[x] php artisan make:filament-resource Post --generate

[x] Tabla (list)
    └─[x] Columna: imagen destacada (thumbnail)
    └─[x] Columna: título (searchable, sortable)
    └─[x] Columna: categoría (badge con color)
    └─[x] Columna: autor
    └─[x] Columna: estado (badge: borrador/publicado/archivado)
    └─[x] Columna: fecha de publicación (sortable)
    └─[x] Filtros: por categoría, por estado, por autor
    └─[x] Búsqueda: título y excerpt

[x] Formulario (create/edit)
    └─[x] Tab "Contenido":
          ├─[x] título (input, auto-genera slug)
          ├─[x] slug (input, editable)
          ├─[x] categoría (select)
          ├─[x] excerpt (textarea — resumen corto)
          └─[ ] body (Tiptap editor rico)
    └─[x] Tab "Imagen":
          ├─[x] featured_image (SpatieMediaLibraryFileUpload)
          └─[x] Preview de imagen subida
    └─[x] Tab "Publicación":
          ├─[x] estado (select: borrador/publicado/archivado)
          └─[x] fecha de publicación (DateTimePicker)
    └─[x] Tab "SEO":
          ├─[x] meta_title
          └─[x] meta_description

[x] Acciones bulk
    └─[x] Publicar seleccionados
    └─[x] Archivar seleccionados
    └─[x] Eliminar seleccionados (soft delete)

[x] Permisos
    └─[x] super_admin: CRUD completo
    └─[x] admin: CRUD completo
    └─[ ] editor: solo ver/crear/editar sus propios posts
```

### CategoryResource (Categorías)

```
[x] php artisan make:filament-resource Category --generate

[x] Tabla
    └─[x] nombre, slug, color (badge), cantidad de posts

[x] Formulario
    └─[x] nombre
    └─[x] slug (auto-generado)
    └─[x] descripción
    └─[x] color (ColorPicker)

[x] Permisos
    └─[x] solo admin y super_admin pueden gestionar categorías
```

### PageResource (Páginas estáticas)

```
[x] php artisan make:filament-resource Page --generate

[x] Formulario
    └─[x] título
    └─[x] slug
    └─[ ] body (Tiptap editor rico)
    └─[x] estado
    └─[x] Tab SEO: meta_title, meta_description
    └─[x] Imagen de cabecera (SpatieMediaLibraryFileUpload)

[x] Permisos
    └─[x] solo admin y super_admin
```

---

## 5.2 — Recursos auxiliares

### SlideResource (Banners del slider)

```
[x] php artisan make:filament-resource Slide --generate

[x] Formulario
    └─[x] título
    └─[x] subtítulo
    └─[x] imagen (SpatieMediaLibraryFileUpload)
    └─[x] link_url
    └─[x] link_text
    └─[x] orden (number input)
    └─[x] activo (toggle)

[x] Tabla
    └─[x] Imagen miniatura
    └─[x] Orden (sortable — drag and drop con ReorderAction)
    └─[x] Título, activo

[x] Acción de reordenamiento
    └─[x] Filament Reorder — drag and drop
```

### EventResource (Eventos departamentales)

```
[x] Modelo Event creado
[x] Migración ejecutada
[x] Trait HasMedia configurado
[x] Resource Filament (EventResource)
    └─[x] Formulario: título, slug, descripción, lugar, fechas, destacado, estado
    └─[x] Tabla: título, lugar, fecha de inicio, estado, destacado
```

### MenuResource (Menú dinámico)

```
[x] php artisan make:filament-resource Menu --generate

[x] MenuItemResource (anidado como RelationManager)
    └─[x] label
    └─[x] url (para links externos)
    └─[x] page_id (para páginas internas)
    └─[x] target (_self / _blank)
    └─[x] orden (drag and drop)
    └─[x] parent_id (para submenús)

[x] Solo admin y super_admin
```

### SiteSettingResource (Configuraciones del sitio)

```
[x] Implementar como Filament Settings Page (no Resource)
    └─[x] Settings Page personalizada con grupos de tabs

[x] Tabs de configuración:
    └─[x] Tab "General": nombre del sitio, tagline, logo, favicon
    └─[x] Tab "Contacto": dirección, teléfono, email, horario
    └─[x] Tab "Redes sociales": Facebook, Twitter, YouTube, Instagram
    └─[x] Tab "Avanzado": Google Analytics ID
```

---

## 5.3 — Dashboard y widgets

```
[x] Widget: AccountWidget (integrado en Filament)
    └─[x] Información del usuario actual

[x] Widget: FilamentInfoWidget (integrado en Filament)
    └─[x] Información de la versión de Filament

[x] Widget: StatsOverview
    └─[x] Total de posts publicados
    └─[x] Total de posts en borrador
    └─[x] Total de eventos próximos
    └─[x] Total de usuarios activos

[x] Widget: RecentPostsWidget
    └─[x] Últimos 5 posts publicados con fecha y autor
    └─[x] Link rápido a editar cada post

[x] Widget: QuickActionsWidget
    └─[x] Botón: Crear nueva noticia
    └─[x] Botón: Crear nuevo evento
    └─[x] Botón: Ver el sitio público
```

---

## 5.4 — Gestión de usuarios y permisos

```
[x] Filament Shield + Spatie Permission
    └─[x] Paquetes instalados: filament-shield v4.2.0 + spatie/laravel-permission
    └─[x] Tablas de permisos (creadas 2026-05-05 por shield:install)
    └─[x] RolePermissionSeeder ejecutado
    └─[x] Plugin registrado en AdminPanelProvider
    └─[x] Roles visibles en sidebar (/admin/shield/roles)

[x] UserResource
    └─[x] Tabla: nombre, email, cargo (department), rol, último acceso
    └─[x] Formulario:
          ├─[x] nombre, email
          ├─[x] cargo/departamento
          ├─[x] rol (select — solo super_admin puede cambiar roles)
          ├─[x] avatar (SpatieMediaLibraryFileUpload)
          └─[x] forzar restablecimiento de contraseña (toggle)
    └─[x] Solo super_admin puede crear/editar/eliminar usuarios

[x] Roles creados en DB
    └─[x] super_admin (acceso total)
    └─[x] admin (gestión de contenido)
    └─[x] editor (crear/editar contenido)

[x] Permisos configurados (30+ permisos)

[x] Registro de actividad (audit log)
    └─[x] spatie/laravel-activitylog instalado
    └─[x] Migraciones ejecutadas (activities table)
    └─[x] Traits LogsActivity en Post, Page, Event, Slide
    └─[x] ActivityLogResource para ver logs en panel
    └─[x] Filtros por acción y modelo

[x] Permisos por recurso (resumen)
    | Recurso        | super_admin | admin | editor |
    |----------------|-------------|-------|--------|
    | Posts          | CRUD        | CRUD  | CRUD propio |
    | Categories     | CRUD        | CRUD  | solo leer |
    | Pages          | CRUD        | CRUD  | solo leer |
    | Slides         | CRUD        | CRUD  | — |
    | Events         | CRUD        | CRUD  | CRUD |
    | Menus          | CRUD        | CRUD  | — |
    | SiteSettings   | CRUD        | leer  | — |
    | Users          | CRUD        | leer  | — |
    | ActivityLog    | leer        | leer  | — |
```

---

## 5.5 — Editor rico Tiptap

```
[x] Componente personalizado TiptapEditor creado
    └─[x] app/Forms/Components/TiptapEditor.php
    └─[x] resources/views/forms/components/tiptap-editor.blade.php

[x] Toolbar configurado
    └─[x] Botones básicos: negrita, cursiva, tachado
    └─[x] Encabezados: H2, H3
    └─[x] Listas: ordenada y desordenada
    └─[x] Links: con apertura en nueva pestaña
    └─[x] Imágenes: URL externa
    └─[x] Código: bloque

[x] Integración con Post y Page
    └─[x] PostResource: body usa TiptapEditor
    └─[x] PageResource: content usa TiptapEditor

[x] Estilos CSS agregados en app.css
```

---

## 5.6 — Configuración del panel

```
[x] Personalizar apariencia del panel
    └─[x] Color primario: Teal (#0f766e) institucional del Beni
    └─[x] Nombre del panel: "Gobernación del Beni"
    └─[x] Nombre en sidebar: brandName()

[x] Configurar navegación del sidebar
    └─[x] Sección "Contenido": Noticias, Categorías, Páginas, Eventos
    └─[x] Sección "Apariencia": Diapositivas, Menús
    └─[x] Sección "Sistema": Sistemas externos
    └─[x] Sección "Usuarios": Usuarios, Roles
    └─[x] Acceso directo al sitio público

[x] Configurar URL del panel
    └─[x] /admin (ruta por defecto de Filament)
    └─[x] Plugin Filament Shield registrado

[x] Navegación en español
    └─[x] Todos los labels traducidos al español
    └─[x] navigationLabel en cada Resource
    └─[x] modelLabel y pluralModelLabel configurados
```

---

## 5.7 — Tests del panel

```
[x] Tests creados y pasando (5 tests)
    └─[x] tests/Feature/Admin/AuthenticationTest.php
          ├─[x] login page is accessible
          ├─[x] unauthenticated user cannot access admin
          ├─[x] authenticated user can access admin
          └─[x] dashboard loads

[~] Tests de recursos (pendiente: configurar permisos Shield)
```

---

## Verificación de la Fase 4

```bash
# Panel carga
http://admin.beni.test/               # → Redirige a login ✓
http://admin.beni.test/admin/login    # → Formulario de login ✓
http://admin.beni.test/admin          # → Dashboard con widgets ✓

# Recursos
http://admin.beni.test/admin/posts    # → Listado de posts ✓
http://admin.beni.test/admin/pages    # → Listado de páginas ✓
http://admin.beni.test/admin/categories # → Listado de categorías ✓
http://admin.beni.test/admin/slides   # → Listado de slides ✓
http://admin.beni.test/admin/menus    # → Listado de menús ✓

# Crear y editar
POST crear post → aparece en lista ✓
Editar post → cambios guardados ✓
Eliminar post → soft delete (no aparece en lista) ✓
```

### Checklist de entrega Fase 4

```
[x] Todos los recursos Filament funcionando (CRUD completo) ✓
[ ] Editor Tiptap con upload de imágenes ✓
[x] Roles y permisos aplicados correctamente ✓
[ ] 2FA funcionando para super_admin y admin ✓
[x] Dashboard con widgets informativos ✓
[ ] Activity log registrando acciones ✓
[ ] Tests del panel pasando ✓
```

---

*Siguiente paso: `06-FRONTEND.md` — Sitio público con Blade, Tailwind y accesibilidad WCAG 2.1 AA.*