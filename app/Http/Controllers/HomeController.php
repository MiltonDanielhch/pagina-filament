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

        return view('home', compact('slides', 'latestPosts', 'featuredEvents', 'categories', 'externalSystems', 'title', 'description'));
    }
}