<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServiciosController extends Controller
{
    public function index(): View
    {
        $title = 'Servicios';
        $description = 'Servicios que ofrece la Gobernación Autónoma Departamental del Beni a la ciudadanía.';

        return view('servicios.index', compact('title', 'description'));
    }
}
