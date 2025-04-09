<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'recipient_id',
        'uid',
        'verification_code',
        'issued_date',
        'status',
    ];

    protected $dates = ['issued_date'];

    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($certificate) {
            // Buat verification_code dari UUID
            $certificate->verification_code = strtoupper(Str::uuid()->toString());
    
            // Format UID seperti CERT-2025-04-0012 (CERT-YYYY-MM-XXXX)
            $datePart = now()->format('Y-m');
            
            // Ambil urutan sertifikat bulan ini
            $count = Certificate::whereYear('created_at', now()->year)
                                ->whereMonth('created_at', now()->month)
                                ->count() + 1;
    
            // Format nomor jadi 4 digit dengan leading zero
            $serial = str_pad($count, 4, '0', STR_PAD_LEFT);
    
            $certificate->uid = "CERT-{$datePart}-{$serial}";
        });
    }
    

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class, 'recipient_id', 'id');
    }    
}
