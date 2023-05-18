<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfluencersGetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'                  => $this->name,
            'name_artistic'         => $this->name_artistic,
            'gender'                => $this->gender,
            'birthday'              => $this->birthday,
            'profile_photo_path'    => $this->profile_photo_path,
        ];
    }
}
