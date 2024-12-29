<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AccountModel;

class AdminModel extends Model
{
    // ADMIN MODEL
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'birthdate',
        'email',
        'role',
        'password',
    ];

    public function account()
    {
        return $this->belongsTo(AccountModel::class);
    }
}
