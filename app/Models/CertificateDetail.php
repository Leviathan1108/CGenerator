<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'certificate_name',
        'certificate_title',
        'issue_date',
        'recipient_name',
        'logo_path',
    ];
}
