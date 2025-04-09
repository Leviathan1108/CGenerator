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

        // Auto generate UID dan Verification Code saat create
        static::creating(function ($certificate) {
            $certificate->uid = Str::uuid();
            $certificate->verification_code = strtoupper(Str::random(10));
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
