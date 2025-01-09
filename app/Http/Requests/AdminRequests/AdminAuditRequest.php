<?php

namespace App\Http\Requests\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAuditRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'admin_id' => 'nullable|exists:admins,id',  
            'action_event' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'event_date' => 'required|date',
        ];
    }
}

