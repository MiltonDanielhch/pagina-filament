# 11 — Fase 10: Migración de Contenido desde WordPress

> **Anterior:** `10-DEPLOY.md`
> **Siguiente:** `12-FUTURO.md`
> **Semanas:** 13–14
> **Objetivo:** Todo el contenido del sitio WordPress actual migrado al nuevo sistema. Redirecciones 301 verificadas. Sin pérdida de SEO.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 11.1 | Preparación y exportación desde WordPress | **0%** |
| 11.2 | Script de migración de posts | **0%** |
| 11.3 | Migración de páginas estáticas | **0%** |
| 11.4 | Migración de imágenes y media | **0%** |
| 11.5 | Configurar redirecciones 301 | **0%** |
| 11.6 | Migración del menú de navegación | **0%** |
| 11.7 | Validación completa post-migración | **0%** |
| 11.8 | Go-live y monitoreo primera semana | **0%** |
| **Total Fase 10** | | **0%** |

---

## 11.1 — Preparación y exportación desde WordPress

```
[ ] Acceso a WordPress actual
    └─[ ] Credenciales de la base de datos WordPress
    └─[ ] Acceso FTP/SFTP para descargar imágenes (wp-content/uploads/)
    └─[ ] Credenciales del panel de administración de WordPress

[ ] Exportar contenido
    └─[ ] Opción A — Exportación WP nativa:
          WordPress Admin → Herramientas → Exportar → Seleccionar "Todo el contenido"
          → Descarga un archivo .xml (WXR — WordPress eXtended RSS)
    └─[ ] Opción B — Acceso directo a la BD (más completo):
          mysqldump wordpress_db > wordpress_backup.sql
          → Permite migrar datos más fielmente

[ ] Inventario pre-migración
    └─[ ] Anotar cantidad total de:
          ├─[ ] Posts publicados: ___
          ├─[ ] Posts en borrador: ___
          ├─[ ] Páginas publicadas: ___
          ├─[ ] Categorías: ___
          ├─[ ] Imágenes en Media Library: ___
          └─[ ] Total de usuarios: ___
    └─[ ] Esta cifra es el objetivo de verificación post-migración

[ ] Backup completo de WordPress antes de iniciar
    └─[ ] Base de datos: mysqldump completo
    └─[ ] Archivos: zip de wp-content/uploads/
    └─[ ] Guardar en ubicación segura (no en el servidor de producción)
```

---

## 11.2 — Script de migración de posts

> Ejecutar primero en staging. Solo pasar a producción después de validar.

```
[ ] Crear comando Artisan: php artisan make:command MigrateWordPressPosts

[ ] Lógica del comando (MigrateWordPressPosts.php)
    └─[ ] Leer el archivo XML exportado o conectar a la BD de WP
    └─[ ] Para cada post de WordPress:
          ├─[ ] Mapear campos:
          │     WP post_title       → Post.title
          │     WP post_name        → Post.slug (verificar unicidad)
          │     WP post_content     → Post.body (limpiar shortcodes)
          │     WP post_excerpt     → Post.excerpt
          │     WP post_status      → Post.status (publish→published, draft→draft)
          │     WP post_date        → Post.published_at
          │     WP category         → Post.category_id (mapear nombres)
          │     WP post_author      → Post.user_id (mapear emails)
          ├─[ ] Limpiar contenido:
          │     └─[ ] Eliminar shortcodes de WordPress [gallery], [caption], etc.
          │     └─[ ] Reemplazar URLs de imágenes de WP por las nuevas URLs
          │     └─[ ] Eliminar estilos inline innecesarios de Elementor/Gutenberg
          └─[ ] Registrar en log: post migrado / error al migrar

[ ] Mapeo de categorías
    └─[ ] Crear tabla de equivalencias:
          WP category slug → Laravel Category.id
    └─[ ] Si una categoría de WP no existe en Laravel → crearla automáticamente

[ ] Mapeo de autores
    └─[ ] Si el email del autor de WP existe en users → asignar ese user_id
    └─[ ] Si no existe → asignar al usuario "Administrador" o crear el usuario

[ ] Manejo de slugs duplicados
    └─[ ] Si ya existe un post con ese slug → agregar sufijo numérico: slug-2, slug-3

[ ] Ejecutar en staging
    └─[ ] php artisan migrate:wordpress-posts --source=wordpress_export.xml
    └─[ ] Verificar: count en Laravel == count en WordPress ✓
    └─[ ] Revisar manualmente 10 posts al azar ✓
```

