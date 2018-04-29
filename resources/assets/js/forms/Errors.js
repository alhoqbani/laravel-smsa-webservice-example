class Errors {

    constructor() {
        this.errors = [];
    }

    has(field) {
        return this.errors.find(error => error.field === field) !== undefined;
    }

    any() {
        return this.errors.length > 0;
    }

    get(field) {

        let error = this.errors.find(error => error.field === field);

        if (error !== undefined) {
            return error.message
        }

    }

    all() {
        return this.errors;
    }

    set(field, message) {
        this.errors.push({
            field,
            message
        });
    }

    setErrors(errors) {

        for (let field in errors) {
            if (errors.hasOwnProperty(field)) {
                this.set(field, errors[field][0])
            }
        }

    }

    delete(field) {

        if (field) {
            let index = this.errors.findIndex(error => error.field === field);
            if (index !== -1) {
                this.errors.splice(index, 1)
            }

            return;
        }

        this.errors = [];
    }

}

export default Errors;