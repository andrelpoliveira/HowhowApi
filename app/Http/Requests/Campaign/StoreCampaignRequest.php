<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
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
            'name'              =>  ['required' , 'string', 'unique:campaigns'],
            'budget'            =>  ['required' , 'string'], 
            'brand_info'        =>  ['string'],
            'campaign_purpose'  =>  ['required' , 'string'],
            'min_reach'         =>  ['string'],
            'states'            =>  ['string'],
            'line_of_business'  =>  ['required' , 'string'],
            'category'          =>  ['string'],
            'social_media'      =>  ['required' , 'string'],
            'content_type'      =>  ['required' , 'string'],
            'type'              =>  ['required' , 'string'],
            'private'           =>  ['required' , 'string'],
            'campaign_photo'    =>  ['required' , 'max:5120' , 'mimes:png,jpg,jpeg']
        ];
    }
}
