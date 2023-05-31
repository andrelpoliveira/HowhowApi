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
            'budget'            => $this->budget,
            'line_of_business'  => $this->line_of_business,
            'campaign_photo'    => $this->campaign_photo,
            'private'           => $this->private,
            'ended'             => $this->ended,
        ];
    }
}
