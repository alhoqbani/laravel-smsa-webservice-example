<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShipmentsController extends Controller
{


    public function store(Request $request)
    {
        $this->validate($request, [
            'customer.name'         => ['required'],
            'customer.mobile'       => ['required'],
            'customer.addressLine1' => ['required'],
            'customer.addressLine2' => ['required'],
            'customer.city'         => ['required'],
            'customer.country'      => ['required'],
            'customer.zipCode'      => ['required'],
            'customer.POBox'        => ['required'],
            'customer.tel1'         => ['required'],
            'customer.tel2'         => ['required'],
            'customer.email'        => ['required'],

            'shipment.type'            => ['required'],
            'shipment.referenceNumber' => ['required'],
            'shipment.itemsCount'      => ['required'],
            'shipment.weight'          => ['required'],
            'shipment.id'              => ['required'],
            'shipment.description'     => ['required'],
            'shipment.sentDate'        => ['required'],
            'shipment.cashOnDelivery'  => ['required'],
            'shipment.defaultCurrency' => ['required'],
            'shipment.value'           => ['required'],
            'shipment.customs'         => ['required'],
            'shipment.insurance'       => ['required'],
            'shipment.deliveryDate'    => ['required'],
            'shipment.gpsPoints'       => ['required'],

            'shipper.name'         => ['required'],
            'shipper.contactName'  => ['required'],
            'shipper.addressLine1' => ['required'],
            'shipper.addressLine2' => ['required'],
            'shipper.city'         => ['required'],
            'shipper.country'      => ['required'],
            'shipper.phone'        => ['required'],

        ]);

        return $request->all();
    }

}
