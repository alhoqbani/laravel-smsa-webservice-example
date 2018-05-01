<?php

namespace App\Http\Controllers\Api;

use Alhoqbani\SmsaWebService\Smsa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfsController extends Controller
{

    /**
     * @param Request $request
     * @param Smsa    $smsa
     * @return \Illuminate\Http\JsonResponse
     * @throws \Alhoqbani\SmsaWebService\Exceptions\RequestError
     */
    public function show(Request $request, Smsa $smsa)
    {
        $data = $request->validate([
            'awb' => ['required'],
        ]);

        // Disable throwing exceptions
        $smsa->shouldUseExceptions = false;

        $result = $smsa->awbPDF($data['awb']);

        if ($result->success) {

            $response = $result->jsonSerialize();

            // We can save the file to a local file, to download it later.
            Storage::put('pdfs/' . $data['awb'] . '.pdf', $result->data);

            // PDFs are sent as binary, so it must be converted to base64 to send it as json.
            $response['data'] = base64_encode($result->data);

            return response()->json($response);

        } else {
            return response()->json($result->jsonSerialize(), 400);
        }

    }
}