### Ejemplo de comando simplificado

```php
// app/Console/Commands/MigrateWordPressPosts.php
class MigrateWordPressPosts extends Command
{
    protected $signature = 'migrate:wordpress-posts {--source=}';

    public function handle(): void
    {
        $xmlPath = $this->option('source') ?? storage_path('wordpress_export.xml');
        $xml = simplexml_load_file($xmlPath);
        $ns = $xml->getNamespaces(true);

        $bar = $this->output->createProgressBar(count($xml->channel->item));

        foreach ($xml->channel->item as $item) {
            $content = $item->children($ns['content']);
            $wp      = $item->children($ns['wp']);

            if ((string) $wp->post_type !== 'post') continue;

            $slug = (string) $wp->post_name;
            $slug = $this->ensureUniqueSlug($slug);

            Post::create([
                'title'        => (string) $item->title,
                'slug'         => $slug,
                'body'         => $this->cleanContent((string) $content->encoded),
                'status'       => (string) $wp->status === 'publish' ? 'published' : 'draft',
                'published_at' => (string) $wp->post_date ?: null,
                'user_id'      => 1, // ajustar según mapeo de autores
                'category_id'  => $this->mapCategory($item, $ns),
            ]);

            $bar->advance();
        }

        $bar->finish();
        $this->info("\nMigración completada.");
    }

    private function cleanContent(string $content): string
    {
        // Eliminar shortcodes de WordPress
        $content = preg_replace('/\[.*?\]/', '', $content);
        // Más limpieza según necesidad
        return trim($content);
    }
}
```

---

## 11.3 — Migración de páginas estáticas

```
[ ] Crear comando: php artisan make:command MigrateWordPressPages

[ ] Páginas a migrar (identificadas en Fase 1)
    └─[ ] Listar las páginas del WP export tipo 'page'
    └─[ ] Para cada página: mapear title, slug, content, status

[ ] Páginas especiales — revisar manualmente
    └─[ ] Páginas con Elementor → el HTML puede ser complejo
          └─[ ] Limpiar el HTML de clases y estilos de Elementor
          └─[ ] Reestructurar como HTML semántico limpio
    └─[ ] Páginas con iframes (trámites, mapas) → reinsertarlos manualmente
    └─[ ] Páginas con tablas → verificar que se ven bien en el nuevo diseño

[ ] Asignación de páginas a rutas fijas
    └─[ ] /sobre-nosotros → Page con slug: sobre-nosotros
    └─[ ] /gobernador → Page con slug: gobernador
    └─[ ] /contacto → Ruta dedicada (no del modelo Page)
```

---

## 11.4 — Migración de imágenes y media

```
[ ] Descargar todas las imágenes del WordPress actual
    └─[ ] Descargar wp-content/uploads/ completo por FTP/SFTP
    └─[ ] Estructura típica: uploads/YYYY/MM/imagen.jpg
    └─[ ] Tamaño estimado: ___ GB (verificar en Fase 1)

[ ] Crear comando: php artisan make:command MigrateWordPressMedia

[ ] Asociar imágenes destacadas a los posts migrados
    └─[ ] Cada post de WP tiene un _thumbnail_id en wp_postmeta
    └─[ ] Buscar la URL de la imagen en wp_posts (tipo attachment)
    └─[ ] Descargar la imagen y asociarla al Post via Spatie:
          $post->addMediaFromUrl($imageUrl)->toMediaCollection('featured');
    └─[ ] Si la imagen no es accesible externamente: leer desde el archivo descargado

[ ] Imágenes dentro del contenido de posts
    └─[ ] Las URLs apuntan al dominio antiguo (ej: https://viejo.beni.gob.bo/wp-content/...)
    └─[ ] En el script de migración: reemplazar estas URLs por las del nuevo dominio
    └─[ ] O mejor: descargar todas las imágenes del body y re-subirlas a Spatie
          └─[ ] Expresión regular para encontrar <img src="..."> en el body
          └─[ ] Descargar cada imagen, subir a storage y reemplazar la URL

[ ] Optimización post-migración
    └─[ ] Verificar que las conversiones WebP se generaron ✓
    └─[ ] Eliminar imágenes duplicadas o sin uso: php artisan media-library:clean

[ ] Verificación
    └─[ ] Revisar 10 posts al azar → imágenes cargando ✓
    └─[ ] Sin imágenes rotas en el homepage ✓
```

---

