# GUÍA DE PRESENTACIÓN
## Sistema de Cálculo del IDTGB - Ley 812
**Gobierno Autónomo Departamental del Beni**

---

## 1. INFORMACIÓN GENERAL DE LA PRESENTACIÓN

### a) Título del sistema
Sistema de Cálculo del Impuesto Departamental a la Transmisión Gratuita de Bienes (IDTGB) - Ley 812

### b) Objetivo de la presentación
Presentar el sistema IDTGB desarrollado para el GAD Beni, destacando los desafíos operativos resueltos, el marco tributario de la Ley 812, el motor de cálculo, la arquitectura técnica y el flujo operativo.

### c) Versión del sistema
v1.0.0

### d) Estado actual
Puesta en Producción (Febrero 2026)

### e) Plataforma
idtgb.beni.gob.bo

### f) Responsables
- **Dirección de Sistemas**: Ing. Sergio Coca Martínez (Director)
- **Desarrollador Líder**: Ing. Milton Daniel Hipamo Cholima
- **Unidad Ejecutora**: Dirección de Impuestos y Rentas

---

## 2. ESTRUCTURA DE LA PRESENTACIÓN

La presentación consta de 9 slides principales que cubren:

1. **Portada**: Identidad del sistema y responsables
2. **Desafíos Operativos Resueltos**: Problemas que el sistema soluciona
3. **Marco Tributario Ley 812**: Tasas, plazos y multas
4. **Motor de Cálculo IDTGB**: Las 4 fases del cálculo
5. **Los 4 Pilares del Sistema**: Principios fundamentales
6. **Código Fuente**: Implementación de las 4 fases
7. **Arquitectura del Motor de Cálculo**: Diseño técnico
8. **Arquitectura del Sistema**: Stack tecnológico
9. **Flujo Operativo**: Proceso completo de trámite
10. **Cierre**: Contactos y soberanía tecnológica

---

## 3. SLIDE 1: PORTADA

### Elementos visuales
- **Panel izquierdo**: Escudo del Beni con identidad institucional
- **Panel derecho**: Información del proyecto

### Información clave
- **Nombre**: Sistema IDTGB
- **Descripción**: Cálculo del Impuesto Departamental a la Transmisión Gratuita de Bienes
- **Base legal**: Ley N° 812 · Código Tributario Boliviano
- **Estado**: PUESTA EN PRODUCCIÓN
- **Versión**: v1.0.0

### Metadatos
- **Unidad Ejecutora**: Dirección de Impuestos y Rentas
- **Dirección de Sistemas**: Ing. Sergio Coca Martínez
- **Desarrollador Líder**: Ing. Milton Daniel Hipamo Cholima
- **Línea de tiempo**: Inicio Nov 2025 · Producción Feb 2026
- **Plataforma**: idtgb.beni.gob.bo

---

## 4. SLIDE 2: DESAFÍOS OPERATIVOS RESUELTOS

### Título
Desafíos Operativos Resueltos

### Subtítulo
Automatización integral del cálculo tributario según la Ley N° 812 y el Código Tributario Boliviano

### 3 Cards principales

#### Card 1: Cálculo de Interés Escalonado
- **Icono**: Calculadora
- **Descripción**: Eliminación del error humano en cálculo de tasas por mora con acumulación en dominio UFV puro
- **Tags**:
  - 4% AÑOS 1-4
  - 6% AÑOS 5-7
  - 10% AÑO 8+

#### Card 2: Mantenimiento de Valor en UFV
- **Icono**: Rotación
- **Descripción**: Conversión automatizada a Unidad de Fomento de Vivienda con importación de históricos del Banco Central de Bolivia
- **Badge**: TABLA UFVS · HISTÓRICOS BCB

#### Card 3: Formulario A-01 con Validación QR
- **Icono**: QR Code
- **Descripción**: Generación de PDF oficial con código QR único y hash de validación para evitar falsificaciones en trámites
- **Badge**: HASH ÚNICO · VERIFICACIÓN

### 3 Bloques inferiores

#### Exenciones Automáticas
- Vivienda única familiar
- Descuentos por discapacidad (50%)

#### Calculadora Pública
- Ciudadanos calculan sin registro
- Donaciones, herencias y legados

