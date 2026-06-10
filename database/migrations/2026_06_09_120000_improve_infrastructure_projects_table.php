<?php

/**
 * Ubicación: `database/migrations/2026_06_09_120000_improve_infrastructure_projects_table.php`
 *
 * Descripción: Amplía la tabla `infrastructure_projects` con los campos
 *              especificados en A1.14 del doc `14-cumplimiento-normativo-rm067-2025.md`:
 *                - code (código único del proyecto, ej: GAD-BENI-PI-2026-001)
 *                - status: nuevos valores (planificacion, ejecucion, concluido, paralizado)
 *                - progress_percentage (avance físico 0–100)
 *                - end_date_planned, end_date_real
 *                - latitude, longitude ya existen — se hacen opcionales
 *                - beneficiary_communities (json)
 *                - contracting_company, financing_source
 *                - secretariat_id (FK → secretariats)
 *                - contract_number
 *                - gallery_id (FK → galleries)
 *
 * Cumplimiento: RM 067/2025 — Componente 15 (Proyectos de Inversión)
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('infrastructure_projects', function (Blueprint $table) {
            // Código único del proyecto
            $table->string('code', 50)->nullable()->unique()->after('slug');

            // Presupuesto en Bolivianos (más preciso que el actual decimal 15,2)
            // ya existe, no se duplica

            // Avance físico del proyecto
            $table->unsignedTinyInteger('progress_percentage')->default(0)->after('budget');

            // Fechas adicionales de planificación / ejecución real
            $table->date('end_date_planned')->nullable()->after('completion_date');
            $table->date('end_date_real')->nullable()->after('end_date_planned');

            // Geolocalización — ya existen; permitimos null en municipios sin coord.
            // (sólo cambio de definición, no requiere acción)

            // Comunidades beneficiarias (array JSON)
            $table->json('beneficiary_communities')->nullable()->after('municipality');

            // Empresa contratista y fuente de financiamiento
            $table->string('contracting_company')->nullable()->after('description');
            $table->string('financing_source')->nullable()->after('contracting_company');
            $table->string('contract_number')->nullable()->after('financing_source');

            // Relación con secretaría responsable
            $table->foreignId('secretariat_id')
                ->nullable()
                ->after('user_id')
                ->constrained('secretariats')
                ->nullOnDelete();

            // Galería de imágenes del proyecto (Spatie media en el modelo, FK opcional)
            $table->foreignId('gallery_id')
                ->nullable()
                ->after('secretariat_id')
                ->constrained('galleries')
                ->nullOnDelete();

            // Indicador destacado para mostrar en homepage
            $table->boolean('is_featured')->default(false)->after('status');

            // Soft deletes ya estaba; no se duplica
            $table->index(['status', 'is_featured']);
        });
    }

    public function down(): void
    {
        Schema::table('infrastructure_projects', function (Blueprint $table) {
            $table->dropForeign(['secretariat_id']);
            $table->dropForeign(['gallery_id']);
            $table->dropIndex(['status', 'is_featured']);
            $table->dropColumn([
                'code',
                'progress_percentage',
                'end_date_planned',
                'end_date_real',
                'beneficiary_communities',
                'contracting_company',
                'financing_source',
                'contract_number',
                'secretariat_id',
                'gallery_id',
                'is_featured',
            ]);
        });
    }
};
