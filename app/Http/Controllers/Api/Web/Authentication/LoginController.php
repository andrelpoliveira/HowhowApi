<?php

namespace App\Http\Controllers\Api\Web\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());
        
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if(!User::where(['email' => $request->email])->first())
        {
            return $this->error('', 'User dosent exist', 401);
        }

        if(!$token = auth()->attempt($credentials))
        {
            return $this->error('An error has occurred', 'Credentials do not match', 401);
        }
        
        return $this->success([
            'token' => $token
        ], 'Sucess');

    }

    public function logout()
    {
        auth()->logout();

        return $this->success('sucess', 'Successfully logged out');
    }
}
