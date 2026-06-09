<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\View\View;

class OfficeController extends Controller
{
    public function index(): View
    {
        $offices = Office::active()->orderBy('sort_order')->get();
        return view('offices.index', compact('offices'));
    }
}
