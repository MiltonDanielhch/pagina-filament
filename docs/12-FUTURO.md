# 12 — Features Futuras (Post-MVP)

> **Anterior:** `11-MIGRACION.md`
> **Semanas:** Post-lanzamiento — planificación a 18 meses
> **Objetivo:** Roadmap de evolución del sitio una vez el MVP esté en producción.

> Estas features **no bloquean el lanzamiento**. Se planifican en sprints mensuales después del go-live.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Criterios de priorización

Cada feature se clasifica por:

- **Impacto ciudadano** — ¿Cuántos ciudadanos se benefician?
- **Impacto editorial** — ¿Ahorra tiempo al equipo de comunicaciones?
- **Complejidad** — Baja / Media / Alta
- **Dependencias** — ¿Requiere otra feature o sistema?

---

## Mes 1–3 post-lanzamiento — Estabilización

```
[ ] Sistema de Newsletter
    └─[ ] Tabla: subscribers (email, name, verified_at, unsubscribed_at)
    └─[ ] Formulario de suscripción en el footer y en páginas de noticias
    └─[ ] Verificación de email (double opt-in)
    └─[ ] Comando para enviar newsletter: seleccionar posts y despachar
    └─[ ] Botón de baja (unsubscribe) en cada email
    └─[ ] Complejidad: Media | Impacto ciudadano: Alto

[ ] Contador de visitas por artículo
    └─[ ] Campo view_count en Post y Event
    └─[ ] Middleware que incrementa al cargar la vista
    └─[ ] Widget en dashboard: "Posts más visitados esta semana"
    └─[ ] Sin usar Google Analytics — privacidad compliant
    └─[ ] Complejidad: Baja | Impacto editorial: Medio

[ ] Compartir en redes sociales
    └─[ ] Botones en el detalle de post: Facebook, X (Twitter), WhatsApp, copiar link
    └─[ ] WhatsApp es el más relevante para el contexto boliviano
    └─[ ] Sin usar SDKs externos — solo links nativos de compartir
    └─[ ] Complejidad: Baja | Impacto ciudadano: Medio

[ ] Página de resultados del gobierno
    └─[ ] Modelo: Achievement (logro, descripción, fecha, área, imagen)
    └─[ ] Recurso Filament para gestionar logros
    └─[ ] Página pública: /resultados
    └─[ ] Complejidad: Baja | Impacto ciudadano: Alto

[ ] Mejoras de accesibilidad nivel AAA (opcional)
    └─[ ] Revisar elementos en nivel AAA que sean factibles sin alto costo
    └─[ ] Modo de alto contraste (botón en navbar)
    └─[ ] Tamaño de fuente ajustable
    └─[ ] Complejidad: Media | Impacto ciudadano: Medio
```

---

## Mes 3–6 post-lanzamiento — Funcionalidades cívicas

```
[ ] Portal de Transparencia integrado
    └─[ ] Sección /transparencia en el sitio principal
    └─[ ] Documentos públicos (contratos, licitaciones, presupuesto)
    └─[ ] Modelo: Document (tipo, año, descripción, archivo PDF)
    └─[ ] Búsqueda de documentos por tipo, año y palabra clave
    └─[ ] Integración con el sistema de Transparencia existente (si tiene API)
          o carga manual desde el panel Filament
    └─[ ] Complejidad: Media | Impacto ciudadano: Muy alto

[ ] Sistema de Denuncias / Sugerencias ciudadanas
    └─[ ] Formulario público: /denuncias
    └─[ ] Campos: tipo (denuncia/sugerencia), área de gobierno, descripción, adjunto
    └─[ ] Panel Filament: bandeja de entrada por área
    └─[ ] Estados: recibido, en proceso, resuelto, archivado
    └─[ ] Notificación al ciudadano cuando cambia el estado (si dejó email)
    └─[ ] Complejidad: Media | Impacto ciudadano: Muy alto

[ ] Directorio de funcionarios
    └─[ ] Modelo: Official (nombre, cargo, área, foto, email institucional)
    └─[ ] Página pública: /autoridades
    └─[ ] Organgigrama visual por área de gobierno
    └─[ ] Complejidad: Baja | Impacto ciudadano: Alto

[ ] Galería multimedia (fotos y videos)
    └─[ ] Modelo: Gallery (título, fecha, tipo: foto/video, álbum)
    └─[ ] Modelos: GalleryItem (media o link de YouTube/Vimeo)
    └─[ ] Página pública: /galeria con filtros por tipo y fecha
    └─[ ] Lightbox para visualización de fotos
    └─[ ] Embeds de YouTube (no subir videos al servidor)
    └─[ ] Complejidad: Media | Impacto ciudadano: Medio

[ ] Agenda del gobernador
    └─[ ] Modelo: Agenda (título, descripción, fecha, hora, lugar, público: sí/no)
    └─[ ] Página pública: /agenda
    └─[ ] Vista de calendario mensual (Alpine.js o Livewire)
    └─[ ] Exportar a Google Calendar / iCal
    └─[ ] Complejidad: Media | Impacto ciudadano: Medio
```

