# Roadmap de Mejoras del Sitio Web - Gobernación del Beni

Este documento contiene un plan de trabajo para implementar las mejoras sugeridas al sitio web público.

## Prioridad Alta

### 1. Consistencia de Colores
- [x] Cambiar botones de contacto de `bg-amber-600` a color `official`
  - Archivo: `resources/views/contact.blade.php`
  - Línea: 66-69
  - Acción: Reemplazar `bg-amber-600 hover:bg-amber-700` con `btn-primary` o clases del color oficial

### 2. Navegación - Breadcrumbs
- [x] Agregar breadcrumbs en página de gobernador
  - Archivo: `resources/views/gobernador.blade.php`
  - Ubicación: Después del hero section
- [x] Agregar breadcrumbs en página de eventos
  - Archivo: `resources/views/events.blade.php`
  - Ubicación: Después del título principal
- [x] Agregar breadcrumbs en página de contacto
  - Archivo: `resources/views/contact.blade.php`
  - Ubicación: Después del título principal
- [x] Crear componente de breadcrumb reutilizable
  - Archivo: `resources/views/components/breadcrumb.blade.php`
- [x] Agregar breadcrumbs en página de noticias (blog)
  - Archivo: `resources/views/blog.blade.php`
- [x] Agregar breadcrumbs en detalle de noticias
  - Archivo: `resources/views/posts/show.blade.php`
- [x] Agregar breadcrumbs en páginas estáticas (Política de Privacidad, etc.)
  - Archivo: `resources/views/pages/show.blade.php`
- [x] Implementar dropdowns en menú de navegación
  - Archivo: `resources/views/layouts/main.blade.php`
  - Agregado campo parent_id en MenuItem para soportar submenús
  - Dropdown funcional en móvil y escritorio

### 3. Footer Completo
- [ ] Revisar contenido actual del footer en `layouts/main.blade.php` esto tienes que ver con el backend tambien con filament porque es dinamico el footer principal header
- [ ] Agregar enlaces legales (Política de Privacidad, Términos de Uso)
- [ ] Agregar mapa del sitio con enlaces principales
- [ ] Agregar información de contacto completa
- [ ] Agregar redes sociales actualizadas

## Prioridad Media

### 4. Imágenes - Alt Text
- [ ] Revisar todas las imágenes en `home.blade.php`
- [ ] Revisar imágenes en `gobernador.blade.php`
- [ ] Revisar imágenes en `blog.blade.php`
- [ ] Revisar imágenes en `events.blade.php`
- [ ] Asegurar que todas las imágenes tengan alt text descriptivo

### 5. Formularios - Validación JavaScript
- [ ] Agregar validación en tiempo real al formulario de contacto
  - Archivo: `resources/views/contact.blade.php`
  - Acción: Agregar JavaScript para validación de campos
- [ ] Agregar feedback visual en tiempo real
- [ ] Mostrar errores antes de enviar el formulario

### 6. Paginación Mejorada
- [ ] Mejorar diseño de paginación en `blog.blade.php`
  - Archivo: `resources/views/blog.blade.php`
  - Línea: 34-36
- [ ] Mejorar diseño de paginación en `events.blade.php`
  - Archivo: `resources/views/events.blade.php`
  - Línea: 34-36
- [ ] Usar estilos Tailwind más modernos para botones de paginación
- [ ] Agregar números de página con mejor diseño

## Prioridad Baja

### 7. Performance - Lazy Loading
- [ ] Implementar lazy loading para iframes de Google Maps
  - Archivo: `resources/views/home.blade.php`
  - Ubicación: Sección "Nuestro Territorio" y "Visítanos"
- [ ] Usar atributo `loading="lazy"` en imágenes pesadas
- [ ] Considerar usar imágenes estáticas para mapas con link a Google Maps

### 8. Mobile Experience
- [ ] Probar slider en dispositivos móviles
  - Archivo: `resources/views/home.blade.php`
  - Ubicación: Sección de slides
- [ ] Optimizar tamaño de imágenes para móviles
- [ ] Mejorar touch gestures para slider
- [ ] Probar todas las páginas en diferentes tamaños de pantalla

## Extras (Opcionales)

### 9. Accesibilidad Adicional
- [ ] Agregar modo alto contraste
- [ ] Mejorar navegación por teclado
- [ ] Agregar ARIA labels en elementos interactivos

### 10. SEO Adicional
- [ ] Agregar schema.org markup para organización gubernamental
- [ ] Implementar canonical URLs
- [ ] Mejorar meta descriptions en todas las páginas

### 11. UX Mejorada
- [ ] Agregar animaciones sutiles en hover
- [ ] Implementar loading states para contenido asíncrono
- [ ] Agregar notificaciones toast para acciones del usuario

---

## Notas de Implementación

### Consistencia de Colores
El color institucional `official` está definido en Tailwind. Usar siempre:
- `bg-official` para fondos
- `text-official` para texto
- `border-official` para bordes
- `hover:bg-official-dark` para hover states

### Breadcrumbs
Estructura sugerida:
```blade
<nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
    <a href="/" class="hover:text-official">Inicio</a>
    <span>/</span>
    <span class="text-gray-900">Página Actual</span>
</nav>
```

### Lazy Loading
Para iframes de Google Maps:
```html
<iframe loading="lazy" ...></iframe>
```

Para imágenes:
```html
<img loading="lazy" ...></img>
```

---

## Progreso

- [x] Análisis completo del sitio web
- [ ] Implementación de mejoras de prioridad alta
- [ ] Implementación de mejoras de prioridad media
- [ ] Implementación de mejoras de prioridad baja
- [ ] Pruebas en diferentes dispositivos
- [ ] Deploy a producción

---

**Última actualización:** Junio 4, 2026
**Estado:** Plan inicial creado
