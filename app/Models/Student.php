<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // ACCOUNT MODEL
    protected $table = "student";
    
    protected $fillable = [
        'password',
    ];
}