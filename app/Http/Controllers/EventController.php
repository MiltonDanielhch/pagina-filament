<?php

/**
 * Ubicación: `app/Http/Controllers/EventController.php`
 *
 * Descripción: Controlador para listar y mostrar eventos departamentales.
 *              Filtra por fecha y muestra detalle de evento.
 *
 * Métodos: index() — GET /eventos, show() — GET /eventos/{slug}
 * Roadmap: 06-FRONTEND.md — Bloque 6.4
 */

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::where('status', 'published')
            ->where('starts_at', '>', now()->subDay())
            ->orderBy('starts_at')
            ->paginate(10);

        return view('events', compact('events'));
    }
}