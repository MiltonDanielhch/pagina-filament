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

        return view('home', compact('slides', 'latestPosts', 'categories', 'externalSystems'));
    }
}