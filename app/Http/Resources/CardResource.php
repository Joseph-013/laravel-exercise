<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(
            Auth::user()->role === 'admin' ? [
                'user_id' => $this->user_id,
            ] : [],
            [
                'id' => $this->id,
                'profile_picture' => $this->profile_picture,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'title' => $this->title,
                'id_code' => $this->id_code,
                'contact' => $this->contact,
                'blood_type' => $this->blood_type,
            ]
        );
    }
}
