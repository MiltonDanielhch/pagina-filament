# DOCUMENTACIÓN TÉCNICA DEL SISTEMA
## Sistema de Cálculo del IDTGB - Ley 812
**Gobierno Autónomo Departamental del Beni**

---

## 1. INFORMACIÓN GENERAL DEL SISTEMA

### a) Nombre oficial del sistema
Sistema de Cálculo del Impuesto Departamental a la Transmisión Gratuita de Bienes (IDTGB) - Ley 812

### b) Objetivo general
Automatizar el cálculo del Impuesto Departamental a la Transmisión Gratuita de Bienes (IDTGB) aplicado a transferencias de inmuebles sin contraprestación económica (donaciones, herencias, legados) en el Departamento del Beni, implementando la metodología establecida en la Ley 812 con cálculo de intereses escalonados en dominio UFV puro.

### c) Objetivos específicos
- Calcular el tributo (IDTGB base) según tasas variables por departamento, parentesco y tipo de transmisión
- Aplicar intereses por mora escalonados según Ley 812 (4% hasta 4 años, 6% años 5-7, 10% año 8 en adelante)
- Convertir cálculos a dominio UFV puro para precisión según normativa boliviana
- Generar Formulario A-01 oficial con código QR para trámites de transferencia gratuita
- Proporcionar calculadora pública para ciudadanos sin necesidad de registro
- Gestionar trámites, personas, inmuebles, pagos y documentos
- Administrar tasas, exenciones (vivienda única familiar) y valores UFV históricos

### d) Unidad solicitante o propietaria del sistema
Dirección de Sistemas y Telecomunicaciones - Gobierno Autónomo Departamental del Beni

### e) Responsable funcional (unidad solicitante)
 Recaudación y Control de Ingresos Propios - GAD Beni

### f) Responsable técnico (Dirección de Sistemas y Telecomunicaciones)
Ing. Milton Daniel Hipamo Cholima
Ing. Sergio Coca Martínez (Director de Sistemas y Telecomunicaciones)

### g) Fecha de inicio del proyecto
noviembre 2026

### h) Fecha de puesta en producción
febrero 2026

### i) Estado actual del sistema
Producción

### j) Versión actual del sistema
1.0.0

---

## 2. MARCO NORMATIVO Y PROCEDIMENTAL

### a) Normativa que respalda el desarrollo o implementación del sistema

#### Leyes
- **Ley 812**: Ley de Modificación al Código Tributario Boliviano (establece intereses escalonados)
- **Ley 2492**: Código Tributario Boliviano
- **Ley 317**: Ley de Régimen Tributario Simplificado

#### Decretos Supremos
- **DS 27310**: Reglamento al Código Tributario

#### Normativa interna institucional
- Reglamentos internos del GAD Beni para recaudación de impuestos
- Manuales de procedimientos de la Dirección de Impuestos

### b) Procedimientos institucionales automatizados por el sistema
- Registro de trámites de transferencia gratuita de inmuebles (donaciones, herencias, legados)
- Cálculo automático de IDTGB según tasas vigentes por parentesco
- Aplicación de intereses por mora según tramos establecidos (Ley 812)
- Aplicación de exenciones (vivienda única y familiar)
- Generación de Formulario A-01 con código QR de validación
- Gestión de pagos y comprobantes
- Validación de documentos requeridos

### c) Diagramas o descripción de los procesos de negocio implementados

#### Flujo principal del proceso:
1. **Inicio**: Usuario inicia sesión en el sistema (funcionario) o accede a calculadora pública (ciudadano)
2. **Registro de trámite**: Ingreso de datos de transmisión gratuita (fecha, tipo: donación/herencia/legado, valor declarado)
3. **Registro de inmuebles**: Datos catastrales, ubicación (solo Beni), tipo de inmueble
4. **Registro de partes**: Disponentes (quien transmite) y adquirentes (quien recibe) con parentescos
5. **Cálculo automático**: Sistema calcula IDTGB según tasa por parentesco, aplica exenciones si corresponde
6. **Revisión**: Funcionario revisa y valida la información, documentos requeridos
7. **Generación de formulario**: Emisión de Formulario A-01 con código QR
8. **Pago**: Registro de pago y generación de comprobante (si no hay exención total)
9. **Finalización**: Cambio de estado a "Finalizado"

