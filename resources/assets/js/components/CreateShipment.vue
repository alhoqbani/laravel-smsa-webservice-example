<template>
    <div class="container py-3">

        <div class="row justify-content-center" v-if="message && !this.form.busy">
            <div class="col-12">
                <div class="alert fade show"
                     :class="[this.form.successful ? 'alert-info' : 'alert-danger']">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    {{ message }}
                </div>
            </div>
        </div>

        <div class="row justify-content-center" v-if="showResult">
            <div class="col-12">
                <div class="alert fade show alert-primary" :class="[result.success ? 'alert-primary' : 'alert-danger']">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    <h4 class="alert-heading" v-if="result.success">Shipment created successfully.</h4>
                    <h4 class="alert-heading" v-else>Request Failed.</h4>
                    <div class="d-flex justify-content-between">
                        <p>{{ result.data || result.error }}</p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark align-self-end" data-toggle="modal"
                                data-target="#resultModal">Full Result
                        </button>
                    </div>
                    <ResultModal :result="result"></ResultModal>
                </div>
            </div>
        </div>

        <div class="row py-1">
            <div class="mx-auto col-lg-6 mt-lg-2">
                <div class="form-group form-row">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="all-fields" name="allFields"
                               class="custom-control-input"
                               :value="false" v-model="minimumFields">
                        <label class="custom-control-label"
                               for="all-fields">Display all fields.</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="minimum-fields" name="minimumFields"
                               class="custom-control-input"
                               :value="true" v-model="minimumFields">
                        <label class="custom-control-label"
                               for="minimum-fields">Display only minimum required fields.</label>
                    </div>
                </div>
            </div>
        </div>

        <form class="form" role="form">

            <div class="row py-1">
                <div class="mx-auto col-lg-6 mt-lg-2">
                    <!-- form customer info -->
                    <div class="card">
                        <div class="card-header" @click="openCard.customer = ! openCard.customer"
                             style="cursor: pointer">
                            <h4 class="mb-0"><i class="fas"
                                                :class="[openCard.customer ? 'fa-caret-down' : 'fa-caret-right']"></i>
                                Customer</h4>
                        </div>
                        <div class="card-body" v-show="openCard.customer">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-name">Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.name')}"
                                           type="text"
                                           id="customer-name"
                                           required
                                           v-model="form.data.customer.name">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.name')">{{ form.errors.get('customer.name') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-mobile">Mobile</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.mobile')}"
                                           type="text"
                                           id="customer-mobile"
                                           required
                                           v-model="form.data.customer.mobile">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.mobile')">{{ form.errors.get('customer.mobile') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-address-1">Address
                                    Line 1</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.addressLine1')}"
                                           type="text"
                                           id="customer-address-1"
                                           required
                                           v-model="form.data.customer.addressLine1">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.addressLine1')">{{ form.errors.get('customer.addressLine1') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-address-2">Address
                                    Line 2</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.addressLine2')}"
                                           type="text"
                                           id="customer-address-2"
                                           required
                                           v-model="form.data.customer.addressLine2">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.addressLine2')">{{ form.errors.get('customer.addressLine2') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-city">City</label>
                                <div class="col-lg-9">
                                    <select id="customer-city" size="0"
                                            class="form-control custom-select"
                                            :class="{'is-invalid': form.errors.has('customer.city')}"
                                            required
                                            v-model="form.data.customer.city">
                                        <option value="other">Other</option>
                                        <option value="" selected disabled>Choose a city</option>
                                        <option v-for="city of cities" :value="city.name">{{city.name}}</option>
                                    </select>

                                    <input class="form-control mt-1"
                                           :class="{'is-invalid': form.errors.has('customer.city')}"
                                           type="text"
                                           required
                                           placeholder="customer city"
                                           v-if="showOtherCity || otherCity"
                                           v-model="otherCity">

                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.city')">{{ form.errors.get('customer.city') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-country">Country</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.country')}"
                                           type="text"
                                           id="customer-country"
                                           required
                                           v-model="form.data.customer.country">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.country')">{{ form.errors.get('customer.country') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-zip">Zip
                                    Code</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.zipCode')}"
                                           type="text"
                                           id="customer-zip"
                                           v-model="form.data.customer.zipCode">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.zipCode')">{{ form.errors.get('customer.zipCode') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-po-box">PO
                                    Box</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.POBox')}"
                                           type="text"
                                           id="customer-po-box"
                                           v-model="form.data.customer.POBox">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.POBox')">{{ form.errors.get('customer.POBox') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-tel-1">Tel
                                    1</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.tel1')}"
                                           type="text"
                                           id="customer-tel-1"
                                           v-model="form.data.customer.tel1">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.tel1')">{{ form.errors.get('customer.tel1') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="customer-tel-2">Tel
                                    2</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.tel2')}"
                                           type="text"
                                           id="customer-tel-2"
                                           v-model="form.data.customer.tel2">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.tel2')">{{ form.errors.get('customer.tel2') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="customer-email">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('customer.email')}"
                                           type="email"
                                           id="customer-email"
                                           v-model="form.data.customer.email">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('customer.email')">{{ form.errors.get('customer.email') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /form user info -->
                </div>
            </div>

            <div class="row py-1">
                <div class="mx-auto col-lg-6 mt-md-2">
                    <!-- form shipment info -->
                    <div class="card">
                        <div class="card-header" @click="openCard.shipment = ! openCard.shipment"
                             style="cursor: pointer">
                            <h4 class="mb-0"><i class="fas"
                                                :class="[openCard.shipment ? 'fa-caret-down' : 'fa-caret-right']"></i>
                                Shipment</h4>
                        </div>
                        <div class="card-body" v-show="openCard.shipment">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-type">Type</label>
                                <div class="col-lg-9">
                                    <select id="shipment-type" size="0"
                                            class="form-control custom-select"
                                            :class="{'is-invalid': form.errors.has('shipment.type')}"
                                            required
                                            v-model="form.data.shipment.type">
                                        <option value="DLV" selected>DLV</option>
                                        <option value="VAL">VAL</option>
                                        <option value="HAL">HAL</option>
                                        <option value="BLT">BLT</option>
                                    </select>
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.type')">{{ form.errors.get('shipment.type') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-ref">Reference
                                    Number</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.referenceNumber')}"
                                           type="text"
                                           id="shipment-ref"
                                           v-model="form.data.shipment.referenceNumber">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.referenceNumber')">{{ form.errors.get('shipment.referenceNumber') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-count">Items
                                    Count</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.itemsCount')}"
                                           type="text"
                                           id="shipment-count"
                                           v-model="form.data.shipment.itemsCount">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.itemsCount')">{{ form.errors.get('shipment.itemsCount') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-weight">Weight</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.weight')}"
                                           type="text"
                                           id="shipment-weight"
                                           v-model="form.data.shipment.weight">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.weight')">{{ form.errors.get('shipment.weight') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-id">Id</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.id')}"
                                           type="text"
                                           id="shipment-id"
                                           v-model="form.data.shipment.id">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.id')">{{ form.errors.get('shipment.id') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-description">Description</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.description')}"
                                           type="text"
                                           id="shipment-description"
                                           v-model="form.data.shipment.description">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.description')">{{ form.errors.get('shipment.description') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-sent-date">Sent
                                    Date</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.sentDate')}"
                                           type="text"
                                           id="shipment-sent-date"
                                           v-model="form.data.shipment.sentDate">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.sentDate')">{{ form.errors.get('shipment.sentDate') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-cod">Cash On
                                    Delivery</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.cashOnDelivery')}"
                                           type="text"
                                           id="shipment-cod"
                                           v-model="form.data.shipment.cashOnDelivery">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.cashOnDelivery')">{{ form.errors.get('shipment.cashOnDelivery') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-value">Value</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.value')}"
                                           type="text"
                                           id="shipment-value"
                                           v-model="form.data.shipment.value">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.value')">{{ form.errors.get('shipment.value') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-currency">Currency</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.defaultCurrency')}"
                                           type="text"
                                           id="shipment-currency"
                                           v-model="form.data.shipment.defaultCurrency">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.defaultCurrency')">{{ form.errors.get('shipment.defaultCurrency') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipment-customs">Customs</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.customs')}"
                                           type="text"
                                           id="shipment-customs"
                                           v-model="form.data.shipment.customs">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.customs')">{{ form.errors.get('shipment.customs') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-insurance">Insurance</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.insurance')}"
                                           type="text"
                                           id="shipment-insurance"
                                           v-model="form.data.shipment.insurance">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.insurance')">{{ form.errors.get('shipment.insurance') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-delivery-date">Delivery
                                    Date</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.deliveryDate')}"
                                           type="text"
                                           id="shipment-delivery-date"
                                           v-model="form.data.shipment.deliveryDate">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.deliveryDate')">{{ form.errors.get('shipment.deliveryDate') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipment-gps">GPS
                                    Points</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipment.gpsPoints')}"
                                           type="text"
                                           id="shipment-gps"
                                           v-model="form.data.shipment.gpsPoints">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipment.gpsPoints')">{{ form.errors.get('shipment.gpsPoints') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-1">
                <div class="mx-auto col-lg-6 mt-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group form-row">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="add-shipper"
                                           v-model="form.data.addShipper">
                                    <label class="custom-control-label" for="add-shipper">Add shipper details?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-1" v-if="form.data.addShipper">
                <div class="mx-auto col-lg-6 mt-lg-2">
                    <!-- form shipper info -->
                    <div class="card">
                        <div class="card-header" @click="openCard.shipper = ! openCard.shipper" style="cursor: pointer">
                            <h4 class="mb-0"><i class="fas"
                                                :class="[openCard.shipper ? 'fa-caret-down' : 'fa-caret-right']"></i>
                                Shipper</h4>
                        </div>
                        <div class="card-body" v-show="openCard.shipper">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-name">Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipper.name')}"
                                           type="text"
                                           id="shipper-name"
                                           v-model="form.data.shipper.name">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipper.name')">{{ form.errors.get('shipper.name') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipper-contact-name">Contact
                                    Name</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipper.contactName')}"
                                           type="text"
                                           id="shipper-contact-name"
                                           v-model="form.data.shipper.contactName">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipper.contactName')">{{ form.errors.get('shipper.contactName') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipper-address-1">Address
                                    Line 1</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipper.addressLine1')}"
                                           type="text"
                                           id="shipper-address-1"
                                           v-model="form.data.shipper.addressLine1">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipper.addressLine1')">{{ form.errors.get('shipper.addressLine1') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row" v-if=" ! minimumFields">
                                <label class="col-lg-3 col-form-label form-control-label" for="shipper-address-2">Address
                                    Line 2</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipper.addressLine2')}"
                                           type="text"
                                           id="shipper-address-2"
                                           v-model="form.data.shipper.addressLine2">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipper.addressLine2')">{{ form.errors.get('shipper.addressLine2') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-city">City</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipper.city')}"
                                           type="text"
                                           id="shipper-city"
                                           v-model="form.data.shipper.city">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipper.city')">{{ form.errors.get('shipper.city') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-country">Country</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipper.country')}"
                                           type="text"
                                           id="shipper-country"
                                           v-model="form.data.shipper.country">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipper.country')">{{ form.errors.get('shipper.country') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="shipper-phone">Phone</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('shipper.phone')}"
                                           type="tel"
                                           id="shipper-phone"
                                           v-model="form.data.shipper.phone">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('shipper.phone')">{{ form.errors.get('shipper.phone') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-1">
                <div class="mx-auto col-lg-6 mt-lg-2">
                    <div class="form-group row">
                        <button class="btn btn-primary btn-block" @click.prevent="submitForm()">Submit</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</template>
