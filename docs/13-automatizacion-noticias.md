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
| 13.1 | Análisis de flujo actual y dolor de usuarios | **0%** | Alta |
| 13.2 | Opción A: Campos inteligentes y autocompletado | **0%** | Alta |
| 13.3 | Opción B: Plantillas de noticias predefinidas | **0%** | Alta |
| 13.4 | Opción C: Botón "Compartir en Redes" (semi-auto) | **0%** | Media |
| 13.5 | Opción D: Importador desde Word (DOCX) | **0%** | Baja |
| 13.6 | Testing con usuarios reales (periodistas) | **0%** | Alta |
| **Total Fase 13** | | **0%** |

---

## 13.1 — Análisis de flujo actual y dolor de usuarios

```
[ ] Entrevistas con equipo de comunicación
    └─[ ] Identificar cuántas noticias crean por día/semana
    └─[ ] Medir tiempo promedio de creación de una noticia
    └─[ ] Documentar pasos repetitivos que pueden automatizarse
    └─[ ] Identificar errores más comunes en publicación

[ ] Auditoría técnica del proceso actual
    └─[ ] Revisar campos que siempre se repiten (autor, fecha, categoría)
    └─[ ] Analizar estructura típica de noticias publicadas
    └─[ ] Identificar tipos de noticias más frecuentes
    └─[ ] Documentar proceso de publicación en redes sociales actual

[ ] Definir métricas de éxito
    └─[ ] Reducir tiempo de creación de 15 min → 5 min por noticia
    └─[ ] Eliminar 100% de campos repetitivos manuales
    └─[ ] Aumentar publicaciones en redes sociales acompañadas en 80%
```

---

## 13.2 — Opción A: Campos inteligentes y autocompletado

> **Prioridad:** Alta | **Esfuerzo:** Bajo | **Impacto:** Alto

```
[ ] Implementar Autor por defecto
    └─[ ] Detectar usuario logueado automáticamente
    └─[ ] Campo user_id oculto o readonly en formulario
    └─[ ] Permitir override solo para super_admin (si necesita publicar por otro)

[ ] Automatizar Fecha de publicación
    └─[ ] Default: now() para published_at
    └─[ ] Opción "Programar para más tarde" visible solo si se expande
    └─[ ] Timezone configurado a America/La_Paz

[ ] Sugerencia automática de Categoría
    └─[ ] Implementar análisis de palabras clave en título
    └─[ ] Mapear: "salud|hospital|medicina" → categoría Salud
    └─[ ] Mapear: "obra|construcción|asfalto|puente" → Infraestructura
    └─[ ] Mapear: "cultura|tradición|festividad" → Cultura
    └─[ ] Mostrar sugerencia con botón "Aplicar" (no forzado)

[ ] Generación automática de Extracto
    └─[ ] Si excerpt está vacío → tomar primeros 150 caracteres del body
    └─[ ] Limpiar HTML tags para que sea texto plano
    └─[ ] Añadir "..." al final si se trunca

[ ] Slug inteligente desde Título
    └─[ ] Campo slug disabled + dehydrated
    └─[ ] Generar automáticamente con Str::slug() en live()
    └─[ ] Validar unicidad antes de guardar
```

---

## 13.3 — Opción B: Plantillas de noticias predefinidas

> **Prioridad:** Alta | **Esfuerzo:** Medio | **Impacto:** Alto

```
[ ] Diseñar sistema de plantillas
    └─[ ] Crear tabla post_templates (id, name, type, default_data)
    └─[ ] Seeder con 3 plantillas base
    └─[ ] UI: Selector de plantilla en "Crear Noticia"

[ ] Plantilla "Comunicado Oficial"
    └─[ ] Estructura: Título formal + Cuerpo estructurado + Firma
    └─[ ] Categoría default: Comunicados Oficiales
    └─[ ] Placeholder para: REF. N° / FECHA / ASUNTO
    └─[ ] Texto base con formato institucional

[ ] Plantilla "Evento / Actividad"
    └─[ ] Campos destacados: Fecha, Hora, Lugar
    └─[ ] Categoría default: Eventos
    └─[ ] Estructura: ¿Qué? ¿Cuándo? ¿Dónde? ¿Quiénes asisten?
    └─[ ] Placeholder para agenda/contacto

[ ] Plantilla "Nota de Prensa"
    └─[ ] Estructura periodística: Lead + Cuerpo + Contexto + Cita
    └─[ ] Categoría default: Prensa
    └─[ ] Formato con pirámide invertida (lo importante primero)
    └─[ ] Campo "Fuente" o "Contacto para más info"

[ ] UI/UX en Filament
    └─[ ] Botón "Nueva Noticia Rápida" en header del recurso Posts
    └─[ ] Modal o dropdown para seleccionar plantilla
    └─[ ] Preview de plantilla antes de aplicar
    └─[ ] Opción "Empezar en blanco" siempre disponible
```

---

## 13.4 — Opción C: Botón "Compartir en Redes" (semi-automático)

> **Prioridad:** Media | **Esfuerzo:** Medio | **Impacto:** Medio

```
[ ] Preparar datos para redes sociales
    └─[ ] Generar texto sugerido para Facebook (título + extracto + link)
    └─[ ] Generar texto sugerido para Twitter/X (truncar a 280 chars)
    └─[ ] Preparar imagen destacada (og:image) automáticamente

[ ] Implementar acciones en Filament
    └─[ ] Checkbox "Preparar para redes sociales" en formulario Post
    └─[ ] Botones de acción en header de página de edición:
        └─[ ] "Compartir en Facebook" → abre popup con fb.com/sharer
        └─[ ] "Compartir en X/Twitter" → abre popup con twitter.com/intent/tweet
        └─[ ] "Copiar texto" → copia al portapapeles el mensaje formateado

[ ] Configuración de cuentas
    └─[ ] Agregar en .env: FACEBOOK_PAGE_URL, TWITTER_HANDLE
    └─[ ] Configurar metatags Open Graph para previews correctos
    └─[ ] Validar que imágenes tengan dimensiones óptimas (1200x630)

[ ] Registro de actividad
    └─[ ] Campo shared_to_social (boolean) en posts
    └─[ ] Timestamp de cuando se compartió
    └─[ ] Log simple de qué red se usó (auditoría)

[!] NOTA: Automatización total deshabilitada por seguridad
    └─[ ] No implementar publicación directa vía API (riesgo de errores públicos)
    └─[ ] Siempre requerir revisión humana antes de publicar
    └─[ ] Mantener control editorial institucional
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
