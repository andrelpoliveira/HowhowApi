<?php

namespace App\Traits;

trait HttpResponses {

    protected function unknownError()
    {
        return response()->json([
            'error' => 'A unknown error has ocurred'
        ], 504);
    }

    protected function success ($data, $message = null , $code = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ], $code);

    }

    protected function error ($data, $message = null , $code = 400)
    {
        return response()->json([
            'error' => $data,
            'message' => $message
        ], $code);

    }

    protected function successfullyUpdated($data, $wasUpdated)
    {
        return response()->json([
            'data' => $data,
            'message' => 'success at updating' . $wasUpdated . ' .',
        ], 200);
    }


    protected function wrongPassWord ()
    {
        return response()->json([
            'error' => 'Wrong password given'
        ], 401);
    }

    /**
     * Responses da criação de usuario
     * 
    */

    protected function userRegistered()
    {
        return response()->json([
            'sucess' => 'User registered successfully'
        ], 200);
    }

    protected function errorAtCreatingUser()
    {
        return response()->json([
            'error' => 'An error has occurred at the user creation, please try again later'
        ], 500);
    }

    /*
        Responses relacionados a se o usuario é autorizado para tal endpoint
    */
    
    protected function brandDosentOwnCampaign()
    {
        return response()->json([
            'error' => 'Your brand dosent have privilage to acess this campaign'
        ], 401);
    }

    protected function itsNotInfluencer()
    {
        return response()->json([
            'error' =>  'Only influencers have acess to this action'          
        ], 401);
    }
    
    protected function itsNotAgency()
    {
        return response()->json([
            'error' =>  'Only agencys have acess to this action'          
        ], 401);
    }
    
    protected function itsNotBrand()
    {
        return response()->json([
            'error' =>  'Only brands have acess to this action'          
        ], 401);
    }

    protected function dosentOwnRights()
    {
        return response()->json([
            'error' =>  'User dosent have rights do this action'          
        ], 401);
    }

    /*
    * Responses relacionadas ao convite para campanhas
    */


    protected function invitationNotFound()
    {
        return response()->json([
            'error' => 'The invitation was not found, it may been canceled by the author'
        ], 401);
    }

    protected function invitationAccepted()
    {
        return response()->json([
            'success' => 'The invitation was accepted'
        ], 200);
    }

    protected function invitationRefused()
    {
        return response()->json([
            'success' => 'The invitation was refused'
        ], 200);
    }

    protected function invitationDeleted()
    {
        return response()->json([
            'success' => 'The invitation was deleted'
        ], 200);
    }

    protected function errorAtInvitationCreation()
    {
        return response()->json([
            'error' => 'Error at sending invitation.'
        ], 500);
    }

    protected function invitationSent()
    {
        return response()->json([
            'success' => 'Invitation sent'
        ], 200);
    }    

    /*
    responses relacionadas a campanhas
    */

    protected function campaignClosed()
    {
        return response()->json([
            'success' => 'Campaign was ended with success.'
        ], 200);
    }

    protected function successfullyUpdatedCampaign($campaign)
    {
       return response()->json([
            'success' => 'Campaign was successfully updated',
            'campaign' => $campaign
       ],200); 
    }

    protected function successfullyCreatedCampaign($campaign)
    {
        return response()->json([
            'success' => 'Campaign was successfully created',
            'campaign' => $campaign
        ],200); 
    }

    protected function errorAtCampaignCreation()
    {
        return response()->json([
            'error' => 'Error at creating campaign.'
        ], 500);
    }

    protected function errorAtCampaignUpdate()
    {
        return response()->json([
            'error' => 'Error at updating campaign'
        ], 500);
    }

    protected function campaignNotFound()
    {
        return response()->json([
            'error' => 'campaign not found'
        ], 404);
    }

    protected function errorAtJoiningCampaign()
    {
        return response()->json([
            'error' => 'Error at joining campaign'
        ], 500);
    }

    protected function successAtJoiningCampaign($campaignName)
    {
        return response()->json([
            'success' => 'success at joining campaign ' . $campaignName
        ], 200);
    }
}