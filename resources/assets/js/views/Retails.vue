<template>
    <div>
        Retails Page
    </div>
</template>

<script>
    export default {
        name: 'Retails',


        mounted() {
            axios.get('/api/retails')
                .then(res => console.log(res))
                .catch(err => console.log(err));
        }
    }
</script>