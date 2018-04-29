<template>
    <div class="mt-5">
        <div class="row justify-content-center" v-if="message">
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

        <div class="card bg-light" v-if="showTrack">
            <div class="card-body col-md-8">
                <div class="card-title">
                    <h4>Tracking Information:</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th scope="row">AWB</th>
                            <td>{{track.awb}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Date</th>
                            <td>{{track.date}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Activity</th>
                            <td>{{track.activity}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Details</th>
                            <td>{{track.details}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Location</th>
                            <td>{{track.location}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Reference</th>
                            <td>{{track.reference}}</td>
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
        name: 'Track',

        data() {
            return {
                form: new LaravelForm({
                    awb: '',
                    reason: '',
                }),
                message: '',
                showTrack: false,
                track: {
                    awb: '',
                    date: '',
                    activity: '',
                    details: '',
                    location: '',
                    reference: ''
                }
            }
        },

        methods: {
            submitForm() {
                this.showTrack = false;
                let vm = this;
                this.form.get('/api/tracking/track')

                    .then(data => {
                        this.track = data.track;
                        this.showTrack = true;
                    })

                    .catch(response => {

                        if (response.status === 400) {
                            vm.message = response.data.error;
                        }

                    });
            }
        }
    }
</script>