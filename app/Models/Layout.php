<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $fillable = ['template_id', 'layout'];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
