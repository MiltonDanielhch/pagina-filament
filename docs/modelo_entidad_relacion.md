# Modelo Entidad-Relación (ERD) - Sistema Portal Gubernamental Beni

Este documento describe el modelo entidad-relación del sistema portal gubernamental del departamento del Beni, Bolivia.

---

## 📊 Tablas del Sistema

### 1. Tablas de Autenticación y Autorización

#### users
**Descripción:** Usuarios del sistema con acceso a la aplicación.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre completo del usuario |
| email | string | Email único |
| email_verified_at | timestamp | Fecha de verificación de email |
| password | string | Contraseña encriptada |
| remember_token | string | Token para "recordarme" |
| department | string | Departamento del usuario (nullable) |
| avatar | string | URL del avatar (nullable) |
| two_factor_secret | string | Secreto de autenticación 2FA (nullable) |
| two_factor_recovery_codes | text | Códigos de recuperación 2FA (nullable) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** email

---

#### permissions
**Descripción:** Permisos específicos del sistema (Spatie Permission).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre del permiso |
| guard_name | string | Guard del permiso (web, api) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Índice único compuesto:** (name, guard_name)

---

#### roles
**Descripción:** Roles de usuario para control de acceso (Spatie Permission).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre del rol |
| guard_name | string | Guard del rol (web, api) |
| team_id | bigint | ID del equipo (nullable, si teams habilitado) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Índice único compuesto:** (team_id, name, guard_name) o (name, guard_name)

---

#### model_has_permissions
**Descripción:** Tabla pivot polimórfica para asignar permisos a modelos (Spatie Permission).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| permission_id | bigint | FK → permissions.id |
| model_type | string | Tipo de modelo (App\Models\User, etc.) |
| model_id | bigint | ID del modelo |
| team_id | bigint | ID del equipo (nullable) |

**PK compuesta:** (permission_id, model_id, model_type) o (team_id, permission_id, model_id, model_type)

**Relaciones:**
- `permission_id` → permissions (N:1, cascadeOnDelete)

---

#### model_has_roles
**Descripción:** Tabla pivot polimórfica para asignar roles a modelos (Spatie Permission).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| role_id | bigint | FK → roles.id |
| model_type | string | Tipo de modelo (App\Models\User, etc.) |
| model_id | bigint | ID del modelo |
| team_id | bigint | ID del equipo (nullable) |

**PK compuesta:** (role_id, model_id, model_type) o (team_id, role_id, model_id, model_type)

**Relaciones:**
- `role_id` → roles (N:1, cascadeOnDelete)

---

#### role_has_permissions
**Descripción:** Tabla pivot entre roles y permissions (Spatie Permission).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| permission_id | bigint | FK → permissions.id |
| role_id | bigint | FK → roles.id |

**PK compuesta:** (permission_id, role_id)

**Relaciones:**
- `permission_id` → permissions (N:1, cascadeOnDelete)
- `role_id` → roles (N:1, cascadeOnDelete)

---

### 2. Tablas de Sistema Laravel

#### password_reset_tokens
**Descripción:** Tokens para reset de contraseña (Laravel default).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| email | string | Email (PK) |
| token | string | Token de reset |
| created_at | timestamp | Fecha de creación |

---

#### sessions
**Descripción:** Sesiones de usuario (Laravel default).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | string | ID de sesión (PK) |
| user_id | bigint | FK → users.id (nullable) |
| ip_address | string(45) | Dirección IP |
| user_agent | text | User agent del navegador |
| payload | longText | Payload de sesión |
| last_activity | integer | Última actividad |

**Relaciones:**
- `user_id` → users (N:1)

---

#### cache
**Descripción:** Tabla de cache (Laravel default).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| key | string | Clave de cache (PK) |
| value | longText | Valor de cache |
| expiration | integer | Tiempo de expiración |

---

#### jobs
**Descripción:** Cola de trabajos (Laravel default).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| queue | string | Nombre de cola |
| payload | longText | Payload del trabajo |
| attempts | tinyint | Número de intentos |
| reserved_at | int | Tiempo reservado |
| available_at | int | Tiempo disponible |
| created_at | int | Tiempo de creación |