### d) Relación del sistema con otros sistemas institucionales o externos
- **Sistema de UFV del Banco Central de Bolivia**: Importación de valores históricos de UFV

---

## 3. ARQUITECTURA TECNOLÓGICA

### Frontend

#### Framework utilizado
- **Framework**: Laravel 10 (JavaScript vanilla con Blade templates)
- **Versión**: Vite 4.0.0
- **panel administrativo** Voyager
- **Librerías principales**:
  - Axios 1.1.2 (para peticiones HTTP)
  - Lodash 4.17.19 (utilidades JavaScript)
  - Laravel Vite Plugin 0.7.2
- **Herramientas de construcción y despliegue**:
  - Vite para bundling y hot reload
  - PostCSS 8.1.14 para procesamiento de CSS

### Backend

#### Framework utilizado
- **Framework**: Laravel Framework
- **Versión**: 10.0.0
- **Lenguaje de programación**: PHP 8.2+
- **Librerías principales**:
  - Laravel Sanctum 3.0 (autenticación API)
  - Laravel Tinker 2.7 (consola interactiva)
  - Guzzle HTTP 7.2 (cliente HTTP)
  - Barryvdh Laravel DOMPDF 3.1 (generación de PDF)
  - Bacon QR Code 2.0 (generación de códigos QR)
  - SimpleSoftwareIO Simple QR Code 4.2 (QR codes)
  - TCG Voyager 1.7 (panel administrativo)
  - Orangehill ISeed 3.0 (generación de seeders)

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
- Respaldo manual mediante mysqldump
- Respaldo de tablas críticas: tramites, pagos, people, inmuebles
- Periodicidad recomendada: Diaria para producción

### Infraestructura

#### Sistema operativo del servidor
- Linux (Ubuntu/Debian) o Windows Server
- Configuración Docker con imagen unit:1.33.0-php8.2

#### Virtualización utilizada
Docker containers con Unit Application Server

#### Docker o contenedores
Sí, utiliza Dockerfile con:
- Imagen base: unit:1.33.0-php8.2
- Extensiones PHP: pcntl, opcache, pdo, pdo_mysql, intl, zip, gd, exif, ftp, bcmath, redis
- Optimización OPcache habilitada
- Memory limit: 512M
- Upload max filesize: 64M

#### Servidores web utilizados
- Nginx Unit (application server)
- Puerto: 8000

### despliegue con coolify
- dockerfile imagen

---

## 4. AMBIENTES DE TRABAJO

### a) Desarrollo

#### Ubicación
Servidor de desarrollo

#### Servidor
Localhost o servidor de desarrollo interno

#### Dirección IP
127.0.0.1 (local) o IP interna de red

#### Responsable
Desarrollador del sistema

#### Configuración
- APP_ENV=local
- APP_DEBUG=true
- Base de datos: MySQL local

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

### c) Producción

#### Ubicación física
Centro de datos del GAD Beni

#### Centro de datos
Data Center del Gobierno Autónomo Departamental del Beni

#### Servidor
Servidor de producción con Docker  https://panel.beni.gob.bo/

#### Dirección IP
192.168.192.118

#### Responsable
Dirección de Sistemas y Telecomunicaciones

#### Configuración
- APP_ENV=production
- APP_DEBUG=false
- Base de datos: MySQL de producción
- Optimizaciones habilitadas (config:cache, view:cache, event:cache)

---

## 5. FLUJO FUNCIONAL DEL SISTEMA

### a) Procesos principales

#### 1. Gestión de Trámites
- Creación de trámites de transferencia gratuita de inmuebles
- Edición de trámites en estado Borrador
- Cálculo automático de impuestos según parentesco
- Cambio de estado (Borrador → Pagado/Observado/Anulado/Finalizado)

#### 2. Cálculo de IDTGB
- Cálculo de tributo base según tasas vigentes por parentesco
- Aplicación de exenciones (vivienda única y familiar)
- Cálculo de intereses escalonados por tramos (Ley 812)
- Conversión UFV para mantenimiento de valor
- Cálculo de multa IDF

