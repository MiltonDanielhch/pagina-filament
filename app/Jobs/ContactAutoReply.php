<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactAutoReply implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $name;
    public string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
        $this->onQueue('emails');
    }

    public function handle(): void
    {
        $body = "Estimado/a {$this->name},

Gracias por ponerse en contacto con la Gobernación Autónoma Departamental del Beni.

Hemos recibido su mensaje y nuestro equipo lo revisará a la brevedad posible. Le informamos que nuestro horario de atención es de lunes a viernes de 08:00 a 16:00.

Si su consulta es urgente, puede comunicarse directamente a nuestros teléfonos:
- Teléfono: (591) 346-21651
- Dirección: Plaza José Ballivian N° 1, Trinidad, Beni

Atentamente,
Gobernación Autónoma Departamental del Beni
Gobierno Autónomo Departamental - Bolivia";

        Mail::raw($body, function ($mail) {
            $mail->to($this->email)
                ->subject('Confirmación de recepción - Gobernación del Beni');
        });
    }
}