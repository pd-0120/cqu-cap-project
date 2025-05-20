<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CaretakerApprovedNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Caretaker Registration Approved')
            ->line('Congratulations! Your caretaker account has been approved.')
            ->action('Login Now', url('/login'));
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
