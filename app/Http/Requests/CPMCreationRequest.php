<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CPMCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'yt_vd_insertion'       =>  ['nullable'],
            'yt_vd_dedicated'       =>  ['nullable'],
            'yt_repost'             =>  ['nullable'],
            'yt_post_community'     =>  ['nullable'],
            'yt_short'              =>  ['nullable'],
            'yt_sh_insertion'       =>  ['nullable'],
            'yt_live'               =>  ['nullable'],
            'yt_presential'         =>  ['nullable'],
            'ist_combo'             =>  ['nullable'],
            'ist_insertion'         =>  ['nullable'],
            'ist_vd_dedicated'      =>  ['nullable'],
            'ist_post'              =>  ['nullable'],
            'ist_repost'            =>  ['nullable'],
            'ist_live'              =>  ['nullable'],
            'fb_combo'              =>  ['nullable'],
            'fb_post_feed'          =>  ['nullable'],
            'fb_vd_dedicated'       =>  ['nullable'],
            'fb_repost'             =>  ['nullable'],
            'fb_story'              =>  ['nullable'],
            'fb_live'               =>  ['nullable'],
            'tw_retweet'            =>  ['nullable'],
            'tw_post'               =>  ['nullable'],
            'kw_insertion'          =>  ['nullable'],
            'kw_vd_insertion'       =>  ['nullable'],
            'kw_repost'             =>  ['nullable'],
            'kw_live'               =>  ['nullable'],
            'tk_insertion'          =>  ['nullable'],
            'tk_vd_dedicated'       =>  ['nullable'],
            'tk_repost'             =>  ['nullable'],
            'tk_live'               =>  ['nullable'],
            'tk_impulse'            =>  ['nullable'],
            'tk_selectedRadio'      =>  ['nullable'],
            'hw_remarketing'        =>  ['nullable'],
            'hw_link_bio'           =>  ['nullable'],
            'hw_link_description'   =>  ['nullable'],
            'hw_link_comment'       =>  ['nullable'],
        ];
    }
}