---

## Mes 6–12 post-lanzamiento — Digitalización de trámites

```
[ ] Catálogo de trámites
    └─[ ] Modelo: Procedure (nombre, descripción, requisitos, costo, tiempo estimado, área)
    └─[ ] Página pública: /tramites con buscador y filtros por área
    └─[ ] Cada trámite con link al sistema donde se gestiona (SISCOR u otro)
    └─[ ] Complejidad: Baja | Impacto ciudadano: Muy alto

[ ] Consulta de estado de trámites (integración SISCOR)
    └─[ ] Formulario en /tramites/consultar: ingresar número de expediente
    └─[ ] Consulta vía API al SISCOR (requiere que SISCOR tenga API)
    └─[ ] Si no tiene API: mostrar link directo al SISCOR
    └─[ ] Complejidad: Alta (depende de SISCOR) | Impacto ciudadano: Muy alto

[ ] Descargas de formularios y documentos oficiales
    └─[ ] Modelo: OfficialDocument (nombre, tipo, fecha, archivo PDF, área)
    └─[ ] Página: /descargas con búsqueda
    └─[ ] Gestión desde Filament (upload de PDFs)
    └─[ ] Complejidad: Baja | Impacto ciudadano: Alto

[ ] Portal de licitaciones y contrataciones
    └─[ ] Modelo: Tender (título, número, tipo, monto estimado, apertura, cierre)
    └─[ ] Documentos adjuntos (TOR, bases, addendas)
    └─[ ] Estados: convocatoria, en proceso, adjudicado, desierto
    └─[ ] Página: /licitaciones con filtros y buscador
    └─[ ] Notificación por email a interesados suscritos
    └─[ ] Complejidad: Media-Alta | Impacto ciudadano: Alto

[ ] Mapa interactivo del Beni
    └─[ ] Integración con Leaflet.js (open source, sin costo)
    └─[ ] Mostrar: municipios del departamento, proyectos de infraestructura
    └─[ ] Fuente de datos: GeoJSON del GADGET Beni
    └─[ ] Complejidad: Media | Impacto ciudadano: Medio
```

---

## Mes 12–18 post-lanzamiento — Plataforma departamental

