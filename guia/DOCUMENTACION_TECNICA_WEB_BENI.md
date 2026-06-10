# DOCUMENTACIÓN TÉCNICA DEL SISTEMA
## Portal Web Institucional - Gobernación Autónoma Departamental del Beni
**Gobierno Autónomo Departamental del Beni**

---

## 1. INFORMACIÓN GENERAL DEL SISTEMA

### a) Nombre oficial del sistema
Portal Web Institucional - Gobernación Autónoma Departamental del Beni

### b) Objetivo general
Proporcionar una plataforma web integral para la gestión de contenidos, comunicación gubernamental, transparencia y servicios digitales al ciudadano del Departamento del Beni, Bolivia, con un panel administrativo moderno basado en Filament.

### c) Objetivos específicos
- Gestionar publicaciones y noticias institucionales con categorías y editor enriquecido
- Administrar páginas estáticas con contenido dinámico
- Mantener slider/banners configurables para el homepage
- Gestionar sistema de menús jerárquicos con múltiples ubicaciones
- Publicar y gestionar eventos departamentales con calendario
- Administrar galerías de imágenes multimedia
- Integrar con sistemas externos del estado (SISCOR, Gaceta, Transparencia)
- Implementar módulo de transparencia (presupuesto, POA, informes, rendición de cuentas)
- Gestionar marco normativo (leyes, decretos, resoluciones)
- Administrar convocatorias y contrataciones
- Implementar libro de reclamaciones virtual (quejas y reclamos)
- Gestionar datos abiertos del departamento
- Administrar autoridades y organigrama institucional
- Gestionar proyectos de infraestructura departamental
- Proporcionar estadísticas departamentales
- Implementar SEO optimizado con sitemap XML
- Gestionar roles y permisos granulares

### d) Unidad solicitante o propietaria del sistema
Dirección de Sistemas y Telecomunicaciones - Gobierno Autónomo Departamental del Beni

### e) Responsable funcional (unidad solicitante)
Unidad de Comunicación Social - GAD Beni

### f) Responsable técnico (Dirección de Sistemas y Telecomunicaciones)
Ing. Milton Daniel Hipamo Cholima

### g) Fecha de inicio del proyecto
mayo 2026

### h) Fecha de puesta en producción
junio 2026

### i) Estado actual del sistema
Producción

### j) Versión actual del sistema
1.0.0

---

## 2. MARCO NORMATIVO Y PROCEDIMENTAL

### a) Normativa que respalda el desarrollo o implementación del sistema

#### Leyes
- **Ley 241**: Ley de Simplificación Administrativa (transparencia y acceso a información)
- **Ley 2341**: Ley de Procedimiento Administrativo
- **Ley 843**: Ley de Transparencia y Acceso a la Información Pública

#### Normas Técnicas
- **RM 067/2025**: Reglamento de Gestión de Información y Servicios Digitales

#### Normativa interna institucional
- Reglamentos internos del GAD Beni para gestión de información
- Manuales de procedimientos de la Unidad de Comunicación Social

### b) Procedimientos institucionales automatizados por el sistema
- Publicación de noticias y comunicados oficiales
- Gestión de eventos institucionales
- Atención de quejas y reclamos ciudadanos (Libro de Reclamaciones Virtual)
- Publicación de convocatorias y procesos de contratación
- Divulgación de información de transparencia (presupuesto, POA, informes)
- Publicación de marco normativo departamental
- Gestión de datos abiertos
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

#### Flujo de quejas y reclamos:
1. **Inicio**: Ciudadano accede a formulario de quejas y reclamos
2. **Registro**: Ingreso de datos personales y descripción del reclamo
3. **Generación**: Sistema genera código de seguimiento único
4. **Confirmación**: Envío de confirmación con código de seguimiento
5. **Seguimiento**: Ciudadano puede consultar estado por código
6. **Atención**: Funcionario revisa y procesa reclamo
7. **Respuesta**: Registro de respuesta y cambio de estado
8. **Cierre**: Finalización del proceso

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
  - TipTap Editor 3.22 (editor de texto enriquecido)
  - Axios 1.11 (para peticiones HTTP)
  - Laravel Vite Plugin 2.0
- **Herramientas de construcción y despliegue**:
  - Vite para bundling y hot reload
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
  - Spatie Laravel Backup 9.0 (respaldos automatizados)
  - Spatie Laravel Sitemap 8.0 (generación de sitemaps)
  - Spatie Laravel Sluggable (generación de slugs)
  - Laravel Horizon 5.46 (gestión de colas Redis)
  - Laravel Activity Log (registro de actividades)
  - SEO Tools (optimización SEO)
  - Laravel Tinker 2.10 (consola interactiva)

