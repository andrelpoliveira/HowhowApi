<?php

namespace App\Http\Requests\CampaignInvitations;

use Illuminate\Foundation\Http\FormRequest;

class DeleteInvitationRequest extends FormRequest
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
            'invitation_id' => ['required']
        ];
    }
}
