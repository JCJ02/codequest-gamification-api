<?php

namespace App\Http\Requests\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateLanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'language_title' => 'nullable|string|max:100',
            'language_description' => 'nullable|string|max:255',
        ];
    }
}
