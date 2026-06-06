<?php

/**
 * Ubicación: `app/Http/Controllers/HomeController.php`
 *
 * Descripción: Controlador principal del sitio público. Carga slides,
 *              posts recientes, categorías y sistemas externos para el homepage.
 *
 * Métodos: index() — GET /
 * Roadmap: 06-FRONTEND.md — Bloque 6.1
 */

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Slide;
use App\Models\Event;
use App\Models\ExternalSystem;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('is_active', true)->orderBy('order')->get();
        $latestPosts = Post::published()->latest('published_at')->take(6)->get();
        $featuredEvents = Event::where('status', 'published')
            ->where('is_featured', true)
            ->where('starts_at', '>', now())
            ->orderBy('starts_at')
            ->take(3)
            ->get();
        $categories = Category::all();
        $externalSystems = ExternalSystem::active()->get();

        $title = 'Gobernación Autónoma Departamental del Beni - Trinidad, Bolivia';
        $description = 'Sitio web oficial de la Gobernación Autónoma Departamental del Beni. Información sobre servicios gubernamentales, noticias, trámites y proyectos de desarrollo para el departamento del Beni, Bolivia.';

        $aboutSettings = [
            'title' => SiteSetting::get('about_title', 'Construyendo el futuro del Beni'),
            'description' => SiteSetting::get('about_description', 'En el corazón de la Amazonía boliviana, la Gobernación del Departamento del Beni se erige como el motor del progreso y el bienestar de nuestra gente. Somos la institución pública que lidera la administración y el desarrollo autónomo de este vasto y diverso territorio.'),
            'mission' => SiteSetting::get('about_mission', 'Ser el <strong>Gobierno Autónomo Departamental del Beni</strong> que, con transparencia y eficiencia, impulsa el desarrollo integral del departamento, promoviendo el bienestar de su población, la protección de su medio ambiente y la consolidación de su identidad cultural.'),
            'vision' => SiteSetting::get('about_vision', 'Consolidar al Beni como un departamento líder en desarrollo sostenible, con una economía diversificada, infraestructura moderna, servicios básicos de calidad y un fuerte compromiso con la preservación de su riqueza natural y cultural.'),
        ];

        // Get the about image path and generate correct URL
        $aboutImagePath = SiteSetting::get('about_image', '');
        if ($aboutImagePath) {
            $aboutSettings['image'] = Storage::disk('public')->url($aboutImagePath);
        } else {
            $aboutSettings['image'] = '';
        }

        return view('home', compact('slides', 'latestPosts', 'featuredEvents', 'categories', 'externalSystems', 'title', 'description', 'aboutSettings'));
    }

    public function about()
    {
        $externalSystems = ExternalSystem::active()->get();
        return view('sobre-nosotros', compact('externalSystems'));
    }
}