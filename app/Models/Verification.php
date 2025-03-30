<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $fillable = [
        'verification_code',
        'verified_at',
        'verified_by',
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'verification_code', 'verification_code');
    }
}
?>