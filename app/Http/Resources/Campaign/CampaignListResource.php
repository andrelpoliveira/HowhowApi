<?php

namespace App\Http\Resources\Campaign;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'states'            => $this->states,
            'line_of_business'  => $this->line_of_business,
            'campaign_photo'    => $this->campaign_photo,
            'private'           => $this->private,
            'ended'             => $this->ended,
            'social_media'      => $this->social_media,
            'content_type'      => $this->content_type,
        ];
    }
}
