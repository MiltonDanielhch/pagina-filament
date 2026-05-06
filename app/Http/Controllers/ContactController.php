<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(ContactRequest $request)
    {
        $data = $request->validated();
        
        // Guardar o enviar email
        // Mail::to('despacho@beni.gob.bo')->send(new ContactMail($data));
        
        return back()->with('success', 'Mensaje enviado correctamente. Nos pondremos en contacto pronto.');
    }
}