<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $incrementing = false; //biar tidak increment
    protected $keyType = 'string'; //typenya string


    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'certificate_id',
        'photo_profile',
    ];

    // untuk membuat uuid custom
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // UUID untuk kolom id
            $user->id = (string) Str::uuid();

            // Custom ID format: USR-2025-001
            $year = now()->format('Y'); //tahunnya
            $count = User::whereYear('created_at', $year)->count() + 1; //increment 001
            $user->custom_id = 'USR-' . $year . '-' . str_pad($count, 3, '0', STR_PAD_LEFT); //menyatukan
        });
    }
    //end

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'timestamp',
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'certificate_id');
    }

}
