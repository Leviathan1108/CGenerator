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
    public $verification_code;

    public function __construct($name, $imageName, $verification_code)
    {
        $this->name = $name;
        $this->imageName = $imageName;
        $this->verification_code = $verification_code;
    }

    public function build()
    {
        return $this->subject('Your Certificate from Maxy Academy ' . $this->name)
        ->markdown('emails.certificate')
        ->attach(storage_path("app/public/{$this->imageName}"), [
            'as' => 'sertifikat_' . $this->name . '.png',
            'mime' => 'image/png',
        ]);
    }

}
