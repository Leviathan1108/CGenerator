<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table = 'templates';
    protected $guarded = [];
    protected $fillable = ['name', 'file_path', 'created_by', 'layout_storage'];

    protected $casts = [
        'layout_storage' => 'array',
    ];
}
