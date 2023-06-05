<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserCpmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'yt_vd_insertion'       =>$this->yt_vd_insertion,
            'yt_vd_dedicated'       =>$this->yt_vd_dedicated,
            'yt_repost'             =>$this->yt_repost,
            'yt_post_community'     =>$this->yt_post_community,
            'yt_short'              =>$this->yt_short,
            'yt_sh_insertion'       =>$this->yt_sh_insertion,
            'yt_live'               =>$this->yt_live,
            'yt_presential'         =>$this->yt_presential,
            'ist_combo'             =>$this->ist_combo,
            'ist_insertion'         =>$this->ist_insertion,
            'ist_vd_dedicated'      =>$this->ist_vd_dedicated,
            'ist_post'              =>$this->ist_post,
            'ist_repost'            =>$this->ist_repost,
            'ist_live'              =>$this->ist_live,
            'fb_combo'              =>$this->fb_combo,
            'fb_post_feed'          =>$this->fb_post_feed,
            'fb_vd_dedicated'       =>$this->fb_vd_dedicated,
            'fb_repost'             =>$this->fb_repost,
            'fb_story'              =>$this->fb_story,
            'fb_live'               =>$this->fb_live,
            'tw_retweet'            =>$this->tw_retweet,
            'tw_post'               =>$this->tw_post,
            'kw_insertion'          =>$this->kw_insertion,
            'kw_vd_insertion'       =>$this->kw_vd_insertion,
            'kw_repost'             =>$this->kw_repost,
            'kw_live'               =>$this->kw_live,
            'tk_insertion'          =>$this->tk_insertion,
            'tk_vd_dedicated'       =>$this->tk_vd_dedicated,
            'tk_repost'             =>$this->tk_repost,
            'tk_live'               =>$this->tk_live,
            'tk_impulse'            =>$this->tk_impulse,
            'tk_selectedRadio'      =>$this->tk_selectedRadio,
            'hw_remarketing'        =>$this->hw_remarketing,
            'hw_link_bio'           =>$this->hw_link_bio,
            'hw_link_description'   =>$this->hw_link_description,
            'hw_link_comment'       =>$this->hw_link_comment,
        ];
    }
}
