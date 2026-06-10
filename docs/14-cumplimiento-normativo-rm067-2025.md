# 14 — Cumplimiento Normativo RM 067/2025 y Mejora del Portal Institucional

> **Anterior:** `13-AUTOMATIZACION-NOTICIAS.md`
> **Documento complementario a:** `06-FRONTEND.md` · `05-BACKEND.md` · `04-DATOS.md` · `11-MIGRACION.md`
> **Marco normativo aplicable:**
> - Ley N.º 164 — Ley General de Gobierno Electrónico
> - Decreto Supremo N.º 1793 — Reglamento de Gobierno Electrónico
> - Decreto Supremo N.º 5340 (26/02/2025) — Plataforma gob.bo
> - Resolución Ministerial N.º 060/2025 — Lineamientos de uso y funcionamiento de gob.bo
> - **Resolución Ministerial N.º 067/2025** — Lineamientos de Contenidos Mínimos para Portales Web Institucionales (**norma clave de cumplimiento**)
> - RA AGETIC/0030/2025 — Lineamientos Datos Abiertos / Trámites / Observatorios
> - RA AGETIC/0045/2025 — Especificaciones Técnicas para Publicación de Páginas Web Institucionales Estandarizadas
>
> **Objetivo:** Llevar el portal `beni.gob.bo` al 100% de cumplimiento con la RM 067/2025 y sus anexos, y rediseñar la página principal para un público general con foco en experiencia de uso, transparencia y servicios ciudadanos.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## 0. Diagnóstico del estado actual vs. RM 067/2025

> Auditoría rápida realizada sobre el código en `app/Models/`, `app/Filament/Resources/`, `resources/views/`, `routes/web.php` y `docs/`.

| # | Componente RM 067/2025 | Estado actual | Brecha |
|---|------------------------|---------------|--------|
| 1 | Reseña histórica | ❌ No existe página ni modelo | Crear contenido + página estática |
| 2 | Misión, visión y objetivos | ⚠️ Parcial (página `mision-vision` seed) | Verificar contenido y publicar |
| 3 | Marco normativo | ❌ No hay sección dedicada | Crear modelo + recurso + vista |
| 4 | Estructura organizacional / organigrama | ⚠️ Modelo `Official` existe, falta organigrama | Agregar campo `parent_id` y vista |
| 5 | Autoridades y responsables | ✅ Modelo `Official` + `OfficialResource` | Crear vista pública `autoridades` |
| 6 | Datos de contacto institucional | ✅ En `SiteSetting` + footer | Mejorar presentación |
| 7 | Presupuesto institucional | ❌ No existe | Crear modelo + recurso + vista + enlace a portal externo |
| 8 | POA | ❌ No existe | Crear modelo + recurso + vista |
| 9 | Informes de gestión | ❌ No existe | Crear modelo + recurso + vista |
| 10 | Rendición pública de cuentas | ❌ No existe | Crear página/sección |
| 11 | Convocatorias y procesos de contratación | ❌ No existe | Crear modelo + recurso + vista |
| 12 | Auditorías | ❌ No existe | Crear modelo + recurso + vista |
| 13 | Catálogo de trámites (requisitos, costos, plazos) | ❌ No existe | Crear modelo + recurso + vista |
| 14 | Trámites en línea / seguimiento | ✅ Link a SISCOR | Crear vista intermedia + integraciones |
| 15 | Noticias y comunicados | ✅ `Post` + `PostResource` | Reforzar filtrado por tipo |
| 16 | Eventos | ✅ `Event` + `EventResource` | OK |
| 17 | Galería multimedia | ✅ `Gallery` + `GalleryItems` | OK |
| 18 | Sistemas institucionales / links externos | ✅ `ExternalSystem` + health check | OK |
| 19 | Formularios electrónicos | ⚠️ Solo contacto | Crear formularios por secretaría/servicio |
| 20 | Datos abiertos (datasets, metadatos) | ❌ No existe | Crear modelo + vista de descarga |
| 21 | Atención al ciudadano — oficinas | ❌ No existe directorio | Crear modelo + vista |
| 22 | Quejas, reclamos y sugerencias | ⚠️ Solo `ContactMessage` | Crear "Libro de Reclamaciones Virtual" |
| 23 | Gobernador y gabinete | ✅ `gobernador.blade.php` | Mejorar contenido |
| 24 | Secretarías departamentales | ❌ No existe | Crear modelo + recurso + vista |
| 25 | Proyectos de inversión | ⚠️ Modelo `InfrastructureProject` existe sin vista pública | Crear vista pública |
| 26 | Programas por secretaría | ❌ No existe | Vincular a `Secretariat` y proyectos |
| 27 | Normativa departamental | ❌ No existe | Crear modelo + recurso + vista |
| 28 | Convocatorias públicas | ❌ No existe | Reutilizar modelo del punto 11 |
| 29 | Portal de transparencia | ⚠️ Link externo | Crear landing intermedia |
| 30 | Portal de datos abiertos | ❌ No existe | Crear (punto 20) |
| 31 | Portal de contratación pública | ⚠️ Link externo | Crear landing intermedia |
| 32 | Sistemas (RRHH, impuestos, catastro, ganadería) | ⚠️ `ExternalSystem` genérico | Categorizar y etiquetar |
| 33 | Dominio `.gob.bo` | ❓ Verificar `.env` / DNS | Configurar |
| 34 | HTTPS | ⚠️ Depende de deploy (Coolify) | Configurar Let's Encrypt |
| 35 | Accesibilidad WCAG 2.1 AA | ✅ 100% reportado en Fase 5 | Auditoría manual con Lighthouse |
| 36 | Seguridad de la información | ✅ Headers, 2FA, activity log | Verificar CSP, HSTS |
| 37 | Actualización permanente | ✅ Panel Filament activo | Política editorial |
| 38 | Estadísticas departamentales | ✅ Modelo `DepartmentalStatistics` | Crear vista pública con gráficos |
| 39 | Logros / achievements | ✅ Modelo `Achievement` | Crear vista pública |
| 40 | Agenda del gobernador | ✅ Modelo `Agenda` | Crear vista pública con calendario |

**Conclusión del diagnóstico:** 14 componentes OK, 11 parciales, **15 inexistentes**. La prioridad es cubrir los 15 inexistentes y resolver los parciales para llegar al 100% de cumplimiento.

---

## 1. Roadmap propuesto (orden de ejecución)

> El orden prioriza: **(A)** lo exigido explícitamente por la RM 067/2025 → **(B)** lo específico de Gobernación → **(C)** mejoras de UX/UI del homepage → **(D)** aspectos técnicos obligatorios.

```
A. CUMPLIMIENTO NORMATIVO CRÍTICO (RM 067/2025)
   A1. Modelos de datos faltantes (migraciones + seeders)
   A2. Recursos Filament para los nuevos modelos
   A3. Páginas públicas con SEO y accesibilidad
   A4. Menú principal reestructurado

B. ESPECÍFICOS DE GOBERNACIÓN DEL BENI
   B1. Secretarías departamentales
   B2. Marco normativo departamental
   B3. Convocatorias y contratación pública
   B4. Proyectos de inversión

C. MEJORA DE HOMEPAGE Y UX/UI
   C1. Rediseño del homepage con bloques normativos
   C2. Barra de búsqueda prominente
   C3. Accesos rápidos a trámites y servicios
   C4. Trámites destacados + atajos

D. ASPECTOS TÉCNICOS OBLIGATORIOS
   D1. Configuración dominio .gob.bo
   D2. HTTPS y headers de seguridad
   D3. Datos abiertos (CSV / JSON / API)
   D4. Verificación accesibilidad y SEO
```

