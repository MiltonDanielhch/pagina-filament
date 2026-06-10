<?php

/**
 * Ubicación: `app/Http/Controllers/InfrastructureProjectController.php`
 *
 * Descripción: Controlador público para Proyectos de Inversión del Beni.
 *              Listado con mapa interactivo y ficha detallada.
 *
 * Cumplimiento: RM 067/2025 — Componente 15 (Proyectos de Inversión)
 */

namespace App\Http\Controllers;

use App\Models\InfrastructureProject;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InfrastructureProjectController extends Controller
{
    public function index(Request $request): View
    {
        $query = InfrastructureProject::query();

        // Filtros
        if ($status = $request->get('estado')) {
            $query->where('status', $status);
        }
        if ($municipality = $request->get('municipio')) {
            $query->where('municipality', $municipality);
        }
        if ($category = $request->get('categoria')) {
            $query->where('category', $category);
        }
        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('municipality', 'like', "%{$search}%");
            });
        }

        $projects = $query->orderByDesc('start_date')
            ->paginate(12)
            ->withQueryString();

        // Para filtros laterales
        $allProjects = InfrastructureProject::all();
        $municipalities = $allProjects->pluck('municipality')->filter()->unique()->sort()->values();
        $categories = $allProjects->pluck('category')->filter()->unique()->sort()->values();
        $statuses = $allProjects->pluck('status')->filter()->unique()->sort()->values();

        // Para el mapa (preparado como array simple para @json)
        $mapProjects = InfrastructureProject::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'title', 'slug', 'municipality', 'status', 'latitude', 'longitude', 'category', 'budget'])
            ->map(function ($p) {
                return [
                    'lat'         => (float) $p->latitude,
                    'lng'         => (float) $p->longitude,
                    'title'       => $p->title,
                    'url'         => route('gobierno.proyectos.show', $p->slug),
                    'status'      => $p->status,
                    'category'    => $p->category,
                    'budget'      => (float) $p->budget,
                    'municipality'=> $p->municipality,
                ];
            })
            ->values();

        // Estadísticas rápidas
        $stats = [
            'total' => InfrastructureProject::count(),
            'in_progress' => InfrastructureProject::inProgress()->count(),
            'completed' => InfrastructureProject::completed()->count(),
            'budget_total' => InfrastructureProject::sum('budget'),
        ];

        // Schema.org ItemList (JSON-LD) para SEO
        $itemList = $projects->take(10)->map(function ($p, $i) {
            return [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'url'      => route('gobierno.proyectos.show', $p->slug),
                'name'     => $p->title,
            ];
        })->values()->all();
        $itemListJson = json_encode($itemList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        return view('gobierno.proyectos.index', compact(
            'projects', 'mapProjects', 'municipalities', 'categories', 'statuses', 'stats', 'itemListJson'
        ));
    }

    public function show(string $slug): View
    {
        $project = InfrastructureProject::where('slug', $slug)->firstOrFail();

        // Proyectos relacionados (mismo municipio o categoría)
        $related = InfrastructureProject::where('id', '!=', $project->id)
            ->where(function ($q) use ($project) {
                $q->where('municipality', $project->municipality)
                  ->orWhere('category', $project->category);
            })
            ->take(4)
            ->get();

        return view('gobierno.proyectos.show', compact('project', 'related'));
    }
}