### Motor de Base de Datos

#### Nombre del motor
MySQL / MariaDB

#### Versión
MySQL 8.0+ / MariaDB 10.6+

#### Configuración relevante
- Charset: utf8mb4
- Collation: utf8mb4_unicode_ci
- Motor de almacenamiento: InnoDB

#### Estrategia de respaldo
- Respaldo automatizado con Spatie Laravel Backup
- Respaldo de base de datos completa
- Respaldo de archivos storage
- Periodicidad: Configurable (recomendado: diaria)
- Retención: Configurable (recomendado: 30 días)

### Infraestructura

#### Sistema operativo del servidor
- Linux (Ubuntu/Debian) o Windows Server
- Configuración Docker con imagen php:8.3-fpm

#### Virtualización utilizada
Docker containers con PHP-FPM y Nginx

#### Docker o contenedores
Sí, utiliza Dockerfile con:
- Imagen base: php:8.3-fpm
- Extensiones PHP: pdo_mysql, mbstring, exif, pcntl, bcmath, gd, zip, intl, redis
- Optimización GD con WebP para conversión de imágenes
- Nginx como servidor web
- Supervisord para gestión de procesos
- Memory limit: Configurable en Docker
- Upload max filesize: Configurable en PHP

#### Servidores web utilizados
- Nginx (servidor web)
- PHP-FPM (procesador PHP)
- Puerto: 8000

### Despliegue con Coolify
- Dockerfile optimizado para Coolify
- Configuración automática de variables de entorno
- Build de assets Vite durante deployment
- Supervisord para gestión de procesos en background

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

#### Configuración
- APP_ENV=local
- APP_DEBUG=true
- Base de datos: SQLite o MySQL local
- Cache: database o file

### b) Pruebas (Test o QA)

#### Ubicación
Servidor de pruebas interno

#### Servidor
Servidor de staging/pruebas

#### Dirección IP
Por definir (según infraestructura GAD Beni)

#### Responsable
Equipo de QA / Dirección de Sistemas

#### Configuración
- APP_ENV=testing
- APP_DEBUG=true
- Base de datos: MySQL de pruebas
- Cache: Redis o database

### c) Producción

#### Ubicación física
Centro de datos del GAD Beni o nube (Coolify)

#### Centro de datos
Data Center del Gobierno Autónomo Departamental del Beni o Coolify Cloud

#### Servidor
Servidor de producción con Docker vía Coolify

#### Dirección IP
Por definir (según infraestructura)

#### Responsable
Dirección de Sistemas y Telecomunicaciones

#### Configuración
- APP_ENV=production
- APP_DEBUG=false
- Base de datos: MySQL de producción
- Optimizaciones habilitadas (config:cache, view:cache, route:cache)
- Cache: Redis recomendado
- Colas: Redis con Laravel Horizon

---

## 5. FLUJO FUNCIONAL DEL SISTEMA

### a) Procesos principales

#### 1. Gestión de Contenido (CMS)
- Creación y edición de noticias/publicaciones
- Gestión de categorías de contenido
- Creación de páginas estáticas dinámicas
- Gestión de slider/banners del homepage
- Gestión de menús de navegación jerárquicos
- Configuración del sitio (ajustes globales)

#### 2. Gestión de Eventos
- Creación de eventos departamentales
- Gestión de fechas y ubicaciones
- Calendario de eventos
- Exportación a iCal y Google Calendar
- Destacado de eventos importantes

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

#### 5. Servicios al Ciudadano
- Gestión de trámites y procedimientos
- Convocatorias y contrataciones
- Quejas y reclamos (Libro de Reclamaciones Virtual)
- Datos abiertos
- Oficinas de atención ciudadana

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

#### UC-02: Registrar queja o reclamo
- Actor: Ciudadano
- Precondición: Ninguna
- Flujo:
  1. Acceder a sección "Quejas y Reclamos"
  2. Completar formulario con datos personales
  3. Describir motivo del reclamo
  4. Adjuntar documentos (opcional)
  5. Enviar formulario
  6. Sistema genera código de seguimiento único
  7. Sistema envía confirmación
  8. Ciudadano puede consultar estado con código

