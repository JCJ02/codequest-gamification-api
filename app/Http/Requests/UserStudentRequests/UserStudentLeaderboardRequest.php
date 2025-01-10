<?php

namespace App\Http\Requests\UserStudentRequests;

use Illuminate\Foundation\Http\FormRequest;

class UserStudentLeaderboardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_student_id' => 'nullable|exists:user_student,id',
            'user_student_score' => 'nullable|integer|min:0',
        ];
    }
}
