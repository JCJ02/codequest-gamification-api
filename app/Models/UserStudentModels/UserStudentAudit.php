<?php

namespace App\Models\UserStudentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStudentAudit extends Model
{
    use HasFactory, SoftDeletes;

    // USER STUDENT AUDIT MODEL
    protected $table = 'user_student_audit';
    protected $fillable = ['user_student_id', 'action_event', 'description', 'event_date'];
    protected $casts = ['event_date' => 'datetime'];

    public function userStudent()
    {
        return $this->belongsTo(UserStudent::class, 'user_student_id');
    }
}
