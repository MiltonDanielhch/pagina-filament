<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Jobs\ContactAutoReply;
use App\Jobs\SendContactNotification;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(ContactRequest $request)
    {
        $data = $request->validated();
        
        SendContactNotification::dispatch($data);
        ContactAutoReply::dispatch($data['name'], $data['email']);
        
        return back()->with('success', 'Mensaje enviado correctamente. Nos pondremos en contacto pronto.');
    }
}