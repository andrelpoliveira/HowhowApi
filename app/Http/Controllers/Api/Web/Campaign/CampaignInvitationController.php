<?php

namespace App\Http\Controllers\Api\Web\Campaign;

use App\Models\CampaignInvitation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignInvitations\CampaignInvitationRequest;
use App\Http\Requests\CampaignInvitations\AnswerCampaignInvitationRequest;
use App\Http\Requests\CampaignInvitations\DeleteInvitationRequest;
use App\Models\Campaign;
use App\Models\CampaignParticipants;
use App\Traits\HttpResponses;

class CampaignInvitationController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function deleteInvitation(DeleteInvitationRequest $request)
    {
        $user = auth()->user();

        $request->validated();

        if($user->role == 'brand')
        {
            if(!$invitation = CampaignInvitation::where(['id' => $request->invitation_id])->first())
            {
                return $this->invitationNotFound();
            }
            else
            {
                $campaign = Campaign::where(['id' => $invitation->campaign_id])->first();
                if($campaign->marca_id == $user->id)
                {
                    $invitation->delete();                    
                }
            }
        }
        else
        {
            return $this->itsNotBrand();
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampaignInvitationRequest $request)
    {
        $user = auth()->user();
        $request->validated($request->all());

        if($user->role == 'brand')
        {
            $campaign = Campaign::where(['id' => $request->campaign_id])->first();

            if($campaign->marca_id == $user->id)
            {
                $data = [
                    'received_message'   => $request->message,
                    'invited_influencer' => $request->influencer_id,
                    'campaign_id'        => $request->campaign_id
                ];
                if(!$campaignInvitation = CampaignInvitation::create($data))
                {
                    return $this->errorerrorAtInvitationCreation();
                }
                else
                {
                    return $this->invitationSent();
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

    public function answerInvitation(AnswerCampaignInvitationRequest $request)
    {
        $user = auth()->user();
        $request->validated($request->all());

        //se for falso/não encontrar nenhum registro
        if(!$invitation = CampaignInvitation::where(['id' => $request->invitation_id])->first())
        {  
            return $this->invitationNotFound();
        }
        else
        {
                if($request->invitation_answer == 'accepted')
                {
                    CampaignParticipants::updateOrCreate([
                        ['influencer_id' => $user->id , 'campaign_id' => $invitation->campaign_id], ['confirmationStatus' => 'accepted' , 'was_invited' => 1]
                    ]);
                }
                elseif($request->invitation_answer == 'refused')
                {
                    $invitation->is_refused = 1;
                    $invitation->save();

                    return $this->invitationRefused();
                }
                else
                {
                    return $this->unknownError();
                }
        }
    }

}
