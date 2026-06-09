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
        // Cargar Gobernador y su gabinete
        $gobernador = Official::active()
            ->where('position_level', 1)
            ->orderBy('sort_order')
            ->first();

        $vicegobernador = Official::active()
            ->where('position_level', 2)
            ->orderBy('sort_order')
            ->get();

        $secretarios = Official::active()
            ->where('position_level', 3)
            ->with('secretariat')
            ->orderBy('sort_order')
            ->get();

        return view('institutional.organigrama', compact('gobernador', 'vicegobernador', 'secretarios'));
    }
}
