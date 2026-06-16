<?php

namespace App\Http\Controllers;

use App\Models\MarcoNormativo;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransparencyController extends Controller
{
    public function index(): View
    {
        $marcoCount = MarcoNormativo::published()->count();

        // Mapeo de bloques de transparencia => URL del menú que los habilita
        $sectionUrls = [
            'marcoNormativo' => '/transparencia/marco-normativo',
            'presupuesto'    => '/transparencia/presupuesto',
            'poa'            => '/transparencia/poa',
            'informes'       => '/transparencia/informes',
            'rendicion'      => '/transparencia/rendicion-cuentas',
            'auditorias'     => '/transparencia/auditorias',
            'convocatorias'  => '/convocatorias',
            'datosAbiertos'  => '/datos-abiertos',
        ];

        // Recoger todos los ítems del menú header (activos e inactivos)
        $headerItems = collect();
        $headerMenu = Menu::where('location', 'header')
            ->where('is_active', true)
            ->first();

        if ($headerMenu) {
            $headerItems = $headerMenu->items()->get(['url', 'is_active']);
        }

        // Cada bloque se muestra por defecto; se oculta solo si existe un
        // ítem de menú con esa URL y está desactivado.
        $sectionActive = [];
        foreach ($sectionUrls as $key => $url) {
            $normalized = rtrim($url, '/');
            $matching = $headerItems->first(function ($item) use ($normalized) {
                return $item->url && rtrim($item->url, '/') === $normalized;
            });

            // Si hay un ítem de menú asociado, respetar su estado; si no hay, mostrar.
            $sectionActive[$key] = $matching ? (bool) $matching->is_active : true;
        }

        return view('transparency.index', array_merge(
            compact('marcoCount'),
            $sectionActive
        ));
    }

    public function marcoNormativo(Request $request): View
    {
        $query = MarcoNormativo::published();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('number', 'like', "%{$search}%");
            });
        }

        if ($type = $request->get('tipo')) {
            $query->byType($type);
        }

        if ($scope = $request->get('ambito')) {
            $query->where('scope', $scope);
        }

        $normas = $query->orderBy('issue_date', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('transparency.marco-normativo', compact('normas'));
    }

    public function presupuesto(): View
    {
        return view('transparency.presupuesto');
    }

    public function poa(): View
    {
        return view('transparency.poa');
    }

    public function informes(): View
    {
        return view('transparency.informes');
    }

    public function rendicion(): View
    {
        return view('transparency.rendicion');
    }

    public function auditorias(): View
    {
        return view('transparency.auditorias');
    }
}
