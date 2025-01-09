<?php

namespace App\Models\UserStudentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStudentChatMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_student_chat_message';

    protected $fillable = [
        'user_student_id',
        'recepient_id',
        'message_date',
        'message_content',
    ];

    public function userStudent()
    {
        return $this->belongsTo(UserStudent::class, 'user_student_id');
    }

    public function recepient()
    {
        return $this->belongsTo(UserStudent::class, 'recepient_id');
    }
}
