<?php

namespace App\Http\Resources\Campaign;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class CampaignListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'              => $this->name,
            'brand_name'        => $this->brand_name,
            'brand_info'        => $this->brand_info,    
            'campaign_purpose'  => $this->campaign_purpose,
            'country'           => $this->country,
            'states'            => json_decode($this->states),
            'line_of_business'  => $this->line_of_business,
            'campaign_photo'    => Storage::disk('s3')->temporaryUrl($this->campaign_photo, now()->addMinutes(5)),
            'private'           => $this->private,
            'ended'             => $this->ended,
            'social_media'      => json_decode($this->social_media),
            'content_type'      => json_decode($this->content_type),
        ];
    }
}
