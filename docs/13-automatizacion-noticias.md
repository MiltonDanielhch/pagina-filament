# 13 — Fase 13: Automatización y Agilización de Creación de Noticias

> **Anterior:** `12-FUTURO.md`
> **Siguiente:** —
> **Semana:** 13-14
> **Objetivo:** Reducir el tiempo de creación de noticias en 60% mediante automatización de campos, plantillas inteligentes e integraciones seleccionadas.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso | Prioridad |
|--------|--------|----------|-----------|
| 13.1 | Análisis de flujo actual y dolor de usuarios | **70%** | Alta |
| 13.2 | Opción A: Campos inteligentes y autocompletado | **100%** | Alta |
| 13.3 | Opción B: Plantillas de noticias predefinidas | **100%** | Alta |
| 13.4 | Opción C: Botón "Compartir en Redes" (semi-auto) | **100%** | Media |
| 13.5 | Opción D: Importador desde Word (DOCX) | **0%** | Baja |
| 13.6 | Testing con usuarios reales (periodistas) | **0%** | Alta |
| **Total Fase 13** | | **58%** |

---

## 13.1 — Análisis de flujo actual y dolor de usuarios

```
[ ] Entrevistas con equipo de comunicación
    └─[ ] Identificar cuántas noticias crean por día/semana
    └─[ ] Medir tiempo promedio de creación de una noticia
    └─[ ] Documentar pasos repetitivos que pueden automatizarse
    └─[ ] Identificar errores más comunes en publicación

[x] Auditoría técnica del proceso actual
    └─[x] Revisar campos que siempre se repiten (autor, fecha, categoría)
    └─[x] Analizar estructura típica de noticias publicadas
    └─[x] Identificar tipos de noticias más frecuentes
    └─[x] Documentar proceso de publicación en redes sociales actual

[ ] Definir métricas de éxito
    └─[ ] Reducir tiempo de creación de 15 min → 5 min por noticia
    └─[ ] Eliminar 100% de campos repetitivos manuales
    └─[ ] Aumentar publicaciones en redes sociales acompañadas en 80%
```

---

---

## Hallazgos de la Auditoría Técnica (13.1)

### Campos que siempre se repiten en el formulario actual

**Archivo:** `app/Filament/Resources/Posts/Schemas/PostForm.php`

| Campo | Estado actual | Potencial de automatización |
|-------|---------------|---------------------------|
| `user_id` (Autor) | Select manual, required | **ALTO** - Detectar usuario logueado automáticamente |
| `category_id` (Categoría) | Select manual | **MEDIO** - Sugerir por palabras clave en título |
| `title` (Título) | TextInput manual, required | **BAJO** - Siempre es único |
| `slug` | Ya automático (desde title) | ✅ **YA IMPLEMENTADO** |
| `excerpt` (Extracto) | Textarea manual | **ALTO** - Auto desde body (primeros 150 chars) |
| `body` (Contenido) | RichEditor manual, required | **BAJO** - Contenido principal |
| `status` | Select con default 'draft' | ✅ **PARCIAL** - Tiene default |
| `is_pinned` (Destacado) | Toggle manual | **BAJO** - Decisión editorial |
| `published_at` (Fecha) | DateTimePicker manual | **ALTO** - Default now() con timezone |
| `meta_title` | TextInput manual | **MEDIO** - Auto desde title si está vacío |
| `meta_description` | Textarea manual | **MEDIO** - Auto desde excerpt si está vacío |

### Estructura típica de noticias (Modelo Post)

**Archivo:** `app/Models/Post.php`

- **Campos principales:** user_id, category_id, title, slug, excerpt, body, status, is_pinned, published_at
- **SEO:** meta_title, meta_description
- **Media:** Spatie Media Library (featured + gallery)
- **Auditoría:** SoftDeletes + ActivityLog
- **Relaciones:** belongsTo User, belongsTo Category

### Tipos de noticias más frecuentes (Categorías existentes)

**Archivo:** `database/seeders/CategorySeeder.php`

| Categoría | Slug | Color | Palabras clave sugeridas |
|-----------|------|-------|--------------------------|
| Salud | salud | #EF4444 | salud, hospital, medicina, covid, vacuna, consulta |
| Infraestructura | infraestructura | #F59E0B | obra, construcción, asfalto, puente, carretera, edificio |
| Cultura | cultura | #8B5CF6 | cultura, tradición, festividad, folklore, arte, música |
| Educación | educacion | #3B82F6 | educación, escuela, colegio, universidad, estudiante, docente |

### Proceso de publicación en redes sociales actual

**Archivo:** `app/Filament/Pages/Settings/SiteSettings.php`

