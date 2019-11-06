<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablece tu Contraseña', 'Vida y Verdad')
            ->line('Recibiste este e-mail porque su cuenta solicitó restablecer su contraseña')
            ->action('Restabelcer Contraseña', url('password/reset', $this->token))
            ->line('Si no solicitó restablecer su contraseña ignore este mensaje');
    }
}
