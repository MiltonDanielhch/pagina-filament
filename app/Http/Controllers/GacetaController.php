<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class GacetaController extends Controller
{
    private array $sections = [
        'estatuto-departamental' => [
            'label' => 'Estatuto Departamental',
            'title' => 'Estatuto Departamental',
            'description' => 'Norma institucional fundamental que establece la organización, atribuciones y funcionamiento del Gobierno Autónomo Departamental del Beni, en el marco de la Constitución Política del Estado y las leyes aplicables.',
            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
        ],
        'ley-departamental' => [
            'label' => 'Ley Departamental',
            'title' => 'Leyes Departamentales',
            'description' => 'Son normas jurídicas de carácter general y de cumplimiento obligatorio en la jurisdicción del Departamento del Beni, que son sancionadas por la Asamblea Legislativa Departamental y promulgadas por la Gobernadora o Gobernador del Departamento.',
            'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
        ],
        'decretos-departamental' => [
            'label' => 'Decretos Departamental',
            'title' => 'Decretos Departamentales',
            'description' => 'Serán firmados por la Gobernadora o el Gobernador o conjuntamente con las Secretarias o Secretarios cuando emerjan de decisiones adoptadas en Gabinete y para aprobación de reglamentación a leyes departamentales.',
            'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
        ],
        'decretos-gubernativo' => [
            'label' => 'Decretos Gubernativo',
            'title' => 'Decretos de Gobernación',
            'description' => 'Otorgación de reconocimientos a personas naturales o jurídicas, aprobación de reglamentos específicos, reglamentos internos y manuales, designación de Directoras o Directores de Servicios Desconcentrados o Direcciones Desconcentradas, personerías jurídicas y otros.',
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
        ],
        'resolucion-departamental' => [
            'label' => 'Resolución Departamental',
            'title' => 'Resoluciones de Gobernación',
            'description' => 'Firmadas por el Secretario o Secretaria Departamental sobre asuntos sometidos a sus funciones y atribuciones, conforme a la normativa vigente del Gobierno Autónomo Departamental del Beni.',
            'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
        ],
        'resolucion-administrativa' => [
            'label' => 'Resolución Administrativa',
            'title' => 'Resoluciones Administrativas de Gobernación',
            'description' => 'Disposiciones administrativas emitidas por las autoridades competentes del Gobierno Autónomo Departamental del Beni para la gestión interna y la ejecución de acciones administrativas en el marco de sus atribuciones.',
            'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
        ],
        'personalidad-juridica' => [
            'label' => 'Personalidad Jurídica',
            'title' => 'Personalidad Jurídica',
            'description' => 'Reconocimiento oficial de la personalidad jurídica de organizaciones sociales, fundaciones y asociaciones sin fines de lucro en el Departamento del Beni, otorgado mediante resolución administrativa del Ejecutivo Departamental.',
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z',
        ],
    ];

    public function index(): View
    {
        return view('gaceta.index', [
            'sections' => $this->sections,
        ]);
    }

    public function show(string $slug): View
    {
        if (!isset($this->sections[$slug])) {
            abort(404);
        }

        $section = $this->sections[$slug];
        $section['slug'] = $slug;

        return view('gaceta.show', compact('section'));
    }
}
