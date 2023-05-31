<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreAgencyRequest extends FormRequest
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
            'name_artistic'     => ['required'  ,   'string'    ,   'max:255'], 
            'business_name'     => ['required'  ,   'string'    ,   'max:255'], 
            'phone'             => ['required'  ,   'string'    ,   'max:255'], 
            'landline'          => ['nullable'  ,   'string'    ,   'max:255'   ,   'unique:users'],
            'cnpj'              => ['required'  ,   'string'    ,   'max:18'    ,   'unique:users' , 'min:18'],  
            'email'             => ['required'  ,   'string'    ,   'max:255'   ,   'unique:users'], 
            'password'          => ['required'  ,   'confirmed' ,   Password::min(8)->mixedCase()->numbers()->letters()->symbols()],
        ];
    }
}
