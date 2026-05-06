# PROMPT MAESTRO — Gobierno del Beni (Bolivia)

---

## 📍 Mapa de Archivos del Proyecto

| Archivo | Ubicación | Descripción |
|---------|-----------|-------------|
| **Prompt Maestro** | `docs/PROMPT_MAESTRO.md` | Este archivo — contexto global del proyecto |
| **Índice Roadmap** | `docs/00-indice.md` | Índice de todas las fases |
| **Análisis** | `docs/02-analisis.md` | Fase 1: Análisis WordPress (100%) |
| **Setup** | `docs/03-setup.md` | Fase 2: Setup Laravel + Filament (60%) |
| **Datos** | `docs/04-datos.md` | Fase 3: Modelos y migraciones (100%) |
| **Backend** | `docs/05-backend.md` | Fase 4: Panel Filament (50%) |
| **Frontend** | `docs/06-frontend.md` | Fase 5: Sitio público (80%) |
| **Integraciones** | `docs/07-integraciones.md` | Fase 6: Sistemas externos (100%) |
| **Rendimiento** | `docs/08-rendimiento.md` | Fase 7: Performance (60%) |
| **Seguridad** | `docs/09-seguridad.md` | Fase 8: Seguridad (0%) |
| **Deploy** | `docs/10-deploy.md` | Fase 9: Docker + Coolify (0%) |

---

## 📊 Estado del Proyecto

| Fase | Nombre | Estado | % |
|------|--------|--------|---|
| ✅ **1. Análisis** | `02-analisis.md` | **COMPLETADO** | 100% |
| 🔄 **2. Setup** | `03-setup.md` | **EN PROGRESO** | 60% |
| ✅ **3. Datos** | `04-datos.md` | **COMPLETADO** | 100% |
| 🔄 **4. Backend** | `05-backend.md` | **EN PROGRESO** | 50% |
| ⏳ **5. Frontend** | `06-frontend.md` | PENDIENTE | 80% |
| ⏳ **6. Integraciones** | `07-integraciones.md` | PENDIENTE | 100% |
| ⏳ **7. Rendimiento** | `08-rendimiento.md` | PENDIENTE | 60% |
| ⏳ **8. Seguridad** | `09-seguridad.md` | PENDIENTE | 0% |
| ⏳ **9. Deploy** | `10-deploy.md` | PENDIENTE | 0% |

**MIGRACIÓN WORDPRESS → LARAVEL 12 + FILAMENT v5**

**Leyenda:** ✅ Completado | 🔄 Activo | ⏳ Pendiente

---

## Stack Tecnológico

- **Backend**: Laravel 12.58 + PHP 8.3
- **Panel Admin**: Filament v5.6.2
- **Frontend**: Blade + Tailwind CSS v4
- **Base de datos**: MySQL 8.0
- **Media**: Spatie Media Library
- **Auth**: Filament Shield (RBAC)
- **Deploy**: Docker + Coolify

---

## Tu Misión

→ Migrar el sitio de WordPress a Laravel 12 + Filament v5, paso a paso
→ Usar los documentos **docs/XX-*.md** como fuente de verdad
→ Mantener los checkboxes actualizados en cada avance
→ Nunca simplificar, nunca omitir pasos

---

## Contexto del Proyecto

**Proyecto**: beni.gob.bo  
**Institución**: Gobernación Autónoma Departamental del Beni (Bolivia)  
**Gobernador**: Dr. Alejandro Unzueta  
**Fase actual**: Backend (Fase 4) — Panel Filament

### Estado Completado

**Bloque I — Análisis WordPress (100%)**
- ✅ 4 páginas identificadas (Inicio, Gobernador, Transparencia, Contacto)
- ✅ 3 posts/news
- ✅ 4 categorías (Salud, Infraestructura, Cultura, Educación)
- ✅ Sistemas externos: Gaceta, SISCOR, Transparencia

**Bloque II — Setup (60%)**
- ✅ Laravel 12 instalado
- ✅ Filament v5 instalado
- ✅ Paquetes: Spatie Media Library, Backup, Sitemap, SEO Tools, Sluggable
- ✅ Filament Shield con roles
- ✅ Super admin creado (admin@admin.com)

**Bloque III — Datos (100%)**
- ✅ Modelos: Post, Category, Page, Slide, ExternalSystem, Event
- ✅ Migraciones ejecutadas
- ✅ Seeders con datos de prueba

**Bloque IV — Backend (50%)**
- ✅ PostResource, CategoryResource, PageResource
- ✅ SlideResource, ExternalSystemResource
- ✅ **EventResource** (recién creado)
- ✅ UserResource con roles
- ✅ Panel configurado con color institucional (Teal #0f766e)

---

## Reglas de Ejecución

### Regla 1 — Trabajar siempre con estado real

Cuando te pase un **Roadmap** (ej: `05-backend.md`), debes:

- Identificar todas las tareas `[~]` en progreso
- Si no hay `[~]`, identificar la siguiente `[ ]` pendiente
- **NUNCA** saltar tareas; seguir el orden lógico del documento
- Si hay `[!]` bloqueadas, proponer cómo desbloquearlas

### Regla 2 — Actualización obligatoria del Roadmap

Después de **CADA** avance real:

- Mostrar exactamente qué líneas cambian en el archivo de **Roadmap**
- Dar el bloque actualizado con los checks `[x]` marcados
- Formato: `"Fase X Backend: 50% → 55%"`

### Regla 3 — Micro-pasos, nunca todo de golpe

Cada respuesta tiene exactamente:

- 1 tarea principal o máximo 3 tareas relacionadas del mismo bloque
- Explicación breve del por qué antes del código
- Comandos exactos con flags completos
- Código completo (no snippets parciales)
- Ruta exacta de cada archivo

### Regla 4 — Verificar antes de ejecutar

**DETENTE** si detectas:

- Error de sintaxis en código nuevo
- Conflicto con recursos existentes
- Migración no ejecutada
- Paquete no instalado

→ Señala el problema, explica por qué ocurre, da la solución correcta

### Regla 5 — Nunca asumir, siempre verificar

Si algo no está claro, pregunta antes de escribir.

---

## Comandos útiles

| Comando | Descripción |
|---------|-------------|
| `php artisan migrate` | Ejecutar migraciones |
| `php artisan migrate:status` | Ver estado de migraciones |
| `php artisan db:seed` | Ejecutar seeders |
| `php artisan route:list --path=admin` | Listar rutas del admin |
| `composer show \| grep filament` | Ver versiones de Filament |

---

## URLs de prueba

- **Frontend**: http://localhost:8000
- **Admin**: http://localhost:8000/admin
- **Login**: http://localhost:8000/admin/login

---

## Cómo proseguir

**Último avance:** EventResource creado y registrado en el panel.

**Estado actual:**
- Fase 4 (Backend): 50% completado
- EventResource funcionando en /admin/events

**Para continuar:**
1. Revisar `docs/05-backend.md`
2. Identificar siguiente tarea pendiente
3. Ejecutar y actualizar文档es