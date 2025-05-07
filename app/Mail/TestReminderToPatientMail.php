<?php

namespace App\Mail;

use App\Models\PatientTest;
use App\Models\Test;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestReminderToPatientMail extends Mailable
{
    use Queueable, SerializesModels;
    public PatientTest $patientTest;
    public User $patient;
    public  Test $test;
    public function __construct(PatientTest $test)
    {

        $this->patientTest = $test;
        $this->patient = $test->patient;
        $this->test = $test->test;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reminder to take your test',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.test-reminder-to-patient',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
