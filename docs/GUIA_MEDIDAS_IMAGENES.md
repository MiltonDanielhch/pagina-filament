# Guía de tamaños de imagen para el proyecto

Este documento describe las medidas recomendadas para cada módulo de imagen del proyecto `pagina-filament`. Incluye análisis del uso real en el código, recomendaciones para el diseñador y notas sobre las configuraciones de upload en el admin.

---

## 1. Logo del sitio

### Archivos relevantes
- `resources/views/layouts/main.blade.php`
- `app/Filament/Pages/Settings/SiteSettings.php`

### Uso actual
- Logo del encabezado y footer se muestra en un contenedor de `w-12 h-12` (48x48 px) dentro de un círculo.
- El admin permite subir `site_logo` como imagen en Filament.

### Recomendación
- Tamaño de diseño: `800x800 px`
- Forma: `cuadrado` (ratio 1:1)
- Formato recomendado: `PNG` o `WebP`
- Opción: fondo transparente para logo centrado.
- Asegurarse de dejar espacio interior para que el símbolo o texto no quede pegado a los bordes.

### Favicon
- Se puede subir también desde el admin como `site_favicon`.
- Tamaños recomendados para exportar:
  - `32x32 px`
  - `48x48 px`
  - `512x512 px`

---

## 2. Slider principal / diapositivas

### Archivo relevante
- `resources/views/home.blade.php`
- `app/Models/Slide.php`
- `app/Filament/Resources/Slides/Schemas/SlideForm.php`

### Uso actual
- La sección hero `section` tiene altura `h-[500px]` en mobile y `md:h-[600px]` en desktop.
- La imagen se muestra con `class="w-full h-full object-cover"`.

### Recomendación
- Resolución mínima: `1600x900 px`
- Resolución ideal: `1920x1080 px` o `2000x1000 px`
- Ratio sugerido: `16:9` o `2:1`
- El contenido visual más importante debe ir centrado porque `object-cover` recorta lados y parte superior/inferior.
- Evitar texto o elementos clave cerca de los extremos de la imagen.

---

## 3. Noticias recientes en home

### Archivo relevante
- `resources/views/home.blade.php`

### Uso actual
- Tarjetas de noticias usan `class="w-full h-48 object-cover"`.
- Esto es un recuadro horizontal con relación aproximada `16:9`.

### Recomendación
- Resolución mínima: `800x450 px`
- Resolución ideal: `1200x675 px`
- Ratio: `16:9`
- Mantener la imagen horizontal y el foco visual en el centro.

---

## 4. Listado de blog / noticias

### Archivo relevante
- `resources/views/blog.blade.php`

### Uso actual
- Imagen destacada principal del post usa `class="w-full h-64 md:h-96 object-cover"`.
- Las tarjetas del feed usan `class="w-full h-48 object-cover"`.

### Recomendación para imagen destacada principal
- Resolución mínima: `1200x675 px`
- Resolución ideal: `1600x900 px` o `1920x1080 px`
- Ratio: `16:9`

### Recomendación para las tarjetas del feed
- Resolución mínima: `800x450 px`
- Ideal: `1200x675 px`
- Ratio: `16:9`

---

## 5. Imagen principal de post individual

### Archivo relevante
- `resources/views/posts/show.blade.php`
- `app/Models/Post.php`
- `app/Filament/Resources/Posts/Schemas/PostForm.php`

### Uso actual
- La imagen se muestra con `class="w-full h-64 md:h-96 object-cover rounded-lg mb-8"`.
- Se utiliza la conversión `large` declarada en `Post.php`.

### Recomendación
- Resolución mínima: `1200x675 px`
- Resolución ideal: `1600x900 px` o `1920x1080 px`
- Ratio: `16:9`
- Esta imagen debe tener suficiente calidad para verse bien en pantallas grandes.

---

## 6. Conversión de imágenes en el backend

### Archivo relevante
- `app/Models/Post.php`

### Conversiones actuales
- `thumb` → `150x150` (miniatura)
- `medium` → `width 800` px
- `large` → `width 1200` px
- `og` → `1200x630` px

### Recomendación para el diseñador
- Subir siempre imágenes grandes (ideal `1600px` o más de ancho) para asegurar buena calidad al generar `medium` y `large`.
- Para contenido social, usar `og` con ratio `1200x630 px`.
- Si el diseñador entrega WebP, mejor; si no, JPG de buena calidad.

---

## 7. Resumen de medidas por sección

| Sección | Uso en código | Tamaño recomendado | Ratio | Notas |
|---|---|---|---|---|
| Logo principal | `main.blade.php` | `800x800 px` | `1:1` | Contenedor de 48x48 px, deja espacio interior |
| Favicon | `main.blade.php` | `32x32`, `48x48`, `512x512` | `1:1` | Usar ícono sencillo |
| Slider / hero | `home.blade.php` | `1920x1080 px` / `2000x1000 px` | `16:9` / `2:1` | Centrar foco visual |
| Noticias - tarjetas | `home.blade.php`, `blog.blade.php` | `1200x675 px` | `16:9` | Bucles de imagen recortable |
| Post destacado | `blog.blade.php` | `1600x900 px` | `16:9` | Calidad y proporción uniforme |
| Post individual | `posts/show.blade.php` | `1600x900 px` | `16:9` | Imagen principal grande |
| Open Graph / social | `Post.php` | `1200x630 px` | `1.91:1` | Texto legible y diseño centrado |

---

## 8. Consejos para el diseñador

1. **Mantén el contenido importante centrado** cuando el layout use `object-cover`.
2. **Usa imágenes horizontales** para slides y cards.
3. **Evita texto pequeño**: si el texto es necesario, colócalo en áreas seguras y de alto contraste.
4. **Guarda copias de alta resolución** para permitir reducción sin pérdida.
5. **Utiliza WebP si es posible**, pero también exporta JPG/PNG compatibles.
6. **Revisa el tamaño de archivo**: para web, ideal menos de 300 KB por imagen de `1200px` de ancho si es posible.

---

## 9. Dónde editar estas imágenes en el panel de administración

- `Gestión > Configuración del sitio`:
  - `Logo del sitio`
  - `Favicon del sitio`
- `SlideResource` en Filament:
  - Imagen de diapositiva (`collection('slides')`)
- `PostResource` en Filament:
  - Imagen destacada de noticia (`collection('featured')`)

---

## 10. Notas finales

- Este proyecto usa `Spatie Media Library` para manejar uploads de `Post` y `Slide`.
- El frontend usa `tailwind` con `object-cover`, por lo que las imágenes se recortan para llenar el contenedor.
- Si se desea consistencia visual, sube todas las imágenes horizontales con el mismo ratio `16:9`.
