# Roadmaps — beni.gob.bo

> **Proyecto:** Migración WordPress → Laravel 12 + Filament v5
> **Stack:** Laravel 12 · Filament v5 · Tailwind CSS · Livewire · Alpine.js · Docker · Coolify
> **Fecha:** Mayo 2026

---

## Por dónde empezar

Lee los roadmaps **en este orden numérico**. Cada número indica la secuencia de ejecución.

| # | Archivo | Descripción | Semanas |
|---|---------|-------------|---------|
| 00 | `00-INDICE.md` | Este archivo — índice y guía de lectura | — |
| 01 | `01-MASTER.md` | Roadmap maestro — visión general de las 10 fases | 1–14 |
| 02 | `02-ANALISIS.md` | Fase 1 — Análisis y planificación del sitio actual | Sem 1 |
| 03 | `03-SETUP.md` | Fase 2 — Setup inicial, entorno, CI/CD y testing | Sem 2 |
| 04 | `04-DATOS.md` | Fase 3 — Modelos, migraciones y estructura de BD | Sem 3–4 |
| 05 | `05-BACKEND.md` | Fase 4 — Panel Filament, recursos y permisos | Sem 4–6 |
| 06 | `06-FRONTEND.md` | Fase 5 — Sitio público (Landing page) | Sem 6–8 |
| 07 | `07-INTEGRACIONES.md` | Fase 6 — Sistemas externos y health checks | Sem 8–9 |
| 08 | `08-RENDIMIENTO.md` | Fase 7 — Optimización y performance | Sem 9–10 |
| 09 | `09-SEGURIDAD.md` | Fase 8 — Seguridad (ampliada a 2 semanas) | Sem 10–11 |
| 10 | `10-DEPLOY.md` | Fase 9 — Infraestructura, Docker, Coolify y deploy | Sem 12 |
| 11 | `11-MIGRACION.md` | Fase 10 — Migración de contenido desde WordPress | Sem 13–14 |
| 12 | `12-FUTURO.md` | Features futuras — post-MVP (18 meses) | Post-MVP |

---

## Estados usados en todos los archivos

```
[ ] Pendiente
[~] En progreso
[x] Completado
[!] Bloqueado — requiere acción antes de continuar
```

---

## Resumen de tiempo estimado

| Escenario | Tiempo |
|-----------|--------|
| 1 desarrollador | 14 semanas |
| 2 desarrolladores | 9–10 semanas |
| Features futuras (post-MVP) | 18 meses adicionales |

> Las 2 semanas extra respecto al plan original cubren testing automatizado y seguridad ampliada — no negociables para un sitio de gobierno.

---

## Dependencias críticas entre fases

```
01-MASTER
    │
    ├─► 02-ANALISIS  (sem 1)
    │       └─► 03-SETUP  (sem 2)
    │               └─► 04-DATOS  (sem 3–4)
    │                       └─► 05-BACKEND  (sem 4–6)
    │                               └─► 06-FRONTEND  (sem 6–8)
    │                                       └─► 07-INTEGRACIONES  (sem 8–9)
    │                                               └─► 08-RENDIMIENTO  (sem 9–10)
    │                                                       └─► 09-SEGURIDAD  (sem 10–11)
    │                                                               └─► 10-DEPLOY  (sem 12)
    │                                                                       └─► 11-MIGRACION  (sem 13–14)
    │
    └─► 12-FUTURO  (post-MVP, paralelo en planificación)
```

---

## Stack tecnológico

| Componente | Tecnología | Versión |
|------------|-----------|---------|
| Framework | Laravel | 12.x |
| Panel admin | Filament | v5 |
| PHP | PHP | ^8.3 |
| Base de datos | MySQL | 8.0 (o PostgreSQL 15+) |
| CSS | Tailwind CSS | v4 (evaluar estabilidad) |
| JS interactivo | Alpine.js | 3.x |
| Componentes reactivos | Livewire | 3.x |
| Editor de contenido | Tiptap | 2.x |
| Autenticación/Roles | Filament Shield | verificar v5 |
| Media | Spatie Media Library | 11.x |
| SEO meta tags | artesaos/seotools | latest |
| Sitemap | spatie/laravel-sitemap | latest |
| Backup | Spatie Backup | 8.x |
| Búsqueda | Laravel Scout + Meilisearch | latest |
| Colas | Redis + Laravel Horizon | latest |
| Testing | Pest + Laravel Dusk | latest |
| Logs de auditoría | spatie/laravel-activitylog | latest |
| Monitoreo de errores | Sentry | latest |
| Deploy | Coolify (self-hosted) | latest |
| Contenedores | Docker + Nginx + PHP-FPM | — |

---

*Generado en Mayo 2026 para la Gobernación Autónoma Departamental del Beni*
