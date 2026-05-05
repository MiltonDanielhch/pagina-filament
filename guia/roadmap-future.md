# Roadmap — Funcionalidades Futuras y Mejoras

> **Stack:** Laravel 12 · Filament v5 · Features opcionales para el Beni
> 
> **Inspirado en:** Análisis de gobernaciones de Bolivia (Cochabamba, La Paz)
> **Objetivo:** Potenciar el proyecto con features avanzada

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
🟡 Fase 2      🔴 Fase 3
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| F.1 | Portal de Transparencia y Denuncias | **0%** |
| F.2 | Trámites en Línea (SISCOR v2) | **0%** |
| F.3 | Sistema de Gestión Documental | **0%** |
| F.4 | Portal de Datos Abiertos | **0%** |
| F.5 | App Móvil / PWA | **0%** |
| F.6 | Chatbot/Virtual Assistant | **0%** |
| F.7 | Sistema de Citas Médicas | **0%** |
| F.8 | Gestión de Proyectos | **0%** |
| F.9 | Sistema de Convivencia | **0%** |
| F.10 | Geoportal / GIS | **0%** |
| **Total Futuros** | | **0%** |

---

## Análisis de Gobernaciones Bolivianas

### Estructura Actual Beni (Referencia)

```
┌─────────────────────────────────────────────────────────────────────┐
│                    GOBERNACIÓN DEL BENI                             │
│                 Dr. Alejandro Unzueta Shiriqui                      │
│                      Gobernador                                    │
└──────────────────────────┬──────────────────────────────────────────┘
                           │
        ┌──────────────────┼──────────────────┐
        ▼                  ▼                  ▼
┌──────────────┐    ┌──────────────┐    ┌──────────────┐
│  DESPACHO   │    │ SECRETARÍAS  │    │  ASAMBLEA   │
│  GOBERNACIÓN│    │ (10+ áreas)  │    │ LEGISLATIVA │
└──────────────┘    └──────────────┘    └──────────────┘
                           │
         ┌────────────────┼────────────────┐
         ▼                ▼                ▼
   ┌───────────┐    ┌───────────┐    ┌───────────┐
   │ Gaceta   │    │ SISCOR    │    │Sistemas  │
   │ Jurídica │    │Trámites   │    │ Externos │
   └───────────┘    └───────────┘    └───────────┘
```

### Comparativa con Otras Gobernaciones

| Feature | Beni (Actual) | Cochabamba | La Paz | Propuesta |
|---------|--------------|-----------|-------|----------|
| Portal Transparente | 🔴 Basic | 🟢 Full | 🟢 Full | **🟡 Improve** |
| Trámites Online | 🔴 Siscor v1 | 🟢 iGOB | 🟢 iGOB 24/7 | **🟡 Upgrade** |
|-app Móvil | 🔴 No | 🔴 No | 🟢 Yes | **🟡 Add** |
| Denuncias | 🔴 No | 🔴 No | 🟢 Yes | **🟡 Add** |
| Datos Abiertos | 🔴 No | 🔴 No | 🟢 Yes | **🟡 Add** |
| GIS/Mapas | 🔴 No | 🔴 No | 🟢 Yes | **🟡 Add** |
| Chatbot IA | 🔴 No | 🔴 No | 🔴 No | **🟡 Add** |

---

## F.1 — Portal de Transparencia y Denuncias

> **Referencia:** La Paz tiene unidad强大的 de transparencia
> **Inspiración:** https://lapaz.bo/transparencia/

### Descripción
- Portal de rendición de cuentas
- Sistema de denuncias ciudadanas
- Seguimiento de denuncias
- Estadísticas de corrupción
- Información de servidores públicos

### Features

```
[ ] Portal de Transparencia
    └─[ ] Presupuesto ejecutado
    └─[ ] Planes de acción
    └─[ ] Informes de gestión
    └─[ ] Nómina de funcionarios

[ ] Sistema de Denuncias
    └─[ ] Formulario de denuncia
    └─[ ] Seguimiento por código
    └─[ ] Notificaciones al denunciante
    └─[ ] Historial de denuncias

[ ] Mapa de Riesgos
    └─[ ] Áreas vulnerables
    └─[ ] Indicadores
    └─[ ] Alertas

[ ] Rendición de Cuentas
    └─[ ] Informes trimestrales
    └─[ ] Visualización de datos
    └─[ ] Descarga de documentos
```

### Modelos

