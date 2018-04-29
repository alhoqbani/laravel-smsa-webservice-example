<template>
    <div class="mt-5">
        <div class="row justify-content-center" v-if="message && !this.form.busy">
            <div class="col-12">
                <div class="alert alert-dismissible fade show"
                     :class="[this.form.successful ? 'alert-info' : 'alert-danger']">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    {{ message }}
                </div>
            </div>
        </div>
        <form>
            <div class="form-group row">

                <div class="col-md-4">
                    <input id="awb" type="text"
                           class="form-control" :class="{'is-invalid': form.errors.has('awb')}"
                           name="awb" placeholder="awb" v-model="form.data.awb">
                    <small class="text-muted">Example: 290019315792</small>
                    <span class="invalid-feedback" v-show="form.errors.has('awb')">{{ form.errors.get('awb') }}</span>
                </div>

                <div class="col-md-2">

                    <button type="submit" class="btn btn-outline-success" @click.prevent="submitForm" disabled
                            v-if="form.busy">
                        <i class="fa fa-btn fa-spinner fa-spin"></i> Submit
                    </button>
                    <button type="submit" class="btn btn-outline-success" @click.prevent="submitForm" v-else>
                        Submit
                    </button>
                </div>
            </div>
        </form>

        <div class="card bg-light" v-if="status">
            <div class="card-body col-md-8">
                <div class="card-title">
                    <h4>Shipment status:</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th scope="row">Status</th>
                            <td>{{status}}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    import LaravelForm from '../forms/LaravelForm';

    export default {
        name: 'Status',

        data() {
            return {
                form: new LaravelForm({
                    awb: '',
                }),
                message: '',
                status: '',
            }
        },

        methods: {
            submitForm() {
                this.status = false;
                let vm = this;
                this.form.get('/api/tracking/status')

                    .then(data => {
                        this.status = data.status;
                    })

                    .catch(response => {
                        vm.message = response.data.message;
                    });
            }
        }
    }
</script>