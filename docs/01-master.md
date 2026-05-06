# 01 — Roadmap Master

> **Archivo anterior:** `00-INDICE.md`
> **Siguiente:** `02-ANALISIS.md`
> **Propósito:** Vista general de las 10 fases del proyecto, progreso acumulado y puntos de atención.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso general

| # | Fase | Semanas | Progreso |
|---|------|---------|----------|
| 1 | Análisis y planificación | 1 | **0%** |
| 2 | Setup y configuración inicial | 2 | **0%** |
| 3 | Estructura de datos | 3–4 | **0%** |
| 4 | Backend — Panel Filament | 4–6 | **0%** |
| 5 | Frontend — Sitio público | 6–8 | **0%** |
| 6 | Integración con sistemas externos | 8–9 | **0%** |
| 7 | Rendimiento y optimización | 9–10 | **0%** |
| 8 | Seguridad | 10–11 | **0%** |
| 9 | Despliegue | 12 | **0%** |
| 10 | Migración de contenido | 13–14 | **0%** |
| — | **Total** | **14 semanas** | **0%** |

---

## Hitos principales

```
Semana 2  → [ ] Entorno local funcional + CI/CD activo
Semana 4  → [ ] Base de datos migrada y seeds listos
Semana 6  → [ ] Panel Filament completo con todos los recursos
Semana 8  → [ ] Sitio público funcional en staging
Semana 9  → [ ] Integraciones y health checks activos
Semana 11 → [ ] Auditoría de seguridad aprobada
Semana 12 → [ ] Deploy a producción
Semana 14 → [ ] Contenido migrado + redirecciones 301 verificadas
```

---

## Prioridades del proyecto

### Alta prioridad (MVP)
1. **Panel de administración** — El equipo editorial debe poder publicar sin ayuda técnica
2. **Accesibilidad WCAG 2.1 AA** — Obligatorio para sitios de gobierno
3. **Rendimiento** — Lighthouse Performance > 90
4. **Seguridad** — 2FA en panel admin, headers correctos, WAF

### Media prioridad
1. **Buscador interno** — Feature más usada en sitios de gobierno
2. **Galería de imágenes** — Para eventos departamentales
3. **Modelo de Eventos** — Calendario de actividades
4. **Health checks** — Estado en vivo de sistemas externos

### Baja prioridad (post-MVP)
1. **Newsletter** — Suscripción por email
2. **Estadísticas** — Vistas por artículo
3. **Multimedia** — Embeds de YouTube/Vimeo

---

## Sistemas externos a mantener

| Sistema | URL | Estado actual |
|---------|-----|--------------|
| Gaceta Jurídica | https://gaceta.beni.gob.bo | Activo |
| SISCOR | https://siscor.beni.gob.bo | Activo |
| Transparencia | https://transparencia.beni.gob.bo | Activo |
| Sistema de Almacén | (URL interna) | Verificar |
| Sistema de Minería / SENASMC | (URL interna) | Verificar |
| SIRETRA | (URL interna) | Verificar |

> Estos sistemas no se reemplazan en el MVP. Se mantienen como links con indicador de estado (health check).

---

## Documentación de referencia

| Recurso | URL |
|---------|-----|
| Laravel 12 | https://laravel.com/docs/12.x |
| Filament v5 | https://filamentphp.com/docs |
| Tailwind CSS v4 | https://tailwindcss.com/docs |
| Alpine.js | https://alpinejs.dev |
| Livewire 3 | https://livewire.laravel.com |
| Coolify | https://coolify.io/docs |
| Spatie Media Library | https://spatie.be/docs/laravel-medialibrary |
| Pest PHP | https://pestphp.com/docs |

---

*Ver detalle de cada fase en los archivos `02` al `11`.*