```php
// App/Models/Transparency/Report.php
class Report extends Model {
    protected $table = 'transparency_reports';
    public function category(): BelongsTo
    public function attachments(): HasMany
    public function department(): BelongsTo
}

// App/Models/Transparency/Denounce.php
class Denounce extends Model {
    protected $table = 'denounces';
    public function category(): BelongsTo
    public function status(): BelongsTo
    public function comments(): HasMany
    public function department(): BelongsTo
}
```

### Recursos Filament

```
[ ] TransparencyReportResource
    └─[ ] CRUD completo
    └─[ ] Fechas de publicación
    └─[ ] Adjuntos

[ ] DenounceResource
    └─[ ] CRUD interno
    └─[ ] Cambios de estado
    └─[ ] Asignación
    └─[ ] Respuesta
```

---

## F.2 — Trámites en Línea (SISCOR v2)

> **Referencia:** La Paz iGOB 24/7
> **Inspiración:** https://lapaz.bo/

### Descripción
- Sistema de seguimiento de trámites mejorado
- Citas previas
- Pagos en línea
- Notificacionespush
- Firma digital

### Features

```
[ ] Catálogo de Trámites
    └─[ ] Listado completo
    └─[ ] Requisitos
    └─[ ] Tiempo estimado
    └─[ ] Costo

[ ] Solicitud Digital
    └─[ ] Formularios dinámicos
    └─[ ] Adjuntos digitales
    └─[ ] Firma digital (opcional)

[ ] Seguimiento
    └─[ ] Timeline de estado
    └─[ ] Notificaciones
    └─[ ] Historial

[ ] Citas Previas
    └─[ ] Agenda online
    └─[ ] Selección de horario
    └─[ ] Recordatorio

[ ] Pagos en Línea
    └─[ ] Integration con banco
    └─[ ] Comprobantes
    └─[ ] Deudas pendientes
```

### Modelos

```php
// App/Models/Procedure/Procedure.php
class Procedure extends Model {
    protected $table = 'procedures';
    public function category(): BelongsTo
    public function requirements(): HasMany
    public function steps(): HasMany
}

// App/Models/Procedure/Request.php
class Request extends Model {
    protected $table = 'procedure_requests';
    public function procedure(): BelongsTo
    public function applicant(): BelongsTo
    public function payments(): HasMany
    public function documents(): HasMany
    public function statusLogs(): HasMany
}
```

---

## F.3 — Sistema de Gestión Documental

### Descripción
- Oficios y memorándums
- Flujo de aprobación
- Firmas digitales
- Archivo digital

### Features

```
[ ] Gestión de Documentos
    └─[ ] Crear documento
    └─[ ] Templates
    └─[ ] Firmas
    └─[ ] Numeración automática

[ ] Flujo Documental
    └─[ ] Aprobaciones
    └─[ ] Derivación
    └─[ ] Seguimiento

[ ] Archivo
    └─[ ] Indexación
    └─[ ] Búsqueda
    └─[ ] Conservación
```

---

## F.4 — Portal de Datos Abiertos

> **Referencia:** La Paz datos abiertos
> **Inspiración:** datos.gob.bo

### Descripción
- Datasets descargables
- APIs públicas
- Visualizaciones
- Indicadores departamentales

### Features

```
[ ] Catálogo de Datos
    └─[ ] Datasets por categoría
    └─[ ] Metadatos
    └─[ ] Frecuencia actualización

[ ] APIs
    └─[ ] REST API pública
    └─[ ] Documentación
    └─[ ] Rate limiting

[ ] Visualizaciones
    └─[ ] Gráficos interactivos
    └─[ ] Mapas
    └─[ ] Dashboards
```

---

## F.5 — App Móvil / PWA

> **Referencia:** La Paz tiene app/web progresiva

### Descripción
- App web progresiva (PWA)
- Notificacionespush
- Acceso offline básico
- Modo osc dark

### Features

```
[ ] PWA Setup
    └─[ ] Manifest.json
    └─[ ] Service Worker
    └─[ ] Offline fallback

[ ] Funcionalidades
    └─[ ] Noticias
    └─[ ] Trámites
    └─[ ] Denuncias
    └─[ ] Contacto

[ ] Notificaciones
    └─[ ] FCM setup
    └─[ ] Push notifications
    └─[ ] In-app messages
```

---

## F.6 — Chatbot / Asistente Virtual

