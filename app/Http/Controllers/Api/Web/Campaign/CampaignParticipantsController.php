<?php

namespace App\Http\Controllers\Api\Web\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignParticipants\JoinCampaignRequest;
use App\Http\Requests\CampaignParticipants\ChangeStatusRequest;
use App\Http\Resources\InfluencerParticipationsResource;
use App\Models\Campaign;
use App\Models\CampaignParticipants;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CampaignParticipantsController extends Controller
{
    use HttpResponses;
    /**
     * Retorna todas as campanhas que o influenciador está participando
     */
    public function whereInfluencerParticipate()
    {
        $user = auth()->user();

        return InfluencerParticipationsResource::collection( CampaignParticipants::where(['influencer_id' => $user->id])->with('campaign')->get());
    }

    /**
     * Entra em uma campanha
     */
    public function joinCampaign(JoinCampaignRequest $request)
    {
        $user = auth()->user();
        if($campaign = Campaign::where(['name' => $request->name])->first())
        {
            if($user->role == 'influencer')
            {
                if(!CampaignParticipants::firstOrCreate(['influencer_id' => $user->id, 'campaign_id' => $campaign->id] , ['influencer_id' => $user->id, 'campaign_id' => $campaign->id]))
                {
                    return $this->errorAtJoiningCampaign();
                }
                else
                {
                    return $this->successAtJoiningCampaign($campaign->name);
                }
            }
            else
            {
                return $this->itsNotInfluencer();
            }
        }
        else
        {
            return $this->campaignNotFound();
        }
    }   
    /**
     * Muda o status de confirmação entre aceito ou recusado
     */
    public function changeInfluencerConfirmationStatus(ChangeStatusRequest $request)
    {
        $user = auth()->user();
        $request->validated();
        /*
        *  0 -> influenciador entrou e está esperando confirmação da empresa 
        *  1 -> influenciador Aceito
        *  2 -> influenciador recusado
        */
        if($user->role == 'brand')
        {
            $participation  =   CampaignParticipants::where(['id' => $request->participation_id])->with(['campaign' , 'influencer'])->first();
            if($participation->campaign->marca_id == $user->id)
            {
                if($request->status == 'accepted')
                {
                    $participation->confirmationStatus == 'accepted';
                    $participation->save();

                    return $this->influencerAccepted();
                }
                elseif ($request->status == 'refused')
                {
                    $influencerName_artistic = $participation->influencer->name_artistic;
                    $influencerName          = $participation->influencer->name;
                    
                    $participation->delete();
                    
                    return $this->influencerRefused($influencerName_artistic, $influencerName);
                }

            }
            else
            {
                return $this->brandDosentOwnCampaign();
            }
        }
        else
        {
            return $this->itsNotBrand();
        }
    }
    
    
}