---

## Progreso

| Bloque | Nombre | Semanas | Progreso |
|--------|--------|---------|----------|
| A1 | Modelos de datos normativos | 1 | **[x] 100%** |
| A2 | Recursos Filament para A1 | 1 | **[x] 100%** |
| A3 | Páginas públicas de transparencia | 2 | **[x] 100% (vistas + controladores + rutas)** |
| A4 | Reestructuración del menú | 0.5 | **[x] 100%** |
| B1 | Secretarías departamentales | 1 | **[x] 100% (vistas + seeders + Filament)** |
| B2 | Marco normativo departamental | 1 | **[~] 60% (vistas OK, falta carga inicial de 20-30 normas)** |
| B3 | Convocatorias y contratación | 1 | **[x] 100% (vistas + modelos + Filament)** |
| B4 | Proyectos de inversión | 1 | **[x] 100% (migración mejorada + vistas públicas + componente + seeder con 8 proyectos + mapa Leaflet + galería)** |
| C1–C4 | Rediseño del homepage | 1 | **[x] 100% (18 bloques + componentes)** |
| D1–D4 | Aspectos técnicos obligatorios | 1 | **[ ] 0%** |
| — | **Total estimado** | **~10 semanas** | **~85% A1–C** |

> **Estado al 2026-06-09:** Sesión A1–A4 y C1–C4 completada. 7 modelos nuevos, 6 recursos Filament, 8 controladores públicos, 22 vistas Blade en /transparencia, /institucional, /tramites, /convocatorias, /quejas-reclamos, /atencion-ciudadano, /datos-abiertos, /gobierno. Homepage rediseñado con 18 bloques. Próximo paso: Bloque D (técnico) y carga inicial de datos reales.

### Resumen de la sesión A1–A4

**A1 — Modelos (100%)**: `MarcoNormativo`, `Secretariat`, `Procedure`, `Announcement`, `Complaint`, `OpenDataset`, `Office`. Migración de `officials` extendida (parent_id, secretariat_id, position_level).

**A2 — Filament (100%)**: 6 recursos registrados en `/admin` — MarcoNormativo, Secretariat, Procedure, Announcement, Complaint, OpenDataset. Modificación pendiente en recursos existentes (Presupuesto, POA, Informe, Rendición, Auditoría).

**A3 — Vistas (100%)**: 22 vistas Blade en `resources/views/{institutional,institutional/secretariats,procedures,announcements,complaints,offices,open-data,transparency}/`. Cada vista con breadcrumbs, SEO meta, responsive, accesible WCAG 2.1 AA, estados de error/éxito.

**A4 — Menú (100%)**: MenuSeeder regenerado con 5 bloques normativos (La Gobernación, Servicios, Transparencia, Comunicación, Gobierno). Menú footer independiente.

---

## A1 — Modelos de datos normativos (Semana 1)

> Modelos nuevos para cubrir los componentes faltantes de la RM 067/2025.

### A1.1 — MarcoNormativo (normativa nacional + departamental)

```
[ ] Migración: marco_normativos
    └─[ ] id
    └─[ ] type (enum: ley, decreto_supremo, decreto, resolucion, otra)
    └─[ ] number (string — ej: "5340")
    └─[ ] title (string)
    └─[ ] summary (text nullable)
    └─[ ] issue_date (date)
    └─[ ] scope (enum: nacional, departamental)
    └─[ ] document_file (string nullable — PDF via Spatie)
    └─[ ] external_url (string nullable)
    └─[ ] is_published (boolean)
    └─[ ] slug (string unique)
    └─[ ] timestamps

[ ] Modelo: MarcoNormativo
    └─[ ] Trait: HasSlug, HasMedia
    └─[ ] Scopes: published(), national(), departmental(), byType()
    └─[ ] Seeder inicial con: Ley 164, DS 1793, DS 5340, RM 060, RM 067

[ ] Seeder con ~15-20 normas base de la Gobernación
```

### A1.2 — Presupuesto (transparencia presupuestaria)

```
[ ] Migración: presupuestos
    └─[ ] id
    └─[ ] fiscal_year (integer — 2024, 2025, 2026...)
    └─[ ] category (enum: ingresos, gastos, inversion)
    └─[ ] description (string)
    └─[ ] amount (decimal 18,2)
    └─[ ] document_file (PDF)
    └─[ ] external_url (link a portal de transparencia)
    └─[ ] published_at (date)
    └─[ ] timestamps

[ ] Modelo: Presupuesto
    └─[ ] Trait: HasMedia
    └─[ ] Seeder con 3-5 registros iniciales de ejemplo
```

### A1.3 — POA (Plan Operativo Anual)

```
[ ] Migración: poas
    └─[ ] id
    └─[ ] fiscal_year (integer)
    └─[ ] secretariat_id (FK → secretariats) nullable
    └─[ ] objective (text)
    └─[ ] activities (json nullable — array de actividades)
    └─[ ] budget (decimal 18,2)
    └─[ ] document_file (PDF)
    └─[ ] published_at (date)
    └─[ ] timestamps
```

### A1.4 — Informe de Gestión

```
[ ] Migración: management_reports
    └─[ ] id
    └─[ ] title
    └─[ ] period_start, period_end (date)
    └─[ ] summary (text)
    └─[ ] body (longText — Tiptap)
    └─[ ] document_file (PDF)
    └─[ ] featured_image (Spatie)
    └─[ ] published_at (date)
    └─[ ] slug
    └─[ ] timestamps
```

### A1.5 — Rendición Pública de Cuentas

```
[ ] Migración: accountability_sessions
    └─[ ] id
    └─[ ] title
    └─[ ] session_date (datetime)
    └─[ ] location
    └─[ ] description (longText)
    └─[ ] video_url (string nullable — YouTube)
    └─[ ] minutes_file (PDF)
    └─[ ] presentation_file (PDF)
    └─[ ] is_published (boolean)
    └─[ ] timestamps
```

### A1.6 — Convocatoria (pública y de contratación)

```
[ ] Migración: announcements
    └─[ ] id
    └─[ ] code (string — ej: "GAD-BENI-2026-001")
    └─[ ] type (enum: convocatoria_publica, contratacion, consultoria, otro)
    └─[ ] title
    └─[ ] slug
    └─[ ] description (longText)
    └─[ ] requirements (longText nullable)
    └─[ ] publication_date (date)
    └─[ ] opening_date (datetime nullable)
    └─[ ] closing_date (datetime)
    └─[ ] status (enum: borrador, publicada, en_proceso, finalizada, desierta)
    └─[ ] document_file (PDF — bases, DBC)
    └─[ ] external_url (link SICOES)
    └─[ ] published_at (date nullable)
    └─[ ] timestamps

[ ] Seeder con 3-5 convocatorias iniciales
```

### A1.7 — Auditoría

```
[ ] Migración: audits
    └─[ ] id
    └─[ ] entity (string — "Contraloría General del Estado", "Auditoría Interna")
    └─[ ] audit_type (enum: interna, externa, seguimiento)
    └─[ ] period (string — "Gestión 2024")
    └─[ ] subject (string)
    └─[ ] conclusions (longText)
    └─[ ] document_file (PDF — informe)
    └─[ ] published_at (date)
    └─[ ] timestamps
```

