<?php

namespace App\Http\Requests\UserStudentRequests;

use Illuminate\Foundation\Http\FormRequest;

class UserStudentAuditRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'user_student_id' => 'nullable|exists:user_students,id', 
            'action_event' => 'required|string|max:50',
            'description' => 'required|string',
            'event_date' => 'required|date',
        ];
    }
}