### Descripción
- IA para atenciónciudadana
- Preguntas frecuentes
- Guía de trámites
- Disponible 24/7

### Features

```
[ ] Chatbot
    └─[ ] NLP integration
    └─[ ] Flujo de conversación
    └─[ ] Escalamiento humano

[ ] Capacidades
    └─[ ] Info general
    └─[ ] Consulta de trámites
    └─[ ] Estado de solicitud
    └─[ ] Denuncias
```

---

## F.7 — Sistema de Citas Médicas

> **Referencia:** Otros departamentos tienen salud digital

### Descripción
- Citas para centros de saluddepartamentales
- Historial médico
- Telemedicina básica

### Features

```
[ ] Citas Médicas
    └─[ ] Reserva online
    └─[ ] Recordatorio
    └─[ ] Cancelación

[ ] Historia Clínica
    └─[ ] Datos del paciente
    └─[ ] Historial de atenciones
    └─[ ] Vacunas
```

---

## F.8 — Sistema de Gestión de Proyectos

### Descripción
- Seguimiento de proyectosPOA
- Indicadores
- Reportes
- Mapas de inversión

### Features

```
[ ] Proyectos
    └─[ ] Registro de proyectos
    └─[ ] Seguimiento
    └─[ ] Indicadores
    └─[ ] reports

[ ] Presupuesto
    └─[ ] Asignación
    └─[ ] Ejecución
    └─[ ] Variaciones
```

---

## F.9 — Sistema de Convivencia

### Descripción
- Registro civil
- Certificados
- Matrimonios
- Defunciones

### Features

```
[ ] Registro Civil
    └─[ ] Nacimientos
    └─[ ] Matrimonios
    └─[ ] Defunciones

[ ] Certificados
    └─[ ] En línea
    └─[ ] Pago
    └─[ ] Entrega
```

---

## F.10 — Geoportal / GIS

> **Referencia:** La Paz tiene sistema territorial
> **Inspiración:** sitservicios.lapaz.bo

### Descripción
- Mapas interactivos
- Catastro
- Uso de suelos
- Proyectosgeorreferenciados

### Features

```
[ ] Mapas
    └─[ ] Visor interactivo
    └─[ ] Capas múltiples
    └─[ ] Búsqueda espacial

[ ] Capas
    └─[ ] Proyectos
    └─[ ] Establecimientos
    └─[ ] Vías
    └─[ ] Terrenos
```

---

## Organigrama Propuesto para el Beni (Future State)

```
┌────────────────────────────────────────────────────────────────────────────┐
│              GOBERNACIÓN AUTÓNOMA DEPARTAMENTAL DEL BENI                   │
│                  Dr. Alejandro Unzueta Shiriqui                     │
│                           Gobernador                                │
└─────────────────────────────┬──────────────────────────────────────┘
                              │
      ┌───────────────────────┼───────────────────────┐
      ▼                       ▼                       ▼
┌─────────────┐         ┌─────────────┐         ┌─────────────┐
│ DESPACHO   │         │SECRETARÍAS │         │ ASAMBLEA  │
│ GOBERNADOR │         │ (12 áreas) │         │LEGISLATIVA│
└─────────────┘         └─────────────┘         └─────────────┘
      │                       │
      │         ┌────────────┼────────────┐
      │         ▼            ▼            ▼
      │   ┌─────────┐ ┌─────────┐ ┌─────────┐
      │   │ SECRET │ │ SECRET │ │ SECRET │
      │   │PLANIFIC│ │FINANZAS│ │SALUD   │
      │   └───────┘ └───────┘ └───────┘
      │         │            │            │
      │         ▼            ▼            ▼
      │   ┌───────���─┐ ┌─────────┐ ┌─────────┐
      │   │ SECRET │ │ SECRET │ │ SECRET │
      │   │ EDUC   │ │ OBRA   │ │ MEDIO  │
      │   │        │ │ PÚBLICA│ │ AMB.   │
      │   └───────┘ └───────┘ └───────┘
      │         │            │            │
      │         ▼            ▼            ▼
      │   ┌─────────────┐ ┌─────────────┐ ┌────────────┐
      └──►│ SEDEGES  │ │ SEDCAM   │ │ SENASMC  │
          │(Gestión  │ │(Caminos) │ │(Minería)│
          │ Social) │ │         │ │         │
          └────────┘ └────────┘ └─────────┘
                      │
                      ▼
            ┌─────────────────────────────────┐
            │    DIRECCIÓN DE SISTEMAS Y       │
            │      TELECOMUNICACIONES         │
            │   (Área Tech del Futuro)       │
            └──────────────────────────────┘
                      │
    ┌─────────────────┼─────────────────┐
    ▼                 ▼                 ▼
┌──────────┐   ┌──────────┐    ┌──────────┐
│ Portal   │   │ SISCOR   │    │ Gaceta   │
│Digital  │   │   v2    │    │Jurídica  │
│Ciudadano │   │         │    │Digital  │
└──────────┘   └──────────┘    └──────────┘
```

