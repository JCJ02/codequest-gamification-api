<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admin_id' => 'nullable|exists:admins,id',
            'lesson_vid' => 'required|string|max:500',
            'lesson_title' => 'required|string|max:100',
            'lesson_description' => 'required|string|max:500',
            'lesson_prize' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'lesson_vid.required' => 'The lesson video URL is required.',
            'lesson_title.required' => 'The lesson title is required.',
            'lesson_description.required' => 'The lesson description is required.',
            'lesson_prize.required' => 'The lesson prize is required.',
            'admin_id.exists' => 'The provided admin ID does not exist.',
        ];
    }
}
