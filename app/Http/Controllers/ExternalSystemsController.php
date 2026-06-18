<?php

namespace App\Http\Controllers;

use App\Models\ExternalSystem;
use Illuminate\View\View;

class ExternalSystemsController extends Controller
{
    public function index(): View
    {
        $systems = ExternalSystem::active()->get();

        return view('external-systems.index', compact('systems'));
    }
}
