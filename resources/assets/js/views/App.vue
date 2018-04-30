<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <nav class="nav nav-pills nav-justified">
                        <router-link class="nav-item nav-link"
                                     :to="{name: 'home'}"
                                     exact>Home
                        </router-link>
                        <router-link class="nav-item nav-link"
                                     :to="{name: 'shipments'}">Shipments
                        </router-link>
                        <router-link class="nav-item nav-link"
                                     :to="{name: 'track'}">Tracking
                        </router-link>
                        <router-link class="nav-item nav-link"
                                     :to="{name: 'locations'}">Locations
                        </router-link>
                    </nav>

                    <hr>

                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['cities', 'retails'],
        name: 'App',
        created() {
            window.smsaCities = this.cities;
            window.smsaRetails = this.retails;
        }
    }
</script>