<?php

namespace App\Http\Resources\AdminResources;

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
            'admin_name' => $this->admin_name,
            'admin_password' => $this->admin_password,
        ];
    }
}
