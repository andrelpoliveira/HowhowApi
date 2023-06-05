<?php

namespace App\Http\Controllers\Api\Web\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateAgencyRequest;
use App\Http\Requests\User\UpdateBrandRequest;
use App\Http\Requests\User\UpdateInfluencerRequest;
use App\Http\Requests\User\WrapUpRegisterRequest;
use App\Http\Resources\Brand\InfluencersGetResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\UpdateProfileResource;
use App\Http\Resources\UserSelfResource;
use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{

    use HttpResponses;

    //Responsavel pela finalização do registro do influenciador
    public function wrapUpRegisterInfluencer(WrapUpRegisterRequest $request)
    {
        $request->validated();

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
            if($request->exists('about_me'))
            {
                $user->about_me = $request->about_me;
            }
            if($request->exists('country'))
            {
                $user->country = $request->country;
            }
            if($request->exists('state'))
            {
                $user->state = $request->state;
            }
            if($request->exists('adress'))
            {
                $user->adress = json_encode($request->adress, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE);
            }
            if($request->exists('background_photo'))
            {
                $image = $request->background_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->background_photo_path = $uuid;
            }
            if($request->exists('phone2'))
            {
                $user->phone2 = $request->phone2;
            }
            if($request->exists('email2'))
            {
                $user->email2 = $request->email2;
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

        $request->validated();
                        
        if($user->role == 'influencer')
        {

            if($request->exists('email'))
            {
                $user->email = $request->email;
            }
            if($request->exists('email2'))
            {
                $user->email2 = $request->email2;
            }
            if($request->exists('name_artistic'))
            {
                $user->name_artistic = $request->name_artistic;
            }
            if($request->exists('adress'))
            {
                $user->adress = $request->adress;
            }
            if($request->exists('language'))
            {
                $user->language = $request->language;
            }
            if($request->exists('gender'))
            {
                $user->gender = $request->gender;
            }
            if($request->exists('category'))
            {
                $user->category = $request->category;
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
            if($request->exists('phone2'))
            {
                $user->phone2 = $request->phone2;
            }
            if($request->exists('landline'))
            {
                $user->landline = $request->landline;
            }
            if($request->exists('country'))
            {
                $user->country = $request->country;
            }
            if($request->exists('state'))
            {
                $user->state = $request->state;
            }
            if($request->exists('profile_photo'))
            {
                $image = $request->profile_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->profile_photo_path = $uuid;
            }
            if($request->exists('background_photo'))
            {
                $image = $request->background_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->background_photo_path = $uuid;
            }
            if($request->exists('password'))
            {
                $user->password = Hash::make($request->password);
            }
            if($request->exists('about_me'))
            {
                $user->about_me = $request->about_me;
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

        $request->validated();


        if($user->role == 'brand')
        {

            if($request->exists('name_artistic'))
            {
                $user->name_artistic = $request->name_artistic;
            }
            if($request->exists('business_name'))
            {
                $user->business_name = $request->business_name;
            }
            if($request->exists('country'))
            {
                $user->country = $request->country;
            }
            if($request->exists('state'))
            {
                $user->state = $request->state;
            }
            if($request->exists('adress'))
            {
                $user->adress = $request->adress;
            }
            if($request->exists('phone'))
            {
                $user->phone = $request->phone;
            }
            if($request->exists('phone2'))
            {
                $user->phone2 = $request->phone2;
            }
            if($request->exists('landline'))
            {
                $user->landline = $request->landline;
            }
            if($request->exists('cnpj'))
            {
                $user->cnpj = $request->cnpj;
            }
            if($request->exists('line_of_business'))
            {
                $user->line_of_business = $request->line_of_business;
            }
            if($request->exists('email'))
            {
                $user->email = $request->email;
            }
            if($request->exists('email2'))
            {
                $user->email2 = $request->email2;
            }
            if($request->exists('language'))
            {
                $user->language = $request->language;
            }
            if($request->exists('password'))
            {
                $user->password = Hash::make($request->password);
            }
            if($request->exists('profile_photo'))
            {
                $image = $request->profile_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->profile_photo_path = $uuid;
            }
            if($request->exists('about_me'))
            {
                $user->about_me = $request->about_me;
            }
            if($request->exists('background_photo'))
            {
                $image = $request->background_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->background_photo_path = $uuid;
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

        $request->validated();

        if($user->role == 'agency')
        {
            
            if($request->exists('name_artistic'))
            {
                $user->name_artistic = $request->paname_artisticssword;
            }
            if($request->exists('business_name'))
            {
                $user->business_name = $request->business_name;
            }
            if($request->exists('country'))
            {
                $user->country = $request->country;
            }
            if($request->exists('state'))
            {
                $user->state = $request->state;
            }
            if($request->exists('adress'))
            {
                $user->adress = $request->adress;
            }
            if($request->exists('phone'))
            {
                $user->phone = $request->phone;
            }
            if($request->exists('phone2'))
            {
                $user->phone2 = $request->phone2;
            }
            if($request->exists('cnpj'))
            {
                $user->cnpj = $request->cnpj;
            }
            if($request->exists('email'))
            {
                $user->email = $request->email;
            }
            if($request->exists('email2'))
            {
                $user->email2 = $request->email2;
            }
            if($request->exists('language'))
            {
                $user->language = $request->language;
            }
            if($request->exists('password'))
            {
                $user->password = Hash::make($request->password);
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
            if($request->exists('about_me'))
            {
                $user->about_me = $request->about_me;
            }
            if($request->exists('background_photo'))
            {
                $image = $request->background_photo;
                $uuid = Uuid::uuid4()->toString();
                $image->storeAs('profile_photo/'.$user->id , $uuid , 's3');
                $user->background_photo_path = $uuid;
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
            return InfluencersGetResource::collection(User::where(['role' => 'influencer'])->get());
        }
        else
        {
            return $this->dosentOwnRights();
        }

    }

    public function getProfile()
    {
        $user = auth()->user();
        // dd($user->adress);
        return new UpdateProfileResource(auth()->user());
    }
}
