# 09 — Fase 8: Seguridad

> **Anterior:** `08-RENDIMIENTO.md`
> **Siguiente:** `10-DEPLOY.md`
> **Semanas:** 10–11 (2 semanas — ampliado desde el plan original)
> **Objetivo:** El sitio resiste ataques comunes, tiene 2FA activo en el panel, headers HTTP correctos y un proceso documentado ante incidentes.

> ⚠️ Los sitios .gob son objetivos frecuentes de defacement y ataques DDoS en Bolivia y la región. Esta fase no es negociable.

---

## Estados

```
[x] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 9.1 | Autenticación segura y 2FA | **30%** |
| 9.2 | Headers de seguridad HTTP | **0%** |
| 9.3 | Protección de rutas y middleware | **0%** |
| 9.4 | Validación y sanitización de inputs | **0%** |
| 9.5 | WAF básico en Nginx | **0%** |
| 9.6 | Protección contra ataques comunes | **0%** |
| 9.7 | Auditoría manual (pen test básico) | **0%** |
| 9.8 | Monitoreo de errores (Sentry) | **0%** |
| 9.9 | Política de seguridad y runbook | **0%** |
| **Total Fase 8** | | **3%** |

---

## 9.1 — Autenticación segura y 2FA

```
[x] Two-Factor Authentication (2FA) - Preparado
    └─[x] Campos en tabla users: two_factor_secret, two_factor_recovery_codes
    └─[x] Trait HasRoles de Filament Shield
    └─[ ] Habilitar 2FA en Filament para todos los usuarios admin
    └─[ ] Obligatorio para roles: super_admin y admin
    └─[ ] Opcional para rol: editor
    └─[ ] Configurar Tiempo de sesión 2FA: 30 días

[x] Política de contraseñas - Preparado
    └─[x] BCRYPT_ROUNDS=12 en .env

[ ] Gestión de sesiones
    └─[ ] SESSION_LIFETIME=120 (2 horas) en producción
    └─[ ] SESSION_DRIVER=redis

[x] Bloqueo por intentos fallidos
    └─[x] Laravel Throttle ya protege /login
```
[ ] Two-Factor Authentication (2FA)
    └─[ ] Habilitar 2FA en Filament para todos los usuarios admin
    └─[ ] Obligatorio para roles: super_admin y admin
    └─[ ] Opcional para rol: editor
    └─[ ] Configurar tiempo de sesión 2FA: 30 días en el mismo dispositivo
    └─[ ] Documentar proceso de recuperación si se pierde el dispositivo 2FA

[ ] Política de contraseñas
    └─[ ] Mínimo 12 caracteres
    └─[ ] Requerir: mayúsculas, minúsculas, números
    └─[ ] Validar con Laravel Password rules:
          Password::min(12)->mixedCase()->numbers()
    └─[ ] No permitir contraseñas comunes (Password::uncompromised())

[ ] Gestión de sesiones
    └─[ ] SESSION_LIFETIME=120 (2 horas) en producción
    └─[ ] SESSION_DRIVER=redis
    └─[ ] Regenerar session ID en cada login (ya lo hace Laravel)
    └─[ ] Invalidar todas las sesiones al cambiar contraseña

[ ] Bloqueo por intentos fallidos
    └─[ ] Laravel Throttle ya protege /login
    └─[ ] Máximo 5 intentos por minuto por IP
    └─[ ] Después de 5 intentos: bloqueo de 1 minuto
    └─[ ] Notificar por email al admin si hay múltiples intentos fallidos
```

---

## 9.2 — Headers de seguridad HTTP

> Verificar en: https://securityheaders.com — objetivo: calificación **A**

