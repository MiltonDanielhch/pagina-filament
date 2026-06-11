<?php

/**
 * Ubicación: `app/Http/Controllers/OfficialController.php`
 *
 * Descripción: Controlador para mostrar directorio de funcionarios/autoridades.
 *              Agrupa por área de gobierno para mostrar organigrama visual.
 *
 * Método: index() — GET /autoridades
 * Roadmap: 12-FUTURO.md — Directorio de funcionarios
 */

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    public function publicIndex()
    {
        return $this->index();
    }

    public function index()
    {
        $officials = Official::active()
            ->orderBy('area')
            ->orderBy('sort_order')
            ->get();

        // Agrupar por área
        $byArea = $officials->groupBy('area');

        // Áreas ordenadas con prioridad
        $areaOrder = [
            'Gobernación',
            'Secretaría de Planificación',
            'Secretaría de Hacienda',
            'Secretaría de Obras Públicas',
            'Secretaría de Educación',
            'Secretaría de Salud',
            'Secretaría de Desarrollo Productivo',
            'Secretaría de Tierras',
            'Secretaría de Transparencia',
        ];

        // Reordenar grupos
        $sortedByArea = collect();
        foreach ($areaOrder as $area) {
            if ($byArea->has($area)) {
                $sortedByArea->put($area, $byArea->get($area));
            }
        }
        // Agregar otras áreas no listadas
        foreach ($byArea as $area => $officials) {
            if (!$sortedByArea->has($area)) {
                $sortedByArea->put($area, $officials);
            }
        }

        return view('officials', compact('sortedByArea'));
    }
}
