<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\States;

class Countries extends Model
{
    use HasFactory;


    public function states(): HasMany
    {
        return $this->hasMany(States::class, 'states');
    }
}
