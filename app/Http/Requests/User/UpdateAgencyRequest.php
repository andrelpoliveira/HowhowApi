<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateAgencyRequest extends FormRequest
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
            'name_artistic'     => ['string'    ,   'max:255', 'unique:users'], 
            'business_name'     => ['string'    ,   'max:255', 'unique:users'],
            'about_me'          => ['string', 'nullable'], 
            'phone'             => ['string'    ,   'unique:users'],
            'phone2'            => ['string'    ,   'unique:users'],
            'landline'          => ['string'    ,   'unique:users'], 
            'cnpj'              => ['string'    ,   'max:18'  , 'unique:users' , 'min:18'], 
            'email'             => ['string'    ,   'max:255' , 'unique:users'], 
            'email2'            => ['string'    ,   'max:255' , 'unique:users'], 
            'country'           => ['nullable'],  
            'language'          => ['string'],
            'password'          => ['string'    ,   'max:255' , 'confirmed', Password::min(8)->mixedCase()->numbers()->letters()->symbols()],
            'profile_photo'     => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'background_photo'  => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
        ];
    }
}
