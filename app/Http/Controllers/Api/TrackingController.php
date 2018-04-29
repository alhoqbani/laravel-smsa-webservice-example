<?php

namespace App\Http\Controllers\Api;

use Alhoqbani\SmsaWebService\Exceptions\FailedResponse;
use Alhoqbani\SmsaWebService\Exceptions\RequestError;
use Alhoqbani\SmsaWebService\Exceptions\SmsaWebServiceException;
use Alhoqbani\SmsaWebService\Smsa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackingController extends Controller
{


    public function status(Request $request, Smsa $smsa)
    {
        $data = $request->validate([
           'awb' => ['required', 'numeric']
        ]);

        try {

            $status = $smsa->status($data['awb']);

            return response()->json([
               'status' => $status->data
            ]);

        } catch (SmsaWebServiceException $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'type' => get_class($e)
            ], 400);

        }


    }

    public function track(Request $request, Smsa $smsa)
    {
        $data = $request->validate([
            'awb' => ['required', 'numeric']
        ]);

        try {

            $track = $smsa->track($data['awb']);

            return response()->json([
                'track' => $track->data
            ]);

        } catch (SmsaWebServiceException $e) {

            return response()->json([
                'message' => $e->getMessage(),
                'type' => get_class($e)
            ], 400);

        }

    }


}
