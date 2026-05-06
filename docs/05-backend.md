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
| 5.1 | Recursos principales de Filament | **90%** |
| 5.2 | Recursos auxiliares | **60%** |
| 5.3 | Dashboard y widgets | **30%** |
| 5.4 | Gestión de usuarios y permisos | **80%** |
| 5.5 | Editor rico (Tiptap) | **0%** |
| 5.6 | Configuración del panel | **70%** |
| 5.7 | Tests del panel | **0%** |
| **Total Fase 4** | | **50%** |

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
[ ] php artisan make:filament-resource Menu --generate

[ ] MenuItemResource (anidado como RelationManager)
    └─[ ] label
    └─[ ] url (para links externos)
    └─[ ] page_id (para páginas internas)
    └─[ ] target (_self / _blank)
    └─[ ] orden (drag and drop)
    └─[ ] parent_id (para submenús)

[ ] Solo admin y super_admin
```

### SiteSettingResource (Configuraciones del sitio)

```
[x] Implementar como Filament Settings Page (no Resource)
    └─[ ] composer require filament/spatie-laravel-settings-plugin (si disponible)
    └─[x] O usar Settings Page personalizada con grupos de tabs

[x] Tabs de configuración:
    └─[x] Tab "General": nombre del sitio, tagline, logo, favicon
    └─[x] Tab "Contacto": dirección, teléfono, email, horario
    └─[x] Tab "Redes sociales": Facebook, Twitter, YouTube, Instagram
    └─[ ] Tab "Avanzado": Google Analytics ID, código de seguimiento
```

---

## 5.3 — Dashboard y widgets

```
[x] Widget: AccountWidget (integrado en Filament)
    └─[x] Información del usuario actual

[x] Widget: FilamentInfoWidget (integrado en Filament)
    └─[x] Información de la versión de Filament

[ ] Widget: StatsOverview
    └─[ ] Total de posts publicados
    └─[ ] Total de posts en borrador
    └─[ ] Total de eventos próximos
    └─[ ] Total de usuarios activos

[ ] Widget: RecentPostsWidget
    └─[ ] Últimos 5 posts publicados con fecha y autor
    └─[ ] Link rápido a editar cada post

[ ] Widget: SystemStatusWidget
    └─[ ] Estado de los sistemas externos (health checks)
    └─[ ] Indicador verde/rojo por sistema

[ ] Widget: QuickActionsWidget
    └─[ ] Botón: Crear nueva noticia
    └─[ ] Botón: Crear nuevo evento
    └─[ ] Botón: Ver el sitio público
```

---

## 5.4 — Gestión de usuarios y permisos

```
[x] UserResource
    └─[x] Tabla: nombre, email, cargo (department), rol, último acceso
    └─[x] Formulario:
          ├─[x] nombre, email
          ├─[x] cargo/departamento
          ├─[x] rol (select — solo super_admin puede cambiar roles)
          ├─[x] avatar (SpatieMediaLibraryFileUpload)
          └─[x] forzar restablecimiento de contraseña (toggle)
    └─[x] Solo super_admin puede crear/editar/eliminar usuarios

[ ] Registro de actividad (audit log)
    └─[ ] Activar spatie/laravel-activitylog en Post, Page, Event, Slide
    └─[ ] Widget en dashboard: últimas 10 acciones del sistema
    └─[ ] Página de logs: filtrar por modelo, usuario y fecha

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
[ ] Instalar plugin Tiptap para Filament
    └─[ ] composer require awcodes/filament-tiptap-editor
    └─[ ] php artisan vendor:publish --tag=filament-tiptap-editor-config
    └─[ ] npm install (dependencias JS del editor)

[ ] Configurar toolbar
    └─[ ] Botones básicos: negrita, cursiva, subrayado, tachado
    └─[ ] Encabezados: H2, H3, H4
    └─[ ] Listas: ordenada y desordenada
    └─[ ] Links: con apertura en nueva pestaña
    └─[ ] Imágenes: upload con Spatie Media Library
    └─[ ] Tablas: insertar y editar
    └─[ ] Alineación de texto
    └─[ ] Código: inline y bloque
    └─[ ] Limpiar formato

[ ] Upload de imágenes dentro del editor
    └─[ ] Configurar disk y path de almacenamiento
    └─[ ] Límite de tamaño: 5 MB por imagen
    └─[ ] Formatos aceptados: jpg, png, webp, gif
