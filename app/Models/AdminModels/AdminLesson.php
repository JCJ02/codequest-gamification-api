<?php

namespace App\Models\AdminModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminLesson extends Model
{
    use HasFactory, SoftDeletes;
    
    // ADMIN LESSON MODEL
    protected $table = 'lesson_admin'; 
    protected $fillable = ['admin_id', 'lesson_vid', 'lesson_title', 'lesson_description', 'lesson_prize'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