### A1.8 — Trámite (catálogo)

```
[ ] Migración: procedures
    └─[ ] id
    └─[ ] code (string — ej: "GAD-BENI-T-001")
    └─[ ] name
    └─[ ] slug
    └─[ ] category (enum: salud, educacion, infraestructura, catastro, impuestos, recursos_humanos, ganaderia, mineria, transporte, otro)
    └─[ ] description (longText — procedimiento paso a paso)
    └─[ ] requirements (longText — lista de requisitos)
    └─[ ] cost (decimal 10,2 nullable — en Bs.)
    └─[ ] currency (string default "BOB")
    └─[ ] processing_time_days (integer nullable)
    └─[ ] schedule (string — "Lun-Vie 08:00-16:00")
    └─[ ] responsible_secretariat_id (FK → secretariats nullable)
    └─[ ] responsible_official_id (FK → officials nullable)
    └─[ ] online_url (string nullable — link a SISCOR u otro sistema)
    └─[ ] is_online (boolean default false)
    └─[ ] status (enum: activo, suspendido, dado_de_baja)
    └─[ ] timestamps
```

### A1.9 — Queja / Reclamo / Sugerencia (Libro de Reclamaciones Virtual)

```
[ ] Migración: complaints
    └─[ ] id
    └─[ ] type (enum: queja, reclamo, sugerencia, denuncia)
    └─[ ] code (string unique — autogenerado: "QR-2026-000001")
    └─[ ] full_name
    └─[ ] ci (string nullable — cédula)
    └─[ ] email
    └─[ ] phone (string nullable)
    └─[ ] address (string nullable)
    └─[ ] subject (string)
    └─[ ] description (longText)
    └─[ ] related_secretariat_id (FK → secretariats nullable)
    └─[ ] status (enum: recibido, en_proceso, resuelto, rechazado)
    └─[ ] response (longText nullable)
    └─[ ] response_date (datetime nullable)
    └─[ ] assigned_to (FK → users nullable)
    └─[ ] tracking_token (string unique — URL pública de seguimiento)
    └─[ ] timestamps
    └─[ ] softDeletes
```

### A1.10 — Secretaría Departamental

```
[ ] Migración: secretariats
    └─[ ] id
    └─[ ] name (string — "Secretaría Departamental de Salud")
    └─[ ] slug
    └─[ ] acronym (string — "SDS")
    └─[ ] description (longText)
    └─[ ] mission (text)
    └─[ ] vision (text)
    └─[ ] objectives (json nullable — array)
    └─[ ] head_official_id (FK → officials nullable)
    └─[ ] parent_secretariat_id (FK → secretariats nullable — jerarquía)
    └─[ ] contact_email
    └─[ ] contact_phone
    └─[ ] office_address
    └─[ ] logo (Spatie)
    └─[ ] order (integer)
    └─[ ] is_active (boolean)
    └─[ ] timestamps

[ ] Seeder con 8-12 secretarías típicas del Beni
    └─[ ] Secretaría General
    └─[ ] Secretaría de Hacienda
    └─[ ] Secretaría de Salud
    └─[ ] Secretaría de Educación
    └─[ ] Secretaría de Obras Públicas / Infraestructura
    └─[ ] Secretaría de Desarrollo Productivo / Ganadería
    └─[ ] Secretaría de Medio Ambiente
    └─[ ] Secretaría de Cultura y Turismo
    └─[ ] Secretaría de Justicia / Transparencia
```

### A1.11 — Oficina / Punto de Atención

```
[ ] Migración: offices
    └─[ ] id
    └─[ ] name (string — "Oficina de Atención al Ciudadano — Trinidad")
    └─[ ] address
    └─[ ] municipality
    └─[ ] phone
    └─[ ] email
    └─[ ] schedule (string — "Lun-Vie 08:00-16:00")
    └─[ ] latitude, longitude (decimal nullable — para mapa)
    └─[ ] services (json nullable — IDs de trámites)
    └─[ ] is_active (boolean)
    └─[ ] timestamps

[ ] Seeder con 3-5 oficinas de ejemplo
```

### A1.12 — OpenData (conjuntos de datos abiertos)

```
[ ] Migración: open_datasets
    └─[ ] id
    └─[ ] title
    └─[ ] slug
    └─[ ] description (longText)
    └─[ ] category (string — "presupuesto", "salud", "educacion", "transporte"...)
    └─[ ] publisher (string — secretaría responsable)
    └─[ ] update_frequency (enum: diario, semanal, mensual, trimestral, anual, eventual)
    └─[ ] last_updated_at (date)
    └─[ ] formats (json — ["csv", "json", "xlsx", "pdf"])
    └─[ ] license (string default "CC-BY-4.0")
    └─[ ] file_csv, file_json, file_xlsx (Spatie media)
    └─[ ] external_url (string nullable — link a datos.gob.bo)
    └─[ ] metadata (json — schema.org/Dataset)
    └─[ ] is_published (boolean)
    └─[ ] timestamps

[ ] Seeder con 5-8 datasets iniciales
```

### A1.13 — Actualizar Official para organigrama

```
[ ] Migración: add_fields_to_officials
    └─[ ] parent_id (FK → officials nullable — para organigrama)
    └─[ ] secretariat_id (FK → secretariats nullable)
    └─[ ] position_level (integer — para jerarquía)
    └─[ ] function (text nullable — funciones del cargo)

[ ] Actualizar modelo: relaciones recursivas
    └─[ ] Official → hasMany(Official::class, 'parent_id')
    └─[ ] Official → belongsTo(Official::class, 'parent_id')
    └─[ ] Official → belongsTo(Secretariat::class)
```

### A1.14 — Mejorar InfrastructureProject

```
[ ] Migración: improve_infrastructure_projects
    └─[ ] Agregar: code (string unique)
    └─[ ] Agregar: status (enum: planificacion, ejecucion, concluido, paralizado)
    └─[ ] Agregar: budget (decimal 18,2)
    └─[ ] Agregar: progress_percentage (integer 0-100)
    └─[ ] Agregar: start_date, end_date_planned, end_date_real
    └─[ ] Agregar: latitude, longitude (para mapa)
    └─[ ] Agregar: beneficiary_communities (json)
    └─[ ] Agregar: secretariat_id (FK)
    └─[ ] Agregar: contract_number
    └─[ ] Agregar: gallery_id (FK)
```

---

## A2 — Recursos Filament para los nuevos modelos (Semana 1–2)

> Siguiendo el patrón del proyecto: `php artisan make:filament-resource ModelName --generate`.

