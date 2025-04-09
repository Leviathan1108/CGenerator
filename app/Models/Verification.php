<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $table = 'certificate_verifications'; // Sesuai dengan nama tabel baru
    protected $fillable = [
        'certificate_id',
        'verification_code',
        'verified_at',
        'verified_by',
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'certificate_id', 'id');
    }
}
