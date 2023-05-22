<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CampaignParticipants;
use App\Models\campaignInvitation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'name',
        'brand_name',
        'brand_info',
        'campaign_purpose',
        'states',
        'line_of_business',
        'social_media',
        'content_type',
        'private',
        'ended',
        'campaign_photo'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'marca_id');
    }

    public function participants():HasMany
    {
        return $this->hasMany(CampaignParticipants::class);
    }

    public function campaignInvitation(): HasMany
    {
        return $this->hasMany(CampaignInvitation::class);
    }
}
