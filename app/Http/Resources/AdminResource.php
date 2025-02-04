<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
        ];
    }
}
