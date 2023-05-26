<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateBrandRequest extends FormRequest
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
            'name_artistic'     => ['nullable'  ,   'string'    ,  'unique:users' ,'max:255'], 
            'business_name'     => ['nullable'  ,   'string'    ,  'unique:users' ,'max:255'],
            'about_me'          => ['string', 'nullable'],  
            'phone'             => ['nullable'  ,   'string'    ,   'max:255' , 'unique:users'],
            'phone2'            => ['nullable'  ,   'string'    ,   'max:255' , 'unique:users'], 
            'landline'          => ['nullable'  ,   'string'    ,   'unique:users'],
            'cnpj'              => ['nullable'  ,   'string'    ,   'max:18'  , 'unique:users' , 'min:18'], 
            'line_of_business'  => ['nullable'  ,   'string'    ,   'max:255'], 
            'email'             => ['nullable'  ,   'string'    ,   'unique:users'],
            'phone2'            => ['nullable'  ,   'string'    ,   'max:255' , 'unique:users'],
            'country'           => ['nullable'],
            'language'          => ['string'],  
            'password'          => ['nullable'  ,   'string'    ,   'max:255' , 'confirmed', Password::min(8)->mixedCase()->numbers()->letters()->symbols()],
            'profile_photo'     => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'background_photo'  => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
        ];
    }
}