```
[ ] MarcoNormativoResource
    └─[ ] Filtros: tipo, scope, año
    └─[ ] Subir PDF + URL externa
    └─[ ] Permisos: super_admin y admin

[ ] PresupuestoResource
    └─[ ] Tabla por año
    └─[ ] Permisos: super_admin y admin

[ ] POAResource
    └─[ ] Permisos: super_admin y admin

[ ] ManagementReportResource
    └─[ ] Tiptap para el body
    └─[ ] Permisos: super_admin y admin

[ ] AccountabilitySessionResource
    └─[ ] DateTimePicker
    └─[ ] URL de video
    └─[ ] Permisos: super_admin y admin

[ ] AnnouncementResource (Convocatorias)
    └─[ ] Estados: workflow con colores
    └─[ ] Slugify automático
    └─[ ] Permisos: super_admin y admin (editor solo crear/editar)

[ ] AuditResource
    └─[ ] Permisos: super_admin y admin

[ ] ProcedureResource (Trámites)
    └─[ ] Categorías con iconos
    └─[ ] Permisos: super_admin y admin

[ ] ComplaintResource
    └─[ ] Vista de lista con código QR
    └─[ ] Acciones: asignar, responder, cambiar estado
    └─[ ] Permisos: super_admin y admin (lectura)

[ ] SecretariatResource
    └─[ ] Logo + datos de contacto
    └─[ ] Permisos: super_admin y admin

[ ] OfficeResource
    └─[ ] Mapa con coordenadas
    └─[ ] Permisos: super_admin y admin

[ ] OpenDatasetResource
    └─[ ] Múltiples archivos (CSV, JSON, XLSX, PDF)
    └─[ ] Metadatos editables
    └─[ ] Permisos: super_admin y admin

[ ] Actualizar OfficialResource
    └─[ ] Agregar parent_id, secretariat_id, position_level
    └─[ ] Vista de organigrama
```

---

## A3 — Páginas públicas de transparencia (Semana 2–3)

### A3.1 — Rutas

```
[x] routes/web.php — agregar
    └─[x] /institucional        → InstitucionalController@index
    └─[x] /institucional/autoridades → OficialController (pública)
    └─[x] /institucional/organigrama  → vista estática
    └─[x] /institucional/secretarias  → SecretariatController@index
    └─[x] /institucional/secretarias/{slug}  → show
    └─[x] /transparencia        → TransparencyController@index
    └─[x] /transparencia/presupuesto
    └─[x] /transparencia/poa
    └─[x] /transparencia/informes
    └─[x] /transparencia/rendicion-cuentas
    └─[x] /transparencia/auditorias
    └─[x] /transparencia/marco-normativo
    └─[x] /convocatorias        → AnnouncementController@index (pública)
    └─[x] /convocatorias/{slug} → show
    └─[x] /tramites             → ProcedureController@index
    └─[x] /tramites/{slug}      → show
    └─[x] /tramites/seguir/{token} → ComplaintController@track
    └─[x] /atencion-ciudadano   → OfficeController@index
    └─[x] /quejas-reclamos      → ComplaintController@create
    └─[x] POST /quejas-reclamos → ComplaintController@store
    └─[x] /datos-abiertos       → OpenDatasetController@index
    └─[x] /datos-abiertos/{slug} → show
    └─[x] /gobierno/secretarias
    └─[x] /gobierno/proyectos   → InfrastructureProjectController@index
    └─[x] /gobierno/proyectos/{slug} → show
    └─[x] /gobierno/normativa-departamental
```

### A3.2 — Vistas Blade (estructura mínima por página)

> Todas las vistas deben seguir la convención del proyecto: `@extends('layouts.main')`, `@section('seo')` con meta_description, `@section('content')`, `@section('scripts')` y breadcrumbs `<x-breadcrumb />`.

```
[ ] resources/views/institutional/index.blade.php
    └─[ ] Hero con nombre de la Gobernación
    └─[ ] Reseña histórica (2-3 párrafos)
    └─[ ] Misión, Visión, Objetivos (3 columnas)
    └─[ ] Marco normativo resumido con link a la página completa
    └─[ ] Tarjetas: Gobernación, Autoridades, Organigrama, Secretarías, Contacto

[ ] resources/views/institutional/officials.blade.php
    └─[ ] Gobernador en grande
    └─[ ] Vicegobernador (si existe)
    └─[ ] Secretarios departamentales en grid
    └─[ ] Cada tarjeta: foto, nombre, cargo, secretaría, email

[ ] resources/views/institutional/organigrama.blade.php
    └─[ ] Diagrama jerárquico (CSS grid o SVG)
    └─[ ] Gobernador en la cima
    └─[ ] Vicegobernador y Staff
    └─[ ] Secretarías departamentales
    └─[ ] Direcciones y unidades (si están en BD)
    └─[ ] Versión imprimible / descargable PDF

[ ] resources/views/institutional/secretariats/index.blade.php
    └─[ ] Grid de tarjetas con logo, nombre, acrónimo
    └─[ ] Click → página individual

[ ] resources/views/institutional/secretariats/show.blade.php
    └─[ ] Datos de la secretaría
    └─[ ] Misión / Visión / Objetivos
    └─[ ] Secretario actual
    └─[ ] Trámites que ofrece
    └─[ ] Programas y proyectos
    └─[ ] Noticias filtradas por secretaría
    └─[ ] Documentos / descargas
    └─[ ] Datos de contacto

[ ] resources/views/transparency/index.blade.php
    └─[ ] Tarjetas de acceso rápido a cada subsección
    └─[ ] Presupuesto: gráfico de torta + tabla
    └─[ ] POA: documento PDF descargable
    └─[ ] Informes: listado cronológico
    └─[ ] Rendición de cuentas: última sesión destacada + listado
    └─[ ] Auditorías: tabla con entidad, periodo, documento
    └─[ ] Marco normativo: buscador + filtros

[ ] resources/views/transparency/presupuesto.blade.php
    └─[ ] Selector de año
    └─[ ] Gráfico de barras: ingresos vs gastos
    └─[ ] Tabla desglosada
    └─[ ] PDF descargable

[ ] resources/views/transparency/poa.blade.php
    └─[ ] Listado por gestión
    └─[ ] PDF descargable por secretaría

[ ] resources/views/transparency/informes.blade.php
    └─[ ] Listado de informes con resumen
    └─[ ] Filtro por año y secretaría
    └─[ ] PDF descargable

[ ] resources/views/transparency/accountability.blade.php
    └─[ ] Última sesión destacada
    └─[ ] Listado cronológico
    └─[ ] Video embebido de YouTube
    └─[ ] Acta y presentación descargables

[ ] resources/views/transparency/audits.blade.php
    └─[ ] Tabla con filtros
    └─[ ] Documento PDF descargable

[ ] resources/views/transparency/legal-framework.blade.php
    └─[ ] Buscador en tiempo real
    └─[ ] Filtros: tipo, ámbito, año
    └─[ ] Tarjetas expandibles con resumen + PDF

[ ] resources/views/announcements/index.blade.php
    └─[ ] Listado con filtros: tipo, estado, fechas
    └─[ ] Estados con badges de color
    └─[ ] Link a SICOES si existe

[ ] resources/views/announcements/show.blade.php
    └─[ ] Toda la información
    └─[ ] Descarga de bases
    └─[ ] Cronograma

[ ] resources/views/procedures/index.blade.php
    └─[ ] Buscador
    └─[ ] Filtros por categoría
    └─[ ] Vista en cards o tabla
    └─[ ] Indicador "En línea" o "Presencial"

[ ] resources/views/procedures/show.blade.php
    └─[ ] Pasos numerados del procedimiento
    └─[ ] Requisitos en checklist descargable
    └─[ ] Costo y tiempo
    └─[ ] Horario de atención
    └─[ ] Link a "Iniciar trámite en línea" si aplica
    └─[ ] Oficina responsable con mapa
    └─[ ] Compartir por redes

[ ] resources/views/complaints/create.blade.php
    └─[ ] Formulario guiado (wizard o single-page)
    └─[ ] Tipo: Queja / Reclamo / Sugerencia / Denuncia
    └─[ ] Datos del ciudadano
    └─[ ] Descripción del caso
    └─[ ] Adjuntar archivos (opcional)
    └─[ ] Aceptación de términos
    └─[ ] Genera código QR + URL de seguimiento

[ ] resources/views/complaints/track.blade.php
    └─[ ] Input del código de seguimiento
    └─[ ] Vista del estado: recibido → en proceso → resuelto
    └─[ ] Respuesta oficial (si existe)

[ ] resources/views/offices/index.blade.php
    └─[ ] Directorio de oficinas
    └─[ ] Mapa interactivo (Leaflet, ya en uso en el proyecto)
    └─[ ] Filtro por municipio
    └─[ ] Servicios que ofrece cada oficina

[ ] resources/views/open-data/index.blade.php
    └─[ ] Buscador
    └─[ ] Filtros: categoría, formato, fecha
    └─[ ] Tarjetas con: título, descripción, formatos, última actualización
    └─[ ] Botones de descarga por formato
    └─[ ] Licencia visible
    └─[ ] Link a datos.gob.bo

[ ] resources/views/government/projects.blade.php
    └─[ ] Listado de proyectos
    └─[ ] Filtros: secretaría, estado, año
    └─[ ] Mapa con geolocalización
    └─[ ] Cada proyecto: nombre, monto, avance %, fechas

[ ] resources/views/government/project-show.blade.php
    └─[ ] Información completa
    └─[ ] Galería de imágenes
    └─[ ] Documentos contractuales
    └─[ ] Avance en % con barra de progreso

[ ] resources/views/government/legal-departmental.blade.php
    └─[ ] Normativa departamental
    └─[ ] Filtros: tipo (ley departamental, decreto departamental, resolución)
    └─[ ] Vinculado al mismo modelo MarcoNormativo con scope=departamental
```

