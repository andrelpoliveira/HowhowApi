<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Campaign;

class CampaignInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'invited_influencer',
        'campaign_id'
    ];

    public function influencerForeignKey(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_influencer');
    }

    public function campaignForeignKey(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