```

---

## 5.6 — Configuración del panel

```
[x] Personalizar apariencia del panel
    └─[x] Color primario: verde/azul institucional del Beni
    └─[x] Logo de la gobernación en el sidebar
    └─[x] Favicon institucional
    └─[x] Nombre del panel: "Panel Administrativo — Gobernación del Beni"

[x] Configurar navegación del sidebar
    └─[x] Sección "Contenido": Posts, Categorías, Páginas, Eventos
    └─[x] Sección "Apariencia": Slides, Menús
    └─[x] Sección "Configuración": Ajustes del sitio
    └─[x] Sección "Usuarios": Usuarios, Actividad
    └─[x] Acceso directo al sitio público (link externo)

[x] Configurar URL del panel
    └─[x] /admin (ruta por defecto de Filament)
    └─[ ] Solo accesible desde IPs autorizadas (opcional en producción)
```

---

## 5.7 — Tests del panel

```
[ ] Feature tests por recurso
    └─[ ] PostResourceTest
          ├─[ ] un editor puede crear un post
          ├─[ ] un editor no puede publicar directamente (si aplica)
          ├─[ ] un admin puede publicar un post
          ├─[ ] un post publicado aparece en la lista
          └─[ ] eliminar un post hace soft delete
    └─[ ] CategoryResourceTest
          ├─[ ] un admin puede crear una categoría
          └─[ ] un editor no puede crear categorías
    └─[ ] PageResourceTest
          └─[ ] un admin puede editar una página estática

[ ] Test del formulario de login
    └─[ ] Login con credenciales correctas → redirige al dashboard
    └─[ ] Login con credenciales incorrectas → error visible
    └─[ ] Login sin 2FA (si está habilitado) → pide código
```
[ ] Instalar plugin Tiptap para Filament
    └─[ ] composer require awcodes/filament-tiptap-editor
    └─[ ] php artisan vendor:publish --tag=filament-tiptap-editor-config
    └─[ ] npm install (dependencias JS del editor)

[ ] Configurar toolbar
    └─[ ] Botones básicos: negrita, cursiva, subrayado, tachado
    └─[ ] Encabezados: H2, H3, H4
    └─[ ] Listas: ordenada y desordenada
    └─[ ] Links: con apertura en nueva pestaña
    └─[ ] Imágenes: upload con Spatie Media Library
    └─[ ] Tablas: insertar y editar
    └─[ ] Alineación de texto
    └─[ ] Código: inline y bloque
    └─[ ] Limpiar formato

[ ] Upload de imágenes dentro del editor
    └─[ ] Configurar disk y path de almacenamiento
    └─[ ] Límite de tamaño: 5 MB por imagen
    └─[ ] Formatos aceptados: jpg, png, webp, gif
```

---

## 5.6 — Configuración del panel

```
[ ] Personalizar apariencia del panel
    └─[ ] Color primario: verde/azul institucional del Beni
    └─[ ] Logo de la gobernación en el sidebar
    └─[ ] Favicon institucional
    └─[ ] Nombre del panel: "Panel Administrativo — Gobernación del Beni"

[ ] Configurar navegación del sidebar
    └─[ ] Sección "Contenido": Posts, Categorías, Páginas, Eventos
    └─[ ] Sección "Apariencia": Slides, Menús
    └─[ ] Sección "Configuración": Ajustes del sitio
    └─[ ] Sección "Usuarios": Usuarios, Actividad
    └─[ ] Acceso directo al sitio público (link externo)

[ ] Configurar URL del panel
    └─[ ] /admin (ruta por defecto de Filament)
    └─[ ] Solo accesible desde IPs autorizadas (opcional en producción)
```

---

## 5.7 — Tests del panel

```
[ ] Feature tests por recurso
    └─[ ] PostResourceTest
          ├─[ ] un editor puede crear un post
          ├─[ ] un editor no puede publicar directamente (si aplica)
          ├─[ ] un admin puede publicar un post
          ├─[ ] un post publicado aparece en la lista
          └─[ ] eliminar un post hace soft delete
    └─[ ] CategoryResourceTest
          ├─[ ] un admin puede crear una categoría
          └─[ ] un editor no puede crear categorías
    └─[ ] PageResourceTest
          └─[ ] un admin puede editar una página estática

[ ] Test del formulario de login
    └─[ ] Login con credenciales correctas → redirige al dashboard
    └─[ ] Login con credenciales incorrectas → error visible
    └─[ ] Login sin 2FA (si está habilitado) → pide código
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

---

*Siguiente paso: `06-FRONTEND.md` — Sitio público con Blade, Tailwind y accesibilidad WCAG 2.1 AA.*