#### UC-03: Publicar evento
- Actor: Funcionario de comunicación
- Precondición: Usuario autenticado con permisos
- Flujo:
  1. Acceder a panel administrativo
  2. Navegar a Contenido > Eventos > Crear
  3. Ingresar título y descripción
  4. Configurar fecha y hora de inicio/fin
  5. Ingresar ubicación
  6. Cargar imágenes de galería
  7. Marcar como destacado (opcional)
  8. Guardar como borrador o publicar

#### UC-04: Gestionar datos abiertos
- Actor: Funcionario de transparencia
- Precondición: Usuario autenticado con permisos
- Flujo:
  1. Acceder a panel administrativo
  2. Navegar a Transparencia > Datos Abiertos > Crear
  3. Ingresar título y descripción del dataset
  4. Cargar archivo (CSV, Excel, PDF, etc.)
  5. Configurar metadatos
  6. Publicar dataset
  7. Ciudadanos pueden descargar en diferentes formatos

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

#### Gestión de quejas y reclamos:
1. **Entrada**: Datos del ciudadano, descripción del reclamo, documentos adjuntos
2. **Proceso**:
   - Validación de datos obligatorios
   - Generación de token único de seguimiento
   - Almacenamiento en base de datos
   - Envío de confirmación (email si configurado)
   - Asignación de estado inicial
3. **Salida**: Código de seguimiento, confirmación de registro

### d) Entradas y salidas del sistema

#### Entradas:
- Datos de noticias/publicaciones (título, contenido, categoría)
- Datos de eventos (título, fechas, ubicación)
- Datos de quejas y reclamos (información ciudadana, descripción)
- Archivos multimedia (imágenes, documentos)
- Datos de transparencia (presupuestos, informes)
- Datos de autoridades y organigrama
- Datos de proyectos de infraestructura

#### Salidas:
- Páginas web con contenido dinámico
- Sitemap XML
- Feeds RSS (si configurado)
- Reportes de estadísticas
- Códigos de seguimiento para quejas
- Archivos de datos abiertos en múltiples formatos
- Optimizaciones de imágenes WebP

### e) Validaciones implementadas

#### Validaciones de negocio:
- Slug único para posts, páginas, eventos
- Fecha de publicación no puede ser anterior a fecha actual (para publicación inmediata)
- Campos obligatorios según tipo de contenido
- Formatos de archivo permitidos para multimedia
- Tamaños máximos de archivo
- Categoría obligatoria para posts
- Email válido para quejas y reclamos

#### Validaciones técnicas:
- Autenticación requerida para rutas de administración
- CSRF protection en formularios
- Validación de tipos de datos en formularios
- Sanitización de inputs
- Rate limiting para formularios públicos
- Validación de permisos con Filament Shield

### f) Reglas de negocio relevantes

#### Publicación de contenido:
- Estado de posts: draft, published, archived
- Solo contenido con estado "published" es visible públicamente
- Posts pueden estar fijados (pinned) en首页
- Categorías tienen colores para identificación visual

#### Eventos:
- Estado: draft, published
- Eventos pueden ser destacados (featured)
- Eventos futuros se muestran primero
- Exportación a iCal y Google Calendar

#### Quejas y reclamos:
- Cada reclamo genera un token único de seguimiento
- Estados: pendiente, en proceso, resuelto, cerrado
- Ciudadanos pueden consultar estado con token

#### Transparencia:
- Datos abiertos pueden descargarse en múltiples formatos
- Marco normativo clasificado por tipo (ley, decreto, resolución)
- Alcance: nacional o departamental

### g) Integraciones con otros sistemas

#### Sistemas externos (enlaces):
- **SISCOR**: Sistema de Correspondencia (enlace externo)
- **Gaceta Oficial**: Publicación de normas (enlace externo)
- **Transparencia**: Plataforma nacional (enlace externo)

#### Servicios internos:
- **Laravel Horizon**: Gestión de colas Redis
- **Laravel Backup**: Respaldos automatizados
- **Sitemap**: Generación automática de sitemap.xml

---

## 6. COMPONENTES TÉCNICOS A EXPLICAR

### 6.1 Base de Datos

#### a) Modelo entidad-relación

