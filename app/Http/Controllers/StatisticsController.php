<?php

/**
 * Ubicación: `app/Http/Controllers/StatisticsController.php`
 *
 * Descripción: Controlador para la página pública de estadísticas departamentales.
 *
 * Roadmap: 12-FUTURO.md — Sistema de Estadísticas Departamentales
 */

namespace App\Http\Controllers;

use App\Models\DepartmentalStatistics;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Mostrar la página de estadísticas departamentales.
     */
    public function index()
    {
        $statistics = DepartmentalStatistics::latestYear()->first();
        
        if (!$statistics) {
            return view('statistics.index', [
                'statistics' => null,
                'historicalData' => collect(),
            ]);
        }

        $historicalData = DepartmentalStatistics::orderBy('year', 'desc')->limit(10)->get();

        return view('statistics.index', compact('statistics', 'historicalData'));
    }

    /**
     * API endpoint para obtener datos de estadísticas en JSON.
     */
    public function api()
    {
        $statistics = DepartmentalStatistics::orderBy('year', 'desc')->get();
        
        return response()->json($statistics);
    }
}
