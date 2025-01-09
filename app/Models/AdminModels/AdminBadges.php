<?php

namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminBadges extends Model
{
    use HasFactory, SoftDeletes;

    // ADMIN BADGE MODEL
    protected $table = 'admin_badges';
    protected $fillable = ['admin_id', 'badge_name', 'badge_picture', 'badge_description', 'badge_requirements'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