#### 3. Gestión de Personas
- Registro de personas naturales y jurídicas
- Consulta de personas en sistema 
- Gestión de adquirentes y disponentes

#### 4. Gestión de Inmuebles
- Registro de inmuebles con datos catastrales
- Gestión de avalúos

#### 5. Gestión de Pagos
- Registro de pagos de trámites
- Generación de comprobantes
- Control de estados de pago

### b) Casos de uso más importantes

#### UC-01: Registrar nuevo trámite de transferencia gratuita
- Actor: Funcionario de impuestos
- Precondición: Usuario autenticado
- Flujo:
  1. Ingresar datos generales del trámite (tipo: donación/herencia/legado)
  2. Registrar inmuebles involucrados (solo del Beni)
  3. Registrar disponentes (quien transmite el bien)
  4. Registrar adquirentes con parentescos (quien recibe el bien)
  5. Sistema calcula automáticamente IDTGB según tasa por parentesco
  6. Aplicar exenciones si corresponde (vivienda única)
  7. Revisar y guardar trámite
   8. Opción de descargar Formulario A-01 en PDF con qr

#### UC-02: Calcular IDTGB (Calculadora pública)
- Actor: Ciudadano
- Precondición: Ninguna
- Flujo:
  1. Ingresar datos del inmueble (catastro, valor catastral, ubicación)
  2. Seleccionar tipo de transmisión (donación/herencia/legado)
  3. Seleccionar parentesco entre disponente y adquirente
  4. Ingresar fechas (transmisión, presentación, vencimiento)
  5. Sistema calcula y muestra resultado con tasa aplicable
  6. Opción de descargar Formulario A-01 en PDF 

#### UC-03: Generar Formulario A-01
- Actor: Funcionario
- Precondición: Trámite en estado Pagado o Finalizado
- Flujo:
  1. Seleccionar trámite
  2. Sistema genera PDF con Formulario A-01
  3. Descargar o imprimir formulario

#### UC-04: Importar valores UFV
- Actor: Administrador
- Precondición: Usuario con rol de administrador
- Flujo:
  1. Cargar archivo CSV con valores UFV
  2. Sistema valida y procesa datos
  3. Confirmar importación
  4. Sistema registra valores en base de datos

### c) Flujo completo de las funcionalidades críticas

#### Cálculo de IDTGB según Ley 812:
1. **Entrada**: Base imponible (valor catastral o avalúo), departamento (Beni), parentesco, tipo transmisión (donación/herencia/legado), fechas
2. **Proceso**:
   - Determinar base imponible (mayor entre valor declarado, avalúo vigente o valor catastral)
   - Calcular tributo base según tasa por parentesco
   - Convertir a UFV en fecha de vencimiento
   - Calcular intereses por mora por tramos acumulados (si aplica):
     * Tramo 1 (0-1440 días): 4%
     * Tramo 2 (1441-2520 días): 6%
     * Tramo 3 (>2520 días): 10%
   - Calcular deuda tributaria en UFV
   - Convertir a Bolivianos con UFV de pago
   - Calcular multa IDF (50 UFV natural, 100 UFV jurídica)
3. **Salida**: IDTGB base, tributo actualizado, intereses, multa, monto final

### d) Entradas y salidas del sistema

#### Entradas:
- Datos de trámites de transferencia gratuita (fechas, valores, tipos: donación/herencia/legado)
- Datos de personas (CI, NIT, nombres, direcciones)
- Datos de inmuebles (catastro, ubicación en Beni, superficie, tipo)
- Valores UFV históricos
- Tasas impositivas por departamento y parentesco

#### Salidas:
- Formulario A-01 (PDF con código QR)
- Comprobantes de pago (PDF)
- Reportes de trámites
- Cálculos de impuestos
- Estadísticas de recaudación

### e) Validaciones implementadas

#### Validaciones de negocio:
- Fecha de presentación no puede ser anterior a fecha de transmisión
- Base imponible debe ser mayor a 0
- Trámite debe tener al menos un inmueble asociado
- Trámite debe tener al menos un disponente y un adquirente
- Suma de porcentajes de adquirentes debe ser 100%
- CI y NIT deben ser únicos
- Catastro de inmueble debe ser único
- Inmuebles deben pertenecer al departamento Beni

