<?php

namespace App\Http\Controllers;

use App\Models\Official;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    public function index()
    {
        $officials = Official::where('is_active', true)
            ->with('media')
            ->orderBy('position_level')
            ->orderBy('sort_order')
            ->get();

        return view('credenciales', compact('officials'));
    }
}