```
[ ] Configurar en Nginx (ver nginx.conf en 10-DEPLOY.md)

[ ] Headers obligatorios
    └─[ ] X-Frame-Options: SAMEORIGIN
          → Previene clickjacking
    └─[ ] X-Content-Type-Options: nosniff
          → Previene MIME sniffing
    └─[ ] Referrer-Policy: strict-origin-when-cross-origin
          → Controla información enviada en el header Referer
    └─[ ] X-XSS-Protection: 1; mode=block
          → Protección XSS básica en navegadores legacy

[ ] Strict-Transport-Security (HSTS)
    └─[ ] Strict-Transport-Security: max-age=31536000; includeSubDomains
    └─[ ] Solo agregar después de confirmar que SSL funciona correctamente
    └─[ ] No agregar preload hasta estar seguros (difícil de revertir)

[ ] Content-Security-Policy (CSP)
    └─[ ] Iniciar en modo report-only para detectar violaciones sin bloquear:
          Content-Security-Policy-Report-Only: default-src 'self'; ...
    └─[ ] Política base recomendada:
          default-src 'self';
          script-src 'self' 'nonce-{nonce}';
          style-src 'self' 'unsafe-inline';
          img-src 'self' data: https:;
          font-src 'self';
          connect-src 'self';
          frame-ancestors 'none';
    └─[ ] Agregar dominios de terceros necesarios (Google Analytics, etc.)
    └─[ ] Pasar a modo enforce después de 1 semana sin violaciones reportadas

[ ] Permissions-Policy
    └─[ ] Permissions-Policy: geolocation=(), microphone=(), camera=()
          → Deshabilitar APIs del navegador no usadas

[ ] Verificación
    └─[ ] https://securityheaders.com/?q=beni.gob.bo → A ✓
```

---

## 9.3 — Protección de rutas y middleware

```
[ ] Panel admin protegido
    └─[ ] /admin → solo accesible si autenticado (Filament lo hace por defecto)
    └─[ ] /horizon → solo super_admin (Gate en HorizonServiceProvider)
    └─[ ] /telescope → solo entorno local (si está instalado)
    └─[ ] /_debugbar → solo APP_DEBUG=true (auto)

[ ] Middleware de seguridad
    └─[ ] Verificar que app/Http/Middleware/TrustProxies.php está configurado
          (importante si hay un proxy/load balancer delante)
    └─[ ] HTTPS forzado en producción:
          APP_URL=https://beni.gob.bo en .env
          $url->forceScheme('https') en AppServiceProvider si es necesario

[ ] Rate limiting en rutas sensibles
    └─[ ] POST /contacto → throttle:3,1 (3 por minuto)
    └─[ ] POST /buscar → throttle:30,1 (30 por minuto)
    └─[ ] API routes (si existen) → throttle:60,1

[ ] Proteger archivos sensibles
    └─[ ] .env no debe ser accesible públicamente
    └─[ ] /vendor no accesible desde web (public/ como document root)
    └─[ ] Verificar en Nginx: deny access a .env y .git
```

---

## 9.4 — Validación y sanitización de inputs

```
[ ] Validación server-side en todos los formularios
    └─[ ] ContactRequest: todos los campos validados (ver Fase 5)
    └─[ ] Nunca confiar en validación client-side únicamente

[ ] Protección CSRF
    └─[ ] Laravel ya incluye @csrf en formularios Blade
    └─[ ] Verificar que el middleware VerifyCsrfToken está activo
    └─[ ] Excluir solo rutas que lo necesiten (webhooks externos)

[ ] Sanitización de HTML en el editor rico
    └─[ ] El contenido del editor Tiptap puede contener HTML
    └─[ ] Al renderizar: usar {!! $post->body !!} (solo si se confía en el fuente)
    └─[ ] Si hay preocupación: instalar HTMLPurifier para sanitizar antes de guardar
          composer require ezyang/htmlpurifier
    └─[ ] Configurar tags permitidos: p, h2, h3, h4, ul, ol, li, a, img, table, etc.

[ ] SQL Injection
    └─[ ] Laravel Eloquent y Query Builder escapan automáticamente
    └─[ ] No usar DB::statement() con inputs del usuario sin binding
    └─[ ] Revisar cualquier raw query: DB::select(DB::raw(...)) con parámetros
```

---

## 9.5 — WAF básico en Nginx

