# 10 — Fase 9: Infraestructura y Deploy

> **Anterior:** `09-SEGURIDAD.md`
> **Siguiente:** `11-MIGRACION.md`
> **Semana:** 12
> **Objetivo:** Sitio en producción en beni.gob.bo con SSL, backups automáticos y pipeline de deploy desde Git.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 10.1 | Docker setup | **0%** |
| 10.2 | Configuración de Coolify | **0%** |
| 10.3 | Nginx + SSL | **0%** |
| 10.4 | Base de datos en producción | **0%** |
| 10.5 | Variables de entorno de producción | **0%** |
| 10.6 | Pipeline de deploy | **0%** |
| 10.7 | Backups automáticos | **0%** |
| 10.8 | Observabilidad | **0%** |
| 10.9 | Verificación final pre-lanzamiento | **0%** |
| **Total Fase 9** | | **0%** |

---

## 10.1 — Docker setup

### Dockerfile

```dockerfile
# Dockerfile
FROM php:8.3-fpm-alpine

# Dependencias del sistema
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    redis \
    nodejs \
    npm

# Extensiones PHP
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        gd \
        zip \
        bcmath \
        opcache \
        pcntl

# Instalar extensión Redis
RUN pecl install redis && docker-php-ext-enable redis

# OPcache para producción
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini && \
    echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Instalar dependencias PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instalar y compilar assets
COPY package.json package-lock.json ./
RUN npm ci && npm run build

# Copiar código fuente
COPY . .

# Permisos de storage
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
```

### docker-compose.yml

```yaml
# docker-compose.yml (referencia — en producción usa Coolify)
version: '3.8'

services:
  app:
    build: .
    container_name: beni_app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./storage:/var/www/storage
      - ./bootstrap/cache:/var/www/bootstrap/cache
    depends_on:
      - mysql
      - redis
    environment:
      - APP_ENV=production

  nginx:
    image: nginx:alpine
    container_name: beni_nginx
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./docker/nginx/nginx.conf:/etc/nginx/conf.d/default.conf
      - ./:/var/www
      - ./docker/certbot/conf:/etc/letsencrypt
      - ./docker/certbot/www:/var/www/certbot
    depends_on:
      - app

  mysql:
    image: mysql:8.0
    container_name: beni_mysql
    restart: unless-stopped
    volumes:
      - mysql_data:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
      MYSQL_DATABASE: ${DB_DATABASE}
      MYSQL_USER: ${DB_USERNAME}
      MYSQL_PASSWORD: ${DB_PASSWORD}
    command: --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci

  redis:
    image: redis:7-alpine
    container_name: beni_redis
    restart: unless-stopped
    volumes:
      - redis_data:/data
    command: redis-server --appendonly yes

  horizon:
    build: .
    container_name: beni_horizon
    restart: unless-stopped
    working_dir: /var/www
    command: php artisan horizon
    depends_on:
      - mysql
      - redis
    environment:
      - APP_ENV=production

  scheduler:
    build: .
    container_name: beni_scheduler
    restart: unless-stopped
    working_dir: /var/www
    command: sh -c "while true; do php artisan schedule:run; sleep 60; done"
    depends_on:
      - mysql
      - redis
    environment:
      - APP_ENV=production

volumes:
  mysql_data:
  redis_data:
```

```
[ ] Dockerfile creado y testeado localmente
    └─[ ] docker build -t beni-app . → sin errores ✓
    └─[ ] PHP 8.3, extensiones GD, Redis, OPcache activos ✓
    └─[ ] npm run build dentro del container ✓

[ ] .dockerignore configurado
    └─[ ] vendor/
    └─[ ] node_modules/
    └─[ ] .env
    └─[ ] storage/logs/
    └─[ ] .git/
    └─[ ] tests/

[ ] Servicios definidos en docker-compose
    └─[ ] app (PHP-FPM)
    └─[ ] nginx
    └─[ ] mysql
    └─[ ] redis
    └─[ ] horizon (proceso separado)
    └─[ ] scheduler (proceso separado)
```

---

## 10.2 — Configuración de Coolify

