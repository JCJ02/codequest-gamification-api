<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AccountModel;

class AdminModel extends Model
{
    // ADMIN MODEL
    protected $table = 'admin';

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'birthdate',
        'email',
        'role',
        'account_id',
    ];

    public function account()
    {
        return $this->belongsTo(AccountModel::class);
    }
}
