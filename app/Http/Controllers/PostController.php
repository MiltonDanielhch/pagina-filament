<?php

/**
 * Ubicación: `app/Http/Controllers/PostController.php`
 *
 * Descripción: Controlador para listar y mostrar posts/noticias. Incluye búsqueda
 *              por categoría y detalle de post individual.
 *
 * Métodos: index() — GET /blog, show() — GET /blog/{slug}, category() — GET /categoria/{slug}
 * Roadmap: 06-FRONTEND.md — Bloque 6.2
 */

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $pinnedPost = Post::published()->where('is_pinned', true)->first();
        
        $posts = Post::with('category')->published()
            ->when($pinnedPost, function ($query) use ($pinnedPost) {
                $query->where('id', '!=', $pinnedPost->id);
            })
            ->latest('published_at')
            ->paginate(12);
            
        return view('blog', compact('posts', 'pinnedPost'));
    }

    public function show($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::with('category')->published()->where('category_id', $category->id)->latest('published_at')->paginate(10);
        
        $title = $category->name . ' - Gobernación del Beni';
        $description = $category->description ?? 'Noticias sobre ' . $category->name . ' en la Gobernación Autónoma Departamental del Beni.';
        
        return view('posts.category', compact('posts', 'category', 'title', 'description'));
    }
}