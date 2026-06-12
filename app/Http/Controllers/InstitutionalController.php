<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\Secretariat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstitutionalController extends Controller
{
    public function index(): View
    {
        $stats = [
            'secretariats' => Secretariat::active()->count(),
            'authorities' => Official::active()->count(),
            'municipalities' => 48, // dato del Beni
        ];

        return view('institutional.index', compact('stats'));
    }

    public function organigrama(): View
    {
        // Cargar todos los funcionarios activos ordenados por jerarquía
        $officials = Official::active()
            ->with('secretariat')
            ->orderBy('position_level')
            ->orderBy('sort_order')
            ->get();

        // Separar por niveles
        $gobernador = $officials->where('position_level', 1)->first();
        $vicegobernador = $officials->where('position_level', 2);
        $secretarios = $officials->where('position_level', 3);

        // Preparar datos para OrgChart.js
        $chartData = [];
        
        if ($gobernador) {
            $chartData[] = [
                'id' => $gobernador->id,
                'name' => $gobernador->name,
                'title' => $gobernador->position,
                'img' => $gobernador->image_url,
                'level' => 1,
            ];
        }

        if ($vicegobernador && $vicegobernador->count() > 0) {
            foreach ($vicegobernador as $vg) {
                $chartData[] = [
                    'id' => $vg->id,
                    'pid' => $gobernador->id ?? null,
                    'name' => $vg->name,
                    'title' => $vg->position,
                    'img' => $vg->image_url,
                    'level' => 2,
                ];
            }
        }

        if ($secretarios && $secretarios->count() > 0) {
            $parentId = $vicegobernador->count() > 0 ? $vicegobernador->first()->id : ($gobernador->id ?? null);
            foreach ($secretarios as $sec) {
                $chartData[] = [
                    'id' => $sec->id,
                    'pid' => $parentId,
                    'name' => $sec->name,
                    'title' => $sec->secretariat->name ?? $sec->position,
                    'img' => $sec->image_url,
                    'level' => 3,
                ];
            }
        }

        return view('institutional.organigrama', compact('gobernador', 'vicegobernador', 'secretarios', 'chartData'));
    }
}
