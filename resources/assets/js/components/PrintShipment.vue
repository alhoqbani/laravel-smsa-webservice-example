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
                    <h4 v-if="result.success" class="alert-heading">AWB was printed successfully.</h4>
                    <h4 v-else class="alert-heading">Request Failed.</h4>
                    <div class="d-flex justify-content-between">
                        <a v-if="result.success"
                           :href="pdfLink"
                           :download="pdfFileName"
                           ref="downloadLink"
                           target="_blank"
                           class="btn btn-success">Download pdf</a>
                        <p v-else><strong>SMSA Response: </strong>{{result.error}}</p>
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
                            <h4 class="mb-0">Print AWB</h4>
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
                                    <small class="text-muted">Example: 290019459857</small>
                                    <span class="invalid-feedback"
                                          v-show="form.errors.has('awb')">{{ form.errors.get('awb') }}
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="row py-1">
                                <p class="text-muted px-2">Tip: To print AWB PDF create a shipment and use its awb.</p>
                                <div class="mx-auto col-lg-6 mt-lg-2">
                                    <div class="form-group row">
                                        <button type="submit" class="btn btn-outline-success btn-block"
                                                @click.prevent="submitForm" disabled
                                                v-if="form.busy">
                                            <i class="fa fa-btn fa-spinner fa-spin"></i> Print Shipment
                                        </button>
                                        <button type="submit" class="btn btn-outline-success btn-block"
                                                @click.prevent="submitForm" v-else>
                                            Print Shipment
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
        name: 'PrintShipment',
        components: {ResultModal},
        data() {
            return {
                pdfLink: '',
                pdfFileName: '',
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
                }),
            }
        },

        methods: {
            submitForm() {

                this.message = '';
                this.showResult = false;
                let vm = this;

                this.form.get('/api/shipments/pdf')

                    .then(res => {
                        console.log("Res from component", res);

                        // Prepare download pdf button
                        vm.pdfFileName = vm.form.data.awb + '.pdf';
                        vm.pdfLink = "data:application/octet-stream;base64," + res.data;
                        vm.result = res;
                        vm.showResult = true;
                        vm.form.data = {};

                        // window.open(vm.pdfLink + res.data, '_blank');

                        // Try to download the pdf automatically. (browser might block pop ups)
                        vm.$nextTick(() => {
                            if (vm.$refs.downloadLink !== undefined) {
                                vm.$refs.downloadLink.click();
                            }
                        });
                    })

                    .catch(response => {
                        console.log("error response from print shipment component", response);
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