**Entidades principales:**
- **users**: Usuarios del sistema administrativo
- **posts**: Noticias/publicaciones del blog
- **pages**: Páginas estáticas dinámicas
- **categories**: Categorías de contenido
- **slides**: Slider/banners del homepage
- **events**: Eventos departamentales
- **galleries**: Galerías de imágenes
- **gallery_items**: Items individuales de galería
- **menus**: Menús de navegación
- **menu_items**: Items de menú jerárquicos
- **external_systems**: Sistemas externos (SISCOR, Gaceta, etc.)
- **site_settings**: Configuración global del sitio
- **media**: Archivos multimedia (Spatie Media Library)
- **activity_log**: Registro de actividades (Spatie Activity Log)
- **achievements**: Logros y resultados
- **officials**: Autoridades del gobierno
- **offices**: Oficinas de atención ciudadana
- **secretariats**: Secretarías departamentales
- **infrastructure_projects**: Proyectos de infraestructura
- **departmental_statistics**: Estadísticas departamentales
- **marco_normativos**: Marco normativo (leyes, decretos)
- **procedures**: Trámites y procedimientos
- **announcements**: Convocatorias y contrataciones
- **complaints**: Quejas y reclamos
- **open_datasets**: Datos abiertos
- **agendas**: Agenda institucional
- **contact_messages**: Mensajes de contacto
- **post_templates**: Plantillas de posts

**Relaciones principales:**
- posts → user (N:1)
- posts → category (N:1)
- events → user (N:1)
- menu_items → menu (N:1)
- menu_items → menu_items (self-referential para jerarquía)
- galleries → gallery_items (1:N)
- officials → office (N:1)
- infrastructure_projects → secretariat (N:1)
- complaints (sin relaciones directas, token único)

#### b) Tablas principales

**Tabla: posts**
- id (PK)
- user_id (FK)
- category_id (FK, nullable)
- title
- slug (unique)
- excerpt (nullable)
- body (longText)
- status (enum: draft, published, archived)
- is_pinned (boolean)
- published_at (timestamp, nullable)
- meta_title (nullable)
- meta_description (nullable)
- shared_to_social (boolean)
- shared_at (timestamp, nullable)
- view_count (integer)
- softDeletes
- timestamps

**Tabla: pages**
- id (PK)
- title
- slug (unique)
- content (longText, nullable)
- meta_title (nullable)
- meta_description (nullable)
- is_published (boolean)
- timestamps

**Tabla: events**
- id (PK)
- user_id (FK)
- title
- slug (unique)
- description (longText)
- location (nullable)
- starts_at (datetime)
- ends_at (datetime, nullable)
- is_featured (boolean)
- status (enum: draft, published)
- view_count (integer)
- softDeletes
- timestamps

**Tabla: categories**
- id (PK)
- name
- slug (unique)
- description (nullable)
- color (hex)
- timestamps

**Tabla: slides**
- id (PK)
- title
- image
- link (nullable)
- description (nullable)
- order (integer)
- is_active (boolean)
- timestamps

**Tabla: menus**
- id (PK)
- name
- location (unique) - header/footer
- is_active (boolean)
- timestamps

**Tabla: menu_items**
- id (PK)
- menu_id (FK)
- parent_id (FK, nullable, self-referential)
- title
- url
- order (integer)
- is_active (boolean)
- timestamps

**Tabla: external_systems**
- id (PK)
- name
- url
- description (nullable)
- icon (nullable)
- is_active (boolean)
- order (integer)
- last_status (enum: online, offline, unknown)
- last_checked_at (timestamp, nullable)
- timestamps

**Tabla: complaints**
- id (PK)
- name
- email
- phone (nullable)
- identity_document (nullable)
- complaint_type (enum)
- description (longText)
- status (enum)
- token (unique) - código de seguimiento
- response (nullable)
- responded_at (nullable)
- softDeletes
- timestamps

**Tabla: marco_normativos**
- id (PK)
- type (enum: ley, decreto_supremo, decreto, resolución, otra)
- number (string, nullable)
- title
- slug (unique)
- summary (nullable)
- issue_date (date, nullable)
- scope (enum: nacional, departamental)
- document_file (nullable) - PDF via Spatie
- external_url (nullable)
- is_published (boolean)
- sort_order (integer)
- softDeletes
- timestamps

#### c) Vistas (Views) más importantes
No se utilizan vistas de base de datos. Se usan queries Eloquent de Laravel y recursos Filament.

#### d) Procedimientos almacenados (Stored Procedures)
No se utilizan procedimientos almacenados. Toda la lógica está en el código PHP (Laravel).

#### e) Funciones (Functions)
No se utilizan funciones de base de datos. La lógica de negocio está en los modelos y servicios de Laravel.

#### f) Triggers
No se utilizan triggers. Se usan Observers de Laravel y eventos de Eloquent para automatizaciones.

#### g) Jobs o tareas programadas
- **Tabla: jobs**: Para cola de trabajos (Laravel Queue)
- **Laravel Horizon**: Gestión de colas con Redis
- Tareas programadas configurables en app/Console/Kernel.php

