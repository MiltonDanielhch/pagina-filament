<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $query = Announcement::with('secretariat');

        if ($status = $request->get('estado')) {
            $query->where('status', $status);
        } else {
            $query->whereIn('status', ['publicada', 'en_proceso', 'finalizada']);
        }

        if ($type = $request->get('tipo')) {
            $query->byType($type);
        }

        $announcements = $query->orderByDesc('publication_date')
            ->paginate(15)
            ->withQueryString();

        $open = Announcement::open()
            ->with('secretariat')
            ->orderBy('closing_date')
            ->limit(5)
            ->get();

        return view('announcements.index', compact('announcements', 'open'));
    }

    public function show(Announcement $announcement): View
    {
        $announcement->load('secretariat');

        $related = Announcement::where('id', '!=', $announcement->id)
            ->whereIn('status', ['publicada', 'en_proceso', 'finalizada'])
            ->orderByDesc('publication_date')
            ->limit(4)
            ->get();

        return view('announcements.show', compact('announcement', 'related'));
    }
}
