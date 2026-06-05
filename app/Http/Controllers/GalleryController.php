<?php

/**
 * Ubicación: `app/Http/Controllers/GalleryController.php`
 *
 * Descripción: Controlador para mostrar galerías públicas.
 *
 * Roadmap: 12-FUTURO.md — Galería multimedia
 */

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Mostrar todas las galerías públicas.
     */
    public function index(Request $request)
    {
        $type = $request->query('type', 'all');
        $year = $request->query('year', 'all');

        $query = Gallery::published();

        if ($type !== 'all') {
            $query->where('type', $type);
        }

        if ($year !== 'all') {
            $query->whereYear('event_date', $year);
        }

        $galleries = $query->orderBy('event_date', 'desc')->paginate(12);

        $years = Gallery::published()
            ->selectRaw('YEAR(event_date) as year')
            ->whereNotNull('event_date')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('gallery.index', compact('galleries', 'type', 'year', 'years'));
    }

    /**
     * Mostrar una galería específica.
     */
    public function show(string $slug)
    {
        $gallery = Gallery::where('slug', $slug)->published()->firstOrFail();

        return view('gallery.show', compact('gallery'));
    }
}