#### h) Índices relevantes
- Índice único en posts.slug
- Índice único en pages.slug
- Índice único en events.slug
- Índice único en categories.slug
- Índice único en complaints.token
- Índice único en menus.location
- Índice compuesto en menu_items (menu_id, parent_id, order)
- Índices en posts (status, published_at, category_id)
- Índices en events (status, starts_at)
- Índices en marco_normativos (scope, is_published, type, issue_date)

#### i) Estrategia de optimización de consultas
- Uso de Eager Loading (with()) para reducir N+1 queries
- Caching de configuración del sitio
- Índices en campos de búsqueda frecuentes
- Soft deletes para mantener integridad referencial
- Paginación en listados de Filament

#### j) Políticas de respaldo y recuperación
- Respaldo automatizado con Spatie Laravel Backup
- Respaldo de base de datos completa
- Respaldo de archivos storage (media, uploads)
- Periodicidad: Configurable (recomendado: diaria)
- Retención: Configurable (recomendado: 30 días)
- Pruebas de restauración: Mensuales
- Almacenamiento: Local o S3 (configurable)

### 6.2 APIs e Integraciones

#### a) APIs internas
- **API de búsqueda**: `/api/buscar` - Búsqueda de contenido
- **API de proyectos de infraestructura**: `/api/infrastructure-projects` - Lista de proyectos
- **API de estadísticas**: `/api/statistics` - Datos estadísticos

#### b) APIs externas
- **No hay integraciones con APIs REST externas** (solo enlaces a sistemas externos)

#### c) Métodos disponibles
- Rutas web para CRUD de entidades (vía Filament)
- Rutas públicas para contenido (blog, eventos, páginas)
- Rutas API para datos JSON (proyectos, estadísticas, búsqueda)
- Rutas para sitemap XML

#### d) Autenticación utilizada
- **Panel administrativo**: Session-based authentication (Filament)
- **Middleware**: Filament Shield para roles y permisos
- **Roles**: super_admin, admin, editor (configurables)
- **No hay API token authentication configurada**

#### e) Formato de intercambio de datos
- **Formularios**: application/x-www-form-urlencoded
- **AJAX**: JSON
- **Archivos**: multipart/form-data
- **API responses**: JSON

#### f) Dependencias con servicios externos
- **Servidor de archivos**: Sistema de archivos local o S3 (configurable vía Spatie Media Library)
- **Cache**: Redis (recomendado para producción)
- **Colas**: Redis con Laravel Horizon

#### g) Riesgos ante indisponibilidad de servicios externos
- **Sistemas externos (SISCOR, Gaceta)**: Solo enlaces, no afectan funcionamiento principal
- **Redis**: Si no disponible, puede usar database o file para cache/colas
- **S3**: Si no disponible, usa sistema de archivos local

### 6.3 Seguridad

#### a) Mecanismo de autenticación
- Session-based authentication (Laravel default)
- Login a través de Filament panel administrativo
- Filament Shield para gestión de roles y permisos

#### b) Mecanismo de autorización
- Roles y permisos de Spatie Laravel Permission
- Filament Shield para integración con Filament
- Policies de Laravel para modelos (implementadas)
- Permisos granulares por recurso (view, create, update, delete)

#### c) Roles y perfiles
- **super_admin**: Acceso total al sistema
- **admin**: Acceso a la mayoría de funcionalidades
- **editor**: Acceso limitado a contenido
- Roles gestionados a través de Filament Shield

#### d) Políticas de contraseñas
- Configuración Laravel default
- Password reset tokens expiran en 60 minutos
- No hay requisitos de complejidad adicionales configurados

#### e) Registro de auditoría
- Spatie Activity Log para registro de actividades
- Registro automático de cambios en modelos
- Campos de auditoría en tablas principales (created_at, updated_at)
- Soft deletes con información de eliminación

#### f) Bitácoras del sistema
- Laravel Log Channel: stack (daily files en storage/logs)
- Nivel de log: debug en desarrollo, error en producción
- Activity Log para acciones de usuario en panel administrativo

#### g) Cifrado de datos
- APP_KEY para cifrado de cookies y sesiones (AES-256-CBC)
- No hay cifrado de datos sensibles en base de datos
- Contraseñas hasheadas con bcrypt (Laravel default)

#### h) Protección contra ataques comunes
- CSRF protection habilitado (VerifyCsrfToken middleware)
- SQL injection prevenido por Eloquent ORM
- XSS prevenido por Blade templates ({{ }} escapa por defecto)
- Validación de inputs en controladores y recursos Filament
- TrustProxies middleware para balanceadores
- Rate limiting en formularios públicos

