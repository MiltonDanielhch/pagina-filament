<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Slide;
use App\Models\ExternalSystem;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('is_active', true)->orderBy('order')->get();
        $latestPosts = Post::published()->latest('published_at')->take(6)->get();
        $categories = Category::all();
        $externalSystems = ExternalSystem::active()->get();

        $title = 'Gobernación Autónoma Departamental del Beni - Trinidad, Bolivia';
        $description = 'Sitio web oficial de la Gobernación Autónoma Departamental del Beni. Información sobre servicios gubernamentales, noticias, trámites y proyectos de desarrollo para el departamento del Beni, Bolivia.';

        return view('home', compact('slides', 'latestPosts', 'categories', 'externalSystems', 'title', 'description'));
    }
}