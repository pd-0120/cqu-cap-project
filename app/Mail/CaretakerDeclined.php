<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CaretakerDeclined extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $name = 'User'; // Default fallback

        if (is_object($this->user)) {
            $name = trim(($this->user->first_name ?? '') . ' ' . ($this->user->last_name ?? ''));
        }

        return $this->subject('Caretaker Application Declined')
                    ->view('emails.caretaker_declined')
                    ->with([
                        'name' => $name,
                    ]);
    }
}
