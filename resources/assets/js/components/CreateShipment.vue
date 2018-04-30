<template>
    <div class="container py-3">

        <div class="row">
            <div class="mx-auto col-lg-6 mt-lg-2">
                <!-- form customer info -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Customer</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-name">Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="customer-name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label required"
                                       for="customer-mobile">Mobile</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="customer-mobile" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-address-1">Address
                                    Line 1</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" id="customer-address-1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-address-2">Address
                                    Line 2</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="customer-address-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-city">City</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="customer-city">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-country">Country</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="customer-country">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-zip">Zip
                                    Code</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="customer-zip">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-po-box">PO
                                    Box</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="customer-po-box">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-tel-1">Tel
                                    1</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="customer-tel-1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-tel-2">Tel
                                    2</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="customer-tel-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-email">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="customer-email">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /form user info -->
            </div>
            <div class="mx-auto col-lg-6 mt-md-2">
                <!-- form shipment info -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Shipment</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-type">Type</label>
                                <div class="col-lg-9">
                                    <select id="shipment-type" class="form-control custom-select" size="0">
                                        <option value="DLV" selected>DLV</option>
                                        <option value="VAL">VAL</option>
                                        <option value="HAL">HAL</option>
                                        <option value="BLT">BLT</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-ref">Reference
                                    Number</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="shipment-ref">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-count">Items
                                    Count</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" id="shipment-count">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-weight">Weight</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="shipment-weight">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-id">Id</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-description">Description</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-description">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-sent-date">Sent
                                    Date</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-sent-date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-cod">Cash On
                                    Delivery</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-cod">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-value">Value</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-value">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-customs">Customs</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-customs">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-insurance">Insurance</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-insurance">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-delivery-date">Delivery
                                    Date</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-delivery-date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-gps">GPS
                                    Points</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipment-gps">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <button class="btn btn-primary" @click.prevent="submitForm()">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mx-auto col-lg-6 mt-lg-2">
                <!-- form shipper info -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Shipper</h4>
                    </div>
                    <div class="card-body">
                        <form class="form" role="form">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-name">Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="shipper-name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipper-contact-name">Contact
                                    Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="shipper-contact-name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipper-address-1">Address
                                    Line 1</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" id="shipper-address-1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipper-address-2">Address
                                    Line 2</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="shipper-address-2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-city">City</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipper-city">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-country">Country</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipper-country">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-phone">Phone</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" id="shipper-phone">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import LaravelForm from '../forms/LaravelForm';

    export default {
        name: 'CreateShipment',
        data() {
            return {
                form: new LaravelForm({

                }),
            }
        },

        methods: {
            submitForm() {
                console.log("Submit form")
            }
        }


    }
</script>