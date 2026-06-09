<?php

namespace App\Http\Controllers;

use App\Models\OpenDataset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OpenDatasetController extends Controller
{
    public function index(Request $request): View
    {
        $query = OpenDataset::published();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('categoria')) {
            $query->byCategory($category);
        }

        $datasets = $query->orderByDesc('last_updated_at')
            ->paginate(12)
            ->withQueryString();

        $featured = OpenDataset::published()
            ->orderByDesc('download_count')
            ->limit(3)
            ->get();

        $categories = OpenDataset::published()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('open-data.index', compact('datasets', 'featured', 'categories'));
    }

    public function show(OpenDataset $dataset): View
    {
        abort_unless($dataset->is_published, 404);

        $related = OpenDataset::published()
            ->where('id', '!=', $dataset->id)
            ->where('category', $dataset->category)
            ->limit(4)
            ->get();

        return view('open-data.show', compact('dataset', 'related'));
    }

    public function download(OpenDataset $dataset, string $format)
    {
        abort_unless($dataset->is_published, 404);

        $field = "file_{$format}";
        abort_unless(in_array($format, ['csv', 'json', 'xlsx', 'pdf']) && $dataset->$field, 404);

        // Incrementar contador
        $dataset->increment('download_count');

        return Storage::disk('public')->download($dataset->$field, "{$dataset->slug}.{$format}");
    }
}
