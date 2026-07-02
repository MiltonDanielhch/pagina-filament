# DOCUMENTACIÓN DEL SISTEMA
## Portal Web Institucional - Gobernación Autónoma Departamental del Beni
**Gobierno Autónomo Departamental del Beni**

---

## 1. INFORMACIÓN GENERAL DEL SISTEMA

### a) Nombre oficial del sistema
Portal Web Institucional - Gobierno Autónoma Departamental del Beni

### b) Objetivo general
Proporcionar una plataforma web integral para la gestión de contenidos, comunicación gubernamental, transparencia y servicios digitales al ciudadano del Departamento del Beni, Bolivia, con un panel administrativo moderno basado en Filament.

### c) Objetivos específicos
- Gestionar publicaciones y noticias institucionales con categorías y editor enriquecido
- Administrar páginas estáticas con contenido dinámico
- Mantener slider/banners configurables para el homepage
- Gestionar sistema de menús jerárquicos con múltiples ubicaciones
- Administrar galerías de imágenes multimedia
- Integrar con sistemas externos de la Gobernacion (SISCOR, Gaceta, Transparencia)
- Implementar módulo de transparencia (presupuesto, POA, informes, rendición de cuentas)
- Gestionar marco normativo (leyes, decretos, resoluciones)
- Administrar convocatorias y contrataciones
- Administrar autoridades y organigrama institucional
- Implementar SEO optimizado
- Gestionar roles y permisos granulares

### d) Unidad solicitante o propietaria del sistema
Dirección de Sistemas y Telecomunicaciones - Gobierno Autónomo Departamental del Beni

### e) Responsable funcional (unidad solicitante)
Unidad de Comunicación - GAD Beni

### f) Fecha de inicio del proyecto
mayo 2026

### g) Fecha de puesta en producción
julio 2026

### h) Estado actual del sistema
dev
---

## 2. MARCO NORMATIVO Y PROCEDIMENTAL

### a) Normativa que respalda el desarrollo o implementación del sistema

#### Leyes
- **Ley 241**: Ley de Simplificación Administrativa (transparencia y acceso a información)
- **Ley 2341**: Ley de Procedimiento Administrativo
- **Ley 843**: Ley de Transparencia y Acceso a la Información Pública

### b) Procedimientos institucionales automatizados por el sistema
- Publicación de noticias y comunicados oficiales
- Publicación de convocatorias y procesos de contratación
- Divulgación de información de transparencia (presupuesto, POA, informes)
- Publicación de marco normativo departamental
- Actualización de autoridades y organigrama
- Seguimiento de proyectos de infraestructura

### c) Diagramas o descripción de los procesos de negocio implementados

#### Flujo principal de publicación de contenido:
1. **Inicio**: Funcionario inicia sesión en panel administrativo (Filament)
2. **Creación de contenido**: Ingreso de datos de noticia/página/evento
3. **Edición**: Uso de editor enriquecido TipTap para contenido
4. **Categorización**: Asignación de categoría y etiquetas
5. **SEO**: Configuración de meta tags y descripciones
6. **Multimedia**: Carga de imágenes con conversiones automáticas WebP
7. **Revisión**: Revisión y aprobación del contenido
8. **Programación**: Programación de fecha de publicación (opcional)
9. **Publicación**: Cambio de estado a "published"
10. **Difusión**: Publicación en sitio web y redes sociales (opcional)


### d) Relación del sistema con otros sistemas institucionales o externos
- **SISCOR**: Sistema de Correspondencia del Estado Plurinacional (enlace externo)
- **Gaceta Oficial**: Publicación de normas legales (enlace externo)
- **Sistema de Transparencia**: Plataforma nacional de transparencia (enlace externo)

---

## 3. ARQUITECTURA TECNOLÓGICA

### Frontend

#### Framework utilizado
- **Framework**: Laravel 12 con Filament 5 (TALL stack: Tailwind, Alpine, Livewire, Laravel)
- **Versión**: Vite 7.0.7
- **Panel administrativo**: Filament v5
- **Librerías principales**:
  - Tailwind CSS 4.0 (framework CSS utility-first)
  - Alpine.js 3.15 (reactividad ligera vía Livewire)
- **Herramientas de construcción y despliegue**:
  - PostCSS 8 para procesamiento de CSS

### Backend

#### Framework utilizado
- **Framework**: Laravel Framework
- **Versión**: 12.0
- **Lenguaje de programación**: PHP 8.3+
- **Librerías principales**:
  - Filament 5.0 (panel administrativo TALL stack)
  - Filament Shield (gestión de roles y permisos)
  - Spatie Laravel Permission (roles y permisos granulares)
  - Spatie Laravel Media Library 11.0 (gestión de archivos multimedia)

