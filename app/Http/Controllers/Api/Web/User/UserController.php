<?php

namespace App\Http\Controllers\Api\Web\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAgencyRequest;
use App\Http\Requests\User\UpdateBrandRequest;
use App\Http\Requests\User\UpdateInfluencerRequest;
use App\Http\Requests\User\WrapUpRegisterRequest;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\UpdateProfileResource;
use App\Http\Resources\UserSelfResource;
use App\Traits\HttpResponses;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{

    use HttpResponses;

    //Responsavel pela finalização do registro do influenciador
    public function wrapUpRegisterInfluencer(WrapUpRegisterRequest $request)
    {
        $request->validated($request->all());

        $user = auth()->user();

        if($user->role == 'influencer')
        {

            $user->category = json_encode($request->category);
            $user->category = $request->cpf;
            $user->category = $request->birthday;
            $user->category = $request->phone;

            if($request->exists('landline'))
            {
                $user->landline = $request->landline;
            }
            
            $image = $request->profile_photo;
            $uuid = Uuid::uuid4()->toString();
            $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
            $user->profile_photo_path = $uuid;

            $user->save();

            return $this->success($uuid, 'user registration completed');

        }
        else
        {
            return $this->itsNotInfluencer();
        }

    }

    public function updateInfluencer(UpdateInfluencerRequest $request)
    {
        $user = auth()->user();

        $request->validated($request->all());

        if($user->role == 'influencer')
        {

            if($request->exists('email'))
            {
                $user->email = $request->email;
            }

            if($request->exists('name_artistic'))
            {
                $user->name_artistic = $request->name_artistic;
            }

            if($request->exists('language'))
            {
                $user->language = $request->language;
            }

            if($request->exists('category'))
            {
                $user->category = json_encode($request->category);
            }
            
            if($request->exists('cpf'))
            {
                $user->cpf = $request->cpf;
            }

            if($request->exists('birthday'))
            {
                $user->birthday = $request->birthday;
            }

            if($request->exists('phone'))
            {
                $user->phone = $request->phone;
            }

            if($request->exists('landline'))
            {
                $user->landline = $request->landline;
            }

            if($request->exists('profile_photo'))
            {
                $image = $request->profile_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->profile_photo_path = $uuid;

            }

            if($request->exists('password'))
            {
                $user->password = $request->password;
            }

            $user->save();

            return $this->success([
                $user
            ], 'sucess at updating user');

        }
        else
        {
            return $this->itsNotInfluencer();
        }

    }

    /*
        realiza o update da marca baseado no que vem na request
    */
    public function updateBrand(UpdateBrandRequest $request)
    {
        $user = auth()->user();

        $request->validated($request->all());


        if($user->role == 'brand')
        {

            if($request->exists('name_artistic'))
            {
                $user->password = $request->password;
            }
            if($request->exists('business_name'))
            {
                $user->password = $request->password;
            }
            if($request->exists('phone'))
            {
                $user->password = $request->password;
            }
            if($request->exists('landline'))
            {
                $user->password = $request->password;
            }
            if($request->exists('cnpj'))
            {
                $user->password = $request->password;
            }
            if($request->exists('line_of_business'))
            {
                $user->password = $request->password;
            }
            if($request->exists('email'))
            {
                $user->password = $request->password;
            }
            if($request->exists('password'))
            {
                $user->password = $request->password;
            }
            if($request->exists('profile_photo'))
            {
                $image = $request->profile_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->profile_photo_path = $uuid;
            }     
            
            $user->save();

            return $this->success([
                $user
            ], 'sucess at updating user');

        }

        else

        {
            return $this->itsNotBrand();
        }

    }
    /*
        realiza o update da agência baseado no quem na request
    */
    public function updateAgency(UpdateAgencyRequest $request)
    {
        $user = auth()->user();

        $request->validated($request->all());

        if($user->role == 'agency')
        {
            if($request->exists('name_artistic'))
            {
                $user->password = $request->password;
            }
            if($request->exists('business_name'))
            {
                $user->password = $request->password;
            }
            if($request->exists('phone'))
            {
                $user->password = $request->password;
            }
            if($request->exists('cnpj'))
            {
                $user->password = $request->password;
            }
            if($request->exists('email'))
            {
                $user->password = $request->password;
            }
            if($request->exists('password'))
            {
                $user->password = $request->password;
            }
            if($request->exists('landline'))
            {
                $user->password = $request->password;
            }
            if($request->exists('profile_photo'))
            {
                $image = $request->profile_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->profile_photo_path = $uuid;  
            }

            $user->save();

            return $this->success([
                $user
            ], 'sucess at updating user');

        }

        else

        {
            return $this->itsNotAgency();
        }
        

    }
    
    public function getSelf()
    {
        return new UserSelfResource(auth()->user());
    }

    public function getInfluencers()
    {
        $user = auth()->user();
        
        if($user->role == 'brand')
        {
            return CategoriesResource::collection(User::where(['role' => 'influencer'])->get());
        }
        else
        {
            return $this->dosentOwnRights();
        }

    }

    public function getProfile()
    {
        return new UpdateProfileResource(auth()->user());
    }
}
