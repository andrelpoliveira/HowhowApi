<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class WrapUpRegisterRequest extends FormRequest
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
            'name_artistic'                 => ['required'  ,   'string'    ,   'unique:users'],
            'language'                      => ['nullable'  ,   'string'],
            'category'                      => ['required' ],
            'cpf'                           => ['required'  ,   'string'    ,   'unique:users'],
            'birthday'                      => ['required'  ,   'string'],
            'phone'                         => ['required'  ,   'string'    ,   'unique:users'],
            'phone2'                        => ['nullable'  ,   'string'    ,   'unique:users'],
            'landline'                      => ['nullable'  ,   'string'    ,   'unique:users'],
            'profile_photo'                 => ['required'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'background_photo'              => ['nullable'  ,   'max:5120'  ,   'mimes:png,jpg,jpeg'],
            'email2'                        => ['nullable'  ,   'unique:users']
        ];
    }
}