#### Validaciones técnicas:
- Autenticación requerida para rutas de administración
- CSRF protection en formularios
- Validación de tipos de datos en formularios
- Sanitización de inputs

### f) Reglas de negocio relevantes

#### Tasas impositivas:
- Tasas variables por departamento (Beni tiene sus propias tasas)
- Tasas variables por parentesco (línea directa vs colateral vs sin parentesco)
- Tasas variables por tipo de transmisión (donación, herencia, legado)
- Cuanto más cercano el parentesco, menor la tasa

#### Intereses por mora (Ley 812):
- Tramo 1 (años 1-4, hasta 1440 días): 4% anual
- Tramo 2 (años 5-7, días 1441-2520): 6% anual
- Tramo 3 (año 8 en adelante, >2520 días): 10% anual
- Cálculo acumulativo sobre saldos en dominio UFV puro

#### Multas:
- Multa IDF: 50 UFV para personas naturales
- Multa IDF: 100 UFV para personas jurídicas

#### Exenciones:
- Exenciones por parentesco (línea directa - tasas más bajas)
- Exenciones por tipo de inmueble (vivienda única y familiar)
- Exención total si es vivienda única del adquirente
- Descuentos adicionales por discapacidad (50%)

### g) Integraciones con otros sistemas

#### Sistema de UFV (Banco Central de Bolivia):
- Importación manual de valores históricos
- Formato CSV con fecha y valor UFV
- Almacenamiento en tabla `ufvs`

---

## 6. COMPONENTES TÉCNICOS A EXPLICAR

### 6.1 Base de Datos

#### a) Modelo entidad-relación

**Entidades principales:**
- **tramites**: Trámites de transferencia gratuita de inmuebles (donaciones, herencias, legados)
- **people**: Personas (naturales y jurídicas) - disponentes y adquirentes
- **inmuebles**: Inmuebles/propiedades del departamento Beni
- **tipos_transmision**: Tipos de transmisión (donación, herencia, legado)
- **tipos_inmueble**: Tipos de inmueble (vivienda, terreno, comercial)
- **parentescos**: Parentescos entre disponente y adquirente
- **tasas**: Tasas impositivas
- **ufvs**: Valores históricos UFV
- **exenciones**: Exenciones tributarias
- **pagos**: Pagos de trámites
- **documentos**: Documentos adjuntos
- **departamentos**: Departamentos geográficos
- **provincias**: Provincias
- **municipios**: Municipios
- **feriados**: Días feriados para cálculo de días hábiles

**Relaciones principales:**
- tramites → tipo_transmision (N:1)
- tramites → users (N:1)
- tramites ↔ inmuebles (N:M)
- tramites ↔ people (adquirentes) (N:M)
- tramites ↔ people (disponentes) (N:M)
- tramites ↔ exenciones (N:M)
- inmuebles → municipios (N:1)
- municipios → provincias (N:1)
- provincias → departamentos (N:1)
- tasas → departamentos (N:1)
- tasas → parentescos (N:1)
- people → municipios (N:1)

#### b) Tablas principales

**Tabla: tramites**
- id (PK)
- nro_tramite (unique)
- fecha_presentacion
- tipo_transmision_id (FK) - donación, herencia, legado
- valor_declarado
- base_imponible (mayor entre valor declarado, avalúo o valor catastral)
- total_idtgb
- recargo_mora (intereses + multa IDF según Ley 812)
- monto_final
- ufv_aplicada
- estado (enum: Borrador, Pagado, Observado, Anulado, Finalizado)
- hash_validacion (unique) - para verificación por QR
- fecha_transmision
- fecha_vencimiento
- observaciones
- user_id (FK)
- created_by (FK)
- updated_by (FK)
- timestamps

**Tabla: people**
- id (PK)
- person_type (enum: Natural, Jurídica)
- tipo_doc
- ci (unique con complemento)
- ci_complemento
- nit (unique)
- first_name, middle_name, paternal_surname, maternal_surname
- legal_name
- birth_date
- email, phone, address
- gender
- municipio_id (FK)
- status
- estado_persona
- registerUser_id (FK)
- softDeletes
- timestamps

