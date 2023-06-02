<?php

namespace App\Http\Requests\CampaignParticipants;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
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
            'participation_id'    =>  ['required' , 'exists:campaign_participants,id'],
            'status'              =>  ['required']
        ];
    }
}
