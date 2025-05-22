<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCaretakerRegistrationNotification extends Notification
{
    use Queueable;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Caretaker Registration Request')
            ->line('A new caretaker has registered:')
            ->line("Name: {$this->user->first_name} {$this->user->last_name}")
            ->line("Email: {$this->user->email}")
            ->action('View Dashboard', url('/admin/caretakers'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
