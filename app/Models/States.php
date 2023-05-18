<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Countries;


class States extends Model
{
    use HasFactory;

    public function parentCategorie(): BelongsTo
    {
        return $this->belongsTo(ParentCategorie::class, 'belongs_to');
    }
}
