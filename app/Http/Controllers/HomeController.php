<?php

/**
 * Ubicación: `app/Http/Controllers/HomeController.php`
 *
 * Descripción: Controlador principal del sitio público.
 *              Alimenta los 18 bloques del homepage (Sección C — RM 067/2025).
 *
 * Métodos:
 *  - index()  — GET /  (homepage con 18 bloques)
 *  - about()  — GET /sobre-nosotros
 *
 * Roadmap: 06-FRONTEND.md — Bloque 6.1 + 14-cumplimiento-normativo-rm067-2025.md (C2)
 */

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Slide;
use App\Models\Event;
use App\Models\ExternalSystem;
use App\Models\SiteSetting;
use App\Models\Procedure;
use App\Models\Announcement;
use App\Models\Secretariat;
use App\Models\OpenDataset;
use App\Models\InfrastructureProject;
use App\Models\Official;
use App\Models\Complaint;
use App\Models\Office;
use App\Models\DepartmentalStatistics;
use App\Models\Gallery;
use App\Models\GalleryItem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        // Cache de queries pesadas: 5 minutos
        $data = Cache::remember('home:index:v1', 300, function () {
            // Bloque 3 — Hero Slider
            $slides = Slide::where('is_active', true)->orderBy('order')->get();

            // Bloque 5 — Accesos rápidos (se renderizan estáticos)

            // Bloque 6 — Trámites Destacados
            // NOTA: procedures usa `status` enum (activo), no `is_active`
            $featuredProcedures = Procedure::where('status', 'activo')
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->take(8)
                ->get();
            // Fallback: si no hay destacados, los más recientes
            if ($featuredProcedures->isEmpty()) {
                $featuredProcedures = Procedure::where('status', 'activo')
                    ->latest()
                    ->take(8)
                    ->get();
            }

            // Bloque 7 — Últimas Noticias
            $latestPosts = Post::published()->latest('published_at')->take(6)->get();

            // Bloque 8 — Transparencia en Cifras
            // Cada tabla tiene su propia convención: is_active, status, is_published
            $stats = [
                'tramites'        => Procedure::where('status', 'activo')->count(),
                'procedures'      => Procedure::where('status', 'activo')->count(),
                'secretarias'     => Secretariat::where('is_active', true)->count(),
                'oficinas'        => Office::where('is_active', true)->count(),
                'municipios'      => 19,
                'convocatorias'   => Announcement::whereIn('status', ['publicada', 'en_proceso'])->count(),
                'normas'          => \App\Models\MarcoNormativo::where('is_published', true)->count(),
                'datasets'        => OpenDataset::where('is_published', true)->count(),
                'proyectos'       => InfrastructureProject::whereIn('status', ['in_progress', 'ejecucion', 'planificacion', 'planned'])->count(),
                'funcionarios'    => Official::where('is_active', true)->count(),
                'quejas_atendidas' => Complaint::whereIn('status', ['resuelto', 'en_proceso'])->count(),
            ];

            // Bloque 9 — El Gobernador
            $gobernador = Official::where('is_active', true)
                ->whereIn('position_level', [1, 2])
                ->orderBy('position_level')
                ->get();

            // Bloque 10 — Próximos Eventos
            $featuredEvents = Event::where('status', 'published')
                ->where('is_featured', true)
                ->where('starts_at', '>', now())
                ->orderBy('starts_at')
                ->take(3)
                ->get();

            // Bloque 11 — Secretarías
            $secretariats = Secretariat::where('is_active', true)
                ->orderBy('sort_order')
                ->take(12)
                ->get();

            // Bloque 12 — Proyectos destacados (B4 RM 067/2025)
            $featuredProjects = InfrastructureProject::where('is_featured', true)
                ->whereIn('status', [
                    InfrastructureProject::STATUS_PLANNING,
                    InfrastructureProject::STATUS_PROGRESS,
                ])
                ->latest('start_date')
                ->take(4)
                ->get();
            if ($featuredProjects->isEmpty()) {
                $featuredProjects = InfrastructureProject::whereIn('status', [
                    InfrastructureProject::STATUS_PLANNING,
                    InfrastructureProject::STATUS_PROGRESS,
                ])
                    ->latest('start_date')
                    ->take(4)
                    ->get();
            }

            // Bloque 13 — Atención al ciudadano
            $mainOffices = Office::where('is_active', true)
                ->orderBy('sort_order')
                ->take(3)
                ->get();

            // Bloque 14 — Datos abiertos
            // NOTA: open_datasets usa is_published y NO tiene is_featured
            $featuredDatasets = OpenDataset::where('is_published', true)
                ->orderBy('sort_order')
                ->take(3)
                ->get();
            if ($featuredDatasets->isEmpty()) {
                $featuredDatasets = OpenDataset::where('is_published', true)
                    ->orderByDesc('download_count')
                    ->take(3)
                    ->get();
            }

            // Bloque 15 — Gabinete / Autoridades
            $gabinete = Official::where('is_active', true)
                ->where('position_level', '<=', 3)
                ->orderBy('position_level')
                ->take(5)
                ->get();

            // Bloque 16 — Multimedia
            // NOTA: galleries usa status enum (draft/published), no is_active
            $galleries = Gallery::where('status', 'published')
                ->with(['items' => fn($q) => $q->take(6)])
                ->latest()
                ->take(2)
                ->get();

            // Categorías (existente)
            $categories = Category::all();

            // Sistemas externos
            $externalSystems = ExternalSystem::active()->get();

            return compact(
                'slides',
                'featuredProcedures',
                'latestPosts',
                'stats',
                'gobernador',
                'featuredEvents',
                'secretariats',
                'featuredProjects',
                'mainOffices',
                'featuredDatasets',
                'gabinete',
                'galleries',
                'categories',
                'externalSystems',
            );
        });

        // Site settings (no cachear — siempre actualizado)
        $title = 'Gobernación Autónoma Departamental del Beni — Trinidad, Bolivia';
        $description = 'Sitio web oficial de la Gobernación Autónoma Departamental del Beni. Trámites, transparencia, noticias, proyectos de inversión y atención al ciudadano del departamento del Beni, Bolivia.';

        $aboutSettings = [
            'title'       => SiteSetting::get('about_title', 'Construyendo el futuro del Beni'),
            'description' => SiteSetting::get('about_description', 'En el corazón de la Amazonía boliviana, la Gobernación del Departamento del Beni se erige como el motor del progreso y el bienestar de nuestra gente.'),
            'mission'     => SiteSetting::get('about_mission', 'Ser el Gobierno Autónomo Departamental del Beni que, con transparencia y eficiencia, impulsa el desarrollo integral del departamento.'),
            'vision'      => SiteSetting::get('about_vision', 'Consolidar al Beni como un departamento líder en desarrollo sostenible, con una economía diversificada, infraestructura moderna y servicios básicos de calidad.'),
        ];

        $aboutImagePath = SiteSetting::get('about_image', '');
        $aboutSettings['image'] = $aboutImagePath ? Storage::disk('public')->url($aboutImagePath) : '';

        return view('home', array_merge(
            $data,
            compact('title', 'description', 'aboutSettings')
        ));
    }

    public function about()
    {
        $externalSystems = ExternalSystem::active()->get();
        return view('sobre-nosotros', compact('externalSystems'));
    }
}
