<?php

/**
 * Ubicación: `app/Jobs/SendContactNotification.php`
 *
 * Descripción: Job asíncrono para notificar a los administradores
 *              cuando se recibe un mensaje de contacto. Se ejecuta
 *              en la cola 'emails'.
 *
 * Uso: SendContactNotification::dispatch($data)
 * Roadmap: 08-RENDIMIENTO.md — Bloque 8.6
 */

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendContactNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $name;
    public string $email;
    public ?string $subject;
    public string $message;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->subject = $data['subject'] ?? null;
        $this->message = $data['message'];
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        $admins = ['despacho@beni.gob.bo'];
        $subjectLine = $this->subject ?? 'Sin asunto';
        $body = "Nuevo mensaje de contacto recibido:\n\nNombre: {$this->name}\nEmail: {$this->email}\nAsunto: {$subjectLine}\n\nMensaje:\n{$this->message}\n\nResponder a: {$this->email}";

        foreach ($admins as $adminEmail) {
            Mail::raw($body, function ($mail) use ($adminEmail) {
                $mail->to($adminEmail)
                    ->subject('Nuevo mensaje de contacto - Gobernación del Beni');
            });
        }
    }
}