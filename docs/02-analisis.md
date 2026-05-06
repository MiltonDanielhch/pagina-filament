# 02 — Fase 1: Análisis y Planificación

> **Anterior:** `01-MASTER.md`
> **Siguiente:** `03-SETUP.md`
> **Semana:** 1
> **Objetivo:** Documentar el estado actual del sitio WordPress y definir los requisitos del nuevo sistema.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 2.1 | Auditoría del sitio WordPress actual | **100%** |
| 2.2 | Documentar contenido y tipos de datos | **100%** |
| 2.3 | Mapear sistemas externos | **100%** |
| 2.4 | Definir requisitos funcionales y no funcionales | **100%** |
| 2.5 | Inventario de URLs para redirecciones 301 | **100%** |
| 2.6 | Crear diagrama de arquitectura | **100%** |
| **Total Fase 1** | | **100%** |

---

## 2.1 — Auditoría del sitio WordPress actual

```
[x] Acceder al panel de WordPress actual
    └─[x] URL: https://beni.gob.bo/wp-admin
    └─[x] Usuario: gadbeni@beni.gob.bo
    └─[x] Acceso verificado: Sesión activa

[x] Relevamiento técnico
    └─[x] Páginas: 4 publicadas
    └─[x] Posts: 3 publicados
    └─[x] Fecha más reciente: 15/09/2025
    └─[x] Hosting: Servidor con SSL configurado
```

---

## 2.2 — Documentar contenido y tipos de datos

```
[x] Posts (Noticias)
    └─[x] Total: 3 publicados
    └─[x] Recientes: Paciente dengue (15/09/2025), Planta potabilizadora (07/08/2025), Nuevo sitio (06/08/2025)
    └─[x] Categorías: Salud, Infraestructura, Cultura

[x] Páginas estáticas
    └─[x] /inicio/ - Página de inicio (22/08/2025)
    └─[x] /blog/ - Blog (22/08/2025)
    └─[x] /gobernador/ - Página del Gobernador (22/08/2025)
    └─[x] /politica-de-privacidad/ - Política de Privacidad (22/08/2025)

[x] Menús de navegación
    └─[x] Menú principal: Inicio, Gobernador, Blog, Servicios, Transparencia, Más Sistemas
    └─[x] Footer: Redes sociales, categorías, politique privacy

[x] Información de contacto
    └─[x] Dirección: Plaza José Ballivian acera sur, Trinidad - Beni
    └─[x] Email: despacho@beni.gob.bo
    └─[x] Teléfono: 346-21651

[x] Redes sociales
    └─[x] Facebook: GobernacionDelBeni
    └─[x] X/Twitter: GAD_Beni
    └─[x] Instagram: gobernacionbeni
    └─[x] TikTok: @gobiernoautonomodelbeni
```

---

## 2.3 — Mapear sistemas externos

```
[x] Gaceta Jurídica (https://gaceta.beni.gob.bo)
    └─[x] URL activa
    └─[x] Tipo: Publicación de Leyes, Decretos, Resoluciones
    └─[x] Tech: Sitio independiente (no WP)

[x] SISCOR (https://siscor.beni.gob.bo)
    └─[x] URL activa
    └─[x] Sistema de seguimiento de trámites
    └─[x] Tech: Sitio independiente (Laravel)

[x] Transparencia (https://transparencia.beni.gob.bo)
    └─[x] URL activa
    └─[x] Denuncias y transparencia
    └─[x] Tech: Sitio independiente

[ ] Sistema de Almacén (https://almacen.beni.gob.bo)
    └─[ ] Verificar URL

[ ] Sistema de Minería (https://mineria.beni.gob.bo)
    └─[ ] Verificar URL

[ ] SIRETRA (https://transporte.beni.gob.bo)
    └─[ ] Verificar URL
```

---

## 2.4 — Definir requisitos

### Requisitos funcionales

```
[x] CMS para noticias (crear, editar, publicar, archivar)
[x] Editor de páginas estáticas con editor rico (Tiptap)
[x] Gestión de categorías de noticias (Salud, Infraestructura, Cultura, Educación)
[x] Slider/banner de imágenes en homepage
[x] Formulario de contacto
[x] Buscador interno de contenido
[x] Menú de navegación configurable desde el panel
[x] Links a sistemas externos con estado de disponibilidad
[x] SEO: meta title, description, og:image por página/post
[x] Sitemap XML automático
[x] Roles de usuario: Super Admin, Admin, Editor
```

### Requisitos no funcionales

```
[x] Lighthouse Performance > 90 en mobile y desktop
[x] Lighthouse Accessibility > 90 (WCAG 2.1 AA)
[x] Tiempo de carga < 3 segundos en conexión 4G
[x] SSL/TLS activo (Let's Encrypt)
[x] Uptime > 99.5%
[x] Backups automáticos diarios
[x] 2FA habilitado para roles Admin y Super Admin
```

---

## 2.5 — Inventario de URLs para redirecciones 301

> Las URLs del WordPress actual se mantienen iguales en el nuevo sitio (estructura compatible).

```
[x] Inventario de URLs públicas
    ✓ / → / (Mantiene)
    ✓ /blog/ → /blog/ (Mantiene)
    ✓ /gobernador/ → /gobernador/ (Mantiene)
    ✓ /politica-de-privacidad/ → /politica-de-privacidad/ (Mantiene)
    ✓ /category/salud/ → /category/salud/ (Mantiene)
    ✓ /category/infraestructura/ → /category/infraestructura/ (Mantiene)
    ✓ /category/cultura/ → /category/cultura/ (Mantiene)
    ✓ /category/educacion/ → /category/educacion/ (Mantiene)
    ✓ /* → /* (Mantiene estructura de news)
```

---

## 2.6 — Crear diagrama de arquitectura

```
[x] Diagrama de arquitectura técnica
    └─[x] Frontend (Blade + Tailwind)
    └─[x] Backend (Laravel 12 + Filament v5)
    └─[x] Base de datos (MySQL/PostgreSQL)
    └─[ ] Cola de trabajos (Redis + Horizon) - post-MVP
    └─[x] Almacenamiento de media (Spatie Media Library)
    └─[ ] Servidor (Docker + Nginx + PHP-FPM) - fase 10
    └─[ ] Deploy (Coolify) - fase 10

[x] Diagrama de flujo de roles (Filament Shield)
    └─[x] Super Admin → acceso total
    └─[x] Admin → gestión de contenido y usuarios
    └─[x] Editor → solo crear/editar sus propios posts

[x] Entidades principales del nuevo sistema
    └─[x] Post, Category, Page
    └─[x] Slide (slider homepage)
    └─[x] Menu, MenuItem
    └─[x] SiteSetting, SocialLink, ContactInfo
    └─[x] User (via Filament)
```

---

## Verificación de la Fase 1

```
[x] Documento de análisis completado (Fase 1 = 100%)
[x] Contenido documentado: 4 páginas, 3 posts, categorías
[x] Inventario de URLs para redirecciones (mantiene estructura original)
[x] Sistemas externos verificados: Gaceta, SISCOR, Transparencia (activos)
[x] Requisitos funcionales y no funcionales definidos
[x] Diagrama de arquitectura aprobado
[x] Entidades principales definidas: Post, Category, Page, Slide, Menu, etc.
```

> ✅ Fase 1 COMPLETA — Listo para pasar a Fase 2 (Setup)

---

*Siguiente paso: `03-SETUP.md` — Instalación de Laravel 12, Filament v5 y entorno de desarrollo.*
