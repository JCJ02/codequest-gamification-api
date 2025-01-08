<?php

namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminNotification extends Model
{
    use HasFactory, SoftDeletes;

    // ADMIN NOTIFICATION MODEL
    protected $table = 'admin_notification';
    protected $fillable = ['admin_id', 'notification_date', 'notification_message'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
