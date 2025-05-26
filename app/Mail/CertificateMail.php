<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $imageName;

    public function __construct($name, $imageName)
    {
        $this->name = $name;
        $this->imageName = $imageName;
    }

    public function build()
    {
        return $this->subject('Your Certificate')
            ->markdown('emails.certificate')
            ->attach(storage_path("app/public/{$this->imageName}"), [
                'as' => $this->imageName,
                'mime' => 'image/png',
            ]);
    }
}
