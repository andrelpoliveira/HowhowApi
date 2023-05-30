<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateInfluencerRequest extends FormRequest
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
            'email'                         => ['nullable', 'email'     ,   'unique:users'],
            'email2'                        => ['nullable', 'email'    ,   'unique:users'],
            'name_artistic'                 => ['nullable', 'string'    ,   'unique:users'],
            'username'                      => ['nullable', 'string'    ,   'unique:users'],
            'language'                      => ['nullable', 'string'],  
            'category'                      => ['nullable', 'string'],  
            'adress'                        => ['nullable', 'string'], 
            'cpf'                           => ['nullable'  ,   'string'],
            'birthday'                      => ['nullable'  ,   'string'],
            'phone'                         => ['string'    ,   'unique:users'  ,   'nullable'],
            'phone2'                        => ['string'    ,   'unique:users'  ,   'nullable'],
            'landline'                      => ['string'    ,   'unique:users'],
            'country'                       => ['nullable'],
            'background_photo'              => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'background_photo'              => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'password'                      => ['nullable'  ,   'string'    ,   'max:255' , 'confirmed', Password::min(8)->mixedCase()->numbers()->letters()->symbols()],
        ];
    }
}