#### i) Gestión de sesiones
- Session driver: database (recomendado) o file
- Session lifetime: 120 minutos
- Almacenamiento: storage/framework/sessions o base de datos

---

## 7. METODOLOGÍA DE DESARROLLO

### a) Metodología utilizada
**Metodología Híbrida** (combinación de elementos de Scrum y desarrollo iterativo)

### b) Herramientas de gestión utilizadas
- **Control de versiones**: Git
- **Repositorio**: https://github.com/MiltonDanielhch/pagina-filament
- **Seguimiento de tareas**: Roadmap en carpeta docs/
- **Documentación**: Markdown (README.md, DOCUMENTACION_TECNICA_WEB_BENI.md)

### c) Frecuencia de despliegues
- **Desarrollo**: Continuo según avances
- **Pruebas**: Según necesidad de validación
- **Producción**: Por definir (recomendado: quincenal o mensual)

### d) Gestión de incidencias
- Reporte verbal o por correo electrónico
- Corrección directa en código
- Registro en Activity Log para auditoría

### e) Gestión de cambios
- Cambios directos en rama principal
- Code review informal
- Branching strategy: main (producción)

---

## 8. GESTIÓN DEL CÓDIGO FUENTE

### a) Ubicación del repositorio
- **Local**: c:\laravel\principal
- **Remoto**: https://github.com/MiltonDanielhch/pagina-filament

### b) Rama principal
- **main** - rama principal de producción

### c) Estrategia de versionado
- Versionado semántico manual (1.0.0)
- No hay tags de versiones en Git
- Cambios registrados en código

### d) Procedimiento de despliegue

#### Despliegue con Docker (Coolify):
```bash
# Push a GitHub
git push origin main

# Coolify detecta cambios automáticamente
# Build con Dockerfile
# Variables de entorno configuradas en Coolify
# Puerto expuesto: 8000
```

#### Despliegue tradicional:
```bash
# Instalar dependencias
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Configurar permisos
chmod -R 775 storage bootstrap/cache

# Optimizar para producción
php artisan config:cache
php artisan view:cache
php artisan route:cache
php artisan event:cache

# Enlace simbólico para storage
php artisan storage:link
```

### e) Dependencias externas
**Composer (PHP):**
- laravel/framework ^12.0
- filament/filament ~5.0
- bezhansalleh/filament-shield *
- filament/spatie-laravel-media-library-plugin ^5.6
- spatie/laravel-permission *
- spatie/laravel-medialibrary ^11.0
- spatie/laravel-backup ^9.0
- spatie/laravel-sitemap ^8.0
- spatie/laravel-sluggable *
- spatie/laravel-activitylog *
- laravel/horizon ^5.46
- artesaos/seotools *

**NPM (JavaScript):**
- vite ^7.0.7
- tailwindcss ^4.0.0
- @tailwindcss/vite ^4.0.0
- @tiptap/starter-kit ^3.22.5
- alpinejs ^3.15.12
- axios ^1.11.0
- laravel-vite-plugin ^2.0.0

### f) Variables de entorno necesarias
**Variables requeridas:**
- APP_NAME
- APP_ENV
- APP_KEY (generada con php artisan key:generate)
- APP_DEBUG
- APP_URL
- DB_CONNECTION
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

**Variables opcionales:**
- CACHE_STORE (database, redis, file)
- QUEUE_CONNECTION (database, redis)
- SESSION_DRIVER (database, file, redis)
- REDIS_HOST, REDIS_PORT, REDIS_PASSWORD
- MAIL_* (configuración de correo)
- AWS_* (si usa S3 para storage)

### g) Procedimiento de compilación
```bash
# Compilar assets de frontend
npm run build

# Optimizar autoloader
composer dump-autoload --optimize
```

### h) Procedimiento de restauración del sistema
```bash
# Restaurar backup con Spatie Laravel Backup
php artisan backup:restore

# O restaurar manualmente
# Restaurar base de datos
mysql -u root -p database < backup.sql

# Restaurar archivos
cp -r storage_backup/* storage/

# Recrear enlaces simbólicos
php artisan storage:link

# Limpiar caché
php artisan optimize:clear

# Optimizar nuevamente
php artisan optimize
```

---

## 9. MONITOREO Y OPERACIÓN

