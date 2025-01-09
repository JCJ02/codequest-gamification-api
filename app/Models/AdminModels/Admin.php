<?php

namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    // ADMIN MODEL
    protected $table = 'admin';
    protected $fillable = ['admin_name', 'admin_password', 'role'];
    protected $hidden = ['admin_password'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            if (empty($admin->role)) {
                $admin->role = 'admin'; 
            }
        });
    }
}
