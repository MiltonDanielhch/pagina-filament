<?php

/**
 * Ubicación: `app/Http/Controllers/ContactController.php`
 *
 * Descripción: Controlador para el formulario de contacto. Dispatch jobs asíncronos
 *              para notificación y auto-respuesta. Guarda mensajes en base de datos.
 *
 * Métodos: show() — GET /contacto, send() — POST /contacto
 * Roadmap: 06-FRONTEND.md — Bloque 6.5
 */

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Jobs\ContactAutoReply;
use App\Jobs\SendContactNotification;
use App\Models\ContactMessage;
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
        
        // Guardar mensaje en base de datos
        ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
        
        // Enviar notificaciones por correo
        SendContactNotification::dispatch($data);
        ContactAutoReply::dispatch($data['name'], $data['email']);
        
        return back()->with('success', 'Mensaje enviado correctamente. Nos pondremos en contacto pronto.');
    }
}