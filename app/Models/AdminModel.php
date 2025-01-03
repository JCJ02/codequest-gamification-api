<?php

namespace App\Models;

class AdminModel extends Model
{
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
        return $this->hasOne(AccountModel::class, 'admin_id');
    }
}

