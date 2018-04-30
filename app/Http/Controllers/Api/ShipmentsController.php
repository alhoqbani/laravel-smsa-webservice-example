<?php

namespace App\Http\Controllers\Api;

use Alhoqbani\SmsaWebService\Exceptions\SmsaWebServiceException;
use Alhoqbani\SmsaWebService\Models\Customer;
use Alhoqbani\SmsaWebService\Models\Shipment;
use Alhoqbani\SmsaWebService\Smsa;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreShipmentRequest;

class ShipmentsController extends Controller
{


    public function store(StoreShipmentRequest $request, Smsa $smsa)
    {
        $data = $request->validated();


        $customer = new Customer(
            data_get($data, 'customer.name'),
            data_get($data, 'customer.mobile'),
            data_get($data, 'customer.addressLine1'),
            data_get($data, 'customer.city'),
            data_get($data, 'customer.country')
        );

        $shipment = new Shipment(
            data_get($data, 'shipment.referenceNumber'),
            $customer,
            data_get($data, 'shipment.type')
        );


        try {

            $result = $smsa->createShipment($shipment);

            return response()->json($result->jsonSerialize(), 201);

        } catch (SmsaWebServiceException $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

}
