<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 3) {
            return response()->json([
                'posts' => [],
                'pages' => [],
            ]);
        }

        $posts = Post::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%");
            })
            ->with('category')
            ->limit(10)
            ->get();

        $pages = Page::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get();

        return response()->json([
            'posts' => $posts,
            'pages' => $pages,
        ]);
    }

    public function index(Request $request)
    {
        $query = $request->get('q', '');
        
        $results = [];
        
        if (strlen($query) >= 3) {
            $posts = Post::published()
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('excerpt', 'like', "%{$query}%");
                })
                ->with('category')
                ->paginate(10);

            $pages = Page::published()
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
                })
                ->paginate(10);

            $results = [
                'posts' => $posts,
                'pages' => $pages,
            ];
        }

        return view('search.index', compact('query', 'results'));
    }
}