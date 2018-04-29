<template>
    <div>
        Locations Page
    </div>
</template>

<script>
    export default {
        name: 'Locations',


        mounted() {
            axios.get('/api/cities')
                .then(res => console.log(res))
                .catch(err => console.log(err));
        }
    }

</script>