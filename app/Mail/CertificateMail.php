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
        return $this->subject('Sertifikat untuk ' . $this->name)
        ->markdown('emails.certificate')
        ->attach(storage_path("app/public/{$this->imageName}"), [
            'as' => 'sertifikat_' . $this->name . '.png',
            'mime' => 'image/png',
        ]);
    }

}
