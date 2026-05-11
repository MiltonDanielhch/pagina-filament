# Gobernación Autónoma Departamental del Beni

Sistema web oficial de la Gobernación Autónoma Departamental del Beni, Bolivia. Plataforma integral para gestión de contenidos, trámites digitales y comunicación gubernamental.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-5.0-EC4899?style=for-the-badge&logo=livewire&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.0-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)

## 🚀 Características Principales

- **Panel de Administración**: Interfaz moderna con [Filament v5](https://filamentphp.com/) para gestión de contenidos
- **Gestión de Publicaciones**: Sistema de blog/noticias con categorías y editor enriquecido
- **Páginas Dinámicas**: Constructor de páginas con contenido flexible
- **Slider/Banner**: Carrusel de imágenes configurable para el homepage
- **Menús**: Sistema de navegación jerárquico con múltiples ubicaciones
- **Configuración del Sitio**: Panel de ajustes para personalizar el sitio
- **Eventos**: Calendario y gestión de eventos institucionales
- **Sistemas Externos**: Integración con plataformas del estado (SISCOR, Gaceta, Transparencia)
- **SEO Optimizado**: Meta tags, sitemap XML y URLs amigables
- **Responsive**: Diseño adaptable a móviles y tablets
- **Gestión de Roles y Permisos**: Sistema de autorización con [Filament Shield](https://github.com/bezhanSalleh/filament-shield)

## 🛠️ Stack Tecnológico

### Backend
- **[Laravel 12](https://laravel.com)** - Framework PHP moderno
- **[Filament 5](https://filamentphp.com)** - Panel de administración TALL stack
- **[Livewire 3](https://livewire.laravel.com)** - Componentes dinámicos sin JavaScript
- **[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)** - Gestión de roles y permisos
- **[Laravel Media Library](https://spatie.be/docs/laravel-medialibrary)** - Gestión de archivos multimedia
- **[Laravel Backup](https://spatie.be/docs/laravel-backup)** - Respaldos automatizados
- **[Laravel Sitemap](https://github.com/spatie/laravel-sitemap)** - Generación de sitemaps
- **[Laravel Horizon](https://laravel.com/docs/horizon)** - Gestión de colas Redis
- **[Laravel Activity Log](https://github.com/rmsramos/activitylog)** - Registro de actividades
- **[SEO Tools](https://github.com/artesaos/seotools)** - Optimización SEO

### Frontend
- **[Tailwind CSS 4](https://tailwindcss.com)** - Framework CSS utility-first
- **[Vite](https://vitejs.dev)** - Build tool ultrarrápido
- **[Alpine.js](https://alpinejs.dev)** (via Livewire) - Reactividad ligera
- **[TipTap Editor](https://tiptap.dev)** - Editor de texto enriquecido

### Infraestructura
- **Docker** - Contenedores para desarrollo y producción
- **Nginx** - Servidor web con PHP-FPM
- **Supervisord** - Gestión de procesos
- **MySQL/MariaDB** - Base de datos relacional
- **Redis** - Caché y colas
- **Coolify** - Plataforma de deployment

## 📋 Requisitos

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0 o MariaDB >= 10.6
- Redis (opcional, para caché y colas)

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/MiltonDanielhch/pagina-filament.git
cd pagina-filament
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar entorno

```bash
cp .env.example .env
php artisan key:generate
```

Editar `.env` con tus credenciales de base de datos y configuración.

### 4. Construir assets

```bash
npm run build
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Esto creará:
- Usuario admin: `admin@admin.com` / `admin123`
- Roles y permisos (super_admin, admin, editor)
- Slides de ejemplo
- Categorías y posts de ejemplo
- Páginas institucionales
- Sistemas externos (SISCOR, Gaceta, etc.)
- Eventos del Beni
- Configuración del sitio
- Menús de navegación

### 6. Iniciar servidor

```bash
php artisan serve
```

Acceder a `http://localhost:8000`

## 🐳 Docker (Desarrollo)

```bash
docker-compose -f docker-compose.local.yml up -d
```

Servicios disponibles:
- App: `http://localhost`
- MySQL: puerto `3307`
- Redis: puerto `6379`

## 🌐 Docker (Producción - Coolify)

El proyecto está configurado para deployment en [Coolify](https://coolify.io):

1. Push a GitHub
2. Configurar proyecto en Coolify con el repositorio
3. Variables de entorno automáticas desde Coolify
4. Puerto expuesto: `8000`
5. El Dockerfile incluye:
   - PHP 8.3-FPM con extensiones necesarias
   - Nginx configurado
   - Build de assets Vite
   - Supervisord para gestionar procesos

### Variables de entorno importantes para Coolify

```env
APP_NAME="Gobernación del Beni"
APP_ENV=production
APP_KEY=base64:...
APP_URL=https://tudominio.com

DB_HOST=...
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true

TRUSTED_PROXIES=*
```

## 👤 Credenciales por defecto

| Rol | Email | Password |
|-----|-------|----------|
| Super Admin | admin@admin.com | admin123 |

## 📁 Estructura del Proyecto

```
pagina-filament/
├── app/
│   ├── Filament/Resources/      # Recursos del panel admin
│   ├── Http/Controllers/        # Controladores web
│   ├── Models/                  # Modelos Eloquent
│   └── Policies/                # Políticas de autorización
├── database/
│   ├── migrations/              # Migraciones
│   └── seeders/                 # Seeders con datos del Beni
├── docker/
│   ├── nginx/coolify.conf       # Config Nginx para Coolify
│   └── supervisord.conf         # Config Supervisord
├── resources/
│   ├── views/                   # Vistas Blade
│   ├── css/                     # Estilos Tailwind
│   └── js/                      # JavaScript
├── Dockerfile                   # Configuración Docker producción
└── docker-compose*.yml          # Docker Compose dev/prod
```

## 🔐 Seguridad

- Autenticación con [Filament Shield](https://github.com/bezhanSalleh/filament-shield)
- Permisos granulares por recurso (view, create, update, delete)
- Roles predefinidos: super_admin, admin, editor
- Protección CSRF en todos los formularios
- XSS protection con Blade escaping
- SQL injection protection via Eloquent

## 📝 Licencia

Este proyecto es software libre bajo licencia [MIT](https://opensource.org/licenses/MIT).

## 🤝 Contribuir

1. Fork el proyecto
2. Crea tu rama de feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Agrega nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

---

Desarrollado con ❤️ para el Beni, Bolivia.