**Tabla: inmuebles**
- id (PK)
- complemento
- catastro (unique)
- tipo_inmueble_id (FK) - vivienda, terreno, comercial
- municipio_id (FK) - solo municipios del Beni
- barrio_comunidad
- direccion
- superficie_m2
- valor_catastral
- matricula_rr
- es_vivienda_unica_familiar (para exenciones)
- estado_inmueble
- timestamps
- softDeletes

**Tabla: tasas**
- id (PK)
- departamento_id (FK)
- parentesco_id (FK)
- tipo_transmision_id (FK, nullable)
- tasa
- vigente_desde
- vigente_hasta (nullable)
- timestamps

**Tabla: ufvs**
- id (PK)
- fecha
- valor
- timestamps

#### c) Vistas (Views) más importantes
No se utilizan vistas de base de datos. Se usan queries Eloquent de Laravel.

#### d) Procedimientos almacenados (Stored Procedures)
No se utilizan procedimientos almacenados. Toda la lógica está en el código PHP (Laravel).

#### e) Funciones (Functions)
No se utilizan funciones de base de datos. La lógica de cálculo está en el servicio IdtgbCalculator.

#### f) Triggers
No se utilizan triggers. Se usan Observers de Laravel para eventos de modelo.

#### g) Jobs o tareas programadas
- **Tabla: jobs**: Para cola de trabajos (Laravel Queue)
- No hay tareas programadas configuradas actualmente.

#### h) Índices relevantes
- Índice único en tramites.nro_tramite
- Índice único en tramites.hash_validacion
- Índice compuesto en people (ci, ci_complemento)
- Índice único en people.nit
- Índice único en inmuebles.catastro
- Índices en tasas (departamento_id, parentesco_id, tipo_transmision_id, vigente_desde)
- Índices en ufvs (fecha)

#### i) Estrategia de optimización de consultas
- Uso de Eager Loading (with()) para reducir N+1 queries
- Caching de tasas vigentes (3600 segundos)
- Índices en campos de búsqueda frecuentes
- Soft deletes para mantener integridad referencial

#### j) Políticas de respaldo y recuperación
- Respaldo manual mediante mysqldump
- Tablas críticas: tramites, pagos, people, inmuebles, ufvs
- Periodicidad recomendada: Diaria
- Retención: 30 días
- Pruebas de restauración: Mensuales

### 6.2 APIs e Integraciones

#### a) APIs internas
No hay APIs REST internas documentadas. El sistema usa principalmente rutas web con Blade templates.

#### b) APIs externas
- **No hay integraciones con APIs REST externas**

#### c) Métodos disponibles
- Rutas web para CRUD de entidades
- Rutas AJAX para listados y búsquedas
- Ruta pública para calculadora

#### d) Autenticación utilizada
- **Panel administrativo**: Session-based authentication (Laravel Voyager)
- **Middleware**: 'loggin' (custom), 'system' (custom)
- **No hay API token authentication configurada** (Sanctum está instalado pero no se usa)

#### e) Formato de intercambio de datos
- **Formularios**: application/x-www-form-urlencoded
- **AJAX**: JSON
- **Archivos**: multipart/form-data

#### f) Dependencias con servicios externos
- **Servidor de archivos**: Sistema de archivos local o S3 (configurable)

#### g) Riesgos ante indisponibilidad de servicios externos
- **No hay dependencias críticas que afecten el funcionamiento principal**

### 6.3 Seguridad

#### a) Mecanismo de autenticación
- Session-based authentication (Laravel default)
- Login a través de Voyager panel administrativo
- Middleware personalizado: 'loggin', 'system'

#### b) Mecanismo de autorización
- Roles y permisos de Voyager
- Middleware para proteger rutas de administración
- Policies de Laravel para modelos (implementadas pero no todas activas)

#### c) Roles y perfiles
- **admin**: Acceso total al sistema
- **user**: Acceso limitado según permisos Voyager
- Roles gestionados a través de Voyager BREAD

#### d) Políticas de contraseñas
- Configuración Laravel default
- Password reset tokens expiran en 60 minutos
- No hay requisitos de complejidad adicionales configurados

