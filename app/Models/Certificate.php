<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'selected_template_id',
        'contact_id',
        'uid',
        'verification_code',
        'issued_date',
        'status',
        'background_choice',
        'event_name',
        'logo_path',
    ];

    protected $dates = ['issued_date'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            if (empty($certificate->verification_code)) {
                $certificate->verification_code = strtoupper(Str::random(10));
            }

            if (empty($certificate->uid)) {
                $datePart = now()->format('Y-m');
                $count = Certificate::whereYear('created_at', now()->year)
                                    ->whereMonth('created_at', now()->month)
                                    ->count() + 1;
                $serial = str_pad($count, 4, '0', STR_PAD_LEFT);
                $certificate->uid = "CERT-{$datePart}-{$serial}";
            }
        });
    }
public function template()
{
    return $this->belongsTo(Template::class, 'selected_template_id');
}
public function templates()
{
    return $this->belongsTo(Template::class);
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function recipient()
    {
        return $this->hasOne(Recipient::class);
    }
}
