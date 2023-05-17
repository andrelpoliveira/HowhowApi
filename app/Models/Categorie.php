<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ParentCategorie;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'belongs_to',
        'categorie',
        'icon',
        'active',
    ];

    public function parentCategorie(): BelongsTo
    {
        return $this->belongsTo(ParentCategorie::class, 'belongs_to');
    }
}
