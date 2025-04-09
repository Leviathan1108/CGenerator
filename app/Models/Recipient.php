<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = ['certificate_id', 'name', 'email'];

    // Pastikan ada relasi ke Certificate
    public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'certificate_id');
    }
}

