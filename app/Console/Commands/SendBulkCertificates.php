<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CertificateMail;
use App\Models\Certificate;

class SendBulkCertificates extends Command
{
    protected $signature = 'certificates:send-bulk';
    protected $description = 'Send certificates to all participants';
    public function handle()
    {
        $certificates = Certificate::with('contact')->get();
    
        foreach ($certificates as $cert) {
            $contact = $cert->contact;
    
            if (!$contact || !$contact->email) {
                $this->warn("No email for certificate ID {$cert->id}");
                continue;
            }
    
            $name = $contact->name;
            $email = $contact->email;
            $imageName = $cert->image_filename;
    
            $filePath = storage_path("app/public/{$imageName}");
            if (!file_exists($filePath)) {
                $this->error("File not found: {$filePath}");
                continue;
            }
    
            Mail::to($email)->send(new CertificateMail($name, $imageName));
            $this->info("Sent to: {$name} ({$email})");
        }
    
        return Command::SUCCESS;
    }
}   
