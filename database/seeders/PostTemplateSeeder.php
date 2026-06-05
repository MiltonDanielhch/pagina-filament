<?php

/**
 * Ubicación: `database/seeders/PostTemplateSeeder.php`
 *
 * Descripción: Seeder con 3 plantillas base para noticias:
 *              - Comunicado Oficial
 *              - Evento / Actividad
 *              - Nota de Prensa
 *
 * Roadmap: 13-automatizacion-noticias.md — Bloque 13.3
 */

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostTemplate;
use App\Models\Category;

class PostTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener categorías existentes
        $categories = Category::all()->keyBy('slug');

        // Plantilla 1: Comunicado Oficial
        PostTemplate::create([
            'name' => 'Comunicado Oficial',
            'type' => 'comunicado',
            'description' => 'Estructura formal para comunicados oficiales de la Gobernación',
            'is_active' => true,
            'default_data' => [
                'title' => 'COMUNICADO OFICIAL',
                'body' => '<h2>REF. N° ___/___</h2>
<p>FECHA: ' . now()->format('d/m/Y') . '</p>
<h3>ASUNTO: [Especificar asunto]</h3>
<p>La Gobernación Autónoma Departamental del Beni, por medio de la presente comunica a la población beniana que:</p>
<p>[Escribir el contenido del comunicado aquí]</p>
<p><strong>Atentamente,</strong></p>
<p>Gobernación del Beni</p>',
                'category_id' => $categories['infraestructura']->id ?? null,
            ],
        ]);

        // Plantilla 2: Evento / Actividad
        PostTemplate::create([
            'name' => 'Evento / Actividad',
            'type' => 'evento',
            'description' => 'Plantilla para eventos y actividades departamentales',
            'is_active' => true,
            'default_data' => [
                'title' => 'Evento: [Nombre del evento]',
                'body' => '<h2>¿Qué?</h2>
<p>[Descripción del evento]</p>
<h2>¿Cuándo?</h2>
<p><strong>Fecha:</strong> [Especificar fecha]<br>
<strong>Hora:</strong> [Especificar hora]</p>
<h2>¿Dónde?</h2>
<p>[Lugar del evento]</p>
<h2>¿Quiénes asisten?</h2>
<p>[Público objetivo / invitados]</p>
<h2>Contacto</h2>
<p>Para más información: [Teléfono o email]</p>',
                'category_id' => $categories['cultura']->id ?? null,
            ],
        ]);

        // Plantilla 3: Nota de Prensa
        PostTemplate::create([
            'name' => 'Nota de Prensa',
            'type' => 'nota_prensa',
            'description' => 'Formato periodístico con estructura de pirámide invertida',
            'is_active' => true,
            'default_data' => [
                'title' => '[Título de la nota de prensa]',
                'body' => '<p><strong>[Lead - Lo más importante del hecho]</strong></p>
<p>[Desarrollo del hecho con contexto adicional]</p>
<p>[Citas de autoridades o expertos]</p>
<p>[Información de contacto para más detalles]</p>',
                'category_id' => $categories['salud']->id ?? null,
            ],
        ]);
    }
}
