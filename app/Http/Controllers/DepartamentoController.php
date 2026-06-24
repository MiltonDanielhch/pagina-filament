<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DepartamentoController extends Controller
{
    public function index(): View
    {
        $title = 'Departamento del Beni';
        $description = 'Información general sobre el Departamento Autónomo del Beni, su historia, geografía, economía y datos relevantes.';

        return view('departamento.index', compact('title', 'description'));
    }
}
