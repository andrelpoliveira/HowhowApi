<?php

namespace App\Http\Controllers;

use App\Http\Requests\CPMCreationRequest;
use App\Http\Resources\User\GetUserCpmResource;
use App\Models\Cpm;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CpmController extends Controller
{
    use HttpResponses;

    public function getSelfCPM()
    {   
        $user = Auth()->user();
        
        if(!$cpm = Cpm::where(['user_id' => $user->id])->first())
        {
            return $this->userDosentHaveCpm();
        }
        return new GetUserCpmResource($cpm);
    }

    public function createUpdateCPM(CPMCreationRequest $request)
    {
        $user = Auth()->user();

        if($user->role == 'influencer')
        {
            $cpm = Cpm::firstOrNew([
                'user_id'   =>  $user()->id
            ]);
            if($request->exists('yt_vd_insertion'))
            {
                $cpm->yt_vd_insertion = $request->yt_vd_insertion;
            }
            if($request->exists('yt_vd_dedicated'))
            {
                $cpm->yt_vd_dedicated = $request->yt_vd_dedicated;
            }
            if($request->exists('yt_repost'))
            {
                $cpm->yt_repost = $request->yt_repost;
            }
            if($request->exists('yt_post_community'))
            {
                $cpm->yt_post_community = $request->yt_post_community;
            }
            
            if($request->exists('yt_short'))
            {
                $cpm->yt_short = $request->yt_short;
            }
            
            if($request->exists('yt_sh_insertion'))
            {
                $cpm->yt_sh_insertion = $request->yt_sh_insertion;
            }
            
            if($request->exists('yt_live'))
            {
                $cpm->yt_live = $request->yt_live;
            }
            
            if($request->exists('yt_presential'))
            {
                $cpm->yt_presential = $request->yt_presential;
            }
            
            if($request->exists('ist_combo'))
            {
                $cpm->ist_combo = $request->ist_combo;
            }
            
            if($request->exists('ist_insertion'))
            {
                $cpm->ist_insertion = $request->ist_insertion;
            }
            
            if($request->exists('ist_vd_dedicated'))
            {
                $cpm->ist_vd_dedicated = $request->ist_vd_dedicated;
            }
            
            if($request->exists('ist_post'))
            {
                $cpm->ist_post = $request->ist_post;
            }

            if($request->exists('ist_repost'))
            {
                $cpm->ist_repost = $request->ist_repost;
            }

            if($request->exists('ist_live'))
            {
                $cpm->ist_live = $request->ist_live;
            }

            if($request->exists('fb_combo'))
            {
                $cpm->fb_combo = $request->fb_combo;
            }

            if($request->exists('fb_post_feed'))
            {
                $cpm->fb_post_feed = $request->fb_post_feed;
            }

            if($request->exists('fb_vd_dedicated'))
            {
                $cpm->fb_vd_dedicated = $request->fb_vd_dedicated;
            }

            if($request->exists('fb_vd_dedicated'))
            {
                $cpm->fb_vd_dedicated = $request->fb_vd_dedicated;
            }

            if($request->exists('fb_story'))
            {
                $cpm->fb_story = $request->fb_story;
            }

            if($request->exists('fb_live'))
            {
                $cpm->fb_live = $request->fb_live;
            }
            
            if($request->exists('tw_retweet'))
            {
                $cpm->tw_retweet = $request->tw_retweet;
            }

            if($request->exists('tw_post'))
            {
                $cpm->tw_post = $request->tw_post;
            }

            if($request->exists('kw_insertion'))
            {
                $cpm->kw_insertion = $request->kw_insertion;
            }

            if($request->exists('kw_vd_insertion'))
            {
                $cpm->kw_vd_insertion = $request->kw_vd_insertion;
            }

            if($request->exists('kw_repost'))
            {
                $cpm->kw_repost = $request->kw_repost;
            }

            if($request->exists('kw_live'))
            {
                $cpm->kw_live = $request->kw_live;
            }

            if($request->exists('tk_insertion'))
            {
                $cpm->tk_insertion = $request->tk_insertion;
            }

            if($request->exists('tk_vd_dedicated'))
            {
                $cpm->tk_vd_dedicated = $request->tk_vd_dedicated;
            }

            if($request->exists('tk_repost'))
            {
                $cpm->tk_repost = $request->tk_repost;
            }

            if($request->exists('tk_live'))
            {
                $cpm->tk_live = $request->tk_live;
            }

            if($request->exists('tk_impulse'))
            {
                $cpm->tk_impulse = $request->tk_impulse;
            }

            if($request->exists('tk_selectedRadio'))
            {
                $cpm->tk_selectedRadio = $request->tk_selectedRadio;
            }

            if($request->exists('hw_remarketing'))
            {
                $cpm->hw_remarketing = $request->hw_remarketing;
            }

            if($request->exists('hw_link_bio'))
            {
                $cpm->hw_link_bio = $request->hw_link_bio;
            }

            if($request->exists('hw_link_description'))
            {
                $cpm->hw_link_description = $request->hw_link_description;
            }

            if($request->exists('hw_link_comment'))
            {
                $cpm->hw_link_comment = $request->hw_link_comment;
            }

            $cpm->save();

            return new GetUserCpmResource($cpm);
        }
        else
        {
            return $this->itsNotInfluencer();
        }
    }
}