## 11.5 — Configurar redirecciones 301

> Este paso protege el posicionamiento SEO acumulado. Cada URL que cambie necesita una redirección 301.

```
[ ] Instalar paquete de redirecciones
    └─[ ] composer require spatie/laravel-missing-page-redirector
    └─[ ] O usar una tabla redirections en BD con middleware propio
    └─[ ] O configurar directamente en Nginx (más eficiente para listas largas)

[ ] Opción recomendada: tabla en BD + middleware
    └─[ ] Migración: redirections
          ├─[ ] id
          ├─[ ] from_url (string, unique)
          ├─[ ] to_url (string)
          ├─[ ] status_code (integer, default 301)
          └─[ ] hit_count (integer, default 0 — para monitorear uso)
    └─[ ] Middleware: RedirectOldUrls (verifica en la tabla antes de 404)

[ ] Importar redirections.csv (creado en Fase 1)
    └─[ ] php artisan redirections:import --file=redirections.csv
    └─[ ] Verificar que todas las URLs del CSV están en la tabla ✓

[ ] Redirecciones típicas de WordPress a Laravel
    └─[ ] /?p=123 → /noticias/slug-del-post
    └─[ ] /categoria/cultura → /noticias/categoria/cultura
    └─[ ] /tag/nombre-tag → /noticias (Laravel no tiene sistema de tags en MVP)
    └─[ ] /feed → / o /noticias
    └─[ ] /wp-admin → /admin (o bloquear con 404)
    └─[ ] /wp-login.php → /admin/login

[ ] Verificar redirecciones críticas (top 20 URLs con más tráfico)
    └─[ ] Usar curl o extensión de Chrome para verificar cada una:
          curl -I https://beni.gob.bo/old-url → 301 Location: /new-url ✓
```

---

## 11.6 — Migración del menú de navegación

```
[ ] Exportar estructura del menú de WordPress
    └─[ ] WordPress Admin → Apariencia → Menús
    └─[ ] Anotar todos los ítems y jerarquía del menú principal y footer

[ ] Recrear en el panel de Laravel
    └─[ ] Acceder a /admin/menus
    └─[ ] Crear menú "Principal" (location: header)
    └─[ ] Agregar ítems en el mismo orden que el WP original
    └─[ ] Crear menú "Footer" (location: footer)

[ ] Verificar en el sitio
    └─[ ] Navbar muestra los mismos ítems que el WP original ✓
    └─[ ] Submenús funcionan correctamente ✓
    └─[ ] Links internos apuntan a las nuevas rutas ✓
    └─[ ] Links externos se abren en nueva pestaña ✓
```

---

## 11.7 — Validación completa post-migración

> Ejecutar primero en staging, luego repetir en producción el día del go-live.

### Verificación de contenido

```
[ ] Conteos coinciden entre WP y Laravel
    └─[ ] Posts publicados: WP_count === Laravel_count ✓
    └─[ ] Páginas publicadas: WP_count === Laravel_count ✓
    └─[ ] Categorías: WP_count === Laravel_count ✓

[ ] Revisión manual de muestra (20% del contenido)
    └─[ ] Abrir 10 posts al azar → contenido correcto ✓
    └─[ ] Imágenes destacadas cargando ✓
    └─[ ] Imágenes dentro del contenido cargando ✓
    └─[ ] Fecha de publicación correcta ✓
    └─[ ] Categoría correcta ✓

[ ] Páginas estáticas
    └─[ ] /sobre-nosotros → contenido correcto ✓
    └─[ ] /gobernador → contenido correcto ✓
    └─[ ] /contacto → formulario funcional ✓
```

### Verificación de SEO

```
[ ] Redirecciones
    └─[ ] Top 20 URLs antiguas → redirigen 301 a las nuevas ✓
    └─[ ] No hay bucles de redirección ✓
    └─[ ] Las nuevas URLs devuelven 200, no 301 ✓

[ ] Sitemap
    └─[ ] /sitemap.xml tiene todas las URLs migradas ✓
    └─[ ] Enviar nuevo sitemap a Google Search Console ✓

[ ] Meta tags
    └─[ ] Homepage: og:title y og:description presentes ✓
    └─[ ] Posts: meta_title y meta_description migrados (si existían en WP) ✓

[ ] Google Search Console
    └─[ ] Agregar propiedad: beni.gob.bo (si no existe)
    └─[ ] Verificar propiedad con meta tag o DNS
    └─[ ] Enviar sitemap.xml
    └─[ ] Monitorear errores de cobertura en los días siguientes
```