### a) Herramientas de monitoreo implementadas
- **Laravel Horizon**: Para monitoreo de colas Redis
- **Laravel Backup**: Para monitoreo de respaldos
- **Laravel Activity Log**: Para auditoría de acciones
- **Monitoreo manual**: Revisión de logs en storage/logs

### b) Indicadores de rendimiento
- Tiempo de respuesta: Monitoreo manual
- Uso de memoria: Configurable en Docker
- Métricas de colas: Laravel Horizon dashboard

### c) Consumo de recursos
- **PHP Memory Limit**: Configurable en Docker
- **Upload Max Filesize**: Configurable en PHP
- **Max Execution Time**: Configurable en PHP
- **OPcache**: Habilitado por defecto en PHP-FPM

### d) Capacidad máxima estimada de usuarios
- **Concurrentes**: ~100-500 usuarios (estimado)
- **Visitas diarias**: ~1,000-5,000 (estimado)
- **Limitante**: Configuración actual de servidor

### e) Alertas configuradas
- No hay alertas automáticas configuradas
- Monitoreo manual de logs y Horizon

### f) Procedimiento de atención de incidentes
1. Identificar incidente (reporte de usuario o revisión de logs)
2. Revisar logs en storage/logs/laravel.log
3. Revisar Activity Log en panel administrativo
4. Diagnosticar causa raíz
5. Implementar corrección
6. Probar en ambiente de desarrollo
7. Desplegar a producción
8. Verificar solución
9. Documentar incidente

### g) Acuerdos de nivel de servicio (SLA)
- No hay SLAs formales definidos
- Tiempo de respuesta: Según disponibilidad del equipo
- Tiempo de resolución: Según complejidad del incidente

---

## 10. DEMOSTRACIÓN PRÁCTICA

### a) Inicio de sesión
1. Acceder a `/admin`
2. Ingresar credenciales de usuario (email y password)
3. Sistema redirige al dashboard administrativo de Filament

### b) Flujo completo de los procesos críticos

#### Proceso: Publicación de noticia
1. Navegar a `/admin/posts`
2. Clic en "Crear nuevo"
3. Ingresar título de la noticia
4. Redactar contenido con editor TipTap
5. Seleccionar categoría
6. Cargar imagen destacada
7. Configurar SEO (meta title, description)
8. Seleccionar estado: draft o published
9. Clic en "Guardar"
10. Sistema genera automáticamente slug
11. Sistema optimiza imágenes automáticamente
12. Verificar noticia en sitio público

#### Proceso: Gestión de queja o reclamo
1. Ciudadano accede a `/quejas-reclamos`
2. Completa formulario con datos personales
3. Describe motivo del reclamo
4. Adjunta documentos (opcional)
5. Clic en "Enviar"
6. Sistema genera código de seguimiento
7. Sistema muestra confirmación con código
8. Ciudadano puede consultar estado en `/quejas-reclamos/seguir`

### c) Gestión de usuarios
1. Navegar a `/admin/users`
2. Lista de usuarios con Filament
3. Crear nuevo usuario:
   - Ingresar nombre, email, password
   - Asignar rol (super_admin, admin, editor)
   - Asignar permisos específicos
   - Guardar
4. Editar usuario existente
5. Eliminar usuario (soft delete)

### d) Consultas y reportes principales
1. **Activity Log**: `/admin/activity-log` - Registro de todas las acciones
2. **Lista de noticias**: `/admin/posts` con filtros por estado, categoría
3. **Lista de eventos**: `/admin/events` con calendario
4. **Dashboard**: `/admin` con estadísticas generales
5. **Horizon**: `/horizon` - Monitoreo de colas (si configurado)

### e) Integraciones con otros sistemas
- **Sistemas externos**: `/admin/external-systems` - Gestión de enlaces a SISCOR, Gaceta, etc.
- **Monitoreo de estado**: Verificación de disponibilidad de sistemas externos

### f) Procedimientos de respaldo y recuperación (explicación conceptual)

#### Respaldo:
```bash
# Respaldo automático con Spatie Laravel Backup
php artisan backup:run

# Respaldo manual de base de datos
mysqldump -u root -p database > backup_$(date +%Y%m%d).sql

# Respaldo de archivos
tar -czf storage_backup_$(date +%Y%m%d).tar.gz storage/
```

#### Recuperación:
```bash
# Restaurar backup con Spatie
php artisan backup:restore

# Restaurar base de datos manual
mysql -u root -p database < backup_YYYYMMDD.sql

# Restaurar archivos
tar -xzf storage_backup_YYYYMMDD.tar.gz

# Verificar funcionamiento del sistema
php artisan optimize:clear
php artisan optimize
```