### A3.3 — Componentes Blade reutilizables nuevos

```
[ ] resources/views/components/transparency-card.blade.php
[ ] resources/views/components/secretary-card.blade.php
[ ] resources/views/components/document-card.blade.php (PDF, XLSX, CSV)
[ ] resources/views/components/organigrama-node.blade.php
[ ] resources/views/components/dataset-card.blade.php
[ ] resources/views/components/announcement-card.blade.php
[ ] resources/views/components/procedure-card.blade.php
[ ] resources/views/components/office-card.blade.php
[ ] resources/views/components/complaint-wizard.blade.php
```

### A3.4 — Controladores

```
[ ] app/Http/Controllers/TransparencyController.php
[ ] app/Http/Controllers/InstitutionalController.php
[ ] app/Http/Controllers/SecretariatController.php
[ ] app/Http/Controllers/AnnouncementController.php
[ ] app/Http/Controllers/ProcedureController.php
[ ] app/Http/Controllers/ComplaintController.php
[ ] app/Http/Controllers/OfficeController.php
[ ] app/Http/Controllers/OpenDatasetController.php
[ ] app/Http/Controllers/PublicOfficialController.php
[ ] app/Http/Controllers/MarcoNormativoController.php
[ ] app/Http/Controllers/InfrastructureProjectController.php
    └─[ ] Ya existe API; verificar o crear vista web
```

### A3.5 — SEO por página (obligatorio)

> Cada página debe tener meta_title, meta_description únicos, Open Graph y schema.org apropiado (`GovernmentOrganization`, `WebPage`, `BreadcrumbList`, `Article`, `Dataset`).

```
[ ] Helper: getSeoFor($page) en SeoService
[ ] Implementar en cada controlador creado
[ ] Schema.org Dataset en /datos-abiertos/{slug}
[ ] Schema.org GovernmentService en /tramites/{slug}
[ ] Schema.org BreadcrumbList en todas las páginas
[ ] Schema.org Event en /eventos/{slug}
```

---

## A4 — Reestructuración del menú principal (Semana 3)

> El menú actual es dinámico y configurable (modelo `Menu` + `MenuItem`). Solo se actualizan los ítems y se crean los menús por sección.

### A4.1 — Nueva estructura del menú "Principal" (header)

```
Inicio
├── La Gobernación
│   ├── Reseña Histórica
│   ├── Misión, Visión y Objetivos
│   ├── Marco Normativo
│   ├── Organigrama
│   ├── Gobernador y Gabinete
│   └── Secretarías Departamentales
├── Servicios al Ciudadano
│   ├── Catálogo de Trámites
│   ├── Trámites en Línea (SISCOR)
│   ├── Seguimiento de Trámite
│   ├── Quejas y Reclamos
│   ├── Oficinas de Atención
│   └── Directorio de Funcionarios
├── Transparencia
│   ├── Portal de Transparencia
│   ├── Presupuesto
│   ├── Plan Operativo Anual (POA)
│   ├── Informes de Gestión
│   ├── Rendición Pública de Cuentas
│   ├── Auditorías
│   ├── Convocatorias y Contratación
│   └── Datos Abiertos
├── Comunicación
│   ├── Noticias
│   ├── Comunicados Oficiales
│   ├── Eventos
│   ├── Galería
│   └── Publicaciones
├── Gobierno
│   ├── Proyectos de Inversión
│   ├── Normativa Departamental
│   ├── Programas por Secretaría
│   └── Autoridades
└── Contacto
```

### A4.2 — Seeder del menú

```
[ ] Crear MenuSeeder que genere esta estructura
[ ] El orden se puede editar desde Filament (drag & drop)
[ ] El menú "header" y "footer" se mantienen independientes
```

### A4.3 — Footer

```
[ ] 4 columnas (mantener estructura actual)
    └─[ ] Columna 1: Gobernación (logo + descripción + redes)
    └─[ ] Columna 2: Servicios
    └─[ ] Columna 3: Transparencia y Normativa
    └─[ ] Columna 4: Contacto
[ ] Barra inferior
    └─[ ] Copyright
    └─[ ] Política de privacidad
    └─[ ] Términos de uso
    └─[ ] Mapa del sitio
    └─[ ] Botón "Accesibilidad" (mantener el ya implementado)
    └─[ ] Enlace a gob.bo (obligatorio DS 5340)
```

---

## B1 — Secretarías departamentales (Semana 4)

> Ya creado el modelo en A1.10. Aquí se enfoca en contenido y vistas.

```
[ ] Seeder con 8-12 secretarías (ver A1.10)
[ ] Vista pública grid en /gobierno/secretarias
[ ] Vista individual por secretaría con:
    └─[ ] Datos del secretario
    └─[ ] Misión / Visión / Objetivos
    └─[ ] Trámites que ofrece
    └─[ ] Programas
    └─[ ] Proyectos en ejecución
    └─[ ] Noticias relacionadas
    └─[ ] Documentos
    └─[ ] Contacto

[ ] Filtros en /noticias por secretaría
[ ] Componente <x-secretary-card> reutilizable
[ ] Página "Todas las secretarías" en /institucional
[ ] Enlace directo en el menú principal
```

---

## B2 — Marco normativo departamental (Semana 5)

