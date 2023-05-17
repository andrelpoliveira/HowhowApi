<?php

namespace App\Http\Controllers\Api\Web\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Models\Categorie;
use App\Models\ParentCategorie;
use App\Traits\HttpResponses;

class CategoriesController extends Controller
{
    use HttpResponses;

    public function getAllCategories()
    {
        return CategoriesResource::collection(Categorie::with('parentCategorie')->get());
    }
}
