<?php

namespace App\Http\Controllers;

use App\Models\TurismoDestino;
use Illuminate\View\View;

class DepartamentoController extends Controller
{
    public function index(): View
    {
        $title = 'Departamento del Beni';
        $description = 'Información general sobre el Departamento Autónomo del Beni, su historia, geografía, economía y datos relevantes.';

        return view('departamento.index', compact('title', 'description'));
    }

    public function ganaderia(): View
    {
        $title = 'Ganadería - Departamento del Beni';
        $description = 'Sector ganadero del Beni: producción, mejoramiento genético y exportación.';

        return view('departamento.ganaderia', compact('title', 'description'));
    }

    public function agricultura(): View
    {
        $title = 'Agricultura - Departamento del Beni';
        $description = 'Agricultura de precisión en el Beni: arroz, soya y desarrollo tecnológico.';

        return view('departamento.agricultura', compact('title', 'description'));
    }

    public function industriaCastana(): View
    {
        $title = 'Industria de la Castaña - Departamento del Beni';
        $description = 'Industria castañera del Beni: recolección, producción y exportación.';

        return view('departamento.industria-castana', compact('title', 'description'));
    }

    public function mineria(): View
    {
        $title = 'Minería - Departamento del Beni';
        $description = 'Potencial minero del Beni: oro aluvial y minería responsable.';

        return view('departamento.mineria', compact('title', 'description'));
    }

    public function turismo(): View
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

        $title = 'Turismo - Departamento del Beni';
        $description = 'Turismo en el Departamento Autónomo del Beni: cultura, naturaleza y biodiversidad.';

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
