<?php

namespace App\Http\Resources\Campaign;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignShowToOwnerListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'brand_name'        => $this->brand_name,
            'budget'            => $this->budget,
            'category'          => $this->category,
            'brand_info'        => $this->brand_info,
            'states'            => $this->states,
            'line_of_business'  => $this->line_of_business,
            'category'          => $this->category,
            'campaign_photo'    => $this->campaign_photo,
        ];
    }
}
