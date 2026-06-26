<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\ExternalSystem;
use App\Models\InfrastructureProject;
use App\Models\Official;
use App\Models\OpenDataset;
use App\Models\Page;
use App\Models\Post;
use App\Models\Procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    private function searchQuery($model, $fields, $query, $scope = null)
    {
        $q = $model::query();

        if ($scope) {
            $q->{$scope}();
        }

        return $q->where(function ($w) use ($fields, $query) {
            foreach ($fields as $field) {
                $w->orWhere($field, 'like', "%{$query}%");
            }
        });
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (Str::length($query) < 3) {
            return response()->json([
                'posts' => [], 'pages' => [], 'procedures' => [],
                'events' => [], 'announcements' => [], 'officials' => [],
                'projects' => [], 'datasets' => [], 'agenda' => [], 'systems' => [],
            ]);
        }

        $posts = $this->searchQuery(Post::class, ['title', 'excerpt', 'body'], $query, 'published')
            ->with('category')->limit(10)->get();

        $pages = $this->searchQuery(Page::class, ['title', 'content'], $query, 'published')
            ->limit(10)->get();

        $procedures = $this->searchQuery(Procedure::class, ['name', 'description'], $query)
            ->where('status', 'activo')->limit(10)->get();

        $events = $this->searchQuery(Event::class, ['title', 'description', 'location'], $query, 'published')
            ->limit(10)->get();

        $announcements = $this->searchQuery(Announcement::class, ['title', 'description', 'code'], $query)
            ->limit(10)->get();

        $officials = $this->searchQuery(Official::class, ['name', 'position', 'area', 'bio'], $query, 'active')
            ->limit(10)->get();

        $projects = $this->searchQuery(InfrastructureProject::class, ['title', 'description', 'municipality', 'code'], $query, 'published')
            ->limit(10)->get();

        $datasets = $this->searchQuery(OpenDataset::class, ['title', 'description', 'category'], $query, 'published')
            ->limit(10)->get();

        $agenda = $this->searchQuery(Agenda::class, ['title', 'description', 'location'], $query)
            ->limit(10)->get();

        $systems = $this->searchQuery(ExternalSystem::class, ['name', 'description'], $query, 'active')
            ->limit(10)->get();

        return response()->json([
            'posts' => $posts, 'pages' => $pages, 'procedures' => $procedures,
            'events' => $events, 'announcements' => $announcements, 'officials' => $officials,
            'projects' => $projects, 'datasets' => $datasets, 'agenda' => $agenda, 'systems' => $systems,
        ]);
    }

    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $type = $request->get('type', '');

        $results = [];

        if (Str::length($query) >= 3) {
            $count = 0;

            if (!$type || $type === 'posts') {
                $results['posts'] = $this->searchQuery(Post::class, ['title', 'excerpt', 'body'], $query, 'published')
                    ->with('category')->paginate(10)->withQueryString();
                $count += $results['posts']->total();
            }
            if (!$type || $type === 'pages') {
                $results['pages'] = $this->searchQuery(Page::class, ['title', 'content'], $query, 'published')
                    ->paginate(10)->withQueryString();
                $count += $results['pages']->total();
            }
            if (!$type || $type === 'procedures') {
                $results['procedures'] = $this->searchQuery(Procedure::class, ['name', 'description'], $query)
                    ->where('status', 'activo')->paginate(10)->withQueryString();
                $count += $results['procedures']->total();
            }
            if (!$type || $type === 'events') {
                $results['events'] = $this->searchQuery(Event::class, ['title', 'description', 'location'], $query, 'published')
                    ->paginate(10)->withQueryString();
                $count += $results['events']->total();
            }
            if (!$type || $type === 'announcements') {
                $results['announcements'] = $this->searchQuery(Announcement::class, ['title', 'description', 'code'], $query)
                    ->paginate(10)->withQueryString();
                $count += $results['announcements']->total();
            }
            if (!$type || $type === 'officials') {
                $results['officials'] = $this->searchQuery(Official::class, ['name', 'position', 'area', 'bio'], $query, 'active')
                    ->paginate(10)->withQueryString();
                $count += $results['officials']->total();
            }
            if (!$type || $type === 'projects') {
                $results['projects'] = $this->searchQuery(InfrastructureProject::class, ['title', 'description', 'municipality', 'code'], $query, 'published')
                    ->paginate(10)->withQueryString();
                $count += $results['projects']->total();
            }
            if (!$type || $type === 'datasets') {
                $results['datasets'] = $this->searchQuery(OpenDataset::class, ['title', 'description', 'category'], $query, 'published')
                    ->paginate(10)->withQueryString();
                $count += $results['datasets']->total();
            }
            if (!$type || $type === 'agenda') {
                $results['agenda'] = $this->searchQuery(Agenda::class, ['title', 'description', 'location'], $query)
                    ->paginate(10)->withQueryString();
                $count += $results['agenda']->total();
            }
            if (!$type || $type === 'systems') {
                $results['systems'] = $this->searchQuery(ExternalSystem::class, ['name', 'description'], $query, 'active')
                    ->paginate(10)->withQueryString();
                $count += $results['systems']->total();
            }

            $results['total_count'] = $count;
            $results['active_type'] = $type;
        }

        return view('search.index', compact('query', 'results'));
    }

    public static function snippetHighlight($text, $query, $maxLength = 200)
    {
        if (!$text || !$query) {
            return e($text);
        }

        $pos = mb_stripos($text, $query);
        if ($pos === false) {
            return e(Str::limit($text, $maxLength));
        }

        $start = max(0, $pos - 60);
        $snippet = mb_substr($text, $start, $maxLength);

        if ($start > 0) {
            $snippet = '...' . $snippet;
        }
        if ($start + $maxLength < mb_strlen($text)) {
            $snippet .= '...';
        }

        $escaped = e($snippet);

        return preg_replace(
            '/(' . preg_quote($query, '/') . ')/iu',
            '<mark class="bg-yellow-200 text-gray-900 rounded px-0.5">$1</mark>',
            $escaped
        );
    }
}