<script>
    import LaravelForm from '../forms/LaravelForm';
    import ResultModal from '../components/ResultModal';

    export default {
        name: 'CreateShipment',
        components: {ResultModal},
        data() {
            return {
                cities: window.smsaCities,
                minimumFields: true,
                message: '',
                showResult: false,
                result: {
                    success: '',
                    data: '',
                    error: '',
                    type: '',
                    payload: {},
                    request: '',
                    response: '',
                },
                openCard: {
                    customer: true,
                    shipment: true,
                    shipper: true,
                },
                showOtherCity: false,
                otherCity: '',
                form: new LaravelForm({
                    addShipper: '',
                    customer: {
                        name: '',
                        mobile: '',
                        addressLine1: '',
                        addressLine2: '',
                        city: '',
                        country: 'Saudi Arabia',
                        zipCode: '',
                        POBox: '',
                        tel1: '',
                        tel2: '',
                        email: '',
                    },
                    shipment: {
                        type: 'DLV',
                        referenceNumber: Math.floor(Date.now() / 1000).toString(),
                        itemsCount: '',
                        weight: '',
                        id: '',
                        description: '',
                        sentDate: '',
                        cashOnDelivery: '',
                        defaultCurrency: '',
                        value: '',
                        customs: '',
                        insurance: '',
                        deliveryDate: '',
                        gpsPoints: '',
                    },
                    shipper: {
                        name: '',
                        contactName: '',
                        addressLine1: '',
                        addressLine2: '',
                        city: '',
                        country: 'Saudi Arabia',
                        phone: '',
                    },
                }),
            }
        },

        computed: {
            city() {
                return this.form.data.customer.city;
            }
        },

        watch: {
            city(selectedCity) {
                // If the selected city is not from the cities array, we display other cities input field
                let city = this.cities.find(city => city.name === selectedCity);

                if (selectedCity === 'other' || city === undefined) {
                    this.showOtherCity = true;
                } else {
                    this.showOtherCity = false;
                    this.otherCity = null;
                }
            }
        },

        methods: {
            submitForm() {

                if (this.showOtherCity) {
                    this.form.data.customer.city = this.otherCity;
                }

                this.form.data.minimumFields = this.minimumFields;
                this.message = '';
                this.showResult = false;
                let vm = this;

                this.form.post('/api/shipments')

                    .then(res => {
                        console.log("Res from component", res);


                        if (res.success) {
                            vm.form.data = {
                                customer: {},
                                shipment: {
                                    referenceNumber: Math.floor(Date.now() / 1000).toString(),
                                },
                                shipper: {},
                            };
                        }

                        vm.result = res;
                        vm.showResult = true;
                    })

                    .catch(response => {
                        console.log("error response from create shipment component", response);
                        if (response.status === 400) {
                            vm.result = response.data;
                            vm.showResult = true;
                            return;
                        }

                        vm.message = response.data.message;
                    })

                    .finally(() => window.scrollTo(0, 0))
            }
        }


    }
</script>