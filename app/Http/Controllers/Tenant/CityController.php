<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\City;
use Exception;

class CityController extends Controller
{
    public function getCitiesFromStates($idState)
    {
        try {
            $data = City::where('state_id', $idState)->get(['id', 'name']);

            return $this->responseDataSuccess($data);
        } catch (Exception $e) {

            return $this->responseError();
        }
    }
}
