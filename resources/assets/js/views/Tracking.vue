<template>
    <div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'track' }">Track</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'status' }">Status</router-link>
            </li>
        </ul>

        <router-view></router-view>

    </div>
</template>

<script>
    export default {
        name: 'Tracking',

        mounted() {

            // axios.get('/api/tracking/status', {params: {awb: 290019315792}})
            //     .then(res => console.log(res))
            //     .catch(err => console.log(err.response));


            // axios.get('/api/tracking/track', {params: {awb: 290019315792}})
            //     .then(res => console.log(res))
            //     .catch(err => console.log(err.response));

        }

    }
</script>