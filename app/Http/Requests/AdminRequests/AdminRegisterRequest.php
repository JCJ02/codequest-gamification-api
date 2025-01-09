<?php

namespace App\Http\Requests\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_name' => 'required|string|max:255',
            'admin_password' => 'required|string|confirmed|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'admin_name.required' => 'Name is required.',
            'admin_password.required' => 'The Password Field is Required.',
            'admin_password.min' => 'Password must be at least 8 characters long.',
        ];
    }
}
