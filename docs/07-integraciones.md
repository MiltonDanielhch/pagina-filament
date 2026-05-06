# 07 — Fase 6: Integración con Sistemas Externos

> **Anterior:** `06-FRONTEND.md`
> **Siguiente:** `08-RENDIMIENTO.md`
> **Semanas:** 8–9
> **Objetivo:** Links a sistemas externos con health checks automáticos. El homepage muestra en tiempo real si cada sistema está disponible.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
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
[ ] Migración: external_systems
    └─[ ] id
    └─[ ] name (string — ej: "Gaceta Jurídica")
    └─[ ] url (string — URL del sistema)
    └─[ ] description (string nullable — descripción breve)
    └─[ ] icon (string nullable — nombre de ícono o SVG)
    └─[ ] is_active (boolean — mostrar o no en homepage)
    └─[ ] order (integer — orden de aparición)
    └─[ ] last_status (enum: online, offline, unknown)
    └─[ ] last_checked_at (timestamp nullable)
    └─[ ] timestamps

[ ] Modelo: ExternalSystem
    └─[ ] Scope: active()
    └─[ ] Ordenado por: order ASC
    └─[ ] Método: isOnline() → last_status === 'online'

[ ] Seeder: ExternalSystemSeeder
    └─[ ] Gaceta Jurídica → https://gaceta.beni.gob.bo
    └─[ ] SISCOR → https://siscor.beni.gob.bo
    └─[ ] Transparencia → https://transparencia.beni.gob.bo
    └─[ ] Sistema de Almacén → (URL a confirmar en Fase 1)
    └─[ ] SENASMC/Minería → (URL a confirmar en Fase 1)
    └─[ ] SIRETRA → (URL a confirmar en Fase 1)

[ ] ExternalSystemResource en Filament
    └─[ ] CRUD completo para admin
    └─[ ] Campo de estado visible (solo lectura en tabla)
    └─[ ] Botón: "Verificar ahora" (dispara health check manual)
```

---

## 7.2 — Health checks automáticos

```
[ ] Job: CheckExternalSystemHealth
    └─[ ] Para cada ExternalSystem activo:
          ├─[ ] HTTP GET a la URL con timeout de 5 segundos
          ├─[ ] Si responde 200–399 → last_status = 'online'
          ├─[ ] Si responde 400+ o timeout → last_status = 'offline'
          └─[ ] Actualizar last_checked_at = now()
    └─[ ] Cachear resultado por 5 minutos (no golpear los sistemas en cada request)
    └─[ ] En caso de error de conexión: status = 'offline' (no lanzar excepción)

[ ] Programar el job
    └─[ ] En app/Console/Kernel.php (o Illuminate\Console\Scheduling):
          $schedule->job(CheckExternalSystemHealth::class)->everyFiveMinutes();
    └─[ ] En producción: verificar que el scheduler de Laravel esté corriendo
          (cron: * * * * * cd /var/www && php artisan schedule:run)

[ ] Cachear resultados
    └─[ ] Cache::put('external_systems_status', $results, 300) — 5 minutos
    └─[ ] El controller del homepage lee desde caché, no desde BD en cada request

[ ] Notificación por email si un sistema cae (opcional)
    └─[ ] Si last_status cambia de 'online' a 'offline' → enviar email al admin
    └─[ ] Evitar spam: solo notificar si el sistema lleva 2 checks consecutivos offline
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
[ ] Sección "Sistemas de la Gobernación" en homepage
    └─[ ] Título de sección
    └─[ ] Grid de cards — una por sistema externo activo
    └─[ ] Cada card muestra:
          ├─[ ] Ícono del sistema
          ├─[ ] Nombre del sistema
          ├─[ ] Descripción breve
          ├─[ ] Badge de estado: verde "Disponible" / rojo "No disponible" / gris "Sin información"
          └─[ ] Botón/link que abre el sistema en nueva pestaña

[ ] Componente: components/system-badge.blade.php
    └─[ ] Props: $system (ExternalSystem model)
    └─[ ] Variantes de color según last_status:
          ├─[ ] online → verde (bg-green-100 text-green-800)
          ├─[ ] offline → rojo (bg-red-100 text-red-800)
          └─[ ] unknown → gris (bg-gray-100 text-gray-800)
    └─[ ] aria-label en el link: "Abrir {nombre del sistema} (se abre en nueva pestaña)"
    └─[ ] Si está offline: mostrar card deshabilitada pero visible (no ocultar)

[ ] Mensaje de fallback si un sistema está caído
    └─[ ] Texto visible: "Temporalmente no disponible"
    └─[ ] No eliminar el card del DOM — el ciudadano debe saber que el sistema existe
```

---

## 7.4 — Widget en el panel admin

```
[ ] Widget: SystemStatusWidget en dashboard de Filament
    └─[ ] Tabla de sistemas con estado actual
    └─[ ] Columnas: nombre, URL, estado (badge), último chequeo
    └─[ ] Botón de actualización manual para cada sistema
    └─[ ] Se refresca automáticamente cada 5 minutos (polling)

[ ] Indicador visual en sidebar del panel
    └─[ ] Si algún sistema está offline → notificación en el panel admin
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
[ ] Tabla external_systems creada y seeded ✓
[ ] Job CheckExternalSystemHealth funcionando ✓
[ ] Scheduler configurado cada 5 minutos ✓
[ ] Homepage muestra badges de estado en tiempo real ✓
[ ] ExternalSystemResource en panel Filament ✓
[ ] SystemStatusWidget en dashboard del panel ✓
```

---

*Siguiente paso: `08-RENDIMIENTO.md` — Optimización, caché y métricas de performance.*
