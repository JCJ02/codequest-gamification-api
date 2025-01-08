<?php

namespace App\Models\UserStudentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserStudent extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    // USER STUDENT MODEL    
    protected $table = "user_student";
    
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'email',
        'role',
        'username',
        'user_password',
    ];

    protected $hidden = ['user_password'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userstudent) {
            if (empty($userstudent->role)) {
                $userstudent->role = 'user_student';
            }
        });
    }
}