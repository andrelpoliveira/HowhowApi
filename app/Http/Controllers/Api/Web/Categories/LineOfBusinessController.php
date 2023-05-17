<?php

namespace App\Http\Controllers\Api\Web\Categories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LineOfBusinessResource;
use App\Models\LineOfbusiness;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;

class LineOfBusinessController extends Controller
{
    use HttpResponses;

    public function getAllLines()
    {
        return LineOfBusinessResource::collection(DB::table('line_of_business')->get());
    }
}