```nginx
# Agregar en nginx.conf (ver 10-DEPLOY.md para la configuración completa)

# Bloquear user agents comunes de bots maliciosos
if ($http_user_agent ~* (nikto|sqlmap|nmap|masscan|zgrab|python-requests)) {
    return 444;
}

# Bloquear intentos de acceso a archivos sensibles
location ~* \.(env|git|htaccess|htpasswd|ini|log|sh|sql|conf)$ {
    deny all;
    return 404;
}

# Bloquear acceso a directorios ocultos
location ~ /\. {
    deny all;
    return 404;
}

# Limitar tamaño de requests (protección contra flood)
client_max_body_size 10M;
client_body_timeout 10;
client_header_timeout 10;

# Limitar métodos HTTP permitidos
if ($request_method !~ ^(GET|HEAD|POST|PUT|PATCH|DELETE|OPTIONS)$) {
    return 444;
}
```

```
[ ] Agregar configuración WAF al nginx.conf
[ ] Verificar que /admin/.env devuelve 404 ✓
[ ] Verificar que /.git devuelve 404 ✓
[ ] Verificar que archivos .log devuelven 404 ✓
```

---

## 9.6 — Protección contra ataques comunes

### XSS (Cross-Site Scripting)

```
[ ] Blade escapa automáticamente con {{ }}
    └─[ ] Nunca usar {!! !!} con datos del usuario sin sanitizar
    └─[ ] Revisar todas las vistas: buscar {!! en el código
    └─[ ] CSP como segunda línea de defensa

[ ] Content Security Policy implementada (ver 9.2)
```

### CSRF (Cross-Site Request Forgery)

```
[ ] @csrf en todos los formularios POST
[ ] VerifyCsrfToken middleware activo
[ ] Verificar que no hay rutas POST sin protección CSRF inadvertidamente
```

### Clickjacking

```
[ ] X-Frame-Options: SAMEORIGIN (ver 9.2)
[ ] frame-ancestors 'none' en CSP
```

### Open Redirect

```
[ ] Verificar que no hay redirecciones con parámetros de usuario:
    └─[ ] redirect($request->input('url')) → NUNCA hacer esto
    └─[ ] Usar solo named routes para redirecciones: redirect()->route('home')
```

### Exposición de información

```
[ ] APP_DEBUG=false en producción
[ ] APP_ENV=production en producción
[ ] Personalizar páginas de error (403, 404, 500) — no mostrar stack traces
[ ] Nginx: server_tokens off (ocultar versión de Nginx)
[ ] PHP: expose_php = Off en php.ini
```

---

## 9.7 — Auditoría manual (pen test básico)

```
[ ] Semana 1 de esta fase — Revisión interna

[ ] Revisar autenticación
    └─[ ] Intentar acceder a /admin sin autenticar → redirige al login ✓
    └─[ ] Intentar brute force en login → bloqueado por throttle ✓
    └─[ ] Verificar que 2FA es solicitado al login ✓

[ ] Revisar formulario de contacto
    └─[ ] Intentar XSS: <script>alert(1)</script> en campos → escapado ✓
    └─[ ] Intentar SQL injection: ' OR '1'='1 → no causa error ✓
    └─[ ] Intentar spam masivo → bloqueado por throttle ✓
    └─[ ] Honeypot: enviar con campo honeypot lleno → silenciosamente ignorado ✓

[ ] Revisar archivos expuestos
    └─[ ] GET /.env → 404 ✓
    └─[ ] GET /.git/config → 404 ✓
    └─[ ] GET /storage/logs/laravel.log → 403 o 404 ✓
    └─[ ] GET /vendor/autoload.php → 404 ✓

[ ] Revisar headers
    └─[ ] https://securityheaders.com → A ✓
    └─[ ] https://ssllabs.com → A+ ✓

[ ] Revisar permisos del panel
    └─[ ] Editor intenta acceder a /admin/users → 403 ✓
    └─[ ] Editor intenta acceder a /admin/site-settings → 403 ✓
    └─[ ] Admin intenta editar rol de otro admin → denegado ✓

[ ] Semana 2 de esta fase — Revisión externa (opcional pero recomendado)
    └─[ ] Usar herramienta OWASP ZAP (gratis): https://www.zaproxy.org/
    └─[ ] Escaneo pasivo del sitio en staging
    └─[ ] Revisar y corregir findings críticos y altos
```

---

## 9.8 — Monitoreo de errores (Sentry)

