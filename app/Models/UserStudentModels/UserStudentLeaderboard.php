<?php

namespace App\Models\UserStudentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStudentLeaderboard extends Model
{
    use HasFactory, SoftDeletes;

    // USER STUDENT LEADERBOARD
    protected $table = "user_student_leaderboard";
    protected $fillable = ['user_student_id', 'user_student_score'];

    public function userStudent()
    {
        return $this->belongsTo(UserStudent::class, 'user_student_id');
    }
}
