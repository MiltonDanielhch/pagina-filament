<?php

namespace App\Http\Controllers;

use App\Models\TurismoDestino;
use Illuminate\View\View;

class TurismoController extends Controller
{
    public function index(): View
    {
        $cultura = TurismoDestino::published()
            ->byCategory('cultura')
            ->orderBy('sort_order')
            ->get();

        $santuarios = TurismoDestino::published()
            ->byCategory('santuario')
            ->orderBy('sort_order')
            ->get();

        $biodiversidad = TurismoDestino::published()
            ->byCategory('biodiversidad')
            ->orderBy('sort_order')
            ->get();

        $galeria = TurismoDestino::published()
            ->byCategory('galeria')
            ->orderBy('sort_order')
            ->get();

        $title = 'Turismo y Naturaleza - Beni';
        $description = 'Descubra el santuario ecológico más vibrante de Bolivia. Desde los enigmáticos Llanos de Moxos hasta nuestros parques nacionales.';

        return view('turismo.index', compact(
            'cultura',
            'santuarios',
            'biodiversidad',
            'galeria',
            'title',
            'description'
        ));
    }
}
