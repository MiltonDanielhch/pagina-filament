<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProcedureController extends Controller
{
    public function index(Request $request): View
    {
        $query = Procedure::active()->with('secretariat');

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('categoria')) {
            $query->byCategory($category);
        }

        if ($online = $request->get('online')) {
            $query->online();
        }

        $procedures = $query->orderBy('sort_order')
            ->paginate(12)
            ->withQueryString();

        $featured = Procedure::active()->featured()
            ->with('secretariat')
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        return view('procedures.index', compact('procedures', 'featured'));
    }

    public function show(Procedure $procedure): View
    {
        $procedure->load(['secretariat', 'official']);

        $related = Procedure::active()
            ->where('category', $procedure->category)
            ->where('id', '!=', $procedure->id)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        return view('procedures.show', compact('procedure', 'related'));
    }
}
