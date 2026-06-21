<?php

/**
 * Ubicación: `app/Http/Controllers/AchievementController.php`
 *
 * Descripción: Controlador para mostrar logros/resultados del gobierno.
 *              Solo listados públicos, el CRUD se hace en Filament.
 *
 * Método: index() — GET /resultados
 * Roadmap: 12-FUTURO.md — Página de resultados del gobierno
 */

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::with('user')->published()
            ->latest('achieved_at')
            ->paginate(12);

        // Obtener áreas únicas para filtros
        $areas = Achievement::published()
            ->whereNotNull('area')
            ->distinct()
            ->pluck('area')
            ->sort()
            ->values();

        return view('achievements', compact('achievements', 'areas'));
    }
}
