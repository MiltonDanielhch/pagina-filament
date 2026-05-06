# 03 — Fase 2: Setup y Configuración Inicial

> **Anterior:** `02-ANALISIS.md`
> **Siguiente:** `04-DATOS.md`
> **Semana:** 2
> **Objetivo:** Workspace funcional con Laravel 12 + Filament v5, CI/CD activo y base de testing establecida.

---

## Estados

```
[ ] Pendiente   [~] En progreso   [x] Completado   [!] Bloqueado
```

---

## Progreso

| Bloque | Nombre | Progreso |
|--------|--------|----------|
| 3.1 | Entorno de desarrollo local | **100%** |
| 3.2 | Instalación de Laravel 12 + Filament v5 | **100%** |
| 3.3 | Autenticación, roles y configuración | **100%** |
| 3.4 | CI/CD con GitHub Actions | **0%** |
| 3.5 | Setup de testing (Pest + Dusk) | **0%** |
| 3.6 | Entorno de staging en Coolify | **0%** |
| **Total Fase 2** | | **60%** |

---

## 3.1 — Entorno de desarrollo local

```
[x] Requisitos de sistema
    └─[x] PHP ^8.2 instalado (tenemos 8.2.28)
    └─[x] Composer 2.x instalado
    └─[x] Node.js 20+ y npm instalados
    └─[x] MySQL 8.0 (XAMPP)

[x] Variables de entorno
    └─[x] .env configurado
    └─[x] DB_CONNECTION=mysql
```

---

## 3.2 — Instalación de Laravel 12 + Filament v5

```
[x] Crear proyecto Laravel 12
    └─[x] composer create-project laravel/laravel

[x] Instalar Filament v5
    └─[x] composer require filament/filament:"^5.0"
    └─[x] php artisan filament:install --panels
    └─[x] Panel: admin, URL: /admin

[x] Instalar paquetes base
    └─[x] composer require spatie/laravel-medialibrary
    └─[x] composer require spatie/laravel-backup
    └─[x] composer require spatie/laravel-sitemap
    └─[x] composer require artesaos/seotools
    └─[x] composer require spatie/laravel-sluggable

[x] Instalar paquetes de frontend
    └─[x] Tailwind CSS v4 (ya incluido en Laravel 12)
    └─[x] npm install (dependencies instaladas)

[x] Verificar instalación
    └─[x] php artisan --version → Laravel 12.58.0 ✓
    └─[x] php artisan filament:upgrade → OK ✓
```

---

## 3.3 — Autenticación, roles y configuración

```
[x] Filament Shield (roles y permisos)
    └─[x] composer require bezhansalleh/filament-shield
    └─[x] php artisan shield:install
    └─[x] php artisan shield:generate (generado)
    └─[x] Super Admin: admin@admin.com ✓

[x] Roles base a crear
    └─[x] super_admin — acceso total al panel
    └─[x] admin — gestión de contenido y usuarios
    └─[x] editor — solo crear/editar posts propios

[ ] Autenticación de dos factores (2FA)
    └─[ ] Pendiente - Fase de Seguridad

[x] Configuración multilenguaje
    └─[x] ES como locale por defecto

[x] Configuración de logging
    └─[x] LOG_CHANNEL=stack en .env
```

---

## 3.4 — CI/CD con GitHub Actions

```
[ ] Repositorio Git
    └─[ ] git init + primer commit
    └─[ ] Repositorio en GitHub creado
    └─[ ] .gitignore configurado (vendor/, node_modules/, .env)
    └─[ ] Rama principal: main
    └─[ ] Rama de desarrollo: develop

[ ] Workflow de CI (.github/workflows/ci.yml)
    └─[ ] Trigger: push a main y develop, pull_request
    └─[ ] Jobs:
          ├─[ ] lint: php-cs-fixer o Pint
          ├─[ ] test: Pest (php artisan test)
          └─[ ] build: npm run build

[ ] Protección de ramas
    └─[ ] main: requiere PR + CI verde antes de merge
    └─[ ] develop: CI obligatorio
```

### Ejemplo de workflow CI

