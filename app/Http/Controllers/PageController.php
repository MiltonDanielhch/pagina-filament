<?php

/**
 * Ubicación: `app/Http/Controllers/PageController.php`
 *
 * Descripción: Controlador para mostrar páginas estáticas del sitio. Soporta
 *              contenido rico (Tiptap) renderizado.
 *
 * Métodos: show() — GET /{slug}
 * Roadmap: 06-FRONTEND.md — Bloque 6.3
 */

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('pages.show', compact('page'));
    }
}