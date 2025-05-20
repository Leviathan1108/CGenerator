<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'email',
    ];

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
