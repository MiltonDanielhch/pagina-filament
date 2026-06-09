<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Secretariat;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ComplaintController extends Controller
{
    public function create(): View
    {
        $secretariats = Secretariat::active()->orderBy('name')->get();
        return view('complaints.create', compact('secretariats'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'type' => 'required|in:queja,reclamo,sugerencia,denuncia',
            'full_name' => 'required|string|max:255',
            'ci' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string|min:10|max:5000',
            'related_secretariat_id' => 'nullable|exists:secretariats,id',
            'attachment' => 'nullable|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('complaints', 'public');
        }

        $data['ip_address'] = $request->ip();

        $complaint = Complaint::create($data);

        return redirect()
            ->route('complaints.confirmation', $complaint->code)
            ->with('success', 'Su solicitud ha sido registrada correctamente.');
    }

    public function confirmation(string $code): View
    {
        $complaint = Complaint::where('code', $code)->firstOrFail();
        return view('complaints.confirmation', compact('complaint'));
    }

    public function trackForm(): View
    {
        return view('complaints.track-form');
    }

    public function trackSearch(Request $request)
    {
        $request->validate([
            'code' => 'required|string|min:5',
        ]);

        $complaint = Complaint::where('code', $request->input('code'))->first();

        if (!$complaint) {
            return back()
                ->withErrors(['code' => 'No encontramos una solicitud con ese código. Verifica que esté bien escrito.'])
                ->withInput();
        }

        return redirect()->route('complaints.track', $complaint->tracking_token);
    }

    public function track(string $token): View
    {
        $complaint = Complaint::where('tracking_token', $token)->firstOrFail();
        return view('complaints.track', compact('complaint'));
    }
}
