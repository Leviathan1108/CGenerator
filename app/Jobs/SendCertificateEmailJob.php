<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCertificateEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name;
    public $email;
    public $imageFileName;
    public $verification_code;

    /**
     * Create a new job instance.
     */
    public function __construct($name, $email, $imageFileName, $verification_code)
    {
        $this->name = $name;
        $this->email = $email;
        $this->imageFileName = $imageFileName;
        $this->verification_code = $verification_code;
    }

    /**
     * Execute the job.
     */
// SendCertificateEmailJob.php
public function handle(): void
{
    Mail::to($this->email)
        ->send(new \App\Mail\CertificateMail($this->name, $this->imageFileName, $this->verification_code));
}

}