#### e) Registro de auditoría
- Campos de auditoría en tablas principales: created_by, updated_by
- Soft deletes con deleteUser_id, deleteRole, deleteObservation
- No hay sistema de logs centralizado

#### f) Bitácoras del sistema
- Laravel Log Channel: stack (daily files en storage/logs)
- Nivel de log: debug en desarrollo, error en producción
- No hay bitácora de acciones de usuario

#### g) Cifrado de datos
- APP_KEY para cifrado de cookies y sesiones (AES-256-CBC)
- No hay cifrado de datos sensibles en base de datos
- Contraseñas hasheadas con bcrypt (Laravel default)

#### h) Protección contra ataques comunes
- CSRF protection habilitado (VerifyCsrfToken middleware)
- SQL injection prevenido por Eloquent ORM
- XSS prevenido por Blade templates ({{ }} escapa por defecto)
- Validación de inputs en controladores
- TrustProxies middleware para balanceadores

#### i) Gestión de sesiones
- Session driver: file (configurable)
- Session lifetime: 120 minutos
- Almacenamiento: storage/framework/sessions

---

## 7. METODOLOGÍA DE DESARROLLO

### a) Metodología utilizada
**Metodología Híbrida** (combinación de elementos de Scrum y desarrollo iterativo)

### b) Herramientas de gestión utilizadas
- **Control de versiones**: Git
- **Repositorio**: Local (por definir repositorio centralizado)
- **Seguimiento de tareas**: No hay herramienta formal (tareas manuales)
- **Documentación**: Markdown (README.md, GUIA_CALCULO_IDTGB_LEY812.md)

### c) Frecuencia de despliegues
- **Desarrollo**: Continuo según avances
- **Pruebas**: Según necesidad de validación
- **Producción**: Por definir (recomendado: quincenal o mensual)

### d) Gestión de incidencias
- No hay sistema formal de ticketing
- Reporte verbal o por correo electrónico
- Corrección directa en código

### e) Gestión de cambios
- Cambios directos en rama principal
- No hay proceso formal de code review
- No hay branching strategy definida

---

## 8. GESTIÓN DEL CÓDIGO FUENTE

### a) Ubicación del repositorio
- **Local**: c:\laravel\proygobe\impuestos
- **Remoto**: https://github.com/gadbeni

### b) Rama principal
- **main** (o master) - rama principal de producción

### c) Estrategia de versionado
- Versionado semántico manual (1.0.0)
- No hay tags de versiones en Git
- Cambios registrados en código

### d) Procedimiento de despliegue

#### Despliegue con Docker:
```bash
# Construir imagen
docker build -t impuestos-idtgb .

# Ejecutar contenedor
docker run -e DB_DATABASE=impuestos \
           -e DB_HOST=host.docker.internal \
           -e DB_PORT=3306 \
           -e DB_USERNAME=root \
           -e DB_PASSWORD=password \
           -p 8000:8000 \
           impuestos-idtgb
```

#### Despliegue tradicional:
```bash
# Instalar dependencias
composer install --optimize-autoloader --no-dev

# Configurar permisos
chmod -R 775 storage bootstrap/cache

# Optimizar para producción
php artisan config:cache
php artisan view:cache
php artisan event:cache
php artisan route:cache
```

### e) Dependencias externas
**Composer (PHP):**
- laravel/framework ^10.0
- laravel/sanctum ^3.0
- tcg/voyager ^1.7
- barryvdh/laravel-dompdf ^3.1
- bacon/bacon-qr-code ^2.0
- simplesoftwareio/simple-qrcode ^4.2
- guzzlehttp/guzzle ^7.2
- orangehill/iseed ^3.0

**NPM (JavaScript):**
- vite ^4.0.0
- axios ^1.1.2
- laravel-vite-plugin ^0.7.2
- lodash ^4.17.19
- postcss ^8.1.14

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


**Variables opcionales (SIN FTP):**
- SIN_FTP_HOST
- SIN_FTP_PORT
- SIN_FTP_USERNAME
- SIN_FTP_PASSWORD
- SIN_FTP_PATH

### g) Procedimiento de compilación
```bash
# Compilar assets de frontend
npm run build

# Optimizar autoloader
composer dump-autoload --optimize
```