### Verificación técnica

```
[ ] Sin errores 404 no esperados
    └─[ ] Rastrear el sitio con Screaming Frog (gratis hasta 500 URLs)
          o con: wget --spider -r https://beni.gob.bo 2>&1 | grep '404'
    └─[ ] Cada 404 encontrado → crear redirección o corregir el link

[ ] Sin imágenes rotas
    └─[ ] Screaming Frog → pestaña Images → filtrar por status 4xx
    └─[ ] O: extensión "Broken Link Checker" en Chrome

[ ] Performance en producción
    └─[ ] Lighthouse en beni.gob.bo → Performance > 90 ✓
    └─[ ] Sin regresiones respecto al entorno de staging
```

---

## 11.8 — Go-live y monitoreo primera semana

```
[ ] Checklist del día de go-live

[ ] DÍA -1 (día anterior)
    └─[ ] Deploy completo en staging → todo OK ✓
    └─[ ] UAT con el equipo editorial: crear post, editar página, usar buscador ✓
    └─[ ] Backup completo del WordPress actual guardado
    └─[ ] Notificar al equipo: "Mañana a las HH:MM hacemos el cambio"

[ ] DÍA 0 — Go-live (elegir horario de bajo tráfico: ej. 6:00 AM)
    └─[ ] php artisan down en producción
    └─[ ] Ejecutar scripts de migración de contenido en producción
    └─[ ] Verificar conteos (posts, páginas, imágenes)
    └─[ ] Cambiar DNS: beni.gob.bo → IP del nuevo servidor
    └─[ ] Esperar propagación DNS (hasta 24 horas, típicamente 1–2 horas)
    └─[ ] php artisan up
    └─[ ] Verificar health check: /health → {"status":"ok"} ✓
    └─[ ] Verificar homepage en beni.gob.bo ✓
    └─[ ] Enviar sitemap a Google Search Console

[ ] SEMANA 1 — Monitoreo intensivo
    └─[ ] Revisar UptimeRobot cada día: sin alertas de caída ✓
    └─[ ] Revisar Sentry cada día: sin errores nuevos críticos ✓
    └─[ ] Revisar logs de Nginx: buscar picos de 404 o 500
          grep " 404 " /var/log/nginx/beni_access.log | awk '{print $7}' | sort | uniq -c | sort -rn | head 20
    └─[ ] Revisar Google Search Console: sin alertas de cobertura
    └─[ ] Corregir cualquier 404 nuevo encontrado → agregar redirección
    └─[ ] Verificar que el formulario de contacto está recibiendo y enviando emails ✓
    └─[ ] Verificar que el buscador indexa el contenido nuevo ✓

[ ] Comunicar el cambio
    └─[ ] Notificar al equipo editorial que el sistema está activo
    └─[ ] Entregar accesos al panel (/admin) a cada usuario con su rol
    └─[ ] Sesión de capacitación: cómo crear noticias, subir imágenes, editar páginas
    └─[ ] Entregar documento de uso básico del panel (Word o PDF)
```

---

## Verificación final de la Fase 10

```bash
# Conteos de migración
php artisan tinker
>>> Post::published()->count()     # debe coincidir con WP ✓
>>> Page::published()->count()     # debe coincidir con WP ✓
>>> Category::count()              # debe coincidir con WP ✓

# Redirecciones
curl -I https://beni.gob.bo/antigua-url  # → 301 Location: /nueva-url ✓

# SEO
https://beni.gob.bo/sitemap.xml    # → XML con todas las URLs ✓

# Sin imágenes rotas
# Screaming Frog → 0 imágenes con error 4xx ✓

# Monitoreo
https://uptimerobot.com            # → Monitor verde ✓
https://sentry.io                  # → 0 errores nuevos críticos ✓
```

### Checklist de entrega Fase 10

```
[ ] Todo el contenido de WordPress migrado ✓
[ ] Conteos verificados (posts, páginas, categorías) ✓
[ ] Imágenes migradas y sin rotas ✓
[ ] Redirecciones 301 implementadas y verificadas ✓
[ ] Sitemap enviado a Google Search Console ✓
[ ] Menú de navegación configurado ✓
[ ] Go-live completado y monitoreo primera semana activo ✓
[ ] Equipo editorial capacitado y con accesos ✓
```

---

*Siguiente paso: `12-FUTURO.md` — Features futuras para los 18 meses post-MVP.*
