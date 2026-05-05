# Roadmap — Infraestructura y Deploy

> **Stack:** Docker · Coolify · Nginx · PHP-FPM · MySQL/PostgreSQL
> 
> **Pre-requisitos:**
> - MVP backend completo (Laravel)
> - Landing page completada

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| INF.I | Docker setup | **0%** |
| INF.II | Coolify configuration | **0%** |
| INF.III | Nginx + SSL | **0%** |
| INF.IV | Database setup | **0%** |
| INF.V | Deploy pipeline | **0%** |
| INF.VI | Observabilidad | **0%** |
| INF.VII | Backup strategy | **0%** |
| **Total Infra** | | **0%** |

---

## INF.I — Docker Setup

> **Referencia:** ADR 0014 (Deploy), docs/02-STACK.md

```
[ ] Dockerfile
    └─[ ] PHP 8.4-FPM image
    └─[ ] Composer install
    └─[ ] Build assets
    └─[ ] Production optimizations

[ ] docker-compose.yml
    └─[ ] app service
    └─[ ] mysql service
    └─[ ] nginx service
    └─[ ] Networks config

[ ] .dockerignore
    └─[ ] Exclude vendor, node_modules
    └─[ ] Exclude .env
```

### Dockerfile típico
```dockerfile
FROM php:8.4-fpm-alpine

WORKDIR /var/www

COPY composer.* ./
RUN composer install --no-dev --optimize-autoloader

COPY . .
RUN php artisan config:cache && php artisan route:cache

EXPOSE 9000
CMD ["php-fpm"]
```

### docker-compose.yml típico
```yaml
services:
  app:
    build: .
    volumes:
      - .:/var/www
    depends_on:
      - mysql
    environment:
      - APP_ENV=production

  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
      - .:/var/www
    depends_on:
      - app

  mysql:
    image: mysql:8.0
    volumes:
      - mysql_data:/var/lib/mysql
    environment:
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
```

---

## INF.II — Coolify Configuration

> **Referencia:** Coolify self-hosted deployment

```
[ ] Coolify setup
    └─[ ] Docker installation
    └─[ ] Initial config
    └─[ ] Domain setup

[ ] Project config
    └─[ ] New project
    └─[ ] Add Laravel resource
    └─[ ] Configure build pack

[ ] Environment variables
    └─[ ] APP_KEY
    └─[ ] DB_CONNECTION
    └─[ ] Database credentials
    └─[ ] Mail config

[ ] Build settings
    └─[ ] Build pack: nixpacks or dockerfile
    └─[ ] Pre-deploy script
    └─[ ] Post-deploy script

[ ] Health check
    └─[ ] Endpoint: /health
    └─[ ] Interval
```

---

## INF.III — Nginx + SSL

```
[ ] nginx.conf
    └─[ ] Server blocks
    └─[ ] PHP-FPM proxy
    └─[ ] Static files caching
    └─[ ] Gzip compression

[ ] SSL/TLS
    └─[ ] Let's Encrypt via Coolify
    └─[ ] Auto-renew
    └─[ ] HTTP to HTTPS redirect

[ ] Security headers
    └─[ ] X-Frame-Options
    └─[ ] X-Content-Type-Options
    └─[ ] Referrer-Policy
    └─[ ] Content-Security-Policy
```

### nginx.conf ejemplo
```nginx
server {
    listen 80;
    server_name beni.gob.bo;

    root /var/www/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \\.php$ {
        fastcgi_pass app:9000;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~* \\.(jpg|jpeg|png|gif|ico|css|js|webp)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
}
```

---

## INF.IV — Database Setup

```
[ ] MySQL/PostgreSQL en Coolify
    └─[ ] Create database
    └─[ ] User + permissions
    └─[ ] Connection string

[ ] Migraciones
    └─[ ] Run migrations
    └─[ ] Seed data

[ ] Config
    └─[ ] UTF8MB4 charset
    └─[ ] Timezone config
```

---

## INF.V — Deploy Pipeline

```
[ ] Git hooks
    └─[ ] Auto-deploy on push
    └─[ ] Branch selection

[ ] Pre-deployment
    └─[ ] composer install --no-dev
    └─[ ] npm run build
    └─[ ] php artisan migrate --force

[ ] Post-deployment
    └─[ ] php artisan config:cache
    └─[ ] php artisan route:cache
    └─[ ] php artisan view:clear

[ ] Rollback
    └─[ ] Previous version restore
    └─[ ] Database rollback option
```

---

## INF.VI — Observabilidad

```
[ ] Logging
    └─[ ] Laravel log to stdout
    └─[ ] Log viewer en Coolify

[ ] Monitoring
    └─[ ] Resource usage
    └─[ ] Request metrics

[ ] Health checks
    └─[ ] /health endpoint
    └─[ ] Database connection
```

### Health endpoint example
```php
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'app' => 'beni.gob.bo',
        'version' => config('app.version'),
    ]);
});
```

---

## INF.VII — Backup Strategy

```
[ ] Spatie Backup
    └─[ ] composer require spatie/laravel-backup
    └─[ ] Configure backup destination
    └─[ ] Schedule backups

[ ] Coolify backups
    └─[ ] Database snapshots
    └─[ ] Volume backups

[ ] Restore procedure
    └─[ ] Documentar pasos
    └─[ ] Test de restauración
```

### Config de backup
```php
// config/backup.php
'backup' => [
    'destination' => [
        'disks' => ['local'],
    ],
    'cleanup' => [
        'strategy' => Spatie\Backup\Strategies\RemoveOldBackupsStrategy::class,
        'keep_backups_for_days' => 7,
    ],
],
```

---

## Deploy Commands

```bash
# Deploy desde Coolify
# Push a git → trigger automático

# Manual (si necesario)
php artisan migrate --force
php artisan config:cache
php artisan route:cache

# Rollback
# Coolify UI → Previous deployment
```

---

## Verificaciones

```bash
# Health check
https://beni.gob.bo/health  # → {"status":"ok"}

# SSL
https://ssllabs.com/ssltest/analyze.html?d=beni.gob.bo  # → A+

# Performance
Lighthouse > 90
```

---

## Documentación de Referencia

| Recurso | URL |
|---------|-----|
| Coolify | https://coolify.io/docs |
| Docker | https://docs.docker.com |
| Laravel Forge | https://forge.laravel.com |
| Spatie Backup | https://spatie.be/docs/laravel-backup |
| Nginx | https://nginx.org/en/docs/ |