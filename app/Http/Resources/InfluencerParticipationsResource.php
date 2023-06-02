<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class InfluencerParticipationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'confirmationStatus'    =>  $this->confirmationStatus,
            'was_invited'           =>  $this->was_invited,
            'campaign'              =>  [
                'campaign_name'     =>  $this->campaign->name,
                'brand_name'        =>  $this->campaign->brand_name,
                'brand_info'        =>  $this->campaign->brand_info,
                'campaign_purpose'  =>  $this->campaign->campaign_purpose,
                'states'            =>  json_decode($this->campaign->states),
                'line_of_business'  =>  $this->campaign->line_of_business,
                'social_media'      =>  json_decode($this->campaign->social_media),
                'content_type'      =>  json_decode($this->campaign->content_type),
                'private'           =>  $this->campaign->private,
                'ended'             =>  $this->campaign->ended,
                'campaign_photo'    =>  Storage::disk('s3')->temporaryUrl($this->campaign->campaign_photo, now()->addMinutes(5)),
            ]
        ];
    }
}
