<template>
    <div>
        Tracking Page
    </div>
</template>

<script>
    export default {
        name: 'Tracking',

        mounted() {

            // axios.get('/api/tracking/status', {params: {awb: 290019315792}})
            //     .then(res => console.log(res))
            //     .catch(err => console.log(err.response));


            axios.get('/api/tracking/track', {params: {awb: 290019315792}})
                .then(res => console.log(res))
                .catch(err => console.log(err.response));

        }

    }
</script>