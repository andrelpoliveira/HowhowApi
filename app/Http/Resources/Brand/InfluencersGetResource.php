<?php

namespace App\Http\Resources\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
            'profile_photo_path'    => Storage::disk('s3')->temporaryUrl('profile_photo/'.$this->id.$this->profile_photo_path , now()->addMinutes(5)),
        ];
    }
}
