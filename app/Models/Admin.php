<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    // ADMIN MODEL
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'admin';

    protected $fillable = [
        'admin_name',
        'admin_password',
    ];

    protected $hidden = ['password'];

    public function account()
    {
        return $this->hasOne(UserStudent::class, 'admin_id');
    }
}
