<?php

namespace App\Http\Requests\UserStudentRequests;

use Illuminate\Foundation\Http\FormRequest;

class UserStudentRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:user_student,email',
            'role' => 'nullable|string',
            'username' => 'required|string|max:255',
            'user_password' => 'required|string|confirmed|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'First Name is required.',
            'lastname.required' => 'Last Name is required.',
            'birthdate.required' => 'Birthdate is required.',
            'birthdate.date' => 'Birthdate must be a valid date.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email is already taken.',
            'user_password.required' => 'Password is required.',
            'user_password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
