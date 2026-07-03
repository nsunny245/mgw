<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $type;
    public $details;

    public function __construct(string $type, array $details)
    {
        $this->type = $type;
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Makkah Gateway Alerts: ' . $this->type)
                    ->view('emails.admin_notification');
    }
}
