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
            'name'              =>  ['required'    ,    'string'    ,   'unique:campaigns'],
            'campaign_purpose'  =>  ['required'    ,    'string'],
            'states'            =>  ['nullable'    ,    'string'],
            'social_media'      =>  ['required'],
            'content_type'      =>  ['required'],
            'private'           =>  ['nullable'],
            'campaign_photo'    =>  ['max:5120']
        ];
    }
}
