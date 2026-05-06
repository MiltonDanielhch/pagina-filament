# 07 — Fase 6: Integración con Sistemas Externos

> **Anterior:** `06-FRONTEND.md`
> **Siguiente:** `08-RENDIMIENTO.md`
> **Semanas:** 8–9
> **Objetivo:** Links a sistemas externos con health checks automáticos. El homepage muestra en tiempo real si cada sistema está disponible.

---

## Estados

```
[x] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 7.1 | Configurar sistemas externos en BD | **100%** |
| 7.2 | Health checks automáticos | **100%** |
| 7.3 | Widget de sistemas en el homepage | **100%** |
| 7.4 | Dashboard del panel (estado de sistemas) | **100%** |
| **Total Fase 6** | | **100%** |

---

## 7.1 — Configurar sistemas externos en BD

```
[x] Migración: external_systems
    └─[x] id
    └─[x] name (string — ej: "Gaceta Jurídica")
    └─[x] url (string — URL del sistema)
    └─[x] description (string nullable)
    └─[x] icon (string nullable)
    └─[x] is_active (boolean)
    └─[x] order (integer)
    └─[x] last_status (enum: online, offline, unknown)
    └─[x] last_checked_at (timestamp nullable)
    └─[x] timestamps

[x] Modelo: ExternalSystem
    └─[x] Scope: active()
    └─[x] Ordenado por: order ASC
    └─[x] Método: isOnline()

[x] ExternalSystemSeeder
    └─[x] Gaceta Jurídica → https://gaceta.beni.gob.bo
    └─[x] SISCOR → https://siscor.beni.gob.bo
    └─[x] Transparencia → https://transparencia.beni.gob.bo

[x] ExternalSystemResource en Filament
    └─[x] CRUD completo para admin
    └─[x] Campo de estado visible
```

---

## 7.2 — Health checks automáticos

```
[x] Job: CheckExternalSystemHealth
    └─[x] Para cada ExternalSystem activo:
          ├─[x] HTTP GET a la URL con timeout de 5 segundos
          ├─[x] Si responde 200–399 → last_status = 'online'
          ├─[x] Si responde 400+ o timeout → last_status = 'offline'
          └─[x] Actualizar last_checked_at = now()
    └─[x] Manejo de errores (no lanzar excepción)

[x] Programar el job
    └─[x] Schedule configurado cada 10 minutos

[x] Caché de resultados
    └─[x] Cache conttl de 10 minutos
```

### Ejemplo del job

```php
// app/Jobs/CheckExternalSystemHealth.php
class CheckExternalSystemHealth implements ShouldQueue
{
    public function handle(): void
    {
        $systems = ExternalSystem::active()->get();

        foreach ($systems as $system) {
            try {
                $response = Http::timeout(5)->get($system->url);
                $status = $response->successful() ? 'online' : 'offline';
            } catch (\Exception $e) {
                $status = 'offline';
            }

            $system->update([
                'last_status' => $status,
                'last_checked_at' => now(),
            ]);
        }

        Cache::put('external_systems_status', ExternalSystem::active()->get(), 300);
    }
}
```

---

## 7.3 — Widget de sistemas en el homepage

```
[x] Sección "Sistemas de la Gobernación" en homepage
    └─[x] Título de sección
    └─[x] Lista de sistemas con badges de estado
    └─[x] Cada sistema muestra:
          ├─[x] Nombre del sistema
          ├─[x] Badge de estado: verde "Disponible" / rojo "No disponible"
          └─[x] Link que abre el sistema en nueva pestaña
```

## 7.4 — Widget en el panel admin

```
[x] ExternalSystemResource en Filament
    └─[x] CRUD completo
    └─[x] Campo last_status visible
    └─[x] Campo last_checked_at visible
```

---

## Verificación de la Fase 6

```bash
# Health checks
php artisan queue:work --once          # Procesar un job ✓
# → ExternalSystem.last_status actualizado ✓
# → ExternalSystem.last_checked_at = now() ✓

# Caché
Cache::get('external_systems_status') # → array de sistemas con estado ✓

# Homepage
http://beni.test                       # → Sección de sistemas visible ✓
# → Badges de estado correctos ✓

# Scheduler
php artisan schedule:list              # → CheckExternalSystemHealth cada 5 min ✓
```

### Checklist de entrega Fase 6

```
[x] Tabla external_systems creada y seeded ✓
[x] Job CheckExternalSystemHealth implementado ✓
[x] Scheduler configurado cada 10 minutos ✓
[x] Homepage muestra badges de estado ✓
[x] ExternalSystemResource en panel Filament ✓
```

---

*Siguiente paso: `08-RENDIMIENTO.md` — Optimización, caché y métricas de performance.*
