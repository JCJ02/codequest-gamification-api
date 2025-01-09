<?php

namespace App\Models\UserStudentModels;

use App\Models\AdminModels\AdminLevel; // Ensure this import is correct
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserStudentUnlockedLevel extends Model
{
    use HasFactory, SoftDeletes;

    // USER STUDENT UNLOCKED LEVEL MODEL
    protected $table = "user_student_unlocked_level";
    protected $fillable = ['user_student_id', 'admin_level_id', 'unlocked_date'];
    protected $casts = ['unlocked_date' => 'datetime'];

    public function userStudent()
    {
        return $this->belongsTo(UserStudent::class);
    }

    public function adminLevel()
    {
        return $this->belongsTo(AdminLevel::class); 
    }
}
