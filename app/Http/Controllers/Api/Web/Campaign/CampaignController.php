<?php

namespace App\Http\Controllers\Api\Web\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\DeleteCampaignRequest;
use App\Http\Requests\Campaign\StoreCampaignRequest;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Http\Requests\Store\ShowCampaignRequest;
use App\Http\Resources\Campaign\CampaignListResource;
use App\Http\Resources\CampaignShowResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\CampaignParticipants;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class CampaignController extends Controller
{

    use HttpResponses;

    /**
     * retorna uma response de todas as campanhas, irá checar se usuário tem acesso para esse tipo de conteudo.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'brand') {
            return CampaignListResource::collection(Campaign::whereBelongsTo($user)->get());
        } else {
            return CampaignListResource::collection(Campaign::where(['private' => 0, 'ended' => 0])->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        $request->validated();

        $user = auth()->user();
        //return dd($request->social_media);
        if($user->role == 'brand')
        {
            $image = $request->campaign_photo;
            $uuidFolder = Uuid::uuid4()->toString();
            $uuidFileName = Uuid::uuid4()->toString();
            $path = 'campaign_photo/'.$uuidFolder;
            $campaign_photo_path = Storage::disk('s3')->putFileAs($path , $image , $uuidFileName);

            //trata o Json vindo da requisição/Request
            $searchFor = array("{", "}", '""', '"');
            $stringHandled = str_replace($searchFor, "" , $request->content_type);
            $stringHandled2 = explode(',' ,$stringHandled);
            //precisa
            $socialMedia = [];
            // X ira ser divido em string e valor que ira para um array nomeado, a string sera o nome da casa e o valor sera atribuido
            foreach($stringHandled2 as $x)
            {
                $stringExploded = explode(':' ,$x);
                if($stringExploded[1] == "" || $stringExploded[1] == "false" || $stringExploded[1] == "0"){
                    continue;
                }
                else
                {
                    $associativeArray = [
                        $stringExploded[0] => $stringExploded[1]
                    ];
                    $socialMedia = $socialMedia + $associativeArray;
                }
            }

            $data = [
                'marca_id'          => $user->id,
                'name'              => $request->name,
                'brand_name'        => $user->name_artistic,
                'brand_info'        => $user->about_me,
                'campaign_purpose'  => $request->campaign_purpose,
                'states'            => json_encode($request->states, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE),
                'line_of_business'  => $user->line_of_business,
                'social_media'      => $request->social_media,
                'content_type'      => json_encode($socialMedia, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE),
                'private'           => $request->private,
                'campaign_photo'    => $campaign_photo_path
            ];
            $campaign = Campaign::create($data);

            return $this->successfullyCreatedCampaign($campaign);
        }
        else
        {
            return $this->itsNotBrand();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowCampaignRequest $request)
    {
        $user = auth()->user();
        $request->validated();

        $campaign = Campaign;

        if(!$campaign->where(['name' => $request->name])->first())
        {
            
        }

        // if ($user->role == 'brand') {
        //     $campaign = Campaign::where(['name' => $request->name])->first();

        //     if ($campaign->marca_id == $user->id) {
        //         $participants = CampaignParticipants::where(['campaign_id' => $campaign->id])->get();

        //         return $this->success([
        //             'campaign'      => $campaign,
        //             'participants'  => $participants
        //         ]);
        //     } else {
        //         return $this->brandDosentOwnCampaign();
        //     }
        // } else {
        //     return CampaignListResource::collection(Campaign::where(['name' => $request->name])->first());
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignRequest $request)
    {

        $user = auth()->user();

        if ($user->role == 'brand') {
            $request->validated($request->all());

            if (Hash::check(request('password'), auth()->user()->password)) {

                $campaign = Campaign::where(['id' => $request->id]);

                if ($request->exists('name')) {
                    $campaign->name = $request->name;
                }

                if ($request->exists('budget')) {
                    $campaign->budget = $request->budget;
                }

                if ($request->exists('brand_info')) {
                    $campaign->brand_info = $request->brand_info;
                }

                if ($request->exists('campaign_purpose')) {
                    $campaign->campaign_purpose = $request->campaign_purpose;
                }

                if ($request->exists('min_reach')) {
                    $campaign->min_reach = $request->min_reach;
                }

                if ($request->exists('states')) {
                    $campaign->states = json_encode($request->states, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE);
                }

                if ($request->exists('line_of_business')) {
                    $campaign->line_of_business = $request->line_of_business;
                }

                if ($request->exists('social_media')) {
                    $campaign->social_media = json_encode($request->social_media, JSON_UNESCAPED_SLASHES, JSON_UNESCAPED_UNICODE);
                }

                if ($request->exists('private')) {
                    $campaign->private = $request->private;
                }
                if ($request->exists('campaign_photo')) {
                    $photo_path_exploded = explode("/", $campaign->campaign_photo);

                    $image = $request->file('image');

                    $uuid = Uuid::uuid4()->toString();

                    $image->storeAs('campaign_photo/' . $photo_path_exploded[0], $uuid, 's3');

                    $campaign->campaign_photo = $photo_path_exploded . $uuid;
                }

                $campaign->save();

                return $this->successfullyUpdatedCampaign($campaign);
            } else {
                return $this->wrongPassWord();
            }
        } else {
            return $this->itsNotBrand();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function endcampaign(DeleteCampaignRequest $request)
    {
        $request->validated($request->all());

        $user = auth()->user();

        if (Hash::check(request('password'), auth()->user()->password)) {

            if ($user->role == 'brand') {

                $campaign = Campaign::where(['id' => $request->id])->first();

                if ($user->id == $campaign->marca_id) {
                    $campaign->ended = 1;
                    $campaign->private = 1;
                    $campaign->save();

                    return $this->campaignClosed();
                }
            } else {
                return $this->itsNotBrand();
            }
        } else {
            return $this->wrongPassWord();
        }
    }


    //rotas para se quiser entender como funciona o upload de foto e download

    public function photoUpload(Request $request)
    {
        $campaign = Campaign::where(['id' => 6])->first();

        $file = $request->file('campaign_photo');
        $uuidFolder = Uuid::uuid4()->toString();
        $uuidFileName = Uuid::uuid4()->toString();
        $path = 'campaign_photo/'.$uuidFolder;
        $path = Storage::disk('s3')->putFileAs($path , $file , $uuidFileName);
        dd($path);
    }

    public function photoDownload()
    {
        $user = auth()->user();

        dd(Storage::disk('s3')->temporaryUrl('profile_photo/' . $user->id . '/ad92d9c9-3c01-4c05-84d7-dc03f0c47272', now()->addMinutes(5)));
    }

    public function photoPatch(Request $request)
    {
        $campaign = Campaign::where(['id' => 9])->first();

        $photo_path_exploded = explode("/", $campaign->campaign_photo);

        $image = $request->file('image');
        $uuid = Uuid::uuid4()->toString();
    }

    public function tratamentojson()
    {
        $campanha = Campaign::where(['id' => '9'])->first();

        $searchFor = array("{", "}", '""', '"');
        $stringHandled = str_replace($searchFor, "" , $campanha->content_type);
        $stringHandled2 = explode(',' ,$stringHandled);

        //precisa
        $socialMedia = [];
        // X ira ser divido em string e valor que ira para um array nomeado, a string sera o nome da casa e o valor sera atribuido
        foreach($stringHandled2 as $x)
        {
            $stringExploded = explode(':' ,$x);
            if($stringExploded[1] == "" || $stringExploded[1] == "false" || $stringExploded[1] == "0"){
                continue;
            }
            else
            {
                $associativeArray = [
                    $stringExploded[0] => $stringExploded[1]
                ];
                $socialMedia = $socialMedia + $associativeArray;
            }
        }
        // $socialmedia json limpo e tratado
    }
}