---

## 11. ENTREGA FORMAL

### a) Acta de transferencia de conocimiento e inducción
**Por generar** - Debe firmarse al finalizar la presentación

### b) Documentación técnica de lo expuesto en la presentación
- Este documento (DOCUMENTACION_TECNICA_WEB_BENI.md)
- README.md (instrucciones de instalación)
- Código fuente comentado
- Estructura de base de datos (migraciones)
- Roadmap en carpeta docs/

---

## 12. RESPONSABILIDADES

### Desarrollador del sistema:
- **Ing. Milton Daniel Hipamo Cholima**
- Garantizar que toda la información presentada sea completa y actualizada
- Estar disponible para consultas durante el periodo de inducción
- Proporcionar soporte técnico durante los primeros 3 meses post-entrega

### Dirección de Sistemas y Telecomunicaciones:
- Recepcionar la documentación técnica
- Validar la información presentada
- Administrar y dar mantenimiento al sistema
- Capacitar al personal de desarrollo y comunicación

### Unidad de Comunicación Social:
- Validar la funcionalidad del sistema desde el punto de vista funcional
- Reportar incidencias o mejoras necesarias
- Utilizar el sistema según los procedimientos establecidos

---

## ANEXOS

### Anexo A: Estructura de directorios del proyecto

```
pagina-filament/
├── app/
│   ├── Filament/
│   │   ├── Resources/      # Recursos del panel admin
│   │   │   ├── Posts/      # Gestión de noticias
│   │   │   ├── Pages/      # Gestión de páginas
│   │   │   ├── Events/     # Gestión de eventos
│   │   │   ├── Categories/ # Gestión de categorías
│   │   │   ├── Slides/     # Gestión de slider
│   │   │   ├── Menus/      # Gestión de menús
│   │   │   ├── ExternalSystems/ # Sistemas externos
│   │   │   ├── Complaints/ # Quejas y reclamos
│   │   │   ├── MarcoNormativo/ # Marco normativo
│   │   │   ├── OpenDataset/ # Datos abiertos
│   │   │   └── ...         # Otros recursos
│   │   ├── Pages/          # Páginas personalizadas del panel
│   │   └── Widgets/        # Widgets del dashboard
│   ├── Http/
│   │   ├── Controllers/    # Controladores web
│   │   └── Middleware/     # Middleware personalizado
│   ├── Models/             # Modelos Eloquent
│   ├── Policies/           # Políticas de autorización
│   ├── Observers/          # Observers de modelos
│   └── Services/           # Servicios de negocio
├── config/                 # Archivos de configuración
├── database/
│   ├── migrations/         # Migraciones de base de datos
│   └── seeders/            # Seeders con datos del Beni
├── docker/
│   ├── nginx/
│   │   └── coolify.conf    # Config Nginx para Coolify
│   └── supervisord.conf    # Config Supervisord
├── public/                 # Archivos públicos
├── resources/
│   ├── views/              # Vistas Blade
│   ├── css/                # Estilos Tailwind
│   └── js/                 # JavaScript
├── routes/
│   ├── web.php             # Rutas web
│   └── api.php             # Rutas API
├── storage/                # Archivos de almacenamiento
├── tests/                  # Tests unitarios
├── vendor/                 # Dependencias Composer
├── composer.json           # Dependencias PHP
├── package.json            # Dependencias JS
├── Dockerfile              # Configuración Docker
├── .env.example            # Variables de entorno ejemplo
└── README.md               # Documentación general
```

### Anexo B: Comandos de Artisan útiles

```bash
# Instalación
composer install
npm install

# Configuración inicial
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed

# Optimización para producción
php artisan config:cache
php artisan view:cache
php artisan route:cache
php artisan event:cache

# Limpiar caché
php artisan optimize:clear
php artisan cache:clear

# Enlace simbólico para storage
php artisan storage:link

# Respaldo
php artisan backup:run

# Colas
php artisan queue:work
# O usar Laravel Horizon: horizon

# Sitemap
php artisan sitemap:generate

# Activity Log
php artisan activitylog:clean
```

### Anexo C: Contactos

**Desarrollador:**
- Ing. Milton Daniel Hipamo Cholima
- Email: [por definir]

**Dirección de Sistemas:**
- Gobierno Autónomo Departamental del Beni
- Email: [por definir]

**Unidad de Comunicación Social:**
- Gobierno Autónomo Departamental del Beni
- Email: [por definir]

---

**Fin de la Documentación Técnica**