```
[ ] Setup inicial de Coolify (si no está instalado)
    └─[ ] Instalar en servidor VPS: curl -fsSL https://cdn.coollabs.io/coolify/install.sh | bash
    └─[ ] Configurar dominio de acceso al panel de Coolify
    └─[ ] Crear primer usuario administrador

[ ] Crear proyecto en Coolify
    └─[ ] Nombre: beni-gob-bo
    └─[ ] Descripción: Gobernación del Beni — sitio web oficial

[ ] Conectar repositorio GitHub
    └─[ ] Crear GitHub App o Deploy Key en Coolify
    └─[ ] Conectar el repositorio del proyecto
    └─[ ] Rama de producción: main

[ ] Configurar recurso de aplicación
    └─[ ] Tipo: Dockerfile
    └─[ ] Dockerfile path: ./Dockerfile
    └─[ ] Puerto expuesto: 9000 (PHP-FPM, con Nginx como proxy)
    └─[ ] Dominio: beni.gob.bo
    └─[ ] SSL: Let's Encrypt (automático en Coolify)

[ ] Configurar servicios de base de datos en Coolify
    └─[ ] MySQL 8.0 → base de datos: beni_production
    └─[ ] Redis 7 → para caché, sesiones y colas

[ ] Script pre-deploy (en Coolify)
    └─[ ] php artisan down --message="Actualizando el sistema..." --retry=60

[ ] Script post-deploy (en Coolify)
    └─[ ] php artisan migrate --force
    └─[ ] php artisan config:cache
    └─[ ] php artisan route:cache
    └─[ ] php artisan view:cache
    └─[ ] php artisan storage:link
    └─[ ] php artisan horizon:terminate
    └─[ ] php artisan up

[ ] Health check
    └─[ ] Endpoint: /health
    └─[ ] Intervalo: 30 segundos
    └─[ ] Timeout: 10 segundos
    └─[ ] Reintentos: 3
```

---

## 10.3 — Nginx + SSL

### nginx.conf de producción

```nginx
# docker/nginx/nginx.conf
server {
    listen 80;
    server_name beni.gob.bo www.beni.gob.bo;

    # Redirigir HTTP a HTTPS
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    server_name beni.gob.bo;

    root /var/www/public;
    index index.php index.html;

    # SSL — gestionado por Coolify / Let's Encrypt
    ssl_certificate /etc/letsencrypt/live/beni.gob.bo/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/beni.gob.bo/privkey.pem;

    # Protocolos TLS seguros
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384;
    ssl_prefer_server_ciphers off;

    # Headers de seguridad
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains" always;
    add_header Permissions-Policy "geolocation=(), microphone=(), camera=()" always;

    # Ocultar versión de servidor
    server_tokens off;

    # Logs
    access_log /var/log/nginx/beni_access.log;
    error_log /var/log/nginx/beni_error.log;

    # Compresión Gzip
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_types text/plain text/css text/xml application/json
               application/javascript application/rss+xml
               application/atom+xml image/svg+xml;

    # Límites de request
    client_max_body_size 10M;
    client_body_timeout 10;
    client_header_timeout 10;

    # Rutas de Laravel
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP-FPM
    location ~ \.php$ {
        fastcgi_pass app:9000;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_buffer_size 128k;
        fastcgi_buffers 4 256k;
        fastcgi_busy_buffers_size 256k;
    }

    # Assets estáticos con caché largo
    location ~* \.(jpg|jpeg|png|gif|ico|css|js|webp|woff|woff2|svg|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
        access_log off;
    }

    # Bloquear archivos sensibles
    location ~* \.(env|git|htaccess|htpasswd|ini|log|sh|sql|conf|bak)$ {
        deny all;
        return 404;
    }

    location ~ /\. {
        deny all;
        return 404;
    }

    # Bloquear acceso directo a vendor
    location ~* ^/(vendor|node_modules|storage/logs) {
        deny all;
        return 404;
    }
}
```

```
[ ] nginx.conf configurado con todos los headers de seguridad ✓
[ ] Redirección HTTP → HTTPS ✓
[ ] Redirección www → sin www (o al revés, elegir uno) ✓
[ ] SSL Let's Encrypt configurado y auto-renovando ✓
[ ] Gzip habilitado ✓
[ ] Caché de assets estáticos 30 días ✓
[ ] Archivos sensibles bloqueados ✓
```

---

## 10.4 — Base de datos en producción

