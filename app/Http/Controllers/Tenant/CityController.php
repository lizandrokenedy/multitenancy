<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\City;

class CityController extends Controller
{
    public function getCitiesFromStates($idState)
    {
        $data = City::where('state_id', $idState)->get(['id', 'name']);

        return $this->responseDataSuccess($data);
    }
}