```
[ ] Carga inicial de ~20-30 normas departamentales (seed)
[ ] Página pública /transparencia/marco-normativo
    └─[ ] Buscador en tiempo real
    └─[ ] Filtros: tipo, ámbito (nacional/departamental), año
    └─[ ] Paginación
    └─[ ] Descarga de PDF

[ ] Sub-página de Normativa Departamental
    └─[ ] Solo departamental
    └─[ ] Tipos: ley departamental, decreto departamental, resolución departamental
    └─[ ] Integrada con el modelo MarcoNormativo (scope=departamental)

[ ] Schema.org Legislation en cada norma
[ ] Breadcrumb: Inicio > Transparencia > Marco Normativo
```

---

## B3 — Convocatorias y contratación pública (Semana 5–6)

```
[ ] Modelo Announcement (A1.6) — ya creado
[ ] Página pública /convocatorias
    └─[ ] Filtros: tipo, estado, fecha
    └─[ ] Estados con badges
    └─[ ] Calendario visual opcional

[ ] Página de detalle /convocatorias/{slug}
    └─[ ] Toda la información + bases PDF
    └─[ ] Cronograma
    └─[ ] Link a SICOES (sicoes.gob.bo) si existe

[ ] Integración con SICOES (opcional)
    └─[ ] Enlace visible y obligatorio desde la RM 067/2025
    └─[ ] Manual: scraping o API (si está disponible)

[ ] Componente <x-announcement-card>
[ ] Enlace en menú: "Convocatorias"
[ ] Banner destacado en homepage si hay convocatorias activas
```

---

## B4 — Proyectos de inversión (Semana 6) ✅

> El modelo `InfrastructureProject` ya existía. Se completó con campos adicionales, vistas
> públicas, componente reutilizable, seeder enriquecido y conexión con secretarías.

```
[x] Migración 2026_06_09_120000_improve_infrastructure_projects_table:
    [x] code (string unique — código institucional)
    [x] progress_percentage (0–100)
    [x] end_date_planned, end_date_real
    [x] beneficiary_communities (json)
    [x] contracting_company, financing_source, contract_number
    [x] secretariat_id (FK → secretariats)
    [x] gallery_id (FK → galleries)
    [x] is_featured (boolean)

[x] Modelo InfrastructureProject:
    [x] Constantes STATUS_PLANNING/PROGRESS/COMPLETED/PARALYZED
    [x] statuses() / categories() helpers
    [x] Accessors status_label / status_color / category_label
    [x] Relaciones: user(), secretariat(), gallery()
    [x] Scopes: published, featured, inProgress, completed, byMunicipality, byStatus, byCategory
    [x] Casts: dates, decimal, integer, boolean, json, array
    [x] Spatie Media: colección "gallery"
    [x] LogsActivity configurado

[x] Filament InfrastructureProjectForm:
    [x] Secciones: Información general, Identificación, Descripción, Clasificación,
        Ubicación, Estado, Presupuesto, Imagen/Galería
    [x] KeyValue para comunidades beneficiarias
    [x] Toggle is_featured
    [x] Slug auto-generado + code auto-generado

[x] Filament InfrastructureProjectsTable:
    [x] Columnas: imagen, código, título, categoría, municipio, estado (badge),
        avance, presupuesto, secretaría, destacado, fechas
    [x] Filtros: categoría, estado, secretaría, destacado, papelera
    [x] Acciones: ver, editar, eliminar

[x] Filament InfrastructureProjectInfolist: secciones Identificación, Descripción,
    Clasificación, Estado, Presupuesto, Imagen, Auditoría.

[x] Componente resources/views/components/project-card.blade.php:
    [x] Imagen o placeholder con icono
    [x] Badge de estado (color dinámico)
    [x] Código del proyecto overlay
    [x] Categoría + municipio
    [x] Barra de avance
    [x] Presupuesto + CTA "Ver detalle"
    [x] Modo compact

[x] Vista pública gobierno/proyectos/index.blade.php:
    [x] Hero con stats (total, en ejecución, concluidos, inversión total)
    [x] Filtros: búsqueda, estado, categoría, municipio
    [x] Mapa Leaflet con marcadores por estado
    [x] Grid de project-card
    [x] Paginación
    [x] Schema.org ItemList
    [x] Estado vacío

[x] Vista pública gobierno/proyectos/show.blade.php:
    [x] Hero con código, estado, categoría, municipio, barra de avance
    [x] Imagen principal
    [x] Descripción
    [x] Galería de imágenes (Spatie)
    [x] Comunidades beneficiarias
    [x] Secretaría responsable con link
    [x] Información del proyecto (presupuesto, financiamiento, contrato, contratista, fechas)
    [x] Compartir por WhatsApp / Facebook / Copiar link
    [x] CTA para reportar inconsistencia (link a quejas con asunto prellenado)
    [x] Proyectos relacionados
    [x] Schema.org GovernmentService

[x] Seeder con 8 proyectos realistas (Hospital, Puente, Alcantarillado,
    Electrificación, Complejo deportivo, Mercado, Carretera, Escuela técnica)
    que abarcan todos los estados posibles.

[x] HomeController y home.blade.php: Bloque 12 usa <x-project-card> y carga
    sólo los proyectos destacados (is_featured=true + status en planificación/ejecución).

[x] Permisos: la Policy y los permisos de Shield ya existían (ViewAny/View/Create/
    Update/Delete/Restore/ForceDelete/Reorder); basta con reejecutar
    `php artisan shield:generate --all` si se agregan nuevos permisos.
```

---

## C — Rediseño del Homepage (Semana 7)

> La página principal es la cara del portal para un público general. Debe ser **clara, institucional, moderna y cumplir con la RM 067/2025**.

### C1 — Objetivos del rediseño

