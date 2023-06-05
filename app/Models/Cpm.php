<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cpm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'yt_vd_insertion',
        'yt_vd_dedicated',
        'yt_repost',
        'yt_post_community',
        'yt_short',
        'yt_sh_insertion',
        'yt_live',
        'yt_presential',
        'ist_combo',
        'ist_insertion',
        'ist_vd_dedicated',
        'ist_post',
        'ist_repost',
        'ist_live',
        'fb_combo',
        'fb_post_feed',
        'fb_vd_dedicated',
        'fb_repost',
        'fb_story',
        'fb_live',
        'tw_retweet',
        'tw_post',
        'kw_insertion',
        'kw_vd_insertion',
        'kw_repost',
        'kw_live',
        'tk_insertion',
        'tk_vd_dedicated',
        'tk_repost',
        'tk_live',
        'tk_impulse',
        'tk_selectedRadio',
        'hw_remarketing',
        'hw_link_bio',
        'hw_link_description',
        'hw_link_comment',
    ];

    public function ownerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