```yaml
# .github/workflows/ci.yml
name: CI

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main, develop]

jobs:
  test:
    runs-on: ubuntu-latest
    services:
      mysql:
        image: mysql:8.0
        env:
          MYSQL_ROOT_PASSWORD: secret
          MYSQL_DATABASE: testing
        ports:
          - 3306:3306

    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.3'
          extensions: mbstring, pdo, pdo_mysql, redis
          coverage: none

      - name: Install dependencies
        run: composer install --no-dev --optimize-autoloader

      - name: Copy .env
        run: cp .env.example .env.testing

      - name: Generate key
        run: php artisan key:generate --env=testing

      - name: Run tests
        run: php artisan test --env=testing
        env:
          DB_CONNECTION: mysql
          DB_HOST: 127.0.0.1
          DB_PORT: 3306
          DB_DATABASE: testing
          DB_USERNAME: root
          DB_PASSWORD: secret
```

---

## 3.5 — Setup de testing (Pest + Dusk)

```
[ ] Pest PHP
    └─[ ] composer require pestphp/pest --dev
    └─[ ] composer require pestphp/pest-plugin-laravel --dev
    └─[ ] php artisan pest:install
    └─[ ] Configurar phpunit.xml con base de datos de testing
    └─[ ] Primer test de humo: HomeTest.php (GET / → 200 OK)

[ ] Laravel Dusk (tests E2E en browser)
    └─[ ] composer require laravel/dusk --dev
    └─[ ] php artisan dusk:install
    └─[ ] Configurar ChromeDriver
    └─[ ] Primer test Dusk: login al panel admin

[ ] Estructura de tests recomendada
    tests/
    ├── Feature/
    │   ├── Auth/           ← Login, 2FA
    │   ├── Posts/          ← CRUD de noticias
    │   ├── Pages/          ← CRUD de páginas
    │   ├── Contact/        ← Formulario de contacto
    │   └── Frontend/       ← Rutas públicas → 200 OK
    ├── Unit/
    │   └── Models/         ← Tests de modelos
    └── Browser/            ← Tests Dusk E2E
        └── Admin/          ← Flujos del panel admin

[ ] Meta de cobertura
    └─[ ] Mínimo 60% de cobertura antes del deploy a producción
    └─[ ] 100% de rutas públicas testeadas (Feature tests)
    └─[ ] Todos los recursos Filament con al menos 1 test de CRUD
```

---

## 3.6 — Entorno de staging en Coolify

```
[ ] Crear proyecto en Coolify
    └─[ ] Proyecto: beni-staging
    └─[ ] Conectar repositorio GitHub

[ ] Configurar recurso Laravel (staging)
    └─[ ] URL: staging.beni.gob.bo (o staging.beni.test en desarrollo)
    └─[ ] Variables de entorno separadas de producción
    └─[ ] APP_ENV=staging
    └─[ ] APP_DEBUG=false
    └─[ ] Base de datos separada: beni_staging

[ ] Política de deploy a staging
    └─[ ] Auto-deploy al hacer push a rama: develop
    └─[ ] Nunca auto-deploy a producción sin revisión manual
    └─[ ] El equipo editorial valida contenido en staging antes del go-live
```

---

## Verificación de la Fase 2

```bash
# Comandos de verificación
php artisan --version           # → Laravel 12.x ✓
php artisan filament:list       # → panel visible ✓
php artisan test                # → All tests passing ✓
npm run build                   # → sin errores ✓
http://beni.test/admin          # → Login Filament carga ✓
http://beni.test/admin/login    # → Formulario de login visible ✓

# CI/CD
# Push a develop → GitHub Actions CI verde ✓
# staging.beni.gob.bo carga ✓
```

### Checklist de entrega Fase 2

```
[ ] Laravel 12 + Filament v5 instalados y funcionando ✓
[ ] Roles base configurados (super_admin, admin, editor) ✓
[ ] 2FA activo para roles admin ✓
[ ] GitHub Actions CI corriendo en cada push ✓
[ ] Pest instalado con primer test pasando ✓
[ ] Entorno staging en Coolify activo ✓
```

---

*Siguiente paso: `04-DATOS.md` — Modelos, migraciones y estructura de base de datos.*
