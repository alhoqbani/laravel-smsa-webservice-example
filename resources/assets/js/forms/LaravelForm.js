import Errors from './Errors';
import axois from 'axios';

class LaravelForm {

    constructor(data) {

        this.data = {};

        Object.assign(this.data, data);

        this.busy = false;
        this.successful = false;
        this.errors = new Errors();
    }

    valid() {
        return this.errors.any();
    }

    startProcessing() {
        this.busy = true;
        this.successful = false;
        this.errors.delete();
    }

    finishProcessing() {
        this.busy = false;
        this.successful = true;
        this.errors.delete();
    }

    failedForm() {
        this.busy = false;
        this.successful = false;
    }


    get(url, config) {

        let request = axois.get(url, Object.assign({params: this.data}, config));

        return this.submitForm(request);
    }

    post(url, config) {

        let request = axois.post(url, this.data, config);

        return this.submitForm(request);
    }

    submitForm(request) {

        return new Promise((resolve, reject) => {
            this.startProcessing();
            request
                .then(res => {
                    this.finishProcessing();

                    resolve(res.data)
                })
                .catch(error => {
                    this.failedForm();
                    if (error.response.status === 422) {
                        this.errors.setErrors(error.response.data.errors);
                    }
                    reject(error.response);
                });
        });
    }

}


export default LaravelForm;