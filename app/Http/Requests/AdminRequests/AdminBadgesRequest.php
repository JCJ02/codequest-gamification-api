<?php

namespace App\Http\Requests\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBadgesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'admin_id' => 'nullable|exists:admin,id',
            'badge_name' => 'required|string|max:100',
            'badge_picture' => 'required|string|max:100',
            'badge_description' => 'required|string|max:100',
            'badge_requirements' => 'required|string|max:100',
        ];
    }
}
