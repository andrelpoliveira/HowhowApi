<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMidia extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'youtube_data',
        'instagram_data',
        'facebook_data',
        'twitch_data',
        'kwai_data'
    ];

    public function ownerUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'belongs_to');
    }
}
