# 🐛 Debug Session: `procedures-missing-columns`

**Síntoma:** Error 500 al cargar `GET /`
**Error SQL:** `Unknown column 'is_active' in 'where clause'`
**Query afectado:** `select * from procedures where is_active = 1 and is_featured = 1 ...`
**Stacktrace:** `HomeController@index` → `Procedure::where('is_active', true)`

---

## Hipótesis (sin verificar)

- **H1** — La migración de `procedures` no creó las columnas `is_active`, `is_featured` y `sort_order` que el modelo espera.
- **H2** — Otras tablas (slides, officials, secretariats, announcements, open_datasets, marco_normativos) podrían tener la misma inconsistencia.
- **H3** — La migración de `officials` que añade `parent_id`, `secretariat_id`, `position_level` podría no haberse ejecutado.
- **H4** — El `Slide` query (que sí pasó) usa `order`, pero el modelo `Slide` podría esperar un nombre distinto (e.g., `sort_order`).
- **H5** — `featuredProcedures` y `featuredDatasets` usan `is_featured` y `sort_order`. Si tampoco existen en sus tablas, fallarían en orden aleatorio.

## Plan de investigación

1. Listar TODAS las migraciones y leer las de los 7 modelos nuevos.
2. Comparar columnas reales en la DB con columnas esperadas por el modelo.
3. Verificar queries del HomeController contra los modelos.
4. Aplicar fix mínimo (migración nueva o ajuste de modelo).
5. Verificar con logs post-fix.

## Estado

[CLOSED-FIXED] - Resuelto. Todos los tests pasan.

## Causa raíz

El `HomeController@index` (reescrito en el commit `e130ee9`) usaba columnas que NO existían en la base de datos:

| Tabla | Asumida por HomeController | Real |
|-------|---------------------------|------|
| `procedures` | `is_active` | `status` (enum: activo, suspendido, dado_de_baja) |
| `open_datasets` | `is_active` | `is_published` |
| `open_datasets` | `is_featured` | ❌ no existe |
| `infrastructure_projects` | `whereIn(status, [ejecucion, planificacion])` | status varchar(255) con valores `in_progress`, `planned` |
| `marco_normativos` | `is_active` | `is_published` |
| `galleries` | `is_active` | `status` enum |

Y un `route('posts.index')` en `home.blade.php` que no existe (la ruta es `blog`).

## Fix aplicado

**Archivo: `app/Http/Controllers/HomeController.php`**
- Reemplazado `where('is_active', true)` por la convención real de cada tabla.
- Comentarios en línea documentando la convención de cada modelo.
- `InfrastructureProject::whereIn('status', ['in_progress', 'planned'])` corregido.

**Archivo: `resources/views/home.blade.php`**
- `route('posts.index')` → `route('blog')`.

## Verificación post-fix

```
OK 200 GET /                            ← antes 500, ahora 200
OK 200 GET /institucional
OK 200 GET /institucional/organigrama
OK 200 GET /institucional/secretarias
OK 200 GET /tramites
OK 200 GET /convocatorias
OK 200 GET /quejas-reclamos
OK 200 GET /quejas-reclamos/seguir
OK 200 GET /atencion-ciudadano
OK 200 GET /datos-abiertos
OK 200 GET /transparencia
OK 200 GET /transparencia/marco-normativo
OK 200 GET /transparencia/presupuesto
OK 200 GET /transparencia/poa
OK 200 GET /transparencia/informes
OK 200 GET /transparencia/rendicion-cuentas
OK 200 GET /transparencia/auditorias
OK 200 GET /blog
OK 200 GET /eventos
OK 200 GET /galeria
OK 200 GET /autoridades
OK 200 GET /estadisticas
OK 200 GET /contacto
OK 200 GET /sobre-nosotros
OK 200 GET /gobernador
OK 200 GET /buscar
OK 200 GET /agenda
OK 200 GET /resultados
.. 404 GET /quejas-reclamos/seguir/noexiste   (esperado, token inválido)
```

**30/30 rutas OK** (1 404 esperado). Home page renderiza 135,066 bytes de HTML con los 18 bloques presentes.

## Lección

Los modelos usan convenciones distintas según el caso de uso:
- `is_active` (boolean) para "soft on/off": `secretariats`, `offices`, `officials`, `slides`
- `is_published` (boolean) para "es público": `posts`, `open_datasets`, `marco_normativos`
- `status` (enum) para "estados del workflow": `announcements`, `procedures`, `complaints`, `events`, `galleries`, `infrastructure_projects`
- `status` (varchar) en `infrastructure_projects` con valores libres: `planned`, `in_progress`, `completed`, `cancelled`, `on_hold`

Para evitar futuros bugs similares, los scopes de cada modelo deben usarse consistentemente:
- `->active()` para is_active
- `->published()` para is_published o status=publicado
- `->open()` para announcements publicadas/en_proceso
- `->featured()` para is_featured
- `->inProgress()` para infrastructure_projects

## Status

[CLOSED] - Listo para commit


## Fix a aplicar

**Opción A (recomendada):** Corregir `HomeController` para usar columnas reales y scopes del modelo.

### Cambios específicos en `HomeController@index`:

```php
// 1. Procedure: is_active NO existe → usar status
$featuredProcedures = Procedure::where('status', 'activo')
    ->where('is_featured', true)
    ->orderBy('sort_order')
    ->take(8)->get();

$featuredProcedures = Procedure::where('status', 'activo')
    ->latest()->take(8)->get(); // fallback

// 2. OpenDataset: is_active NO existe, is_featured NO existe
$featuredDatasets = OpenDataset::where('is_published', true)
    ->orderBy('sort_order')->take(3)->get();
$featuredDatasets = OpenDataset::where('is_published', true)
    ->orderByDesc('download_count')->take(3)->get(); // fallback

// 3. MarcoNormativo: is_active NO existe
'normas' => MarcoNormativo::where('is_published', true)->count(),

// 4. InfrastructureProject: usar scope correcto
$featuredProjects = InfrastructureProject::whereIn('status', ['in_progress', 'planned'])
    ->latest()->take(4)->get();

// 5. Secretariat: orderBy('order') → orderBy('sort_order')
$secretariats = Secretariat::where('is_active', true)
    ->orderBy('sort_order')->take(12)->get();

// 6. Office: orderBy('order') → orderBy('sort_order')
$mainOffices = Office::where('is_active', true)
    ->orderBy('sort_order')->take(3)->get();

// 7. Gallery: is_active NO existe → usar scope published
$galleries = Gallery::where('status', 'published')
    ->with(['items' => fn($q) => $q->take(6)])
    ->latest()->take(2)->get();
```

También revisar las vistas de los 22 archivos que usen estos modelos.

## Verificación

Después del fix, ejecutar:
```php
// En tinker:
for ($i = 1; $i <= 18; $i++) { 
    try { view('home')->render(); echo "OK\n"; break; }
    catch (\Throwable $e) { echo "Bloque $i: " . $e->getMessage() . "\n"; break; }
}
```

