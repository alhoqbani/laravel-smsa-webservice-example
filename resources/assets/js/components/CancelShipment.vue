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
                    <h4 class="alert-heading" v-if="result.success">Shipment was canceled successfully.</h4>
                    <h4 class="alert-heading" v-else>Request Failed.</h4>
                    <div class="d-flex justify-content-between">
                        <p><strong>SMSA Response:</strong> {{ result.data || result.error }}</p>
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
                <form class="form" role="form">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Cancel Shipment</h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="awb">AWB</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('awb')}"
                                           type="text"
                                           id="awb"
                                           required
                                           v-model="form.data.awb">
                                    <small class="text-muted">Example: 290019315792</small>
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('awb')">{{ form.errors.get('awb') }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"
                                       for="reason">Reason</label>
                                <div class="col-lg-9">
                                    <input class="form-control"
                                           :class="{'is-invalid': form.errors.has('reason')}"
                                           type="text"
                                           id="reason"
                                           required
                                           v-model="form.data.reason">
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('reason')">{{ form.errors.get('reason') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row py-1">
                                <p class="text-muted px-2">Tip: To test cancellation create a shipment and use its awb.</p>
                                <div class="mx-auto col-lg-6 mt-lg-2">
                                    <div class="form-group row">
                                        <button class="btn btn-outline-danger btn-block" @click.prevent="submitForm()">
                                            Cancel Shipment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import LaravelForm from '../forms/LaravelForm';
    import ResultModal from '../components/ResultModal';

    export default {
        name: 'CancelShipment',
        components: {ResultModal},
        data() {
            return {
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
                form: new LaravelForm({
                    awb: '',
                    reason: '',
                }),
            }
        },

        methods: {
            submitForm() {

                this.message = '';
                this.showResult = false;
                let vm = this;

                if (this.form.data.awb.length === 0) {
                    this.form.errors.set('awb', 'awb field is required');

                    return;
                }

                this.form.delete(`/api/shipments/${this.form.data.awb}`, {params: {reason: this.form.data.reason}})

                    .then(res => {
                        console.log("Res from component", res);

                        if (res.success) {
                            vm.form.data = {};
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