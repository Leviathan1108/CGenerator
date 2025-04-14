<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $table = 'certificate_verifications'; // Sesuai dengan nama tabel baru
    public $timestamps = false;
    
    protected $fillable = [
        'verification_code',
        'verified_at',
    ];
    
    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }
}
