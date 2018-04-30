<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class StoreShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->mandatoryFields();

        $shipperFields = [
            'shipper.name'         => ['required'],
            'shipper.contactName'  => ['required'],
            'shipper.addressLine1' => ['required'],
            'shipper.city'         => ['required'],
            'shipper.country'      => ['required'],
            'shipper.phone'        => ['required'],

            'shipper.addressLine2' => [''],
        ];

        $optionalFields = [
            'customer.addressLine2' => [''],
            'customer.zipCode'      => [''],
            'customer.POBox'        => [''],
            'customer.tel1'         => [''],
            'customer.tel2'         => [''],
            'customer.email'        => [''],

            'shipment.id'              => [''],
            'shipment.description'     => [''],
            'shipment.sentDate'        => [''],
            'shipment.cashOnDelivery'  => [''],
            'shipment.defaultCurrency' => [''],
            'shipment.value'           => [''],
            'shipment.customs'         => [''],
            'shipment.insurance'       => [''],
            'shipment.deliveryDate'    => [''],
            'shipment.gpsPoints'       => [''],
        ];

        if ($this->input('addShipper')) {
            $rules = array_merge($rules, $shipperFields);
        }

        if (false === $this->input('minimumFields', false)) {
            $rules = array_merge($rules, $optionalFields);
        }

        return $rules;

    }

    private function mandatoryFields()
    {

        return [
            'customer.name'         => ['required'],
            'customer.mobile'       => ['required'],
            'customer.addressLine1' => ['required'],
            'customer.city'         => ['required'],
            'customer.country'      => ['required'],

            'shipment.type'            => ['required'],
            'shipment.referenceNumber' => ['required'],
            'shipment.itemsCount'      => ['required'],
            'shipment.weight'          => ['required'],
        ];
    }
}
