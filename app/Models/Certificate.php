<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $primaryKey = 'certificate_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'template_id',
        'recipient_id',
        'issued_by',
        'issue_date',
        'status',
        'verification_code',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class, 'recipient_id', 'recipient_id');
    }

    public function issuer()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function verification()
    {
        return $this->hasOne(Verification::class, 'verification_code', 'verification_code');
    }
}

