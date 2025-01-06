<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStudentRegisterRequest extends FormRequest
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birthdate' => 'required|date',
            'email' => 'required|email|unique:user_student',
            'role' => 'required|string',
            'username' => 'required|string|max:255',
            'password' => 'required|confirmed|min:8',
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
            'role.required' => 'Role is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            // 'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
