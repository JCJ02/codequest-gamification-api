<?php

namespace App\Http\Requests\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class AdminNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_id' => 'nullable|exists:admins,id',
            'notification_date' => 'required|date',
            'notification_message' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'notification_date.required' => 'The notification date is required.',
            'notification_message.required' => 'The notification message is required.',
        ];
    }
}
