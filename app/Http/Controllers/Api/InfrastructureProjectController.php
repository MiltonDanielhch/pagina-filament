<?php

/**
 * Ubicación: `app/Http/Controllers/Api/InfrastructureProjectController.php`
 *
 * Descripción: Controlador API para proyectos de infraestructura en el mapa interactivo.
 *
 * Roadmap: 12-FUTURO.md — Mapa interactivo del Beni
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfrastructureProject;
use Illuminate\Http\JsonResponse;

class InfrastructureProjectController extends Controller
{
    /**
     * Obtener todos los proyectos de infraestructura para el mapa.
     */
    public function index(): JsonResponse
    {
        $projects = InfrastructureProject::select([
            'id',
            'title',
            'slug',
            'description',
            'category',
            'municipality',
            'latitude',
            'longitude',
            'status',
            'start_date',
            'completion_date',
            'budget',
        ])->get();

        return response()->json($projects);
    }
}