### Secretarías Propuestas (Basado en Ley 99 + Análisis)

| # | Secretaría | Función Principal | Sistemas Relacionados |
|---|-----------|------------------|-------------------|
| 1 | Planificación y Desarrollo | Planes, proyectos, estadísticas | GIS, DatosAbiertos |
| 2 | Finanzas y Administración | Presupuesto, contador | Backup, Reports |
| 3 | Desarrollo Humano y Social | Educación, cultura, deportes | SEDEGES, Becas |
| 4 | Salud | Centros de salud, epidemiología | CitasMédicas |
| 5 | Secretaría General | Jurídico, rrhh | GestiónDocumental |
| 6 | Desarrollo Productivo | Economía, turismo | Empresas, Pymes |
| 7 | Minería y Energía | Recursos naturales | SENASMC |
| 8 | Medio Ambiente | Recursos hídricos, gestión | Monitoreo |
| 9 | Obras Públicas y Servicios | Infraestructura vial | SEDCAM |
|10 | Transparencia y Anticorrupción | Denuncias, control | PortalTransparencia |
|11 | Sistemas y Telecomunicaciones | TI (Área actual) | Portal, SISCOR |
|12 | Coordinación | Enlace con municipios | Interoperabilidad |

---

## Priorización por Impacto

### Alta Prioridad (Año 1)
1. **F.1 Portal de Transparencia** — Requisito legal
2. **F.2 Trámites v2** — Necesidadciudadana
3. **F.3 GestiónDocumental** — Eficiencia interna

### Media Prioridad (Año 2)
4. **F.4 DatosAbiertos** — Transparencia avanzada
5. **F.5 PWA** — Accesibilidad
6. **F.10 GIS** — Infraestructura

### Baja Prioridad (Año 3+)
7. **F.6 Chatbot** — IA costos
8. **F.7 CitasMédicas** — Coordinación Salud
9. **F.8 Proyectos** — POA digital
10. **F.9 Convivencia** — Registro civil

---

## Dependencias entre Features

```
F.1 (Transparencia) ──────► F.4 (DatosAbiertos)
      │                         │
      │                         ▼
      │                  F.10 (GIS) - map with projects
      │
F.2 (Trámites) ────────► F.5 (PWA)
      │                         │
      │                         ▼
      │                  F.6 (Chatbot) - integrations
      │
F.3 (GestiónDoc) ──────► F.7 (Citas) - workflows
      │
      ▼
F.8 (Proyectos) ───────► F.4 (DatosAbiertos)
```

---

## Stack Tecnológico para Features Futuras

| Feature | Tecnología |
|---------|-----------|
| Portal Transparencia | Filament + Charts |
| Trámites v2 | Filament + Livewire Forms |
| Gestión Doc | Filament + Firmas digital |
| DatosAbiertos | API resource + Swagger |
| PWA | Vite PWA + Workbox |
| Chatbot | Botpress / Langchain |
| Citas Médicas | Filament + Calendar |
| GIS | Leaflet / Mapbox |
| Proyectos | Filament + Gantt |

---

## Tiempo Estimado Total Features Futuras

- **Año 1 (Alta prioridad)**: 6 meses
- **Año 2 (Media prioridad)**: 6 meses  
- **Año 3 (Baja prioridad)**: 6 meses

**Total**: 18 meses (post-MVP)

---

## Documentación de Referencia

| Recurso | URL |
|---------|-----|
| La Paz Transparencia | https://lapaz.bo/transparencia/ |
| La Paz iGOB | https://lapaz.bo/ |
| Cochabamba Gaceta | https://gaceta.beni.gob.bo |
| Datos Bolivia | https://datos.gob.bo |

---

*Documento creado para planificación futura*
*Fecha: Mayo 2026*
*Inspirado en: Análisis de gobernaciones de Bolivia*