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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'                         => ['email'     ,   'unique:users'],
            'name_artistic'                 => ['string'    ,   'unique:users'],
            'username'                      => ['string'    ,   'unique:users'],
            'language'                      => ['string'],  
            'category'                      => ['string'],  
            'adress'                        => ['string'], 
            'cpf'                           => ['nullable'  ,   'string'],
            'birthday'                      => ['nullable'  ,   'string'],
            'phone'                         => ['string'    ,   'unique:users'  ,   'nullable'],
            'phone2'                        => ['string'    ,   'unique:users'  ,   'nullable'],
            'landline'                      => ['string'    ,   'unique:users'],
            'background_photo'              => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'background_photo'              => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'password'                      => ['confirmed', Password::min(8)->mixedCase()->numbers()->letters()->symbols()],
        ];
    }
}