**Estado actual:**
- ✅ Configuración de redes sociales existe: social_facebook, social_twitter, social_youtube, social_instagram
- ❌ **NO hay automatización de publicación** - solo se configuran las URLs
- ❌ **NO hay botones de compartir** en el formulario de Post
- ❌ **NO hay generación de texto pre-formateado** para cada red social
- ❌ **NO hay registro** de cuándo se compartió una noticia

**Conclusión:** El proceso actual es 100% manual - el editor debe:
1. Publicar la noticia en Filament
2. Copiar el link manualmente
3. Ir a cada red social
4. Escribir el mensaje manualmente
5. Publicar manualmente

**Oportunidad de mejora:** Implementar la Opción C (13.4) para reducir este proceso a 2-3 clicks con textos pre-generados.

---

## 13.2 — Opción A: Campos inteligentes y autocompletado

> **Prioridad:** Alta | **Esfuerzo:** Bajo | **Impacto:** Alto

```
[x] Implementar Autor por defecto
    └─[x] Detectar usuario logueado automáticamente
    └─[x] Campo user_id oculto o readonly en formulario
    └─[x] Permitir override solo para super_admin (si necesita publicar por otro)

[x] Automatizar Fecha de publicación
    └─[x] Default: now() para published_at
    └─[x] Timezone configurado a America/La_Paz

[x] Sugerencia automática de Categoría
    └─[x] Implementar análisis de palabras clave en título
    └─[x] Mapear: "salud|hospital|medicina" → categoría Salud
    └─[x] Mapear: "obra|construcción|asfalto|puente" → Infraestructura
    └─[x] Mapear: "cultura|tradición|festividad" → Cultura
    └─[x] Mapear: "educación|escuela|colegio" → Educación
    └─[x] Mostrar sugerencia automáticamente (no forzado)

[x] Generación automática de Extracto
    └─[x] Si excerpt está vacío → tomar primeros 150 caracteres del body
    └─[x] Limpiar HTML tags para que sea texto plano
    └─[x] Añadir "..." al final si se trunca

[x] Slug inteligente desde Título
    └─[x] Campo slug disabled + dehydrated
    └─[x] Generar automáticamente con Str::slug() en live()

[x] Generación automática de SEO (bonus)
    └─[x] meta_title auto desde title si está vacío
    └─[x] meta_description auto desde excerpt si está vacío
```

---

## 13.3 — Opción B: Plantillas de noticias predefinidas

> **Prioridad:** Alta | **Esfuerzo:** Medio | **Impacto:** Alto

```
[x] Diseñar sistema de plantillas
    └─[x] Crear tabla post_templates (id, name, type, default_data)
    └─[x] Seeder con 3 plantillas base
    └─[x] UI: Selector de plantilla en "Crear Noticia"

[x] Plantilla "Comunicado Oficial"
    └─[x] Estructura: Título formal + Cuerpo estructurado + Firma
    └─[x] Categoría default: Infraestructura
    └─[x] Placeholder para: REF. N° / FECHA / ASUNTO
    └─[x] Texto base con formato institucional

[x] Plantilla "Evento / Actividad"
    └─[x] Campos destacados: Fecha, Hora, Lugar
    └─[x] Categoría default: Cultura
    └─[x] Estructura: ¿Qué? ¿Cuándo? ¿Dónde? ¿Quiénes asisten?
    └─[x] Placeholder para agenda/contacto

[x] Plantilla "Nota de Prensa"
    └─[x] Estructura periodística: Lead + Cuerpo + Contexto + Cita
    └─[x] Categoría default: Salud
    └─[x] Formato con pirámide invertida (lo importante primero)
    └─[x] Campo "Fuente" o "Contacto para más info"

[x] UI/UX en Filament
    └─[x] Sección "Plantilla" colapsable al inicio del formulario
    └─[x] Selector de plantilla con live update
    └─[x] Opción "Empezar en blanco" siempre disponible (placeholder)
```

---

## 13.4 — Opción C: Botón "Compartir en Redes" (semi-automático)

> **Prioridad:** Media | **Esfuerzo:** Medio | **Impacto:** Medio

```
[x] Preparar datos para redes sociales
    └─[x] Generar texto sugerido para Facebook (título + extracto + link)
    └─[x] Generar texto sugerido para Twitter/X (truncar a 280 chars)
    └─[x] Generar texto sugerido para WhatsApp
    └─[x] Preparar imagen destacada (og:image) automáticamente

[x] Implementar acciones en Filament
    └─[x] Botones de acción en header de página de edición:
        └─[x] "Compartir en Facebook" → abre popup con fb.com/sharer
        └─[x] "Compartir en X/Twitter" → abre popup con twitter.com/intent/tweet
        └─[x] "Compartir en WhatsApp" → abre wa.me
        └─[x] "Copiar texto" → copia al portapapeles el mensaje formateado

[x] Configuración de cuentas
    └─[x] URLs de redes sociales desde SiteSetting (ya configurado)
    └─[x] Configurar metatags Open Graph para previews correctos
    └─[x] Validar que imágenes tengan dimensiones óptimas (1200x630)

[x] Registro de actividad
    └─[x] Campo shared_to_social (boolean) en posts
    └─[x] Timestamp shared_at de cuando se compartió
    └─[x] Log simple de qué red se usó (auditoría via activitylog)

[!] NOTA: Automatización total deshabilitada por seguridad
    └─[x] No implementar publicación directa vía API (riesgo de errores públicos)
    └─[x] Siempre requerir revisión humana antes de publicar
    └─[x] Mantener control editorial institucional
```