```
[ ] Sistema de Estadísticas Departamentales
    └─[ ] Indicadores clave: población, área, municipios, PIB departamental
    └─[ ] Datos educativos, de salud, infraestructura
    └─[ ] Visualizaciones con Chart.js o Recharts
    └─[ ] Actualización anual desde el panel Filament
    └─[ ] Fuente: INE Bolivia + datos propios
    └─[ ] Complejidad: Media | Impacto ciudadano: Alto

[ ] Blog de áreas de gobierno
    └─[ ] Categorías de posts vinculadas a secretarías (Salud, Educación, etc.)
    └─[ ] Cada secretaría tiene su propio editor asignado
    └─[ ] Páginas de cada secretaría: /secretaria/salud, /secretaria/educacion
    └─[ ] Complejidad: Media | Impacto editorial: Alto

[ ] Multilenguaje (Español + idiomas indígenas)
    └─[ ] Agregar soporte para Movima y/o Tsimane (idiomas del Beni)
    └─[ ] Solo para páginas clave: homepage, trámites, contacto
    └─[ ] Usar spatie/laravel-translatable en los modelos
    └─[ ] Selector de idioma en el navbar
    └─[ ] Complejidad: Alta | Impacto ciudadano: Alto (comunidades originarias)

[ ] API pública de datos abiertos
    └─[ ] Endpoints REST para: noticias, eventos, funcionarios, indicadores
    └─[ ] Documentación con Swagger/OpenAPI
    └─[ ] Rate limiting por API key
    └─[ ] Permite que periodistas, investigadores y sistemas externos consuman datos
    └─[ ] Complejidad: Media | Impacto ciudadano: Medio

[ ] App móvil (PWA)
    └─[ ] Progressive Web App sobre el sitio existente
    └─[ ] Service Worker para funcionamiento offline básico
    └─[ ] Push notifications para noticias destacadas (via Web Push API)
    └─[ ] Instalable en Android e iOS desde el navegador
    └─[ ] No requiere publicar en las tiendas de apps
    └─[ ] Complejidad: Media | Impacto ciudadano: Alto

[ ] Integración con redes sociales del gobierno
    └─[ ] Auto-publicar noticias en Facebook/Twitter al publicar en el panel
    └─[ ] Via API de Meta y X (Twitter)
    └─[ ] Campo en el formulario de post: "Compartir en redes" (toggle)
    └─[ ] Complejidad: Media | Impacto editorial: Alto

[ ] Chatbot de atención ciudadana (IA)
    └─[ ] Chatbot en el sitio que responde preguntas frecuentes
    └─[ ] Base de conocimiento: FAQs de trámites, horarios, contactos
    └─[ ] Escalado a humano si no puede responder
    └─[ ] Complejidad: Alta | Impacto ciudadano: Muy alto
```

---

## Deuda técnica planificada

```
[ ] Actualización de dependencias
    └─[ ] Evaluar migración a Laravel 13 cuando sea estable (2026–2027)
    └─[ ] Actualizar Filament cuando salga versión mayor
    └─[ ] Mantener PHP en versión con soporte activo

[ ] Mejoras de infraestructura
    └─[ ] Evaluar CDN para assets estáticos (Cloudflare free plan)
    └─[ ] Evaluar migración a PostgreSQL si se necesita soporte GIS (mapas)
    └─[ ] Implementar full-text search nativo de MySQL si Meilisearch da problemas

[ ] Documentación
    └─[ ] Manual de usuario del panel (para el equipo editorial)
    └─[ ] Documentación técnica de la arquitectura
    └─[ ] Runbook de operaciones (ya iniciado en Fase 8)
    └─[ ] Guía de onboarding para nuevos desarrolladores

[ ] Testing
    └─[ ] Aumentar cobertura de tests al 80%+ en el año post-lanzamiento
    └─[ ] Agregar tests de performance automatizados (k6 o Artillery)
    └─[ ] Tests de accesibilidad automatizados en CI (axe-core)
```

---

## Resumen de priorización post-MVP

| Feature | Impacto ciudadano | Complejidad | Mes recomendado |
|---------|------------------|-------------|-----------------|
| Compartir en WhatsApp | Medio | Baja | 1 |
| Contador de visitas | Bajo | Baja | 1 |
| Newsletter | Alto | Media | 2 |
| Resultados del gobierno | Alto | Baja | 2 |
| Directorio de funcionarios | Alto | Baja | 3 |
| Catálogo de trámites | Muy alto | Baja | 4 |
| Portal de Transparencia | Muy alto | Media | 4 |
| Galería multimedia | Medio | Media | 5 |
| Sistema de denuncias | Muy alto | Media | 6 |
| Descargas de formularios | Alto | Baja | 6 |
| Portal de licitaciones | Alto | Media-Alta | 8 |
| Agenda del gobernador | Medio | Media | 8 |
| Mapa interactivo | Medio | Media | 10 |
| Estadísticas departamentales | Alto | Media | 12 |
| API pública | Medio | Media | 14 |
| Multilenguaje indígena | Alto | Alta | 15 |
| App PWA | Alto | Media | 16 |
| Chatbot IA | Muy alto | Alta | 18 |

---

*Este documento se revisa y prioriza mensualmente según las necesidades del equipo y la gobernación.*

*Fin del roadmap — volver a `00-INDICE.md` para ver la visión completa del proyecto.*