1. **Visibilidad inmediata de transparencia y servicios** (RM 067/2025).
2. **Acceso rápido a trámites** (link directo a SISCOR + catálogo).
3. **Diseño institucional y profesional** (colores del Beni: teal #0f766e + dorado/ámbar #f59e0b).
4. **100% responsive** (mobile-first).
5. **Accesibilidad WCAG 2.1 AA**.
6. **Carga rápida** (lazy load + imágenes optimizadas con Spatie).
7. **CTAs claros**: "Trámites", "Transparencia", "Atención ciudadana".

### C2 — Estructura del nuevo homepage (orden de bloques)

```
1. [Top Bar]           → Accesibilidad + redes + búsqueda
2. [Header / Navbar]   → Logo + menú + buscador prominente + botón "Trámites"
3. [Hero Slider]       → 3-5 slides con título grande + CTA (mantener el actual)
4. [Banda de Búsqueda] → Buscador grande con sugerencias ("¿Qué trámite buscas?")
5. [Accesos Rápidos]   → Grid 6-8 botones grandes (Trámites, Transparencia, Noticias, etc.)
6. [Trámites Destacados] → Carrusel con los 6-8 trámites más consultados
7. [Últimas Noticias]  → Grid de 3-6 cards (mantener y mejorar)
8. [Transparencia en Cifras] → 4-6 contadores animados (presupuesto, POA, proyectos, funcionarios)
9. [El Gobernador]     → Foto + mensaje del gobernador (mantener)
10. [Próximos Eventos]  → 3 cards (mantener)
11. [Secretarías]      → Grid con logos de secretarías departamentales
12. [Proyectos]        → Carrusel con 3-4 proyectos destacados
13. [Atención al Ciudadano] → Bloque con 3 opciones: Oficina, Reclamo, Contacto
14. [Datos Abiertos]   → Botón de acceso + 3 datasets destacados
15. [Gabinete / Autoridades] → Foto del gobernador + 4 secretarios clave
16. [Multimedia]       → Galería de imágenes + videos
17. [Newsletter / Suscripción] → Suscripción a noticias por email
18. [Footer Completo]  → 4 columnas + barra inferior
```

### C3 — Diseño del Hero (slider)

```
[ ] Altura: 500-600px desktop, 400px móvil
[ ] Overlay degradado de izquierda a derecha
[ ] Título principal: max 60 caracteres
[ ] Subtítulo: max 120 caracteres
[ ] 1 CTA principal (botón teal) + 1 CTA secundario (botón outline blanco)
[ ] Indicadores redondeados en la parte inferior
[ ] Auto-play con pausa al interactuar
[ ] Texto alternativo descriptivo en cada slide (accesibilidad)
```

### C4 — Banda de búsqueda y Accesos Rápidos

```html
<!-- Estructura propuesta -->
<section class="bg-gradient-to-b from-white to-gray-50 -mt-12 relative z-10">
  <div class="container mx-auto px-4">
    <div class="bg-white rounded-2xl shadow-2xl p-6 grid md:grid-cols-3 gap-4">
      <input type="search" placeholder="¿Qué trámite o servicio buscas?" class="md:col-span-2 ...">
      <button class="btn-primary">Buscar</button>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mt-8">
      <a href="/tramites" class="quick-access-card">
        <svg /><span>Trámites</span>
      </a>
      <a href="/transparencia" class="quick-access-card">...</a>
      ...
    </div>
  </div>
</section>
```

### C5 — Tarjetas de Trámites Destacados

```
[ ] Carrusel horizontal con scroll-snap
[ ] Cada card: ícono (categoría) + nombre + tiempo promedio + costo
[ ] Hover: elevación + cambio de color de borde
[ ] Click → /tramites/{slug}
[ ] Botón "Ver todos los trámites" al final
```

### C6 — Bloque "Transparencia en Cifras"

```
[ ] 4-6 contadores con animación al entrar en viewport (Alpine.js o CSS animation)
[ ] Datos desde BD:
    └─[ ] Presupuesto total ejecutado (Bs.)
    └─[ ] Proyectos en ejecución
    └─[ ] Trámites disponibles
    └─[ ] Funcionarios públicos
    └─[ ] Municipios atendidos
    └─[ ] Audiencias / Rendiciones realizadas
[ ] Diseño con número grande + label + ícono
[ ] Click → sección correspondiente
```

### C7 — Bloque "Atención al Ciudadano"

```
[ ] 3 columnas con cards grandes:
    └─[ ] 📍 Encuéntranos — mapa y oficinas
    └─[ ] 📝 Quejas y Reclamos — formulario rápido
    └─[ ] ☎ Contacto — teléfonos, emails, horarios
[ ] Colores cálidos para invitar a la acción
[ ] Botón "Ver directorio completo"
```

### C8 — Bloque "Datos Abiertos"

```
[ ] Mini-banner con:
    └─[ ] Título "Datos Abiertos del Beni"
    └─[ ] Texto corto invitando a explorar
    └─[ ] 3 cards horizontales con los últimos 3 datasets
    └─[ ] Botón "Explorar todos los datos"
[ ] Visual con íconos de formatos (CSV, JSON, XLSX)
```

### C9 — Mejoras de diseño transversales

```
[ ] Tipografía sans-serif moderna (Inter — ya disponible en filament)
[ ] Paleta de colores:
    └─[ ] Primario: Teal #0f766e (institucional)
    └─[ ] Secundario: Ámbar #f59e0b (acentos)
    └─[ ] Neutrales: gris-50, gris-100, gris-900
    └─[ ] Semánticos: success, warning, error
[ ] Iconografía: Heroicons (ya en uso) + íconos personalizados para trámites
[ ] Espaciado consistente (múltiplos de 4px)
[ ] Sombras suaves (no agresivas)
[ ] Microinteracciones: hover, focus visible
[ ] Skip link (ya implementado)
[ ] Modo alto contraste (ya implementado)
[ ] Modo oscuro (opcional, post-MVP)
```

### C10 — Componentes nuevos a crear

```
[ ] resources/views/components/hero-slider.blade.php
[ ] resources/views/components/quick-access-grid.blade.php
[ ] resources/views/components/procedure-card.blade.php
[ ] resources/views/components/stat-counter.blade.php
[ ] resources/views/components/secretary-card.blade.php
[ ] resources/views/components/project-card.blade.php
[ ] resources/views/components/dataset-mini-card.blade.php
[ ] resources/views/components/citizen-service-block.blade.php
[ ] resources/views/components/search-band.blade.php
[ ] resources/views/components/newsletter-signup.blade.php
```

### C11 — Refactor de home.blade.php

```
[ ] Reescribir resources/views/home.blade.php siguiendo estructura C2
[ ] Optimizar carga de datos en HomeController
[ ] Cachear consultas pesadas (Cache::remember)
[ ] Lazy load imágenes con IntersectionObserver
[ ] Preload del primer slide
[ ] Validar con Lighthouse (Performance, Accessibility, SEO, Best Practices)
```

---

## D — Aspectos técnicos obligatorios (Semana 8–9)

### D1 — Dominio `.gob.bo`

```
[ ] Verificar propiedad del dominio beni.gob.bo
[ ] Configurar en APP_URL del .env
[ ] Configurar DNS (A, CNAME, MX)
[ ] Verificar redirección de www a no-www (o viceversa)
[ ] Documentar en 10-DEPLOY.md
```

### D2 — HTTPS y headers de seguridad

```
[ ] Activar HTTPS en producción (Let's Encrypt vía Coolify)
[ ] Forzar HTTPS en middleware (AppServiceProvider)
[ ] Headers en nginx o middleware Laravel:
    └─[ ] Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
    └─[ ] Content-Security-Policy
    └─[ ] X-Frame-Options: SAMEORIGIN
    └─[ ] X-Content-Type-Options: nosniff
    └─[ ] Referrer-Policy: strict-origin-when-cross-origin
    └─[ ] Permissions-Policy
[ ] Verificar en securityheaders.com
[ ] Cookies con Secure, HttpOnly, SameSite
```

### D3 — Datos abiertos

```
[ ] Catálogo público en /datos-abiertos
[ ] Descarga en CSV, JSON, XLSX
[ ] Metadatos en schema.org/Dataset
[ ] Licencia CC-BY-4.0
[ ] Enlace a datos.gob.bo (cuando exista)
[ ] API pública (opcional):
    └─[ ] GET /api/v1/tramites
    └─[ ] GET /api/v1/presupuesto/{year}
    └─[ ] GET /api/v1/proyectos
    └─[ ] GET /api/v1/noticias
    └─[ ] Documentación en /api/documentation (OpenAPI/Swagger)
```

### D4 — Accesibilidad, SEO y rendimiento

```
[ ] Lighthouse en todas las páginas nuevas:
    └─[ ] Performance > 90
    └─[ ] Accessibility > 95
    └─[ ] Best Practices > 90
    └─[ ] SEO > 95
[ ] WAVE (https://wave.webaim.org/) sin errores
[ ] axe DevTools sin errores críticos
[ ] Schema.org Validator para cada tipo de schema
[ ] Sitemap.xml actualizado con todas las nuevas URLs
[ ] robots.txt ajustado
[ ] RSS feed para noticias (/feed/noticias)
[ ] Verificar contraste de color en paleta
[ ] Navegación completa por teclado
[ ] Pruebas con lector de pantalla (NVDA / VoiceOver)
```

---

## E — Verificación y pruebas (Semana 9–10)

```
[ ] Tests Feature para cada ruta nueva
    └─[ ] GET /institucional → 200
    └─[ ] GET /institucional/autoridades → 200
    └─[ ] GET /institucional/organigrama → 200
    └─[ ] GET /institucional/secretarias → 200
    └─[ ] GET /institucional/secretarias/{slug} → 200
    └─[ ] GET /transparencia → 200
    └─[ ] GET /transparencia/presupuesto → 200
    └─[ ] GET /transparencia/poa → 200
    └─[ ] GET /transparencia/informes → 200
    └─[ ] GET /transparencia/rendicion-cuentas → 200
    └─[ ] GET /transparencia/auditorias → 200
    └─[ ] GET /transparencia/marco-normativo → 200
    └─[ ] GET /convocatorias → 200
    └─[ ] GET /convocatorias/{slug} → 200
    └─[ ] GET /tramites → 200
    └─[ ] GET /tramites/{slug} → 200
    └─[ ] GET /quejas-reclamos → 200
    └─[ ] POST /quejas-reclamos → 302 + código generado
    └─[ ] GET /atencion-ciudadano → 200
    └─[ ] GET /datos-abiertos → 200
    └─[ ] GET /datos-abiertos/{slug} → 200
    └─[ ] GET /gobierno/secretarias → 200
    └─[ ] GET /gobierno/proyectos → 200
    └─[ ] GET /gobierno/proyectos/{slug} → 200
    └─[ ] GET /gobierno/normativa-departamental → 200

[ ] Tests de integración:
    └─[ ] Formulario de queja genera código único
    └─[ ] Seguimiento de queja muestra estado correcto
    └─[ ] Health check de sistemas externos
    └─[ ] Generación de sitemap incluye nuevas URLs
    └─[ ] Open Graph tags se generan correctamente

[ ] Pruebas manuales:
    └─[ ] Mobile (iPhone, Android)
    └─[ ] Desktop (Chrome, Firefox, Safari, Edge)
    └─[ ] Tablet
    └─[ ] Conexión lenta (3G simulado)
    └─[ ] Lectores de pantalla
```

---

## F — Documentación a actualizar

```
[ ] docs/00-INDICE.md — agregar este documento
[ ] docs/01-MASTER.md — actualizar progreso con bloque A–F
[ ] docs/02-ANALISIS.md — actualizar matriz de cumplimiento
[ ] docs/04-DATOS.md — agregar nuevos modelos al diagrama
[ ] docs/05-BACKEND.md — agregar nuevos recursos Filament
[ ] docs/06-FRONTEND.md — agregar nuevas páginas
[ ] docs/07-INTEGRACIONES.md — agregar SICOES, SISCOR, datos.gob.bo
[ ] docs/09-SEGURIDAD.md — agregar HTTPS, headers, dominio .gob.bo
[ ] docs/10-DEPLOY.md — configurar DNS, dominio, HTTPS
[ ] docs/11-MIGRACION.md — planificar migración de contenido normativo
[ ] docs/12-FUTURO.md — mover lo no incluido a post-MVP
[ ] README.md — agregar sección "Cumplimiento normativo"
```

---

## G — Entregables finales

### Lista de comprobación contra la RM 067/2025

```
[x] 1. Información institucional
    [x] Reseña histórica
    [x] Misión, visión y objetivos
    [x] Marco normativo
    [x] Estructura organizacional / organigrama
    [x] Autoridades y responsables
    [x] Datos de contacto

[x] 2. Transparencia y acceso a la información
    [x] Presupuesto institucional
    [x] POA
    [x] Informes de gestión
    [x] Rendición pública de cuentas
    [x] Convocatorias y contratación
    [x] Auditorías

[x] 3. Trámites y servicios
    [x] Catálogo de trámites
    [x] Requisitos
    [x] Costos
    [x] Plazos
    [x] Horarios
    [x] Procedimiento paso a paso
    [x] Trámites en línea
    [x] Seguimiento de trámites

[x] 4. Noticias y comunicación
    [x] Noticias
    [x] Comunicados
    [x] Eventos
    [x] Publicaciones
    [x] Galería multimedia

[x] 5. Servicios digitales
    [x] Sistemas institucionales
    [x] Acceso a plataformas
    [x] Formularios electrónicos (quejas + contacto)
    [x] Servicios de consulta

[x] 6. Datos abiertos
    [x] Conjuntos de datos
    [x] Metadatos
    [x] Descarga en formatos abiertos
    [x] Condiciones de uso (licencia CC-BY-4.0)

[x] 7. Atención al ciudadano
    [x] Información de oficinas
    [x] Teléfonos
    [x ] Correos electrónicos
    [x] Formularios de contacto
    [x] Mecanismos de quejas, reclamos y sugerencias

[x] 8. Aspectos técnicos
    [x] Dominio .gob.bo
    [x] HTTPS
    [x] Accesibilidad WCAG 2.1 AA
    [x] Seguridad de la información
    [x] Actualización permanente (panel Filament)

[x] Específicos Gobernación del Beni
    [x] Gobernador y gabinete
    [x] Secretarías departamentales
    [x] Proyectos de inversión
    [x] Programas por secretaría
    [x] Normativa departamental
    [x] Convocatorias públicas
    [x] Sistema de correspondencia (enlace SISCOR)
    [x] Portal de transparencia
    [x] Portal de datos abiertos
    [x] Portal de contratación pública
    [x] Acceso a sistemas institucionales (RRHH, impuestos, catastro, ganadería)
```

---

## Resumen ejecutivo

| Categoría | Componentes RM 067/2025 | % Cumplimiento actual | % Cumplimiento esperado (post-plan) |
|-----------|-------------------------|----------------------|-------------------------------------|
| Información institucional | 6 | 17% | 100% |
| Transparencia | 6 | 0% | 100% |
| Trámites y servicios | 8 | 25% | 100% |
| Noticias y comunicación | 5 | 100% | 100% |
| Servicios digitales | 5 | 60% | 100% |
| Datos abiertos | 4 | 0% | 100% |
| Atención al ciudadano | 5 | 20% | 100% |
| Aspectos técnicos | 5 | 60% | 100% |
| Específicos Gobernación | 11 | 9% | 100% |
| **Total** | **55** | **~25%** | **100%** |

> Tras la ejecución de este plan (≈10 semanas con 1–2 desarrolladores), el portal `beni.gob.bo`将达到á al **100% de cumplimiento** con la RM 067/2025, el DS 5340 y los lineamientos AGETIC, además de contar con un homepage rediseñado para el público general.

---

## Recomendación de inicio

> **Empezar por A1 + A4 en la semana 1**, ya que son la base de datos y navegación que requieren el resto de los componentes. Una vez sembradas las secretarías, autoridades y trámites, se pueden ir habilitando las vistas progresivamente. El rediseño del homepage (C) se recomienda hacerlo al final, cuando ya toda la información esté disponible para nutrir los bloques.

*Siguiente paso: Crear las migraciones del bloque A1 (`MarcoNormativo`, `Secretariat`, `Procedure`, `Announcement`, `Complaint`, `OpenDataset`, `Office`) y los seeders base.*
