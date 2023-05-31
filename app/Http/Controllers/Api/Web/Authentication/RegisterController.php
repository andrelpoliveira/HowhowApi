<?php

namespace App\Http\Controllers\Api\Web\Authentication;


use App\Http\Requests\Register\{
    StoreAgencyRequest,
    StoreBrandRequest,
    StoreInfluencerRequest
};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use HttpResponses;

    public function registerInfluencer(StoreInfluencerRequest $request)
    {
        $request->validated();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'influencer'
        ];

        if(!$user = User::create($data))
        {
            return $this->errorAtCreatingUser();
        }
        else
        {
            return $this->userRegistered();
        }

    }

    public function registerBrand(StoreBrandRequest $request)
    {
        
        $request->validated();

        $data = [
            'name_artistic'     => $request->name_artistic,
            'business_name'     => $request->business_name,
            'phone'             => $request->phone,
            'landline'          => $request->landline,
            'cnpj'              => $request->cnpj,
            'line_of_business'  => $request->line_of_business,
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role'              => 'brand'
        ];

        if(!$user = User::create($data))
        {
            return $this->errorAtCreatingUser();
        }
        else
        {
            return $this->userRegistered();
        }

    }

    public function registerAgency(StoreAgencyRequest $request)
    {

        $request->validated();

        $data = [
            'name_artistic'     => $request->name_artistic,
            'business_name'     => $request->business_name,
            'phone'             => $request->phone,
            'landline'          => $request->landline,
            'cnpj'              => $request->cnpj,
            'line_of_business'  => 'Agência',
            'email'             => $request->email,
            'password'          => Hash::make($request->password),
            'role'              => 'agency'
            ];  

        if(!$user = User::create($data))
        {
            return $this->errorAtCreatingUser();
        }
        else
        {
            return $this->userRegistered();
        }

    }

}
