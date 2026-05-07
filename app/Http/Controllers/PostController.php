<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest('published_at')->paginate(10);
        return view('blog', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::published()->where('category_id', $category->id)->latest('published_at')->paginate(10);
        
        $title = $category->name . ' - Gobernación del Beni';
        $description = $category->description ?? 'Noticias sobre ' . $category->name . ' en la Gobernación Autónoma Departamental del Beni.';
        
        return view('posts.category', compact('posts', 'category', 'title', 'description'));
    }
}