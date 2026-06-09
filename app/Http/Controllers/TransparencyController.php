<?php

namespace App\Http\Controllers;

use App\Models\MarcoNormativo;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransparencyController extends Controller
{
    public function index(): View
    {
        $marcoCount = MarcoNormativo::published()->count();
        return view('transparency.index', compact('marcoCount'));
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
