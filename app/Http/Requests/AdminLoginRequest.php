<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_name' => 'required|string|exists:admin,admin_name',
            'admin_password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'admin_name.required' => 'Name is required.',
            'admin_name.exists' => 'Name does not exist.',
            'admin_password.required' => 'The Password Field is Required.',
            'admin_password.min' => 'Password must be at least 8 characters long.',
        ];
    }
}