#### Multa IDF Integrada
- 50 UFV (Persona Natural)
- 100 UFV (Persona Jurídica)

---

## 5. SLIDE 3: MARCO TRIBUTARIO LEY 812

### Título
Marco Tributario Ley 812

### Subtítulo
Calculadora Pública · Tasas por Parentesco · Plazos de Transmisión

### 3 Columnas de Parentesco

#### Línea Directa - 1%
- **Parentesco**: Cónyuge · Hijos · Padres · Abuelos · Nietos
- **Badge**: TASA MÍNIMA
- **Color**: Verde (#006a4d)

#### Línea Colateral - 10%
- **Parentesco**: Hermanos
- **Badge**: TASA MEDIA
- **Color**: Amarillo (#d48806)

#### Otros / Sin Parentesco - 20%
- **Parentesco**: Tíos · Sobrinos · Sin parentesco
- **Badge**: TASA MÁXIMA
- **Color**: Rojo (#dc2626)

### Tipos de Transmisión y Plazos

#### Entre Vivos
- **Descripción**: Donaciones y transferencias voluntarias entre personas vivas
- **Plazo**: 7 DÍAS HÁBILES
- **Icono**: Handshake

#### Mortis Causa
- **Descripción**: Herencias, legados y sucesiones por fallecimiento del causante
- **Plazo**: 50 DÍAS CALENDARIO
- **Icono**: Cruz

### Multa IDF por Incumplimiento
- **Persona Natural**: 50 UFV
- **Persona Jurídica**: 100 UFV

### Aviso Legal
Este cálculo es referencial basado en la Ley 812. El monto final se determina en ventanilla oficial del GAD Beni.

---

## 6. SLIDE 4: MOTOR DE CÁLCULO IDTGB

### Título
Motor de Cálculo IDTGB

### Subtítulo
Las 4 Fases Secuenciales · Ley N° 812 · Dominio UFV Puro

### FASE 1: Determinación de Fechas y Mora
- **Color**: Verde
- **Descripción**: Cálculo de días de mora según tipo de transmisión
- **Fórmulas**:
  - Entre Vivos: Vencimiento = Transmisión + 5 días hábiles
  - Mortis Causa: Vencimiento = Transmisión + 90 días calendario
  - Días de mora: n = max(0, Presentación − Vencimiento)

### FASE 2: Base Imponible e Impuesto Origen (Bs.)
- **Color**: Azul
- **Descripción**: Cálculo del tributo base según alícuota por parentesco
- **Fórmulas**:
  - BI_Real = Base Imponible × (Participación % / 100)
  - TO_Bs = BI_Real × (Alícuota % / 100)
  - Alícuotas: 1% · 10% · 20%

### FASE 3: Reajuste en UFV · Interés Compuesto por Tramos
- **Color**: Amarillo (CORAZÓN DEL SISTEMA)
- **Descripción**: Conversión a UFV y cálculo de interés compuesto escalonado

#### Tramo 1 · Años 1-4
- n₁ = min(n, 1440)
- r₁ = 4%

#### Tramo 2 · Años 5-7
- n₂ = min(max(0,n−1440),1080)
- r₂ = 6%

#### Tramo 3 · Año 8+
- n₃ = max(0, n − 2520)
- r₃ = 10%

#### Fórmula de interés compuesto acumulativo:
- I₁ = TO_UFV × [(1 + 0.04/360)^n₁ − 1]
- I₂ = (TO_UFV + I₁) × [(1 + 0.06/360)^n₂ − 1]
- I₃ = (TO_UFV + I₁ + I₂) × [(1 + 0.10/360)^n₃ − 1]

### FASE 4: Liquidación Final de Caja (Regreso a Bolivianos)
- **Color**: Púrpura
- **Descripción**: Conversión de deuda tributaria a Bolivianos y adición de multa

#### Fórmulas:
- DT_Bs = (TO_UFV + I_Total) × UFV_Presentación
- Multa_IDF = 50/100 UFV × UFV_Presentación
- Total_Bs = DT_Bs + Multa_IDF

---

## 7. SLIDE 5: LOS 4 PILARES DEL SISTEMA IDTGB

### Título
Los 4 Pilares del Sistema IDTGB

### Subtítulo
Principios de la Ley 812 que el motor de cálculo respeta al 100%

### PILAR 1: Deuda Unificada en UFV
- **Color**: Verde
- **Descripción**: Desde la Ley 812, el "Mantenimiento de Valor" ya no existe como penalidad separada en Bolivianos. El dinero se convierte a UFV el día del vencimiento y al multiplicar por la UFV de pago, se actualiza solo.
- **Badge**: NO hay fila de "mantenimiento" en la planilla

### PILAR 2: Interés Progresivo, No Retroactivo
- **Color**: Amarillo
- **Descripción**: La ley castiga por tramos escalonados. Si el contribuyente debe 6 años, el sistema calcula los primeros 4 al 4% y solo los 2 restantes al 6%. Es una estructura de cascada financiera.
- **Tags**: 4% AÑOS 1-4 · 6% AÑOS 5-7 · 10% AÑO 8+

### PILAR 3: Las Fechas Mandan sobre el Castigo
- **Color**: Azul
- **Descripción**: El reloj no corre desde la presentación en ventanilla. En mortis causa corre desde el fallecimiento (+90 días). En entre vivos, desde la firma de la minuta (+5 días hábiles). Un solo día de paso activa interés y multa.
- **Badges**:
  - MORTIS CAUSA: +90 días calendario
  - ENTRE VIVOS: +5 días hábiles

### PILAR 4: Multa IDF: Deber Formal Independiente
- **Color**: Rojo
- **Descripción**: La deuda tributaria recupera lo que el Estado dejó de percibir. La Multa IDF es una sanción fija por presentar fuera de plazo. No se mezcla con las fórmulas de interés; se calcula por separado y se acopla al final.
- **Badges**:
  - 50 UFV - Persona Natural
  - 100 UFV - Persona Jurídica

---

## 8. SLIDE 6: CÓDIGO FUENTE - LAS 4 FASES

### Título
Código Fuente: Las 4 Fases

### Subtítulo
app/Services/IdtgbCalculator.php · Método performCalculation()

### Grid 2x2 de bloques de código

#### FASE 1: Fechas y Mora
```php
$fechaPago = Carbon::parse($fPres)->startOfDay();
$fechaVenc = Carbon::parse($fVenc)->startOfDay();
$diasMora = 0;

if ($fechaPago->isAfter($fechaVenc)) {
    $diasMora = $fechaPago->diffInDays($fechaVenc);
}
```

#### FASE 2: Base Imponible
```php
$baseReal = $base * ($participacion / 100);
$totalTasas = 0;

// Alícuota por parentesco
$proporcional = round(
    $baseSujeto * ($tasaVal / 100), 2
);

$idtgbBase = max(0, $totalTasas - $totalExenciones);
```

#### FASE 3: Motor UFV (Corazón)
```php
$toUfv = $idtgbBase / $ufvVencimiento;

// Tramo 1: 4% (hasta 1440 días)
$n1 = min($diasMora, 1440);
$i1 = $toUfv * (pow(1 + (0.04 / 360), $n1) - 1);

// Tramo 2: 6% (arrastra saldo)
$i2 = $saldo1 * (pow(1 + (0.06 / 360), $n2) - 1);

// Tramo 3: 10% (acumulativo)
$i3 = $saldo2 * (pow(1 + (0.10 / 360), $n3) - 1);
```

#### FASE 4: Liquidación Final
```php
// Convertir deuda a Bolivianos
$deudaTributariaBs = $deudaTributariaUfv * $ufvPago;

// Multa IDF según tipo
$cantUfvMulta = ($tipoContribuyente === 'Jurídica') 
    ? 100 : 50;
$multaIdf = $cantUfvMulta * $ufvPago;

// Monto final en ventanilla
$final = $deudaTributariaBs + $multaIdf;
```

### Footer técnico
- **DB::transaction()**: Atomicidad garantizada
- **Cache::remember(3600)**: Caché de tasas vigentes
- **try/catch fallback 1.0**: Manejo seguro de errores

---

## 9. SLIDE 7: ARQUITECTURA DEL MOTOR DE CÁLCULO

### Título
Arquitectura del Motor de Cálculo

### Subtítulo
Servicio Core IdtgbCalculator.php · Laravel 10 · PHP 8.2

### Diagrama visual

#### Columna Izquierda: Entradas / Controladores
- **TramiteWizardController**: Trámites oficiales
- **CalculadoraBeniController**: Calculadora pública
- **TramiteObserver**: Auto-recálculo

#### Columna Central: El Servicio Core
- **IdtgbCalculator**: app/Services/IdtgbCalculator.php

##### Métodos Públicos:
- calculateAndSave(): Trámites + DB Transaction
- calculateEstimate(): Calculadora pública
- calcular(): Alias general
- tasaVigente(): Cache 3600s

##### Método Core Privado:
- performCalculation(): Las 4 fases
  - FASE 1: Fechas
  - FASE 2: Base Bs.
  - FASE 3: Motor UFV
  - FASE 4: Liquidación

#### Columna Derecha: Salida
- **Resultado**: DT + Multa IDF
  - Deuda Tributaria
  - Intereses
  - Sanción

### Características técnicas
- **DB Transaction**: Atomicidad garantizada
- **Cache 3600s**: Tasas vigentes en memoria
- **Fallback UFV 1.0**: Manejo seguro de errores
- **Tests Unitarios**: IdtgbCalculatorTest.php

---

## 10. SLIDE 8: ARQUITECTURA DEL SISTEMA

### Título
Arquitectura del Sistema

### Subtítulo
Stack moderno containerizado · Despliegue automatizado con Coolify

### 4 Columnas principales

#### Core Engine
- **Icono**: Laravel
- **Stack**:
  - Laravel 10
  - PHP 8.2+
  - Vite 4.0.0
  - Voyager 1.7

#### Base de Datos
- **Icono**: Database
- **Stack**:
  - MySQL 8.0+
  - MariaDB 10.6+
  - utf8mb4_unicode_ci
  - InnoDB Engine

#### Infraestructura
- **Icono**: Server
- **Stack**:
  - Nginx Unit Server
  - Ubuntu / Debian
  - OPcache Enabled
  - Redis Extension

#### Despliegue
- **Icono**: Rocket
- **Stack**:
  - Coolify
  - Docker Containers
  - unit:1.33.0-php8.2
  - Port 8000

### Fila inferior

#### Seguridad
- APP_KEY AES-256-CBC para sesiones
- Bcrypt para credenciales
- CSRF · XSS protegido por Blade

#### QR Engine
- Bacon QR Code 2.0
- Simple QR Code 4.2
- DOMPDF 3.1 para Formulario A-01

#### Dockerfile
- Memory 512M
- Upload 64M
- OPcache 256M
- Extensions: intl, zip, gd, bcmath

### Footer: Ambientes
- **PRODUCCIÓN**: panel.beni.gob.bo (verde)
- **TESTING**: Por definir (amarillo)
- **DESARROLLO**: Localhost (azul)
- **APP_ENV**: production

---

## 11. SLIDE 9: FLUJO OPERATIVO

### Título
Flujo Operativo

### Subtítulo
Proceso completo de transferencia gratuita de inmuebles · GAD Beni

### Timeline horizontal: 5 pasos

#### PASO 1: Inicio del Trámite
- **Icono**: File Circle Plus
- **Descripción**: Tipo: Donación, Herencia o Legado
- **Requisito**: Funcionario autenticado

#### PASO 2: Registro de Partes
- **Icono**: Users
- **Descripción**:
  - Disponentes (quien transmite)
  - Adquirentes (quien recibe)
- **Regla**: Parentesco → Tasa

#### PASO 3: Inmueble · Beni
- **Icono**: Map Location Dot
- **Descripción**: Catastro único · Municipio · Superficie · Valor catastral
- **Restricción**: Solo departamento Beni

#### PASO 4: Cálculo Automático
- **Icono**: Calculator
- **Descripción**: IDTGB base · Intereses Ley 812 · Exenciones · Multa IDF
- **Método**: performCalculation()

#### PASO 5: Pago + Formulario A-01
- **Icono**: File Signature
- **Descripción**: Registro de pago · Comprobante · PDF con QR de validación
- **Estado**: Finalizado

### Fila inferior

#### Estados del Trámite
- Borrador (pen)
- Observado (clock)
- Pagado (check)
- Finalizado (flag-checkered)
- Anulado (ban)

#### Validaciones Automáticas
- Presentación ≥ Transmisión
- Mínimo 1 inmueble + 1 disponente + 1 adquirente
- Suma de participación = 100%
- CI, NIT y Catastro únicos

---

## 12. SLIDE 10: CIERRE

### Título
Soberanía Tecnológica

### Subtítulo
GAD BENI: Hacia una administración digital, transparente y eficiente en la recaudación tributaria departamental.

### Badge de versión
Sistema IDTGB v1.0.0 · En Producción

### Grid de contactos

#### Correo Electrónico
- **Icono**: Envelope
- **Email**: sistemas@beni.gob.bo
- **Dependencia**: Dirección de Sistemas

#### Plataforma Web
- **Icono**: Globo
- **URL**: idtgb.beni.gob.bo
- **Descripción**: Calculadora Pública + Panel Admin

#### Dependencia
- **Icono**: Building Columns
- **Nombre**: Dirección de Impuestos y Rentas
- **Descripción**: GAD Beni · Recaudación

### Responsables
- **Responsable Técnico**: Ing. Milton Daniel Hipamo Cholima

---

## 13. TECNOLOGÍAS UTILIZADAS EN LA PRESENTACIÓN

### Framework de Presentación
- **Reveal.js 4.5.0**: Framework para presentaciones HTML interactivas
- **Tema**: None (personalizado con CSS)

### Fuentes
- **Montserrat**: 300, 400, 700 (Google Fonts)
- **Poppins**: 600 (Google Fonts)

### Iconos
- **Font Awesome 6.4.0**: Iconos vectoriales

### Colores Institucionales
- **Primary**: #006a4d (Verde Beni)
- **Accent**: #ff9f43 (Naranja)
- **Secundario**: Variaciones de verde, amarillo, azul, rojo, púrpura

### Características de la Presentación
- **Fragments**: Animaciones secuenciales con class="fragment"
- **Gradients**: Fondos con gradientes lineales
- **Cards**: Tarjetas con bordes y sombras
- **Responsive**: Diseño adaptable
- **Navegación**: Flechas y teclado

---

## 14. CÓMO UTILIZAR ESTA GUÍA

### Para presentadores
1. **Preparación**: Revisar cada slide y familiarizarse con el contenido
2. **Ensayo**: Practicar el flujo de la presentación
3. **Tiempo estimado**: 15-20 minutos para presentación completa
4. **Preguntas frecuentes**: Prepararse para preguntas sobre:
   - Cálculo de intereses escalonados
   - Conversión UFV
   - Validación QR
   - Seguridad del sistema

### Para desarrolladores
1. **Referencia técnica**: Usar como guía de arquitectura
2. **Código fuente**: Revisar app/Services/IdtgbCalculator.php
3. **Tests**: Revisar IdtgbCalculatorTest.php
4. **Documentación**: Complementar con DOCUMENTACION_TECNICA_IDTGB.md

### Para administradores
1. **Ambientes**: Conocer los 3 ambientes (desarrollo, testing, producción)
2. **Despliegue**: Entender el proceso con Coolify
3. **Monitoreo**: Revisar logs y métricas
4. **Respaldos**: Seguir procedimientos de backup

---

## 15. RECURSOS ADICIONALES

### Documentación técnica
- **DOCUMENTACION_TECNICA_IDTGB.md**: Documentación completa del sistema
- **README.md**: Instrucciones de instalación
- **Migraciones**: Estructura de base de datos
- **Código fuente**: Comentarios en código

### Enlaces externos
- **Ley 812**: Modificación al Código Tributario Boliviano
- **Ley 2492**: Código Tributario Boliviano
- **Banco Central de Bolivia**: Valores históricos UFV

### Contactos
- **Dirección de Sistemas**: sistemas@beni.gob.bo
- **Dirección de Impuestos y Rentas**: GAD Beni
- **Desarrollador**: Ing. Milton Daniel Hipamo Cholima

---

**Fin de la Guía de Presentación**
