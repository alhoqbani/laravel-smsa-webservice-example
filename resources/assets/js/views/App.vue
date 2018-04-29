<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <nav class="nav nav-pills nav-justified">
                        <router-link class="nav-item nav-link"
                                     to="/"
                                     activeClass="active"
                                     exact>Home

                        </router-link>
                        <router-link class="nav-item nav-link"
                                     to="/locations"
                                     activeClass="active">Locations
                        </router-link>
                        <router-link class="nav-item nav-link"
                                     to="/Tracking"
                                     activeClass="active">Tracking
                        </router-link>
                        <router-link class="nav-item nav-link"
                                     to="/shipments"
                                     activeClass="active">Shipments
                        </router-link>
                    </nav>


                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App'
    }
</script>