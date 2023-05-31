<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateProfileResource extends JsonResource
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
            'email2'                            =>  $this->email2,
            'category'                          =>  $this->category,
            'gender'                            =>  $this->gender,
            'cpf'                               =>  $this->cpf,
            'cnpj'                              =>  $this->cnpj,
            'country'                           =>  $this->country,
            'state'                             =>  $this->state,
            'adress'                            =>  json_decode($this->adress),
            'birthday'                          =>  $this->birthday,
            'landline'                          =>  $this->landline,
            'phone'                             =>  $this->phone,
            'phone2'                            =>  $this->phone2,
            'about_me'                          =>  $this->about_me,
            'theme'                             =>  $this->theme,
            'language'                          =>  $this->language,
            'status'                            =>  $this->status,
            'profile_photo_path'                =>  $this->profile_photo_url,
            'background_photo_path'             =>  $this->background_photo_path
        ];
    }
}
