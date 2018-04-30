<?php

namespace App\Http\Controllers\Api;

use Alhoqbani\SmsaWebService\Exceptions\SmsaWebServiceException;
use Alhoqbani\SmsaWebService\Models\Customer;
use Alhoqbani\SmsaWebService\Models\Shipment;
use Alhoqbani\SmsaWebService\Models\Shipper;
use Alhoqbani\SmsaWebService\Smsa;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreShipmentRequest;

class ShipmentsController extends Controller
{


    public function store(StoreShipmentRequest $request, Smsa $smsa)
    {
        $data = $request->validated();

        // Minimum required fields to create a shipment.
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

        // We add the shipper if we have shipper details
        if (true === $request->input('addShipper', false)) {

            $shipper = new Shipper(
                data_get($data, 'shipper.name'),
                data_get($data, 'shipper.contactName'),
                data_get($data, 'shipper.addressLine1'),
                data_get($data, 'shipper.addressLine2', ''),
                data_get($data, 'shipper.city'),
                data_get($data, 'shipper.country'),
                data_get($data, 'shipper.phone')
            );

            $shipment->setShipper($shipper);
        }

        // Additional fields.
        // We add more fields if the request includes any extra fields.
        if (false === $request->input('minimumFields', false)) {

            $customerDetails = $data['customer'];
            $customer
                ->setAddressLine2($customerDetails['addressLine2'] ?? '')
                ->setZipCode($customerDetails['zipCode'] ?? '')
                ->setPOBox($customerDetails['POBox'] ?? '')
                ->setTel1($customerDetails['tel1'] ?? '')
                ->setTel2($customerDetails['tel2'] ?? '')
                ->setEmail($customerDetails['email'] ?? '');

            $shipmentDetails = $data['shipment'];
            $shipment
                ->setId($shipmentDetails['id'] ?? '')
                ->setDescription($shipmentDetails['description'] ?? '')
                ->setSentDate($shipmentDetails['sentDate'] ?? '')
                ->setCashOnDelivery($shipmentDetails['cashOnDelivery'] ?? 0)
                ->setDefaultCurrency($shipmentDetails['defaultCurrency'] ?? '')
                ->setValue($shipmentDetails['value'] ?? '')
                ->setCustoms($shipmentDetails['customs'] ?? '')
                ->setInsurance($shipmentDetails['insurance'] ?? '')
                ->setDeliveryDate($shipmentDetails['deliveryDate'] ?? '')
                ->setGpsPoints($shipmentDetails['gpsPoints'] ?? '');
        }

        try {

            $result = $smsa->createShipment($shipment);

            return response()->json($result->jsonSerialize(), 201);

        } catch (SmsaWebServiceException $e) {

            return response()->json(
                $e->smsaResponse->jsonSerialize()
                , 400);
        }
    }

}
