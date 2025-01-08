<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLevelRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'admin_id' => 'nullable|exists:admin,id',
            'language_id' => 'nullable|exists:admin_language,id',
            'level_diffuculty' => 'required|string|max:100',
            'level_prize' => 'required|string|max:100',
            'level_task' => 'required|string|max:100',
        ];
    }

    /**
     * Get custom error messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'admin_id.exists' => 'The selected admin does not exist.',
            'language_id.exists' => 'The selected language does not exist.',
            'level_diffuculty.required' => 'The difficulty level is required.',
            'level_prize.required' => 'The prize is required.',
            'level_task.required' => 'The task is required.',
        ];
    }
}