---

### 3. Tablas de Contenido

#### categories
**Descripción:** Categorías para posts.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre de la categoría |
| slug | string | Slug único |
| description | string | Descripción (nullable) |
| color | string | Color hexadecimal (default: #F59E0B) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug

---

#### posts
**Descripción:** Artículos/noticias del portal.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id |
| category_id | bigint | FK → categories.id (nullable) |
| title | string | Título del post |
| slug | string | Slug único |
| excerpt | text | Extracto (nullable) |
| body | text | Contenido completo |
| status | enum | Estado (draft, published, archived) |
| published_at | timestamp | Fecha de publicación (nullable) |
| meta_title | string | Título SEO (nullable) |
| meta_description | text | Descripción SEO (nullable) |
| shared_to_social | boolean | Compartido a redes sociales |
| shared_at | timestamp | Fecha de compartir (nullable) |
| view_count | bigint | Contador de vistas |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug

**Relaciones:**
- `user_id` → users (N:1, cascadeOnDelete)
- `category_id` → categories (N:1, setNullOnDelete)

---

#### pages
**Descripción:** Páginas estáticas del portal.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| title | string | Título de la página |
| slug | string | Slug único |
| content | text | Contenido (nullable) |
| meta_title | string | Título SEO (nullable) |
| meta_description | text | Descripción SEO (nullable) |
| is_published | boolean | Estado de publicación |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Índice único:** slug

---

#### slides
**Descripción:** Slides para el slider principal.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| title | string | Título del slide |
| image | string | URL de la imagen (nullable) |
| link | string | Enlace (nullable) |
| description | string | Descripción (nullable) |
| order | integer | Orden de visualización |
| is_active | boolean | Estado activo |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

---

#### events
**Descripción:** Eventos del portal.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id |
| title | string | Título del evento |
| slug | string | Slug único |
| description | longText | Descripción completa |
| location | string | Ubicación (nullable) |
| starts_at | datetime | Fecha y hora de inicio |
| ends_at | datetime | Fecha y hora de fin (nullable) |
| is_featured | boolean | Evento destacado |
| status | enum | Estado (draft, published) |
| view_count | bigint | Contador de vistas |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug

**Relaciones:**
- `user_id` → users (N:1, cascadeOnDelete)

---

#### media
**Descripción:** Archivos multimedia (Spatie Media Library).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| model_type | string | Tipo de modelo (polimórfico) |
| model_id | bigint | ID del modelo (polimórfico) |
| uuid | uuid | UUID único (nullable) |
| collection_name | string | Nombre de colección |
| name | string | Nombre del archivo |
| file_name | string | Nombre del archivo en disco |
| mime_type | string | Tipo MIME (nullable) |
| disk | string | Disco de almacenamiento |
| conversions_disk | string | Disco de conversiones (nullable) |
| size | bigint | Tamaño en bytes |
| manipulations | json | Manipulaciones de imagen |
| custom_properties | json | Propiedades personalizadas |
| generated_conversions | json | Conversiones generadas |
| responsive_images | json | Imágenes responsivas |
| order_column | unsignedInt | Orden (nullable) |
| created_at | timestamp | Fecha de creación (nullable) |
| updated_at | timestamp | Fecha de actualización (nullable) |

---

### 4. Tablas de Navegación

#### menus
**Descripción:** Menús del sitio (header, footer).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre del menú |
| location | string | Ubicación (header, footer) |
| is_active | boolean | Estado activo |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Índice único:** location

---

#### menu_items
**Descripción:** Ítems de menú con jerarquía.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| menu_id | bigint | FK → menus.id |
| parent_id | bigint | FK → menu_items.id (nullable) |
| label | string | Etiqueta del ítem |
| url | string | URL (nullable) |
| page_id | bigint | FK → pages.id (nullable) |
| target | string | Target (_self, _blank) |
| order | integer | Orden |
| is_active | boolean | Estado activo |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Relaciones:**
- `menu_id` → menus (N:1, cascadeOnDelete)
- `parent_id` → menu_items (N:1, cascadeOnDelete)
- `page_id` → pages (N:1, setNullOnDelete)

---

### 5. Tablas de Configuración

#### site_settings
**Descripción:** Configuraciones del sitio (key/value).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| key | string | Clave de configuración (único) |
| value | text | Valor (nullable) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Índice único:** key

---

#### external_systems
**Descripción:** Sistemas externos integrados.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre del sistema |
| url | string | URL del sistema |
| description | string | Descripción (nullable) |
| icon | string | Icono (nullable) |
| is_active | boolean | Estado activo |
| order | integer | Orden |
| last_status | enum | Último estado (online, offline, unknown) |
| last_checked_at | timestamp | Última verificación |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

---

### 6. Tablas de Actividad

#### activity_log
**Descripción:** Log de actividad (Spatie Activity Log).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| log_name | string | Nombre del log (nullable) |
| description | text | Descripción de la actividad |
| subject_type | string | Tipo de modelo afectado (nullable) |
| subject_id | bigint | ID del modelo afectado (nullable) |
| causer_type | string | Tipo de modelo que causó la acción (nullable) |
| causer_id | bigint | ID del modelo que causó la acción (nullable) |
| properties | json | Propiedades adicionales (nullable) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Índice:** log_name

---

### 7. Tablas de Logros y Autoridades

#### achievements
**Descripción:** Logros del gobierno departamental.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id |
| title | string | Título del logro |
| slug | string | Slug único |
| description | text | Descripción |
| area | string | Área de gobierno (nullable) |
| achieved_at | date | Fecha del logro (nullable) |
| image | string | URL de imagen (nullable) |
| status | enum | Estado (draft, published) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug
**Índices:** (status, achieved_at), area

**Relaciones:**
- `user_id` → users (N:1, cascadeOnDelete)

---

#### officials
**Descripción:** Autoridades y funcionarios del gobierno.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id (nullable) |
| parent_id | bigint | FK → officials.id (nullable) |
| secretariat_id | bigint | FK → secretariats.id (nullable) |
| name | string | Nombre completo |
| position | string | Cargo |
| area | string | Área de gobierno |
| email | string | Email (nullable) |
| phone | string | Teléfono (nullable) |
| image | string | URL de foto (nullable) |
| bio | text | Biografía corta (nullable) |
| function | text | Funciones del cargo (nullable) |
| sort_order | integer | Orden dentro del área |
| position_level | tinyint | Nivel jerárquico (1-6) |
| is_active | boolean | Estado activo |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índices:** (area, is_active, sort_order)

**Relaciones:**
- `user_id` → users (N:1, setNullOnDelete)
- `parent_id` → officials (N:1, setNullOnDelete)
- `secretariat_id` → secretariats (N:1, setNullOnDelete)

---

### 8. Tablas de Galerías

#### galleries
**Descripción:** Galerías de fotos/videos.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id (nullable) |
| title | string | Título de la galería |
| slug | string | Slug único |
| description | text | Descripción (nullable) |
| type | enum | Tipo (photo, video, mixed) |
| event_date | date | Fecha del evento (nullable) |
| cover_image | string | Imagen de portada (nullable) |
| is_featured | boolean | Galería destacada |
| status | enum | Estado (draft, published) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug
**Índices:** (type, status, event_date)

**Relaciones:**
- `user_id` → users (N:1, setNullOnDelete)

---

#### gallery_items
**Descripción:** Ítems individuales de galerías.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| gallery_id | bigint | FK → galleries.id |
| title | string | Título (nullable) |
| caption | text | Descripción (nullable) |
| type | string | Tipo (image, video) |
| image_path | string | Ruta de imagen (nullable) |
| video_url | string | URL de video (nullable) |
| youtube_id | string | ID de YouTube (nullable) |
| sort_order | integer | Orden |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

**Índices:** (gallery_id, sort_order)

**Relaciones:**
- `gallery_id` → galleries (N:1, cascadeOnDelete)

---

### 9. Tablas de Contacto

#### contact_messages
**Descripción:** Mensajes de contacto del formulario.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre del remitente |
| email | string | Email del remitente |
| subject | string | Asunto |
| message | text | Mensaje |
| is_read | boolean | Leído |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

---

### 10. Tablas de Plantillas

#### post_templates
**Descripción:** Plantillas predefinidas para posts.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre de la plantilla |
| type | string | Tipo (comunicado, evento, nota_prensa) |
| default_data | json | Datos predefinidos |
| description | text | Descripción (nullable) |
| is_active | boolean | Estado activo |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

---

### 11. Tablas de Agenda

#### agendas
**Descripción:** Agenda de actividades del gobierno.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id |
| title | string | Título |
| slug | string | Slug único |
| description | text | Descripción (nullable) |
| date | date | Fecha |
| time | time | Hora |
| location | string | Ubicación |
| is_public | boolean | Público |
| status | string | Estado (published, cancelled) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug

**Relaciones:**
- `user_id` → users (N:1, cascadeOnDelete)

---

### 12. Tablas de Proyectos de Infraestructura

#### infrastructure_projects
**Descripción:** Proyectos de inversión/infraestructura.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| user_id | bigint | FK → users.id |
| secretariat_id | bigint | FK → secretariats.id (nullable) |
| gallery_id | bigint | FK → galleries.id (nullable) |
| code | string(50) | Código único (nullable) |
| title | string | Título |
| slug | string | Slug único |
| description | text | Descripción (nullable) |
| contracting_company | string | Empresa contratista (nullable) |
| financing_source | string | Fuente de financiamiento (nullable) |
| contract_number | string | Número de contrato (nullable) |
| category | string | Categoría |
| municipality | string | Municipio |
| beneficiary_communities | json | Comunidades beneficiarias (nullable) |
| latitude | decimal(10,8) | Latitud |
| longitude | decimal(11,8) | Longitud |
| status | string | Estado (planificacion, ejecucion, concluido, paralizado) |
| is_featured | boolean | Proyecto destacado |
| start_date | date | Fecha de inicio (nullable) |
| completion_date | date | Fecha de conclusión (nullable) |
| end_date_planned | date | Fecha planificada (nullable) |
| end_date_real | date | Fecha real (nullable) |
| budget | decimal(15,2) | Presupuesto (nullable) |
| progress_percentage | tinyint | Porcentaje de avance (0-100) |
| image | string | URL de imagen (nullable) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug
**Índices:** (status, is_featured)

**Relaciones:**
- `user_id` → users (N:1, cascadeOnDelete)
- `secretariat_id` → secretariats (N:1, nullOnDelete)
- `gallery_id` → galleries (N:1, nullOnDelete)

---

### 13. Tablas de Estadísticas

#### departmental_statistics
**Descripción:** Estadísticas departamentales por año.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| year | year | Año (único) |
| population | integer | Población (nullable) |
| population_growth_rate | decimal(5,2) | Tasa crecimiento (nullable) |
| urban_population | integer | Población urbana (nullable) |
| rural_population | integer | Población rural (nullable) |
| area_km2 | decimal(10,2) | Área en km² (nullable) |
| municipalities | integer | Municipios (nullable) |
| provinces | integer | Provincias (nullable) |
| gdp_billion_usd | decimal(10,2) | PIB en miles de millones USD (nullable) |
| gdp_per_capita_usd | decimal(10,2) | PIB per cápita USD (nullable) |
| inflation_rate | decimal(5,2) | Tasa inflación (nullable) |
| unemployment_rate | decimal(5,2) | Tasa desempleo (nullable) |
| schools | integer | Escuelas (nullable) |
| students | integer | Estudiantes (nullable) |
| teachers | integer | Profesores (nullable) |
| literacy_rate | decimal(5,2) | Tasa alfabetización (nullable) |
| hospitals | integer | Hospitales (nullable) |
| health_centers | integer | Centros de salud (nullable) |
| doctors | integer | Médicos (nullable) |
| infant_mortality_rate | decimal(5,2) | Tasa mortalidad infantil (nullable) |
| paved_roads_km | integer | Carreteras pavimentadas km (nullable) |
| electrification_coverage | integer | Cobertura electrificación (nullable) |
| internet_users | integer | Usuarios internet (nullable) |
| user_id | bigint | FK → users.id |
| notes | text | Notas (nullable) |
| data_source | string | Fuente de datos (default: INE Bolivia) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** year

**Relaciones:**
- `user_id` → users (N:1, cascadeOnDelete)

---

### 14. Tablas de Marco Normativo

#### marco_normativos
**Descripción:** Marco normativo (leyes, decretos, resoluciones).

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| type | enum | Tipo (ley, decreto_supremo, decreto, resolución, otra) |
| number | string(50) | Número (nullable) |
| title | string | Título |
| slug | string | Slug único |
| summary | text | Resumen (nullable) |
| issue_date | date | Fecha de emisión (nullable) |
| scope | enum | Alcance (nacional, departamental) |
| document_file | string | Archivo PDF (nullable) |
| external_url | string | URL externa (nullable) |
| is_published | boolean | Publicado |
| sort_order | integer | Orden |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug
**Índices:** (scope, is_published, type), issue_date

---

### 15. Tablas de Secretarías

#### secretariats
**Descripción:** Secretarías departamentales del gobierno.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| parent_secretariat_id | bigint | FK → secretariats.id (nullable) |
| head_official_id | bigint | FK → officials.id (nullable) |
| name | string | Nombre |
| slug | string | Slug único |
| acronym | string(20) | Acrónimo (nullable) |
| description | text | Descripción (nullable) |
| mission | text | Misión (nullable) |
| vision | text | Visión (nullable) |
| objectives | json | Objetivos (nullable) |
| contact_email | string | Email de contacto (nullable) |
| contact_phone | string(50) | Teléfono de contacto (nullable) |
| office_address | string | Dirección de oficina (nullable) |
| logo_path | string | Ruta del logo (nullable) |
| color | string(7) | Color hexadecimal (default: #0f766e) |
| sort_order | integer | Orden |
| is_active | boolean | Estado activo |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug
**Índices:** (is_active, sort_order)

**Relaciones:**
- `parent_secretariat_id` → secretariats (N:1, setNullOnDelete)
- `head_official_id` → officials (N:1, setNullOnDelete)

---

### 16. Tablas de Trámites

#### procedures
**Descripción:** Catálogo de trámites y servicios.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| code | string(30) | Código único |
| name | string | Nombre |
| slug | string | Slug único |
| description | longText | Descripción paso a paso (nullable) |
| requirements | longText | Requisitos (nullable) |
| cost | decimal(10,2) | Costo (nullable) |
| currency | string(5) | Moneda (default: BOB) |
| processing_time_days | unsignedSmallInt | Tiempo en días (nullable) |
| schedule | string | Horario (nullable) |
| category | enum | Categoría |
| responsible_secretariat_id | bigint | FK → secretariats.id (nullable) |
| responsible_official_id | bigint | FK → officials.id (nullable) |
| online_url | string | URL en línea (nullable) |
| is_online | boolean | Disponible en línea |
| status | enum | Estado (activo, suspendido, dado_de_baja) |
| is_featured | boolean | Destacado |
| sort_order | integer | Orden |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug, code
**Índices:** (status, is_featured, sort_order), category

**Relaciones:**
- `responsible_secretariat_id` → secretariats (N:1, setNullOnDelete)
- `responsible_official_id` → officials (N:1, setNullOnDelete)

---

### 17. Tablas de Convocatorias

#### announcements
**Descripción:** Convocatorias y procesos de contratación.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| code | string(50) | Código único |
| type | enum | Tipo (convocatoria_publica, contratacion, consultoria, otro) |
| title | string | Título |
| slug | string | Slug único |
| description | longText | Descripción (nullable) |
| requirements | longText | Requisitos (nullable) |
| publication_date | date | Fecha de publicación (nullable) |
| opening_date | datetime | Fecha de apertura (nullable) |
| closing_date | datetime | Fecha de cierre (nullable) |
| status | enum | Estado (borrador, publicada, en_proceso, finalizada, desierta) |
| document_file | string | Archivo (nullable) |
| external_url | string | URL externa (SICOES) (nullable) |
| responsible_secretariat_id | bigint | FK → secretariats.id (nullable) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug, code
**Índices:** (status, type, publication_date)

**Relaciones:**
- `responsible_secretariat_id` → secretariats (N:1, setNullOnDelete)

---

### 18. Tablas de Quejas y Denuncias

#### complaints
**Descripción:** Libro de reclamaciones virtual.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| type | enum | Tipo (queja, reclamo, sugerencia, denuncia) |
| code | string(20) | Código único (autogenerado) |
| full_name | string | Nombre completo |
| ci | string(20) | Cédula de identidad (nullable) |
| email | string | Email |
| phone | string(30) | Teléfono (nullable) |
| address | string | Dirección (nullable) |
| subject | string | Asunto |
| description | longText | Descripción |
| attachment | string | Archivo adjunto (nullable) |
| related_secretariat_id | bigint | FK → secretariats.id (nullable) |
| status | enum | Estado (recibido, en_proceso, resuelto, rechazado) |
| response | longText | Respuesta (nullable) |
| response_date | datetime | Fecha de respuesta (nullable) |
| assigned_to | bigint | FK → users.id (nullable) |
| tracking_token | string(64) | Token de seguimiento (único) |
| ip_address | string | Dirección IP (nullable) |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** code, tracking_token
**Índices:** (status, type), related_secretariat_id

**Relaciones:**
- `related_secretariat_id` → secretariats (N:1, setNullOnDelete)
- `assigned_to` → users (N:1, setNullOnDelete)

---

### 19. Tablas de Datos Abiertos

#### open_datasets
**Descripción:** Conjuntos de datos abiertos.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| title | string | Título |
| slug | string | Slug único |
| description | longText | Descripción (nullable) |
| category | string | Categoría (nullable) |
| publisher | string | Publicador (nullable) |
| update_frequency | enum | Frecuencia actualización |
| last_updated_at | date | Última actualización (nullable) |
| formats | json | Formatos (nullable) |
| license | string(50) | Licencia (default: CC-BY-4.0) |
| file_csv | string | Archivo CSV (nullable) |
| file_json | string | Archivo JSON (nullable) |
| file_xlsx | string | Archivo XLSX (nullable) |
| file_pdf | string | Archivo PDF (nullable) |
| external_url | string | URL externa (nullable) |
| metadata | json | Metadatos (nullable) |
| is_published | boolean | Publicado |
| sort_order | integer | Orden |
| download_count | integer | Contador de descargas |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índice único:** slug
**Índices:** (is_published, category)

---

### 20. Tablas de Oficinas

#### offices
**Descripción:** Directorio de oficinas y puntos de atención.

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | PK |
| name | string | Nombre |
| address | string | Dirección |
| municipality | string | Municipio (nullable) |
| phone | string(50) | Teléfono (nullable) |
| email | string | Email (nullable) |
| schedule | string | Horario (nullable) |
| latitude | decimal(10,7) | Latitud (nullable) |
| longitude | decimal(10,7) | Longitud (nullable) |
| services | json | Servicios (IDs de trámites) (nullable) |
| is_active | boolean | Estado activo |
| sort_order | integer | Orden |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |
| deleted_at | timestamp | Soft delete |

**Índices:** (is_active, municipality)

---

## 🔗 Diagrama de Relaciones

### Autenticación y Autorización
```
users (1) ──< (N) model_has_roles (N) ──> (1) roles
roles (1) ──< (N) role_has_permissions (N) ──> (1) permissions
users (1) ──< (N) model_has_permissions (N) ──> (1) permissions
```

### Contenido
```
users (1) ──< (N) posts
categories (1) ──< (N) posts
users (1) ──< (N) events
users (1) ──< (N) achievements
users (1) ──< (N) galleries
galleries (1) ──< (N) gallery_items
users (1) ──< (N) agendas
```

### Navegación
```
menus (1) ──< (N) menu_items
menu_items (1) ──< (N) menu_items (parent_id - jerarquía)
pages (1) ──< (N) menu_items
```

### Autoridades y Secretarías
```
secretariats (1) ──< (N) officials
officials (1) ──< (N) officials (parent_id - organigrama)
secretariats (1) ──< (N) secretariats (parent_id - jerarquía)
officials (1) ──< (N) secretariats (head_official_id)
users (1) ──< (N) officials
```

### Proyectos y Trámites
```
users (1) ──< (N) infrastructure_projects
secretariats (1) ──< (N) infrastructure_projects
galleries (1) ──< (N) infrastructure_projects
secretariats (1) ──< (N) procedures
officials (1) ──< (N) procedures
secretariats (1) ──< (N) announcements
```

### Ciudadano
```
secretariats (1) ──< (N) complaints
users (1) ──< (N) complaints (assigned_to)
```

### Estadísticas
```
users (1) ──< (N) departmental_statistics
```

---

## 📐 Resumen de Entidades

### Entidades de Autenticación
- **users** - Usuarios del sistema
- **permissions** - Permisos específicos
- **roles** - Roles de usuario
- **model_has_permissions** - Permisos asignados a modelos
- **model_has_roles** - Roles asignados a modelos
- **role_has_permissions** - Permisos asignados a roles

### Entidades de Contenido
- **categories** - Categorías de posts
- **posts** - Artículos/noticias
- **pages** - Páginas estáticas
- **slides** - Slides del slider
- **events** - Eventos
- **media** - Archivos multimedia
- **achievements** - Logros del gobierno
- **galleries** - Galerías
- **gallery_items** - Ítems de galería

### Entidades de Navegación
- **menus** - Menús del sitio
- **menu_items** - Ítems de menú

### Entidades de Configuración
- **site_settings** - Configuraciones del sitio
- **external_systems** - Sistemas externos

### Entidades de Actividad
- **activity_log** - Log de actividad

### Entidades de Autoridades
- **officials** - Autoridades y funcionarios
- **secretariats** - Secretarías departamentales

### Entidades de Servicios
- **procedures** - Catálogo de trámites
- **offices** - Directorio de oficinas
- **announcements** - Convocatorias
- **complaints** - Quejas y denuncias

### Entidades de Transparencia
- **infrastructure_projects** - Proyectos de infraestructura
- **departmental_statistics** - Estadísticas departamentales
- **marco_normativos** - Marco normativo
- **open_datasets** - Datos abiertos

### Entidades de Gestión
- **agendas** - Agenda de actividades
- **post_templates** - Plantillas de posts
- **contact_messages** - Mensajes de contacto

### Entidades de Sistema
- **password_reset_tokens** - Tokens de reset
- **sessions** - Sesiones de usuario
- **cache** - Cache del sistema
- **jobs** - Cola de trabajos

---

## 🎯 Notas Importantes

1. **Soft Deletes:** Las tablas users, categories, posts, events, achievements, officials, galleries, infrastructure_projects, departmental_statistics, marco_normativos, secretariats, procedures, announcements, complaints, open_datasets y offices tienen soft deletes habilitados.

2. **Polimorfismo:** Las tablas media, model_has_permissions y model_has_roles usan relaciones polimórficas.

3. **Jerarquías:**
   - menu_items tiene relación jerárquica consigo misma (parent_id)
   - secretariats tiene relación jerárquica consigo misma (parent_secretariat_id)
   - officials tiene relación jerárquica consigo misma (parent_id)

4. **Índices Únicos:**
   - users: email
   - permissions: (name, guard_name)
   - roles: (team_id, name, guard_name) o (name, guard_name)
   - categories: slug
   - posts: slug
   - pages: slug
   - events: slug
   - achievements: slug
   - galleries: slug
   - agendas: slug
   - infrastructure_projects: slug, code
   - departmental_statistics: year
   - marco_normativos: slug
   - secretariats: slug
   - procedures: slug, code
   - announcements: slug, code
   - complaints: code, tracking_token
   - open_datasets: slug
   - menus: location
   - site_settings: key

5. **Paquetes de Terceros:**
   - Spatie Permission: permissions, roles, model_has_permissions, model_has_roles, role_has_permissions
   - Spatie Activity Log: activity_log
   - Spatie Media Library: media

6. **Cumplimiento Normativo:** Las tablas infrastructure_projects, secretariats, procedures, announcements, complaints, open_datasets y marco_normativos implementan los requisitos de la RM 067/2025 y RA AGETIC/0030/2025.

---

**Última actualización:** 10 de junio de 2026