```
[ ] MySQL 8.0 en Coolify
    └─[ ] Crear base de datos: beni_production
    └─[ ] Crear usuario: beni_user (no usar root)
    └─[ ] Permisos: GRANT ALL ON beni_production.* TO 'beni_user'@'%'
    └─[ ] Charset: utf8mb4
    └─[ ] Collation: utf8mb4_unicode_ci
    └─[ ] Timezone: America/La_Paz

[ ] Primer deploy de la base de datos
    └─[ ] php artisan migrate --force → ejecutar en post-deploy ✓
    └─[ ] php artisan db:seed --class=ProductionSeeder (solo settings y roles)
    └─[ ] Verificar que todas las migraciones están aplicadas ✓

[ ] Optimizaciones MySQL
    └─[ ] innodb_buffer_pool_size = 512M (ajustar según RAM del servidor)
    └─[ ] query_cache_size = 64M
    └─[ ] max_connections = 100
```

---

## 10.5 — Variables de entorno de producción

```
[ ] Configurar en Coolify (NO guardar en el repositorio)

APP_NAME="Gobernación del Beni"
APP_ENV=production
APP_KEY=base64:...               ← php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://beni.gob.bo

LOG_CHANNEL=stack
LOG_LEVEL=warning

DB_CONNECTION=mysql
DB_HOST=mysql                    ← nombre del servicio Docker
DB_PORT=3306
DB_DATABASE=beni_production
DB_USERNAME=beni_user
DB_PASSWORD=...                  ← contraseña fuerte, generada aleatoriamente

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
REDIS_HOST=redis                 ← nombre del servicio Docker
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=587
MAIL_USERNAME=...
MAIL_PASSWORD=...
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@beni.gob.bo
MAIL_FROM_NAME="Gobernación del Beni"

SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://meilisearch:7700
MEILISEARCH_KEY=...

SENTRY_LARAVEL_DSN=https://...@sentry.io/...

FILESYSTEM_DISK=local
```

```
[ ] Todas las variables configuradas en Coolify ✓
[ ] APP_DEBUG=false ✓
[ ] APP_KEY generado y único ✓
[ ] Contraseñas fuertes (mínimo 32 caracteres aleatorios) ✓
[ ] MAIL configurado y testeado ✓
[ ] Sentry DSN válido ✓
```

---

## 10.6 — Pipeline de deploy

```
[ ] Flujo completo de deploy
    1. Developer hace push a rama develop
    2. GitHub Actions CI corre tests automáticamente
    3. Si CI pasa → PR a main
    4. Revisión y merge a main
    5. Coolify detecta push a main → dispara deploy
    6. Script pre-deploy: php artisan down
    7. Docker build → nueva imagen
    8. Script post-deploy: migrate, cache, horizon restart
    9. php artisan up
    10. Health check: /health → {"status":"ok"}

[ ] Rollback si algo falla
    └─[ ] Coolify UI → Previous Deployment → Redeploy
    └─[ ] Si la BD fue migrada y hay problema: php artisan migrate:rollback
    └─[ ] Documentar cómo hacer rollback en el runbook

[ ] Verificaciones post-deploy automáticas
    └─[ ] Health check endpoint responde 200 ✓
    └─[ ] Homepage carga en < 3 segundos ✓
    └─[ ] Panel /admin accesible ✓
```

### Health endpoint

```php
// routes/web.php
Route::get('/health', function () {
    try {
        DB::connection()->getPdo();
        $db = 'ok';
    } catch (\Exception $e) {
        $db = 'error';
    }

    try {
        Cache::store('redis')->put('health_check', true, 10);
        $redis = 'ok';
    } catch (\Exception $e) {
        $redis = 'error';
    }

    $status = ($db === 'ok' && $redis === 'ok') ? 'ok' : 'degraded';

    return response()->json([
        'status'  => $status,
        'app'     => config('app.name'),
        'db'      => $db,
        'redis'   => $redis,
        'version' => config('app.version', '1.0.0'),
    ], $status === 'ok' ? 200 : 503);
})->name('health');
```

---

## 10.7 — Backups automáticos

