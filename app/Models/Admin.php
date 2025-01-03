<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // ADMIN MODEL
    protected $table = "admin";

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'birthdate',
        'email',
        'role',
    ];

    public function account()
    {
        return $this->hasOne(Student::class, 'admin_id');
    }
}