---

## 13.5 — Opción D: Importador desde Word (DOCX)

> **Prioridad:** Baja | **Esfuerzo:** Alto | **Impacto:** Medio

```
[ ] Investigación de librerías
    └─[ ] Evaluar phpoffice/phpword para lectura de DOCX
    └─[ ] Probar extracción de texto con formato
    └─[ ] Validar manejo de imágenes incrustadas
    └─[ ] Verificar soporte de estilos de Word → HTML

[ ] Implementar parser DOCX
    └─[ ] Extraer propiedades del documento (título, autor, asunto)
    └─[ ] Separar contenido: Título (Heading 1) → título post
    └─[ ] Primer párrafo → campo excerpt
    └─[ ] Resto del contenido → campo body (convertido a HTML)
    └─[ ] Imágenes → extraer y subir a medialibrary

[ ] UI de importación
    └─[ ] Botón "Importar desde Word" en lista de Posts
    └─[ ] Dropzone o input file para DOCX
    └─[ ] Preview antes de confirmar importación
    └─[ ] Opciones: ¿Publicar inmediatamente? ¿Guardar como borrador?

[ ] Plantilla Word guía
    └─[ ] Crear documento .docx de ejemplo
    └─[ ] Instrucciones: "Usar Título 1 para el título de noticia"
    └─[ ] Formato recomendado para extracto y contenido
    └─[ ] Distribuir al equipo de comunicación

[ ] Validaciones y manejo de errores
    └─[ ] Detectar documentos sin formato correcto
    └─[ ] Mostrar advertencias si faltan campos obligatorios
    └─[ ] Fallback manual si la conversión falla
```

---

## 13.6 — Testing con usuarios reales (periodistas)

```
[ ] Preparar ambiente de prueba
    └─[ ] Branch feature/13-automatizacion-noticias
    └─[ ] Dataset de noticias de ejemplo
    └─[ ] Acceso para 2-3 usuarios del equipo de comunicación

[ ] Sesiones de testing
    └─[ ] Observar crear noticia con flujo actual vs nuevo
    └─[ ] Medir tiempo con cronómetro
    └─[ ] Documentar feedback y fricciones
    └─[ ] Identificar campos que aún generan confusión

[ ] Ajustes post-testing
    └─[ ] Refinar plantillas según uso real
    └─[ ] Ajustar palabras clave de categorización
    └─[ ] Mejorar textos de ayuda/ui
    └─[ ] Corregir bugs encontrados

[ ] Documentación y capacitación
    └─[ ] Crear video tutorial corto (3-5 min)
    └─[ ] Guía rápida impresa/pdf para escritorio
    └─[ ] Sesión de capacitación presencial/virtual
    └─[ ] FAQ basado en preguntas durante testing
```

---

## Resumen de Implementación Recomendada

### Fase 1 (Inmediata) — Campos Inteligentes
- Autor automático
- Fecha default "ahora"
- Slug desde título
- Extracto auto desde contenido

**Tiempo estimado:** 2-3 horas | **Impacto inmediato:** Alto

### Fase 2 (Semana 1) — Plantillas de Noticias
- 3 plantillas base listas
- Selector en UI
- Seeder con ejemplos

**Tiempo estimado:** 1 día | **Impacto:** Muy Alto

### Fase 3 (Semana 2) — Redes Sociales Semi-Auto
- Botones de compartir
- Textos pre-generados
- Registro de actividad

**Tiempo estimado:** 1 día | **Impacto:** Medio

### Fase 4 (Futuro) — Importador Word
- Solo si el equipo insiste en usar Word
- Prioridad baja por complejidad

**Tiempo estimado:** 2-3 días | **Impacto:** Medio

---

## Decisiones Pendientes

- [ ] ¿Incluir plantilla "Decreto/Resolución" además de las 3 base?
- [ ] ¿Permitir que usuarios creen sus propias plantillas personalizadas?
- [ ] ¿Agregar programación de publicación en redes (Hootsuite-style) en futuro?
- [ ] ¿Integrar con WhatsApp Business API para difusión institucional?

---

## Referencias

- Filament Actions: https://filamentphp.com/docs/actions
- Laravel Queue: https://laravel.com/docs/queues
- PHPWord Documentation: https://phpword.readthedocs.io/
- Open Graph Protocol: https://ogp.me/
