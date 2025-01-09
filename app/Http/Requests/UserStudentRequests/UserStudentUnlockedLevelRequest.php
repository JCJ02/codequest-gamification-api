<?php

namespace App\Http\Requests\UserStudentRequests;

use Illuminate\Foundation\Http\FormRequest;

class UserStudentUnlockedLevelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_student_id' => 'nullable|exists:user_students,id', 
            'admin_level_id' => 'nullable|exists:admin_level,id', 
            'unlocked_date' => 'required|date', 
        ];
    }
}
