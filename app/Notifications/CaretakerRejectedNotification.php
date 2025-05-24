<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CaretakerRejectedNotification extends Notification
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
            ->subject('Caretaker Registration Rejected')
            ->line('We regret to inform you that your caretaker registration request has been rejected.')
            ->action('Contact Support', url('/contact'));
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