### h) Procedimiento de restauración del sistema
```bash
# Restaurar base de datos
mysql -u root -p impuestos < backup.sql

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
- **Laravel Telescope**: No instalado
- **Laravel Horizon**: No instalado (no se usan colas)
- **Monitoreo manual**: Revisión de logs en storage/logs

### b) Indicadores de rendimiento
- No hay métricas configuradas
- Tiempo de respuesta: Monitoreo manual
- Uso de memoria: Configurado en 512M en Docker

### c) Consumo de recursos
- **PHP Memory Limit**: 512M
- **Upload Max Filesize**: 64M
- **Max Execution Time**: 300 segundos
- **OPcache**: Habilitado con 256M

### d) Capacidad máxima estimada de usuarios
- **Concurrentes**: ~50-100 usuarios (estimado)
- **Trámites diarios**: ~200-500 (estimado)
- **Limitante**: Configuración actual de servidor

### e) Alertas configuradas
- No hay alertas automáticas configuradas
- Monitoreo manual de logs

### f) Procedimiento de atención de incidentes
1. Identificar incidente (reporte de usuario o revisión de logs)
2. Revisar logs en storage/logs/laravel.log
3. Diagnosticar causa raíz
4. Implementar corrección
5. Probar en ambiente de desarrollo
6. Desplegar a producción
7. Verificar solución
8. Documentar incidente

### g) Acuerdos de nivel de servicio (SLA)
- No hay SLAs formales definidos
- Tiempo de respuesta: Según disponibilidad del equipo
- Tiempo de resolución: Según complejidad del incidente

---

## 10. DEMOSTRACIÓN PRÁCTICA

### a) Inicio de sesión
1. Acceder a `https://idtgb.beni.gob.bo/`
2. Ingresar credenciales de usuario (email y password)
3. Sistema redirige al dashboard administrativo

### b) Flujo completo de los procesos críticos

#### Proceso: Creación de trámite de transferencia gratuita
1. Navegar a `/admin/tramites/simple/create`
2. Ingresar datos generales:
   - Fecha de presentación
   - Tipo de transmisión (donación, herencia, legado)
   - Valor declarado
   - Base imponible
   - Fecha de transmisión
   - Fecha de vencimiento
3. Agregar disponentes (quien transmite el bien):
   - Buscar persona por CI/NIT
   - Confirmar datos
4. Agregar adquirentes (quien recibe el bien):
   - Buscar persona por CI/NIT
   - Seleccionar parentesco (determina la tasa)
   - Ingresar porcentaje de participación
   - Marcar exenciones si aplica (vivienda única)
5. Agregar inmuebles:
   - Ingresar número catastral
   - Seleccionar tipo de inmueble
   - Seleccionar municipio (solo Beni)
   - Ingresar dirección
6. Clic en "Calcular" para obtener cálculo automático según tasa por parentesco
7. Revisar resultados:
   - IDTGB base según tasa
   - Exenciones aplicadas
   - Intereses por mora (si aplica)
   - Multa IDF
   - Monto final
8. Guardar trámite
9. Registrar pago (si no hay exención total)
10. Marcar como Finalizado (genera PDF A-01 con QR)

### c) Gestión de usuarios
1. Navegar a `/admin/users`
2. Lista de usuarios con Voyager
3. Crear nuevo usuario:
   - Ingresar nombre, email, role
   - Asignar permisos
   - Guardar
4. Editar usuario existente
5. Eliminar usuario (soft delete)

### d) Consultas y reportes principales
1. **Reporte de trámites**: `/admin/reportes`
2. **Lista de trámites**: `/admin/tramites` con filtros
3. **Búsqueda de trámite**: Por número de trámite o hash de validación
4. **Dashboard**: `/admin/dashboard` con estadísticas

### e) Integraciones con otros sistemas
- **Importación UFV**: `/admin/ufvs/import` para cargar archivo CSV

### f) Procedimientos de respaldo y recuperación (explicación conceptual)

#### Respaldo:
1. Respaldo de base de datos MySQL:
   ```bash
   mysqldump -u root -p impuestos > backup_$(date +%Y%m%d).sql
   ```