```
[ ] Configurar Spatie Backup
    └─[ ] composer require spatie/laravel-backup
    └─[ ] php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
    └─[ ] Configurar en config/backup.php:
          ├─[ ] source.files: incluir /var/www/storage/app
          ├─[ ] source.databases: incluir conexión mysql
          ├─[ ] destination.disks: local (y S3 si disponible)
          └─[ ] cleanup: mantener últimos 7 días diarios, 4 semanas semanales

[ ] Programar backups
    └─[ ] En Scheduler: $schedule->command('backup:run')->dailyAt('02:00')
    └─[ ] Monitoreo: $schedule->command('backup:monitor')->dailyAt('03:00')

[ ] Backups de Coolify
    └─[ ] Habilitar snapshots del volumen MySQL en Coolify
    └─[ ] Frecuencia: diaria

[ ] Probar restauración
    └─[ ] php artisan backup:list → listar backups disponibles ✓
    └─[ ] Descargar un backup y verificar que el archivo es válido ✓
    └─[ ] Documentar pasos de restauración en el runbook ✓
```

---

## 10.8 — Observabilidad

```
[ ] Logs centralizados
    └─[ ] Laravel logs → stdout del container (Coolify los captura)
    └─[ ] Nginx logs → stdout y stderr del container
    └─[ ] Ver logs desde Coolify UI en tiempo real

[ ] Métricas del servidor (Coolify)
    └─[ ] CPU, RAM, disco visibles en el panel de Coolify
    └─[ ] Alertas si CPU > 80% por más de 5 minutos

[ ] Sentry (errores de aplicación)
    └─[ ] Configurado en Fase 8 — verificar que recibe eventos de producción

[ ] UptimeRobot (disponibilidad)
    └─[ ] Monitor: https://beni.gob.bo → cada 5 min
    └─[ ] Monitor: https://beni.gob.bo/health → cada 5 min
    └─[ ] Alerta por email + Telegram

[ ] Health endpoint
    └─[ ] https://beni.gob.bo/health → {"status":"ok"} ✓
```

---

## 10.9 — Verificación final pre-lanzamiento

```bash
# ── INFRAESTRUCTURA ──────────────────────────────────
https://beni.gob.bo                    # → 200 OK, sitio carga ✓
https://beni.gob.bo/health             # → {"status":"ok"} ✓
https://beni.gob.bo/admin              # → Redirige a login ✓
http://beni.gob.bo                     # → Redirige a https:// ✓
https://www.beni.gob.bo                # → Redirige a beni.gob.bo ✓

# ── SSL ──────────────────────────────────────────────
# https://ssllabs.com/ssltest/analyze.html?d=beni.gob.bo → A+ ✓

# ── SEGURIDAD ────────────────────────────────────────
curl -I https://beni.gob.bo/.env       # → 404 ✓
# https://securityheaders.com          # → A ✓

# ── FUNCIONALIDAD ────────────────────────────────────
https://beni.gob.bo/noticias           # → 200 OK ✓
https://beni.gob.bo/contacto           # → 200 OK ✓
https://beni.gob.bo/buscar?q=beni      # → 200 OK ✓
https://beni.gob.bo/sitemap.xml        # → XML válido ✓
https://beni.gob.bo/robots.txt         # → 200 OK ✓

# ── PANEL ────────────────────────────────────────────
# Crear un post de prueba → aparece en /noticias ✓
# Login con 2FA → funciona ✓
# Upload de imagen → se guarda en storage ✓

# ── CORREO ───────────────────────────────────────────
# Enviar formulario de contacto → llega al email institucional ✓
# Auto-responder → llega al email del remitente ✓

# ── BACKUPS ──────────────────────────────────────────
php artisan backup:list                # → Al menos 1 backup disponible ✓

# ── PERFORMANCE ──────────────────────────────────────
# Lighthouse en beni.gob.bo → Performance > 90 ✓
```

### Checklist de entrega Fase 9

```
[ ] Dockerfile construye sin errores ✓
[ ] Coolify configurado con proyecto, dominio y SSL ✓
[ ] nginx.conf con headers de seguridad y Gzip ✓
[ ] SSL A+ en ssllabs.com ✓
[ ] Variables de entorno de producción configuradas ✓
[ ] Pipeline de deploy automático desde main ✓
[ ] Backups diarios activos (Spatie + Coolify) ✓
[ ] Health endpoint respondiendo ✓
[ ] Sentry y UptimeRobot activos ✓
[ ] Todas las verificaciones pre-lanzamiento pasando ✓
```

---

*Siguiente paso: `11-MIGRACION.md` — Migración de contenido desde WordPress y verificación de redirecciones.*
