<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignParticipants extends Model
{
    use HasFactory;

    protected $fillable = [
        'influencer_id',
        'campaign_id',
        'confirmationStatus'
    ];

    public function influencerForeignKey(): BelongsTo
    {
        return $this->belongsTo(User::class, 'influencer_id');
    }

    public function campaignForeignKey(): BelongsTo
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
