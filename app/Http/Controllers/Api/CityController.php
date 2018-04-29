<?php

namespace App\Http\Controllers\Api;

use Alhoqbani\SmsaWebService\Exceptions\RequestError;
use Alhoqbani\SmsaWebService\Smsa;
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

        try {

            $cities = $smsa->cities()->data;

            return response()->json([
                'cities' => $cities,
            ]);

        } catch (RequestError $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 400);

        }

    }
}
