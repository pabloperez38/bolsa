<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerificarEmail extends Notification
{
    use Queueable;

    /**
     * Crear una nueva notificación.
     */
    public function __construct()
    {
        //
    }

    /**
     * Canales utilizados por la notificación.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Crear el mensaje de correo.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Confirmá tu correo electrónico - Bolsa de Trabajo UTN')
            ->view('emails.verificar-email', [
                'usuario' => $notifiable,
                'verificationUrl' => $verificationUrl,
            ]);
    }
}
