<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCampaignRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id'                =>  ['required'],
            'name'              =>  ['string', 'unique:campaigns'],
            'budget'            =>  ['string'], 
            'brand_info'        =>  ['string'],
            'campaign_purpose'  =>  ['string'],
            'min_reach'         =>  ['string'],
            'states'            =>  ['string'],
            'line_of_business'  =>  ['string'],
            'category'          =>  ['string'],
            'social_media'      =>  ['string'],
            'type'              =>  ['string'],
            'private'           =>  ['string'],
            'password'          =>  ['required']
        ];
    }
}
