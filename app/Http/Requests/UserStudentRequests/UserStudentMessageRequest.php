<?php

namespace App\Http\Requests\UserStudentRequests;

use Illuminate\Foundation\Http\FormRequest;

class UserStudentMessageRequest extends FormRequest
{
    public function authorize()
    {
        return true;  
    }

    public function rules()
    {
        return [
            'user_student_id' => 'nullable|exists:user_student,id',
            'recipient_id' => 'nullable|exists:user_student,id',
            'message_date' => 'required|date',
            'message_content' => 'required|string|max:100',
        ];
    }
}