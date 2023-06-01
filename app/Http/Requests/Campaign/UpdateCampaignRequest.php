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
            'campaign_name'     =>  ['required'],
            'name'              =>  ['nullable'   ,   'string', 'unique:campaigns'],
            'campaign_purpose'  =>  ['nullable'   ,   'string'],
            'country'           =>  ['nullable'   ,   'string'],
            'states'            =>  ['nullable'   ,   'string'],
            'line_of_business'  =>  ['nullable'   ,   'string'],
            'social_media'      =>  ['nullable'   ,   'string'],
            'content_type'      =>  ['nullable'],
            'private'           =>  ['nullable'   ,   'string'],
            'ended'             =>  ['nullable'],
            'campaign_photo'    =>  ['nullable'   ,   'max:5120'],
            'password'          =>  ['required']
        ];
    }
}