### Motor de Base de Datos

#### Nombre del motor
MySQL 

#### Versión
MySQL 8.0+ 


### Infraestructura

#### Sistema operativo del servidor
- Linux (Ubuntu)
- Configuración Docker con imagen php:8.3-fpm

#### Virtualización utilizada
Docker containers con PHP-FPM y Nginx

#### Docker o contenedores
Sí, utiliza Dockerfile con:
- Imagen base: php:8.3-fpm
- Extensiones PHP: pdo_mysql, mbstring, exif, pcntl, bcmath, gd, zip, intl, redis
- Optimización GD con WebP para conversión de imágenes
- Supervisord para gestión de procesos
- Memory limit: Configurable en Docker
- Upload max filesize: Configurable en PHP

---

## 4. AMBIENTES DE TRABAJO

### a) Desarrollo

#### Ubicación
Servidor de desarrollo local

#### Servidor
Localhost o servidor de desarrollo interno

#### Dirección IP
127.0.0.1 (local) o IP interna de red

#### Responsable
Desarrollador del sistema


## 5. FLUJO FUNCIONAL DEL SISTEMA

### a) Procesos principales

#### 1. Gestión de Contenido (CMS)
- Creación y edición de noticias/publicaciones
- Gestión de categorías de contenido
- Creación de páginas estáticas dinámicas
- Gestión de slider/banners del homepage
- Gestión de menús de navegación jerárquicos
- Configuración del sitio (ajustes globales)

#### 3. Gestión de Galerías
- Creación de galerías de imágenes
- Gestión de items de galería
- Conversiones automáticas WebP
- Optimización de imágenes (thumb, medium, large)

#### 4. Transparencia
- Publicación de presupuestos
- Publicación de POA (Plan Operativo Anual)
- Publicación de informes
- Rendición de cuentas
- Auditorías
- Marco normativo

#### 6. Información Institucional
- Gestión de autoridades
- Organigrama departamental
- Secretarías y direcciones
- Proyectos de infraestructura
- Estadísticas departamentales
- Logros y achievements

### b) Casos de uso más importantes

#### UC-01: Publicar noticia
- Actor: Funcionario de comunicación
- Precondición: Usuario autenticado con permisos de edición
- Flujo:
  1. Acceder a panel administrativo Filament
  2. Navegar a Contenido > Noticias > Crear
  3. Ingresar título y contenido con editor TipTap
  4. Seleccionar categoría
  5. Cargar imagen destacada
  6. Configurar SEO (meta title, description)
  7. Programar fecha de publicación (opcional)
  8. Guardar como borrador o publicar
  9. Sistema genera automáticamente slug
  10. Sistema optimiza imágenes automáticamente

### c) Flujo completo de las funcionalidades críticas

#### Publicación de contenido con optimización de imágenes:
1. **Entrada**: Datos de contenido (título, cuerpo, categoría), archivos de imagen
2. **Proceso**:
   - Validación de datos
   - Generación automática de slug
   - Procesamiento de imágenes con Spatie Media Library
   - Conversiones automáticas: thumb (150x150), medium (800px), large (1200px), OG (1200x630)
   - Formato de salida: WebP optimizado
   - Generación de meta tags SEO
   - Programación de publicación (si aplica)
3. **Salida**: Contenido publicado con imágenes optimizadas, URL amigable, meta tags

### e) Validaciones implementadas

#### Validaciones de negocio:
- Slug único para posts, páginas, eventos
- Fecha de publicación no puede ser anterior a fecha actual (para publicación inmediata)
- Campos obligatorios según tipo de contenido
- Formatos de archivo permitidos para multimedia
- Tamaños máximos de archivo
- Categoría obligatoria para posts
- Email válido para quejas y reclamos

### f) Reglas de negocio relevantes

#### Publicación de contenido:
- Estado de posts: draft, published, archived
- Solo contenido con estado "published" es visible públicamente
- Posts pueden estar fijados (destacados)
- Categorías tienen colores para identificación visual

#### Transparencia:
- Datos abiertos pueden descargarse en múltiples formatos
- Marco normativo clasificado por tipo (ley, decreto, resolución)
- Alcance: nacional o departamental

### g) Integraciones con otros sistemas

#### Sistemas externos (enlaces):
- **SISCOR**: Sistema de Correspondencia (enlace externo)
- **Gaceta Oficial**: Publicación de normas (enlace externo)
- **Transparencia**: Plataforma nacional (enlace externo)

---
