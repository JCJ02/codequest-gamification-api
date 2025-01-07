<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStudentLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|exists:user_student,username',
            'user_password' => 'required|string|min:8',
        ];
    }

    public function messages(): array  
    {
        return [
            'username.required' => 'Username is required.',
            'username.exists' => 'Username does not exist.',
            'user_password.required' => 'Password is required.',
            'user_password.min' => 'Password must be at least 8 characters long.',
        ];
    }
}
