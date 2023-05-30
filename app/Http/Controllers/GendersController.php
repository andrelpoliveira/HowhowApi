<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\GetGendersResource;
use App\Models\Genders;

class GendersController extends Controller
{
    public function getGenders()
    {
        return GetGendersResource::collection(Genders::all());
    }
}
