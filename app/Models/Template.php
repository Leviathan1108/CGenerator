<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    
    protected $table = 'templates';
    protected $fillable = [
        'user_id',
        'name',
        'recipient',
        'date',
        'background_image_url',
        'layout_storage',
    ];
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
