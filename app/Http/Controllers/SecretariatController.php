<?php

namespace App\Http\Controllers;

use App\Models\Secretariat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SecretariatController extends Controller
{
    public function index(Request $request): View
    {
        $query = Secretariat::active()->with('head');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('acronym', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $secretariats = $query->orderBy('sort_order')->get();

        return view('institutional.secretariats.index', compact('secretariats'));
    }

    public function show(Secretariat $secretariat): View
    {
        $secretariat->load(['head', 'procedures', 'announcements']);

        $recentNews = \App\Models\Post::published()
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('institutional.secretariats.show', compact('secretariat', 'recentNews'));
    }
}
