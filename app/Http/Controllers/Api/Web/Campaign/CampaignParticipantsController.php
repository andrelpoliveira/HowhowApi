<?php

namespace App\Http\Controllers\Api\Web\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignParticipants\JoinCampaignRequest;
use App\Http\Requests\CampaignParticipants\ChangeStatusRequest;
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
        
        $campaign = CampaignParticipants::where(['influencer_id' => $user->id])->with('campaigns')->get();

        return $this->success($campaign);
    }

    /**
     * Entra em uma campanha
     */
    public function joinCampaign(JoinCampaignRequest $request)
    {
        $user = auth()->user();

        if($user->role == 'influencer')
        {
            CampaignParticipants::firstOrCreate(['influencer_id' => $user->id, 'campaign_id' => $request->campaign_id] , ['influencer_id' => $user->id, 'campaign_id' => $request->campaign_id]);
        }
        else
        {
            return $this->itsNotInfluencer();
        }

    }
    /**
     * Muda o status de confirmação entre aceito ou recusado
     */
    public function changeInfluencerConfirmationStatus(ChangeStatusRequest $request)
    {
        $user = auth()->user();
        $request->validated($request->all());

        /*
        *  0 -> influenciador entrou e está esperando confirmação da empresa 
        *  1 -> influenciador Aceito
        *  2 -> influenciador recusado
        */

        if($user->role == 'brand')
        {
            CampaignParticipants::where(['influencer_id' => $request->influencer_id, 'campaign_id' => $request->campaign_id])->update(['confirmationStatus' => $request->status]);
        }
        else
        {
            return $this->itsNotBrand();
        }
    }
    
    
}
