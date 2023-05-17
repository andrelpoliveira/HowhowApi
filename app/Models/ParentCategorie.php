<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Categorie;

class ParentCategorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_categorie'
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Categorie::class, 'categorie');
    }
}
