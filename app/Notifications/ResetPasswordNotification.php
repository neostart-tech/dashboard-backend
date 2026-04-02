<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;

class ResetPasswordNotification extends Notification
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
        // Construct the URL for the frontend
        $frontendUrl = Config::get('app.frontend_url', env('FRONTEND_URL', 'http://localhost:3000'));
        $url = $frontendUrl . '/admin/reset-password?token=' . $this->token . '&email=' . urlencode($notifiable->email);

        return (new MailMessage)
            ->subject('Réinitialisation du mot de passe')
            ->view('emails.password-reset', [
                'url' => $url,
                'count' => Config::get('auth.passwords.'.Config::get('auth.defaults.passwords').'.expire'),
                'title' => 'Réinitialisation de mot de passe'
            ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
