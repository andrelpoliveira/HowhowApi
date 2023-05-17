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
            'username'                          =>  $this->username,
            'line_of_business'                  =>  $this->line_of_business,
            'email'                             =>  $this->email,
            'role'                              =>  $this->role,
            'category'                          =>  $this->category,
            'landline'                          =>  $this->landline,
            'phone'                             =>  $this->phone,
            'theme'                             =>  $this->theme,
            'language'                          =>  $this->language,
            'status'                            =>  $this->status,
            'email_verified_at'                 =>  $this->email_verified_at,
            'current_team_id'                   =>  $this->current_team_id,
            'profile_photo_path'                =>  $this->profile_photo_path,
            'gender'                            =>  $this->gender,
            'profile_photo_url'                 =>  $this->profile_photo_url,
        ];
    }
}
