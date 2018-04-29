<?php

namespace App\Http\Controllers\Api;

use Alhoqbani\SmsaWebService\Exceptions\RequestError;
use Alhoqbani\SmsaWebService\Smsa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RetailsController extends Controller
{

    public function index(Smsa $smsa, Request $request, $city = null)
    {

        try {

            $retails = $city ? $smsa->retailsIn($city) : $smsa->retails();

            return response()->json([
                'retails' => $retails->data
            ]);


        } catch (RequestError $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

    }
}
