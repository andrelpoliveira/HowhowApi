<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSelfResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'                              =>  $this->name,
            'name_artistic'                     =>  $this->name_artistic,
            'business_name'                     =>  $this->business_name,
            'line_of_business'                  =>  $this->line_of_business,
            'email'                             =>  $this->email,
            'role'                              =>  $this->role,
            'category'                          =>  $this->category,
            'theme'                             =>  $this->theme,
            'language'                          =>  $this->language,
            'status'                            =>  $this->status,
            'gender'                            =>  $this->gender,
            'profile_photo_url'                 =>  $this->profile_photo_url,
        ];
    }
}
