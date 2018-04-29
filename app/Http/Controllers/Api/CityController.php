<?php

namespace App\Http\Controllers\Api;

use Alhoqbani\SmsaWebService\Smsa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{


    /**
     * List all cities
     *
     * @param Smsa $smsa
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Smsa $smsa)
    {
        return response()->json([
            'cities'
        ]);
    }
}
