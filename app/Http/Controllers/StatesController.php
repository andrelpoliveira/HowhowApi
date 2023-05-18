<?php

namespace App\Http\Controllers;

use App\Http\Resources\GetStatesResource;
use Illuminate\Http\Request;
use App\Models\States;

class StatesController extends Controller
{
    public function getStates()
    {
        return GetStatesResource::collection(States::all());
    }
}