```
[ ] Instalar Sentry
    └─[ ] composer require sentry/sentry-laravel
    └─[ ] php artisan sentry:publish --dsn=https://...@sentry.io/...
    └─[ ] Configurar SENTRY_LARAVEL_DSN en .env de producción

[ ] Configurar qué capturar
    └─[ ] Excepciones no manejadas → automático
    └─[ ] Errores 500 → automático
    └─[ ] No capturar: 404, 403 (demasiado ruido)
    └─[ ] Configurar en bootstrap/app.php:
          $app->withExceptions(function (Exceptions $exceptions) {
              $exceptions->dontReport(ModelNotFoundException::class);
              $exceptions->dontReport(AuthorizationException::class);
          });

[ ] Alertas
    └─[ ] Notificar por email ante error nuevo o pico de errores
    └─[ ] Destinatario: email técnico del equipo

[ ] UptimeRobot (monitoreo de disponibilidad — gratis)
    └─[ ] Crear cuenta en https://uptimerobot.com
    └─[ ] Monitor tipo HTTP(s) → https://beni.gob.bo
    └─[ ] Monitor tipo HTTP(s) → https://beni.gob.bo/health
    └─[ ] Alerta por email y/o Telegram si cae
    └─[ ] Verificación cada 5 minutos
```

---

## 9.9 — Política de seguridad y runbook

```
[ ] Crear archivo SECURITY.md en el repositorio
    └─[ ] Cómo reportar una vulnerabilidad
    └─[ ] Email de contacto para seguridad
    └─[ ] Tiempo de respuesta comprometido (ej: 48 horas para críticos)

[ ] Runbook de incidentes
    └─[ ] ¿Qué hacer si el sitio es defaceado?
          1. Poner sitio en mantenimiento (Coolify → stop container)
          2. Guardar copia del estado actual para análisis
          3. Restaurar desde último backup conocido como limpio
          4. Cambiar todas las contraseñas del panel
          5. Revisar logs de acceso para identificar vector de entrada
          6. Aplicar correcciones antes de volver en línea
    └─[ ] ¿Qué hacer si hay DDoS?
          1. Activar rate limiting agresivo en Nginx
          2. Contactar al proveedor de hosting/servidor
          3. Considerar Cloudflare free plan como proxy de protección
    └─[ ] ¿Qué hacer si se filtra una credencial?
          1. Rotar inmediatamente la credencial comprometida
          2. Invalidar todas las sesiones activas
          3. Revisar logs de actividad de las últimas 24 horas

[ ] Mantenimiento de dependencias
    └─[ ] Revisar mensualmente: composer audit
    └─[ ] Revisar mensualmente: npm audit
    └─[ ] Actualizar Laravel en cada minor version con cambios de seguridad
    └─[ ] Suscribirse a: https://laravel-news.com (anuncios de seguridad)
```

---

## Verificación de la Fase 8

```bash
# Headers de seguridad
# → https://securityheaders.com?q=beni.gob.bo → A ✓

# SSL
# → https://ssllabs.com/ssltest/analyze.html?d=beni.gob.bo → A+ ✓

# Archivos sensibles
curl -I https://beni.gob.bo/.env            # → 404 ✓
curl -I https://beni.gob.bo/.git/config     # → 404 ✓

# Login throttle
# → 5 intentos fallidos → bloqueo de 1 minuto ✓

# 2FA
# → Login con credenciales válidas → pide código 2FA ✓

# Sentry
# → php artisan sentry:test → error de prueba aparece en dashboard ✓

# UptimeRobot
# → Monitor activo, primera verificación OK ✓
```

### Checklist de entrega Fase 8

```
[ ] 2FA obligatorio para admin y super_admin ✓
[ ] Headers HTTP con calificación A en securityheaders.com ✓
[ ] SSL A+ en ssllabs.com ✓
[ ] Archivos sensibles no accesibles públicamente ✓
[ ] WAF básico en Nginx configurado ✓
[ ] Auditoría manual completada sin findings críticos ✓
[ ] Sentry activo y recibiendo eventos ✓
[ ] UptimeRobot monitoreando el sitio ✓
[ ] SECURITY.md y runbook de incidentes documentados ✓
```

---

*Siguiente paso: `10-DEPLOY.md` — Infraestructura Docker, Coolify y deploy a producción.*
