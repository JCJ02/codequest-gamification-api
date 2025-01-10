<?php

namespace App\Models\UserStudentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStudentMessage extends Model
{
    // USER STUDENT MESSAGE MODEL
    use HasFactory, SoftDeletes;

    protected $table = 'user_student_message';
    protected $fillable = ['user_student_id', 'recipient_id', 'message_date','message_content'];

    public function userStudent()
    {
        return $this->belongsTo(UserStudent::class, 'user_student_id');
    }

    public function recipient()
    {
        return $this->belongsTo(UserStudent::class, 'recipient_id');
    }
}