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
| 10.1 | Docker setup | **100%** |
| 10.2 | MySQL externo (bd-principal) | **100%** |
| 10.3 | Redis gestionado Coolify | **100%** |
| 10.4 | Configuración de Coolify | **0%** |
| 10.5 | Nginx + SSL | **0%** |
| 10.6 | Pipeline de deploy | **0%** |
| 10.7 | Backups automáticos | **0%** |
| 10.8 | Observabilidad | **0%** |
| 10.9 | Verificación final pre-lanzamiento | **0%** |
| **Total Fase 9** | | **20%** |

---

## 10.1 — Docker setup

> **Info:** MySQL es externo (bd-principal en Coolify), Redis gestionado Coolify.

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

> **Nota:** MySQL no está incluído - usa el servidor externo "bd-principal" en Coolify.

```yaml
# docker-compose.yml
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
      - redis
    environment:
      - APP_ENV=production

volumes:
  redis_data:
```

```
[x] Dockerfile creado y testeado localmente
    └─[x] docker build -t beni-app . → sin errores ✓
    └─[x] PHP 8.3, extensiones GD, Redis, OPcache activos ✓
    └─[x] npm run build dentro del container ✓

[x] .dockerignore configurado
    └─[x] vendor/, node_modules/, .env, storage/logs/, .git/, tests/

[x] docker-compose.yml sin MySQL (externo)
    └─[x] app (PHP-FPM)
    └─[x] nginx
    └─[x] redis
    └─[x] horizon (proceso separado)
    └─[x] scheduler (proceso separado)
```

---

## 10.2 — MySQL externo (bd-principal Coolify)

> El servidor MySQL "bd-principal" ya existe en Coolify. Se creará una nueva base de datos "beni".

```
[ ] Crear base de datos en bd-principal
    └─[ ] Nombre: beni
    └─[ ] Charset: utf8mb4
    └─[ ] Collation: utf8mb4_unicode_ci

[ ] Crear usuario para la aplicación
    └─[ ] Usuario: beni_user (no usar root)
    └─[ ] Contraseña: generar aleatoria (32+ caracteres)
    └─[ ] Permisos: GRANT ALL ON beni.* TO 'beni_user'@'%'

[ ] Obtener IPs internas de Coolify
    └─[ ] MySQL: 10.x.x.x (red interna Coolify)
    └─[ ] Verificar conexión desde el container

[ ] Probar conexión
    └─[ ] docker run --rm -it beni_app php artisan tinker
    └─[ ] DB::connection()->getPdo(); ✓
```

---

## 10.3 — Configuración de Coolify

> **Info:** MySQL usa el recurso "bd-principal" existente. Redis será nuevo recurso gestionado.

```
[ ] Setup inicial de Coolify (si no está instalado)
    └─[ ] Instalar en servidor VPS: curl -fsSL https://cdn.coollabs.io/coolify/install.sh | bash
    └─[ ] Configurar dominio de acceso al panel de Coolify
    └─[ ] Crear primer usuario administrador

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

[ ] Configurar Redis gestionado (Coolify)
    └─[ ] Crear nuevo recurso Redis 7 en Coolify
    └─[ ] Puerto: 6379
    └─[ ] Obtener IP interna para conexión

[ ] Configurar variables de entorno en Coolify
    └─[ ] DB_HOST: IP del recurso bd-principal (MySQL)
    └─[ ] DB_DATABASE: beni
    └─[ ] DB_USERNAME: beni_user
    └─[ ] DB_PASSWORD: (generar aleatoria)
    └─[ ] REDIS_HOST: IP del recurso Redis
    └─[ ] REDIS_PORT: 6379
    └─[ ] APP_KEY: (generar con php artisan key:generate)
    └─[ ] APP_DEBUG: false

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

## 10.4 — Primer deploy de la base de datos

> MySQL es externo en bd-principal Coolify. Solo ejecutamos migraciones.

```
[ ] Ejecutar migraciones (post-deploy en Coolify)
    └─[ ] php artisan migrate --force
    └─[ ] php artisan db:seed --class=RolePermissionSeeder

[ ] Verificar tablas
    └─[ ] users, posts, categories, pages, slides, events, external_systems
    └─[ ] Verificar que Shield creó sus tablas
```

> **Nota:** Las variables de entorno se configuran directamente en el recurso de Coolify, NO en el repositorio.
> Ver sección 10.3 para las variables ya incluidas en Coolify.

---

## 10.5 — Pipeline de deploy

> Configurado en Coolify (sección 10.3). AquíFlujo completo:

```
[ ] Flujo completo de deploy
    1. Developer hace push a rama main
    2. Coolify detecta push → dispara deploy
    3. Script pre-deploy: php artisan down
    4. Docker build → nueva imagen
    5. Script post-deploy: migrate, cache, horizon restart
    6. php artisan up
    7. Health check: /health → {"status":"ok"}

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

## 10.6 — Backups automáticos

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

## 10.7 — Observabilidad

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

## 10.8 — Verificación final pre-lanzamiento

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
