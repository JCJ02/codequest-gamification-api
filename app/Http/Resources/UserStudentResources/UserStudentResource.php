<?php

namespace App\Http\Resources\UserStudentResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserStudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'role' => $this->role,
            'username' => $this->username,
            'user_password' => $this->user_password,
        ];
    }
}