2. Respaldo de archivos:
   ```bash
   tar -czf storage_backup_$(date +%Y%m%d).tar.gz storage/
   ```
3. Respaldo de código (Git):
   ```bash
   git push origin main
   ```

#### Recuperación:
1. Restaurar base de datos:
   ```bash
   mysql -u root -p impuestos < backup_YYYYMMDD.sql
   ```
2. Restaurar archivos:
   ```bash
   tar -xzf storage_backup_YYYYMMDD.tar.gz
   ```
3. Verificar funcionamiento del sistema

---

## 11. ENTREGA FORMAL

### a) Acta de transferencia de conocimiento e inducción
**Por generar** - Debe firmarse al finalizar la presentación

### b) Documentación técnica de lo expuesto en la presentación
- Este documento (DOCUMENTACION_TECNICA_IDTGB.md)
- GUIA_CALCULO_IDTGB_LEY812.md (guía de cálculo manual)
- README.md (instrucciones de instalación)
- Código fuente comentado
- Estructura de base de datos (migraciones)

---

## 12. RESPONSABILIDADES

### Desarrollador del sistema:
- **Ing. Milton Daniel Hipamo Cholima**
- Garantizar que toda la información presentada sea completa y actualizada
- Estar disponible para consultas durante el periodo de inducción
- Proporcionar soporte técnico durante los primeros 3 meses post-entrega

### Dirección de Sistemas y Telecomunicaciones:
- **Ing. Sergio Coca Martínez (Director)**
- Recepcionar la documentación técnica
- Validar la información presentada
- Administrar y dar mantenimiento al sistema
- Capacitar al personal de desarrollo

### Dirección de Impuestos y Rentas:
- Validar la funcionalidad del sistema desde el punto de vista funcional
- Reportar incidencias o mejoras necesarias
- Utilizar el sistema según los procedimientos establecidos

---

## ANEXOS

### Anexo A: Estructura de directorios del proyecto

```
impuestos/
├── app/
│   ├── Http/
│   │   ├── Controllers/ (Controladores)
│   │   ├── Middleware/ (Middleware personalizado)
│   │   └── Requests/ (Validaciones)
│   ├── Models/ (Modelos Eloquent)
│   ├── Services/ (Servicios de negocio)
│   │   ├── IdtgbCalculator.php (Cálculo según Ley 812)
│   │   ├── DashboardService.php
│   │   └── DiasHabilesService.php
│   ├── Providers/ (Service Providers)
│   └── Policies/ (Policies de autorización)
├── config/ (Archivos de configuración)
├── database/
│   ├── migrations/ (Migraciones de base de datos)
│   ├── seeders/ (Datos de prueba)
│   └── factories/ (Factories para testing)
├── public/ (Archivos públicos)
├── resources/
│   ├── views/ (Vistas Blade)
│   ├── css/ (Estilos)
│   └── js/ (JavaScript)
├── routes/ (Definición de rutas)
│   ├── web.php (Rutas web)
│   ├── api.php (Rutas API)
│   └── console.php (Rutas de consola)
├── storage/ (Archivos de almacenamiento)
├── tests/ (Tests unitarios)
├── vendor/ (Dependencias Composer)
├── composer.json (Dependencias PHP)
├── package.json (Dependencias JS)
├── Dockerfile (Configuración Docker)
├── .env.example (Variables de entorno ejemplo)
└── README.md (Documentación general)
```

### Anexo B: Comandos de Artisan útiles

```bash
# Instalación
composer install
npm install

# Configuración inicial
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

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

# Crear usuario administrador Voyager
php artisan voyager:admin your@email.com --create
```

### Anexo C: Contactos

**Desarrollador:**
- Ing. Milton Daniel Hipamo Cholima
- Email: [por definir]

**Dirección de Sistemas:**
- Ing. Sergio Coca Martínez (Director)
- Email: sergio.coca@beni.gob.bo

**Dirección de Impuestos:**
- [Por definir]

---

**Fecha de elaboración:** 9 de junio de 2026
**Versión del documento:** 1.0
**Elaborado por:** Ing. Milton Daniel Hipamo Cholima
**Revisado por:** [Por definir]
**Aprobado por:** Ing. Sergio Coca Martínez
