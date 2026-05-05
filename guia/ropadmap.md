# Roadmap: Migración beni.gob.bo WordPress → Laravel 12 + Filament v5

## Fase 1: Análisis y Planificación (semana 1)

- [ ] Analizar estructura actual de WordPress
- [ ] Documentar tipos de contenido existentes
- [ ] Identificar plugins y funcionalidades activas
- [ ] Mapear sistemas externos y sus integraciones
- [ ] Definir requisitos técnicos y funcionales
- [ ] Crear diagrama de arquitectura

## Fase 2: Setup y Configuración Inicial (semana 2)

- [ ] Instalar Laravel 12
- [ ] Instalar Filament v5
- [ ] Configurar entorno de desarrollo (Docker/Laragon)
- [ ] Configurar base de datos
- [ ] Setup de autenticación (Filament Shield)
- [ ] Configurar múltiples idiomas (ES/EN)
- [ ] Configurar logging y monitoreo

## Fase 3: Estructura de Datos (semana 3-4)

### 3.1 Modelos y Migraciones
- [ ] Usuarios y Roles (extendidos)
- [ ] Configuraciones del sitio
- [ ] Páginas estáticas
- [ ] Noticias/Artículos
- [ ] Categorías de noticias
- [ ] Imágenes/Media
- [ ] Menús/Navegación
- [ ] Redes sociales
- [ ] Información de contacto

### 3.2 Relaciones
- [ ] Relaciones entre modelos
- [ ] Soft deletes
- [ ] Trait de SEO

## Fase 4: Backend - Panel Filament (semana 4-6)

### 4.1 Recursos de Filament
- [ ] Resource: Páginas (con editor rico)
- [ ] Resource: Noticias
- [ ] Resource: Categorías
- [ ] Resource: Slides/Banners
- [ ] Resource: Redes sociales
- [ ] Resource: Configuraciones del sitio
- [ ] Resource: Menú dinámico
- [ ] Resource: Galería de imágenes

### 4.2 Plugins de Filament
- [ ] Filament Actions (modales)
- [ ] Filament Widgets (dashboard)
- [ ] Editor rico (Tiptap o similar)
- [ ] File uploads optimizados

### 4.3 Gestión de Usuarios
- [ ] Roles y permisos (Filament Shield)
- [ ] Usuarios con cargos/departamentos
- [ ] Actividad/Logs de usuario

## Fase 5: Frontend - Sitio Público (semana 6-8)

### 5.1 Stack UI
- [ ] Tailwind CSS
- [ ] Blade components
- [ ] Livewire (donde sea necesario)

### 5.2 Páginas
- [ ] Homepage con слайдер y noticias
- [ ] Página del Gobernador
- [ ] Blog/Noticias (listado y detalle)
- [ ] Noticias por categoría
- [ ] Página de Sobre Nosotros
- [ ] Misión y Visión
- [ ] Página de Contacto
- [ ] Política de Privacidad

### 5.3 Componentes Reutilizables
- [ ] Header/Navegación dinámica
- [ ] Footer
- [ ] Cards de noticias
- [ ] Slider/Banner
- [ ] Galería de imágenes
- [ ] Links a sistemas externos

### 5.4 SEO y Meta
- [ ] Meta tags dinámicos
- [ ] Sitemap XML
- [ ] Schema.org
- [ ] Open Graph images
- [ ] URLs amigables

## Fase 6: Integración con Sistemas Externos (semana 8-9)

- [ ] Link a Gaceta (https://gaceta.beni.gob.bo)
- [ ] Link a Siscor (https://siscor.beni.gob.bo)
- [ ] Link a Transparencia (https://transparencia.beni.gob.bo)
- [ ] Link a Sistema de Almacén
- [ ] Link a Sistema de Minería
- [ ] Link a SIRETRA
- [ ] Badge/indicador de estado (opcional)

## Fase 7: Rendimiento y Optimización (semana 9-10)

- [ ] Cacheo de vistas
- [ ] Optimización de imágenes (Spatie Media Library)
- [ ] Lazy loading
- [ ] CDN config
- [ ] Compression GZIP/Brotli
- [ ] Queue para procesos largos

## Fase 8: Seguridad (semana 10)

- [ ] Headers de seguridad
- [ ] Rate limiting
- [ ] CSRF protection
- [ ] XSS sanitization
- [ ] Backup automático
- [ ] Logs de auditoría

## Fase 9: Despliegue (semana 11)

- [ ] Configurar servidor (Nginx/PHP-FPM)
- [ ] SSL/TLS (Let's Encrypt)
- [ ] Variables de entorno
- [ ] Deploy script
- [ ] Migraciones en producción
- [ ] Testing de integración

## Fase 10: Migración de Contenido (semana 11-12)

- [ ] Exportar contenido de WordPress
- [ ] Limpiar y transformar datos
- [ ] Importar a Laravel
- [ ] Redirecciones 301
- [ ] Verificación de integridad
- [ ] DNS update

## Puntos a Considerar

### Alta Prioridad
1. **Editor de contenido rico** - El equipo debe poder editar fácilmente
2. **Responsive design** - Funcional en móviles
3. **Sistemas externos** - Mantener links actuales
4. **Rendimiento** - Carga rápida

### Media Prioridad
1. **Galería de imágenes** - Para eventos
2. **Noticias por categoría** - Cultura, Educación, Infraestructura, Salud
3. **Buscar en sitio** - Feature de búsqueda
4. **Forms de contacto** - Con validación

### Baja Prioridad
1. **Newsletter** - Suscripción
2. **Estadísticas** - Vistas de contenido
3. **Multimedia** - Videos YouTube/Vimeo

## Stack Tecnológico

| Componente | Tecnología |
|------------|-------------|
| Framework | Laravel 12 |
| Admin Panel | Filament v5 |
| PHP | ^8.2 |
| Database | MySQL/PostgreSQL |
| CSS | Tailwind CSS |
| Editor | Tiptap o similar |
| Auth | Filament Shield |
| Media | Spatie Media Library |

## Estructura de Diretórios Sugerida

```
project/
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   ├── Widgets/
│   │   └── Pages/
│   ├── Models/
│   └──Http/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   └── css/
├── routes/
└── tests/
```

## Tiempo Estimado Total

- **Tiempo mínimo**: 12 semanas
- **Con equipo**: 8 semanas (2 desarrolladores)

---

*Documento creado para guía de migración*
*Fecha: Mayo 2026*