<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreLanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'admin_id' => 'nullable|exists:admin,id',
            'language_title' => 'required|string|max:100',
            'language_description' => 'required|string|max:255',
        ];
    }
}
