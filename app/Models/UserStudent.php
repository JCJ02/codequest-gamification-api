<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStudent extends Model
{
    // ACCOUNT MODEL
    protected $table = "user_student";
    
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'email',
        'role',
        'username',
        'password',
    ];
}